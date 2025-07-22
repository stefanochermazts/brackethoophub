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
    public $roleFilter = '';
    public $showModal = false;
    public $editing = false;
    public $userId = null;
    public $name = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $password_confirmation = '';

    // Regole di validazione rimosse per utilizzare validazione dinamica nel metodo save

    public function render()
    {
        $query = User::query();
        $currentUser = auth()->user();

        // Se l'utente è un organizzatore, mostra solo i suoi utenti
        if ($currentUser->isOrganizer()) {
            $query->where('organizer_id', $currentUser->id);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->roleFilter) {
            $query->where('role', $this->roleFilter);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.user-management', compact('users'));
    }

    public function showCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editing = false;
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $currentUser = auth()->user();
        
        // Verifica che l'utente corrente possa modificare questo utente
        if ($currentUser->isOrganizer() && $user->organizer_id !== $currentUser->id) {
            session()->flash('error', __('Non hai i permessi per modificare questo utente.'));
            return;
        }

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showModal = true;
        $this->editing = true;
    }

    public function save()
    {
        // Regole di validazione dinamiche
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:user,admin,organizer,company,coach,player',
        ];

        // Per la creazione, la password è obbligatoria
        if (!$this->editing) {
            $rules['password'] = 'required|min:8|confirmed';
            $rules['email'] .= '|unique:users,email';
        } else {
            // Per la modifica, la password è opzionale e l'email deve essere unica eccetto per l'utente corrente
            $rules['password'] = 'nullable|min:8|confirmed';
            $rules['email'] .= '|unique:users,email,' . $this->userId;
        }

        $this->validate($rules);

        $currentUser = auth()->user();

        if ($this->editing) {
            $user = User::findOrFail($this->userId);
            
            // Verifica che l'utente corrente possa modificare questo utente
            if ($currentUser->isOrganizer() && $user->organizer_id !== $currentUser->id) {
                session()->flash('error', 'Non hai i permessi per modificare questo utente.');
                return;
            }

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);

            if ($this->password) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            session()->flash('message', __('Utente aggiornato con successo!'));
        } else {
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ];

            // Se l'utente corrente è un organizzatore, assegna l'organizer_id
            if ($currentUser->isOrganizer()) {
                $userData['organizer_id'] = $currentUser->id;
            }

            User::create($userData);

            session()->flash('message', __('Utente creato con successo!'));
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $currentUser = auth()->user();
        
        if ($user->id === $currentUser->id) {
            session()->flash('error', __('Non puoi eliminare il tuo account!'));
            return;
        }

        // Verifica che l'utente corrente possa eliminare questo utente
        if ($currentUser->isOrganizer() && $user->organizer_id !== $currentUser->id) {
            session()->flash('error', __('Non hai i permessi per eliminare questo utente.'));
            return;
        }

        $user->delete();
        session()->flash('message', __('Utente eliminato con successo!'));
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->editing = false;
        $this->resetErrorBag();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }
} 