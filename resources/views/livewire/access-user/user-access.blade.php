<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    <!----   Mensaje flash ---->
    @if (session()->has('message') && session()->has('color'))
        <div class="w-full bg-{{session('color')}}-600 px-6 py-4 mb-4">
            <h1 class="text-bold text-xl text-white text-center">{{ session('message') }}</h1>
        </div>
    @endif


    <h2 class="text-gray-600 font-bold text-6xl mb-2">Bienvenido:</h2>
    <h1 class="text-gray-600 font-bold text-6xl">{{ auth()->user()->name . " " . auth()->user()->lastname }}</h1>
    
    @if ($lastRegister != [] && $lastRegister->input != null)
        <h4 class="text-gray-600 text-2xl font-semibold mt-6">Hora de acceso</h4>
        <h3 class="text-gray-600 text-2xl font-semibold">{{ Carbon\Carbon::parse($lastRegister->input)->format('h:i:s a') }}</h3>
    @endif

    
    @if ($lastRegister != [] && $lastRegister->output != null)
        <h4 class="text-gray-600 text-2xl font-semibold mt-6">Hora de salida</h4>
        <h3 class="text-gray-600 text-2xl font-semibold">{{ Carbon\Carbon::parse($lastRegister->output)->format('h:i:s a') }}</h3>
    @endif

    <button class="bg-gray-600 text-white font-bold text-xl px-6 py-2 rounded-lg hover:bg-gray-800 my-8" onclick="logout()">Cerrar</button>


    <form action="{{ route('logout') }}" method="post" id="logout">
        @csrf
    </form>

    @push('js')
        <script>
            window.onload = function() {
                // Crear el registro al iniciar la pagina
                createRegister();

                // Esperar 8 segundos para finaliza la sesion
                setTimeout(() => {
                    console.log("Saliendo del sistema...")
                    logout()
                }, 8000);
            }

            // Cerrar la sesion
            function logout() {
                form = document.getElementById("logout")
                form.submit()
            }

            // crear el registro
            function createRegister() {
                window.livewire.emit('create')
            }
        </script>
    @endpush
</div>