<header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-[#3b7854] text-sm py-4 sm:py-0 dark:bg-gray-800">
    <nav class="max-w-[85rem] w-full mx-auto py-2 lg:py-0 px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center">
            <div class="flex items-center justify-between">
                <div class="h-8 w-full flex items-center gap-3">
                    <a href="{{ route('user.home') }}" class="flex items-center justify-center gap-1">
                        <x-icon name="home" class="w-5 h-5 text-white" />
                        <span class="text-white text-nowrap">{{ __('trans.home') }}</span>
                    </a>
                    <div class="w-[1px] h-5 bg-white"></div> 
                    <x-dropdown>
                        <x-slot name="trigger">
                            <div class="flex items-center justify-center gap-1">
                                <x-icon name="location-marker" class="w-5 h-5 text-white" />
                                <span class="text-white">Makati</span>
                                <x-icon name="chevron-down" solid class="w-5 h-5 text-white" />
                            </div>
                        </x-slot>
                     
                        <x-dropdown.item label="Help Center" />
                        <x-dropdown.item separator label="Live Chat" />
                        <x-dropdown.item separator label="Logout" />
                    </x-dropdown>
                    <x-badge flat rounded label="Makati" class="bg-gradient-to-b from-green-600 to-green-500 text-white">
                        <x-slot name="prepend" class="relative flex items-center w-2 h-2">
                            <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-200 animate-ping"></span>
                            <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-200"></span>
                        </x-slot>
                    </x-badge>
                </div>
                
                <div class="md:hidden">
                    <button type="button" class="hs-collapse-toggle p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-gray-700 dark:text-white dark:hover:bg-white/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-collapse="#navbar-basic-usage" aria-controls="navbar-basic-usage" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            </div>
    
            <div id="navbar-basic-usage" class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div class="flex flex-col gap-5 mt-5 md:flex-row md:items-center md:justify-end md:mt-0 md:ps-5">
                    @guest
                        <a href="/login" class="flex items-center justify-center">
                            <span class="text-white">{{ __('trans.login/signup') }}</span>
                        </a>
                    @endguest
                    @auth
                        <div class="flex items-center justify-center">
                            <div class="hs-dropdown relative inline-flex md:flex md:items-center md:justify-center">
                                <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 inline-flex items-center gap-x-2 text-sm rounded-lg text-white">
                                    {{ auth()->user()->name }}
                                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </button>
                            
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50" aria-labelledby="hs-dropdown-default">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="/my-orders">
                                        {{ __('trans.myorders') }}
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                        {{ __('trans.my-account' )}}
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="/logout">
                                        {{ __('trans.logout' )}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endauth
    
                    {{-- <div class="hidden md:inline-flex w-[1px] h-5 bg-white"></div>
                    <a href="#" class="flex items-center justify-center">
                        <span class="text-white">{{ __('trans.myorders') }}</span>
                    </a> --}}
                    <div class="hidden md:inline-flex w-[1px] h-5 bg-white"></div>
                    <a href="#" class="flex items-center justify-center">
                        <span class="text-white">{{ __('trans.aboutus') }}</span>
                    </a>
                    <div class="hidden md:inline-flex w-[1px] h-5 bg-white"></div>
                    <a href="#" class="flex items-center justify-center">
                        <x-icon name="device-mobile" class="w-4 h-4 text-white" />
                        <span class="text-white">{{ __('trans.download') }}</span>
                    </a>
                    <div class="hidden md:inline-flex w-[1px] h-5 bg-white"></div>
                    <div class="flex items-center justify-center">
                        <div class="hs-dropdown relative inline-flex md:flex md:items-center md:justify-center">
                            <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 inline-flex items-center gap-x-2 text-sm rounded-lg text-white">
                                @if ($selectedLanguage == 'en')
                                    English
                                @elseif($selectedLanguage == 'zh_CN')
                                    中文
                                @else
                                    Tiếng Việt
                                @endif
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                          
                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50" aria-labelledby="hs-dropdown-default">
                               
                                <x-button flat label="English" class="w-full" wire:click="changeLanguage('en')" />
                                <x-button flat label="中文" class="w-full" wire:click="changeLanguage('zh_CN')" />
                                <x-button flat label="Tiếng Việt" class="w-full" wire:click="changeLanguage('vi')" />

                                {{-- <a wire:click="changeLanguage({{'zh'}})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                    中文
                                </a>
                                <a wire:click="changeLanguage({{'vn'}})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                    Tiếng Việt
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </nav>
</header>