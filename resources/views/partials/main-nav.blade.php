<nav class="relative bg-gray-800" x-data="{ mobileMenuOpen: false }">
    <div class="w-full px-6 mx-auto">
        <div class="flex items-center justify-between py-6 md:justify-start md:space-x-10">
            <a href="{{ home_url() }}" aria-label="Home Page">
                <img src="{{ \App\imageUrl('logo/logo.svg') }}" alt="Logo {{ $siteName }}" loading="lazy"
                    class="w-40">
            </a>
            @if ($navigation->isNotEmpty())
                <button type="button" x-bind:aria-label="mobileMenuOpen ? 'Zavřít Menu' : 'Otevřít menu'"
                    class="ml-4 text-gray-200 transition md:hidden hover:text-white "
                    @click="mobileMenuOpen = !mobileMenuOpen">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path style="display:none" x-show="!mobileMenuOpen" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="items-center justify-end hidden md:space-x-6 lg:space-x-8 md:flex md:flex-1 lg:w-0">
                    @foreach ($navigation->toArray() as $item)
                        <a href="{{ $item->url }}"
                            class="text-gray-200 transition font-semibold hover:underline hover:text-white {{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }}">
                            {{ $item->label }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @if ($navigation->isNotEmpty())
        <div class="z-50 p-2 transition origin-top-right transform md:hidden" x-show="mobileMenuOpen"
            x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            style="display: none;">
            <div class="px-5 py-6 space-y-6">
                @foreach ($navigation->toArray() as $item)
                    <a href="{{ $item->url }}"
                        class="flex justify-center w-full px-4 py-2 font-bold text-gray-200 border-2 border-gray-200 rounded-sm hover:border-white hover:text-white {{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }}">
                        {{ $item->label }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</nav>
