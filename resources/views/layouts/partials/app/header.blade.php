<header class="bg-blue-900 py-6">
    <div class="container mx-auto flex justify-between items-center px-6">
        <div class="flex">
            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline  mx-5">
                {{ config('app.name', 'Laravel') }}
            </a>
            @auth
                <ul class="gap-8 text-gray-300 mx-8 hidden lg:flex">
                    <li>
                        <a href="{{ route('flats.index') }}" class="hover:text-gray-200">Flats</a>
                    </li>
                    <li>
                        <a href="{{ route('neighborhoods.index') }}" class="hover:text-gray-200">Neighborhoods</a>
                    </li>
                </ul>
            @endauth
        </div>
        <nav class="space-x-4 text-gray-300 text-sm sm:text-base flex">
            @guest
                <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                <span>{{ Auth::user()->name }}</span>

                <a href="{{ route('logout') }}" class="no-underline hover:underline" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
            @endguest
        </nav>
    </div>
</header>
