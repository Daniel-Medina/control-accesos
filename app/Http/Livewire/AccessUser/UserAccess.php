<?php

namespace App\Http\Livewire\AccessUser;

use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAccess extends Component
{

    protected $listeners = ['create'];

    public function render()
    {
        $lastRegister = Register::all()->where('user_id', \auth()->id())->last() ?? [];

        return view('livewire.access-user.user-access', \compact('lastRegister'))->layout('layouts.guest');
    }

    public function create()
    {
        // Validar si existe un registro con el usuario creado
        $lastRegister = Register::all()->where('user_id', \auth()->id())->last() ?? [];

        if ($lastRegister == []) {
            // No existe un registro | Agregar un registro
           Auth::user()->registers()->create([
                'input' => Carbon::now()->toDateTime()
            ]);
            return;
        } else 
        
        // validar si ya paso una hora desde el primer registro de acceso y que no exista la salida
        if (Carbon::parse($lastRegister->input)->addHour(1)->greaterThanOrEqualTo(Carbon::now()->parse()) && $lastRegister->output == '') {
            \session()->flash('message', 'Usted Accedio recientemente al sistema espere antes de registrar la salida.');
            \session()->flash('color', 'red');
            return;
        } else

        // SI existe verificar si existe un registro completo
        if($lastRegister->output == '') {
            // Agregar el valor faltante para terminar la salida
            $lastRegister->update([
                'output' => Carbon::now()->toDateTime()
            ]);

            \session()->flash('message', 'La salida se ha registrado correctamente.');
            \session()->flash('color', 'indigo');

            return;
        } else 
        // Si los registros estan completos verificar el dia si es el mismo dia mostrar una alerta
        if(Carbon::parse($lastRegister->input)->format('d-M-Y') == date('d-M-Y')) {
            \session()->flash('message', 'Ya ha accedido al sistema hoy.');
            \session()->flash('color', 'red');
            return;
        } else if(Carbon::now()->greaterThan(Carbon::parse($lastRegister->input)) ) {
            // Si no existe un registro en el dia actual crear uno nuevo
           Auth::user()->registers()->create([
                'input' => Carbon::now()->toDateTime()
            ]);

            \session()->flash('message', 'El acceso se ha registrado correctamente.');
            \session()->flash('color', 'indigo');
            return;
        } else {
            // Cualquier otra cosa marcar error
            \session()->flash('message', 'ocurrio un error desconocido.');
            \session()->flash('color', 'red');
        }

        
    }
}
