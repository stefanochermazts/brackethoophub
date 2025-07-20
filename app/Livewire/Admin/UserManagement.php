<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editingUser = null;
    public $name = '';
    public $email = '';
    public $role = 'user';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:user,admin',
        'password' => 'nullable|min:8|confirmed',
    ];

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-management', [
            'users' => $users
        ]);
    }

    public function createUser()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function editUser(User $user)
    {
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showModal = true;
    }

    public function saveUser()
    {
        $this->validate();

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        // Se stiamo modificando un utente esistente
        if ($this->editingUser) {
            // Verifica che l'email sia unica (escludendo l'utente corrente)
            $this->validate([
                'email' => 'required|email|max:255|unique:users,email,' . $this->editingUser->id,
            ]);

            $this->editingUser->update($userData);

            // Aggiorna la password solo se fornita
            if ($this->password) {
                $this->editingUser->update([
                    'password' => Hash::make($this->password)
                ]);
            }

            session()->flash('message', 'Utente aggiornato con successo.');
        } else {
            // Verifica che l'email sia unica per nuovi utenti
            $this->validate([
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            $userData['password'] = Hash::make($this->password);
            User::create($userData);

            session()->flash('message', 'Utente creato con successo.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function deleteUser(User $user)
    {
        // Impedisci di eliminare se stessi
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Non puoi eliminare il tuo account.');
            return;
        }

        $user->delete();
        session()->flash('message', 'Utente eliminato con successo.');
        $this->resetPage();
    }

    public function toggleUserStatus(User $user)
    {
        // Impedisci di disabilitare se stessi
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Non puoi modificare il tuo account.');
            return;
        }

        $user->update([
            'email_verified_at' => $user->email_verified_at ? null : now()
        ]);

        session()->flash('message', 'Stato utente aggiornato con successo.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
        $this->role = 'user';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
} 