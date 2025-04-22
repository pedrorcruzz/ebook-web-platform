<nav class="bg-gray-800 p-4 fixed w-full top-0 z-50">
    <div class="flex justify-between items-center">
        <div class="text-white text-xl font-bold">
            Meu Livro
        </div>
        <ul id="menu" class="hidden lg:flex space-x-8 flex-1 justify-center">
            <li><a href="{{ route('app.index') }}" class="text-white hover:text-gray-300">Inicio</a></li>
            <li><a href="#" class="text-white hover:text-gray-300">Livros</a></li>
            <li><a href="#" class="text-white hover:text-gray-300">Contato</a></li>
        </ul>
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative">
                    <button id="user-menu-toggle" class="flex items-center bg-gray-700 text-white px-4 py-2 rounded-full focus:outline-none">
                        <!-- <span class="mr-2">{{ Auth::user()->username }}</span> -->
                        <span class="mr-2">Minha Conta</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50">
                        <a href="{{ route('app.author.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Perfil
                        </a>
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="{{ route('auth.login') }}" class="text-white hover:text-gray-300 bg-gray-700 px-4 py-2 rounded-full">
                    Entrar
                </a>
            @endguest
        </div>
        <div class="block lg:hidden ml-4">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    <ul id="mobile-menu" class="lg:hidden hidden flex-col space-y-2 mt-4">
        <li><a href="{{ route('app.index') }}" class="text-white hover:text-gray-300">Inicio</a></li>
        <li><a href="#" class="text-white hover:text-gray-300">Livros</a></li>
        <li><a href="#" class="text-white hover:text-gray-300">Contato</a></li>
    </ul>
</nav>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        let menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    @auth
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');
        let menuOpen = false;

        userMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
            menuOpen = !menuOpen;
        });

        document.addEventListener('click', function() {
            if (menuOpen) {
                userMenu.classList.add('hidden');
                menuOpen = false;
            }
        });

        userMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    @endauth
</script><
