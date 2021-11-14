<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 border-bottom fixed-top">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('home.index') }}" :active="request()->routeIs('home.index')">
                        {{ __('Home') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>

                    @if(!settings()->get('hide_videos'))
                        <x-jet-nav-link href="{{ route('videos.index') }}" :active="request()->routeIs(['videos.index','videos.list','videos.create','videos.edit','videos.show'])">
                            {{ __('Videos') }}
                        </x-jet-nav-link>
                    @endif

                    @if(!settings()->get('hide_photos'))
                        <x-jet-nav-link href="{{ route('photos.index') }}" :active="request()->routeIs(['photos.index','photos.list','photos.create','photos.edit','photos.show'])">
                            {{ __('Photos') }}
                        </x-jet-nav-link>
                    @endif

                    @if(!settings()->get('hide_articles'))
                        <x-jet-nav-link href="{{ route('articles.index') }}" :active="request()->routeIs(['articles.index','articles.create','articles.edit','articles.show'])">
                            {{ __('Articles') }}
                        </x-jet-nav-link>
                    @endif

                    @if(!settings()->get('hide_lives'))
                        <x-jet-nav-link href="{{ route('lives.index') }}" :active="request()->routeIs(['lives.index','lives.create','lives.edit','lives.show'])">
                            {{ __('Live') }}
                        </x-jet-nav-link>
                    @endif
                    @if(!settings()->get('hide_planner'))

                    <x-jet-nav-link href="{{ route('plans.index') }}" :active="request()->routeIs(['plans.index','plans.create','plans.edit','plans.show'])">
                        {{ __('Planner') }}
                    </x-jet-nav-link>
                    @endif

                    @auth
                    @if( auth()->user()->role == "admin")
                    <x-jet-nav-link href="{{ route('history.index') }}" :active="request()->routeIs(['history.index'])">
                        {{ __('History') }}
                    </x-jet-nav-link>


                    <x-jet-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs(['categories.index','categories.create','categories.edit','categories.show'])">
                        {{ __('Categories') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs(['users.index'])">
                        {{ __('Users') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('settings.index') }}" :active="request()->routeIs(['settings.index'])">
                        {{ __('Settings') }}
                    </x-jet-nav-link>
                    @endif
                    @endauth

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">

                    @if (Auth::guest())
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>

		                    @if (Route::has('register'))
		                        <a href="{{ route('register') }}" class="btn btn-success">Register</a>
		                    @endif
                    @endif



     	 				@if (Route::has('login'))
                        @auth
                        <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>



                        @else

		                @endauth
		                @endif




     	 				@if (Route::has('login'))
                        @auth
                        <x-slot name="content">

                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                        </x-jet-dropdown>
	                    @endauth
	                   	@endif


                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
             <x-jet-responsive-nav-link href="{{ route('home.index') }}" :active="request()->routeIs('home.index')">
                        {{ __('Home') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-responsive-nav-link>

            @if(!settings()->get('hide_videos'))
                <x-jet-responsive-nav-link href="{{ route('videos.index') }}" :active="request()->routeIs(['videos.index','videos.list','videos.create','videos.edit','videos.show'])">
                    {{ __('Videos') }}
                </x-jet-responsive-nav-link>
            @endif

            @if(!settings()->get('hide_photos'))
                <x-jet-responsive-nav-link href="{{ route('photos.index') }}" :active="request()->routeIs(['photos.index','photos.list','photos.create','photos.edit','photos.show'])">
                    {{ __('Photos') }}
                </x-jet-responsive-nav-link>
            @endif

            @if(!settings()->get('hide_articles'))
                <x-jet-responsive-nav-link href="{{ route('articles.index') }}" :active="request()->routeIs(['articles.index','articles.create','articles.edit','articles.show'])">
                    {{ __('Articles') }}
                </x-jet-responsive-nav-link>
            @endif

            @if(!settings()->get('hide_lives'))
                <x-jet-responsive-nav-link href="{{ route('lives.index') }}" :active="request()->routeIs(['lives.index','lives.create','lives.edit','lives.show'])">
                    {{ __('Live') }}
                </x-jet-responsive-nav-link>
            @endif
            @if(!settings()->get('hide_planner'))

                    <x-jet-responsive-nav-link href="{{ route('plans.index') }}" :active="request()->routeIs(['plans.index','plans.create','plans.edit','plans.show'])">
                        {{ __('Planner') }}
                    </x-jet-responsive-nav-link>
            @endif

                    @auth
                    @if( auth()->user()->role == "admin")
                    <x-jet-responsive-nav-link href="{{ route('history.index') }}" :active="request()->routeIs(['history.index'])">
                        {{ __('History') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs(['categories.index','categories.create','categories.edit','categories.show'])">
                        {{ __('Categories') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs(['users.index'])">
                        {{ __('Users') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('settings.index') }}" :active="request()->routeIs(['settings.index'])">
                        {{ __('Settings') }}
                    </x-jet-responsive-nav-link>
                    @endif
                    @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class=" pb-1 border-t border-gray-200">
            <div class="flex items-center px-4 pt-4">
            	@if (Route::has('login'))
                @auth

                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3 pt-4">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
				  @else


				@endauth
				@endif
            </div>



            <div class="mt-3 space-y-1">

            	@if (Route::has('login'))
                @auth
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                 @else
	             	<x-jet-responsive-nav-link href="{{ route('login') }}">
	                	{{ __('Login') }}
	            	</x-jet-responsive-nav-link>


					@if (Route::has('register'))
					<x-jet-responsive-nav-link href="{{ route('register') }}">
	                	{{ __('Register') }}
	            	</x-jet-responsive-nav-link>
					@endif
					@endauth
				@endif


            </div>
        </div>
    </div>
</nav>
