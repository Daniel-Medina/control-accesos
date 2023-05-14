<!---- Seccion del nombre --->
<div class="flex flex-col w-full first:mt-0 mt-4 border-t border-gray-200">
    <label>Nombre del usuario</label>
    <input type="text" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300'}} mt-2" placeholder="Juan Peréz" wire:model.lazy="name">
    <!---- Errores de validacion --->
    @error('name')
        <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
    @enderror
</div>

<!---- Seccion de apellidos --->
<div class="flex flex-col w-full first:mt-0 mt-4">
    <label>Apellidos del usuario</label>
    <input type="text" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm {{ $errors->has('lastname') ? 'border-red-300' : 'border-gray-300'}} mt-2" placeholder="Mendez Rodriguez" wire:model.lazy="lastname">
    <!---- Errores de validacion --->
    @error('lastname')
        <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
    @enderror
</div>

<!---- Seccion del email --->
<div class="flex flex-col w-full first:mt-0 mt-4">
    <label>Correo electronico</label>
    <input type="text" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm {{ $errors->has('email') ? 'border-red-300' : 'border-gray-300'}} mt-2" placeholder="username@example.com" wire:model.lazy="email">
    <!---- Errores de validacion --->
    @error('email')
        <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
    @enderror
</div>

<!---- Seccion del password --->
<div class="flex flex-col w-full first:mt-0 mt-4">
    <label>Contraseña del usuario <span class="text-sm text-gray-400 {{ $modalAction == 1 ?: 'hidden' }}">(opcional*)</span></label>
    <input type="password" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm {{ $errors->has('password') ? 'border-red-300' : 'border-gray-300'}} mt-2" placeholder="*********" wire:model.lazy="password">
    <!---- Errores de validacion --->
    @error('password')
        <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
    @enderror
</div>

<!---- Seccion del rol --->
<div class="flex flex-col w-full first:mt-0 mt-4">
    <label>Rol del usuario</label>
    <select wire:model="rol" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm {{ $errors->has('rol') ? 'border-red-300' : 'border-gray-300'}} mt-2">
        <option value="0" selected>Seleccione una opción</option>
        <option value="ADMIN">Administrador</option>
        <option value="USER">Usuario</option>
    </select>
    <!---- Errores de validacion --->
    @error('rol')
        <span class="text-red-600 text-sm font-bold">{{ $message }}</span>
    @enderror
</div>