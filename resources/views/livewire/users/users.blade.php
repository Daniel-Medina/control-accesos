<div class="py-6">
    <!----   Mensaje flash ---->
    @if (session()->has('message') && session()->has('color'))
        <div class="w-full bg-{{session('color')}}-600 px-6 py-4 rounded-lg mb-4">
            <p class="text-bold text-xl text-white">{{ session('message') }}</p>
        </div>
    @endif
    

    <div class="bg-white w-full rounded-lg shadow">
        {{-- header --}}
        <div class="flex px-6 py-4 rounded-t-lg justify-between items-center w-full">
            <span class="text-gray-800 text-semibold text-2xl">Lista de todos los usuarios</span>
            <button class="bg-indigo-600 px-6 py-2 text-white text-xl text-bold hover:bg-gray-700 rounded-lg" wire:click.prevent="create()">Agregar</button>
        </div>

        {{-- body --}}
        <div class="border-t border-gray-200">
            {{-- Table --}}
            <div>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="p-2">Imagen</th>
                            <th class="p-2">Nombre/s</th>
                            <th class="p-2">Apellidos</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Rol</th>
                            <th class="p-2">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!---- Recorrer los campos de usuarios --->
                        @forelse ($users as $user)
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-200 border-t border-gray-200">
                                <td class="text-center p-2">
                                    <img src="{{ $user->profile_photo_url }}" class="w-10 h-10 rounded-full object-cover object-center mx-auto" alt="">
                                </td>
                                <td class="text-center p-2">{{ $user->name }}</td>
                                <td class="text-center p-2">{{ $user->lastname }}</td>
                                <td class="text-center p-2">{{ $user->email }}</td>
                                <td class="text-center p-2">{{ $user->rol == 'ADMIN' ? 'Administrador' : 'Usuario' }}</td>
                                <td class="p-2 flex justify-center items-center gap-4">
                                    <!---- Acciones ---->
                                    <form action="{{ route('generate-pdf', $user) }}" method="post" target="__black">
                                        @csrf
                                        <button class="bg-green-500 hover:bg-green-600 text-white rounded-lg text-xl px-2 py-2">⏳</button>
                                    </form>
                                    <button class="bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-xl px-2 py-2" wire:click.prevent="show({{ $user->id }})">✍</button>
                                    <button class="bg-red-500 hover:bg-red-600 text-white rounded-lg text-xl px-2 py-2" onclick="deleteUser({{ $user->id }})">✖</button>
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-200 border-t border-gray-200">
                                <td colspan="6">
                                    <h1 class="text-center p-2">No existen usuario registrados</h1>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    {{-- Modal --}}
    <x-dialog-modal wire:model="modal">
        <!---- Header del modal ---->
        <x-slot name="title">
            <!--- Validar si se crea un usuario o se edita --->
            <h1>{{ $modalAction == 0 ? 'Agregar un nuevo Usuario' : 'Editar al usuario' }}</h1>
        </x-slot>

        <!--- Cuerpo del modal --->
        <x-slot name="content">
            <!--- Incluir el formulario en un archivo aparte ---->
            @include('users.user-form')
        </x-slot>

        <!--- Footer del modal ---->
        <x-slot name="footer" class="flex justify-end items-center py-2 px-4">
            @if ($modalAction == 0)
                <!----- Boton de crear ---->
                <button class="bg-indigo-600 text-white hover:bg-indigo-700 rounded-lg text-bold px-6 py-2 mr-4" wire:click.prevent="store()">Crear</button>
            @else
                <!----- Boton de Editar ---->
                <button class="bg-indigo-600 text-white hover:bg-indigo-700 rounded-lg text-bold px-6 py-2 mr-4" wire:click.prevent="update()">Actualizar</button>
            @endif

                <!----- Boton de cancelar ---->
            <button class="bg-gray-500 text-white hover:bg-gray-600 rounded-lg text-bold px-6 py-2" wire:click.prevent="resetUI()">Cerrar</button>
        </x-slot>
    </x-dialog-modal>

    <!--- Cargar el script a la plantilla --->
    @push('js')
    <!--- Mostrar una ventana emergente al presionar eliminar -->
        <script>
            function deleteUser(id) {
                // confrimar la seleccion
                if(confirm('¿Desea eliminar al usuario seleccionado?')) {
                    // Emitir un evento al backend
                    window.livewire.emit('delete', id);
                }
            }
        </script>
    @endpush
</div>
