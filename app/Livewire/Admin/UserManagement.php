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
    public $role = 'user';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:user,admin,organizer',
        'password' => 'nullable|min:8|confirmed',
    ];

    public function render()
    {
        $query = User::query();

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
        $this->validate();

        if ($this->editing) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);

            if ($this->password) {
                $user->update(['password' => Hash::make($this->password)]);
            }

            session()->flash('message', 'Utente aggiornato con successo!');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);

            session()->flash('message', 'Utente creato con successo!');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Non puoi eliminare il tuo account!');
            return;
        }

        $user->delete();
        session()->flash('message', 'Utente eliminato con successo!');
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
        $this->role = 'user';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation();
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