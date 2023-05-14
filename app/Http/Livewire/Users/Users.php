<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $user;
    // Modal show
    public bool $modal = false;
    public int $modalAction = 0; // 0 = Crear | 1 = Editar

    // Datos del usuario
    public string $name = '';
    public string $lastname = '';
    public string $email = '';
    public string $rol = '';
    public string $password = '';

    //  Escuchar eventos de javascript
    protected $listeners = ['delete'];


    // Al cargar la vista
    public function render()
    {
        // Obtener todos los usuarios menos el de la session
        $users = User::all()->where('id', "!=", \auth()->id());

        return view('livewire.users.users', \compact('users'));
    }


    public function resetUI()
    {
        // Clean the view
        $this->resetErrorBag();
        $this->user = [];
        $this->name = '';
        $this->lastname = '';
        $this->email = '';
        $this->password = '';
        $this->rol = '';
        $this->modal = false;
        $this->modalAction = 0;
    }

    public function create()
    {
        // Opciones para crear un usuario nuevo
        $this->resetUI();
        $this->modalAction = 0;
        $this->modal = true;
    }

    public function show(User $user)
    {
        // Mostrar los datos del usuario a editar en el modal
        $this->modalAction = 1;
        $this->modal = true;
        $this->user = $user;

        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->rol = $user->rol;
    }

    public function store()
    {
        // Validar los datos enviados
        $this->validate([
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users,email',
            'password' => 'required|min:8',
            'rol' => 'required',
        ]);

        // Intentar crear el usuario
        try {
            // Crear el usuario
            $newUser = User::create([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'password' => \bcrypt($this->password),
                'rol' => $this->rol == 'ADMIN' ? 'ADMIN' : 'USER',
            ]);

            // Limpiar la vista
            $this->resetUI();

            // Mostrar el resultado
            session()->flash("message", "El usuario {$newUser->name} se creo con éxito.");
            session()->flash("color", "indigo");
        } catch (\Throwable $th) {
            // Si falla mostrar un error 

            // Limpiar la vista
            $this->resetUI();

            session()->flash("message", "Ocurrio el siguiente error: {$th}");
            session()->flash("color", "red");
        }
    }

    public function update()
    {
        // Validar los campos
        $this->validate([
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|min:3|email|unique:users,email,' . $this->user->id,
            'password' => 'min:8',
            'rol' => 'required',
        ]);

        try {
            // Actualizar al usuario
            $this->user->update([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'password' => $this->password == '' ? $this->user->password : \bcrypt($this->password),
                'rol' => $this->rol == 'ADMIN' ? 'ADMIN' : 'USER',
            ]);

            // Limpiar la vista
            $this->resetUI();

            // Enseñarla respuesta
            session()->flash("message", "El usuario se actualizo con éxito.");
            session()->flash("color", "indigo");

        } catch (\Throwable $th) {
            // Limpiar la vista
            $this->resetUI();
            // Mostrar el error
            session()->flash("message", "Ocurrio el siguiente error: {$th}");
            session()->flash("color", "red");
        }

    }

    public function delete(User $user)
    {
        // guardar el nombre
        $name = $user->name;

        // intentar eliminar al usuario
        try {
            $user->delete();

            // Mostrar el resultado
            session()->flash("message", "El usuario {$name} se elimino con éxito.");
            session()->flash("color", "indigo");

        } catch (\Throwable $th) {
            // SI falla mostrar el error
            session()->flash("message", "Ocurrio el siguiente error: {$th}");
            session()->flash("color", "red");
        }

    }
}
