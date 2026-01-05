<?php

namespace App\Livewire\Superadmin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';

    public $nama, $email, $role, $password, $password_confirmation;

    public function render()
    {
        $data = [
            'title' => 'Data User',
            'user' => User::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('role', 'like', '%' . $this->search . '%')
                ->orderBy('role', 'asc')
                ->paginate($this->paginate),
        ];
        return view('livewire.superadmin.user.index', $data);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['nama', 'email', 'role', 'password', 'password_confirmation']);
    }

    public function store()
    {
        $this->validate(
            [
                'nama' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ],
            [
                'nama.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'role.required' => 'Role tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password harus lebih dari 8 karakter',
                'password.confirmed' => 'Password konfirmasi tidak sama',
                'password_confirmation.required' => 'Password tidak boleh kosong',
            ],
        );
        $user = new User();
        $user->nama = $this->nama;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->password);
        $user->save();

        $this->dispatch('closeCreateModal'); 
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->role= $user->role;
        $this->nama = $user->nama;
        $this->nama = $user->nama;
    }
}
