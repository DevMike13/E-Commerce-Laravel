<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <link rel="stylesheet" href="{{ asset('css/swiper/swiper-bundle.min.css') }}" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @wireUiScripts
    </head>
    <body class="h-screen {{ request()->is('my-orders*') ? '' : 'overflow-hidden'}}">
        <x-notifications />
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
        <script src="{{ asset('js/swiper/swiper-bundle.min.js')}}"></script>
        <script>
            var categorySwiper = new Swiper(".categorySlider", {
                slidesPerView: 8,
                spaceBetween: 30,
                simulateTouch: false,
                centerSlide: true, // Corrected: boolean value instead of string
                fade: true, // Corrected: boolean value instead of string
                grabCursor: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },

                breakpoints: {
                    0: {
                        slidesPerView: 4,
                    },
                    520: {
                        slidesPerView: 4,
                    },
                    950: {
                        slidesPerView: 8,
                    },
                },
            });


            var promotionsSwiper = new Swiper(".promotionsSlider", {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                autoplay: true,
                simulateTouch:false,
                centerSlide: 'true',
                fade: 'true',
                grabCursor: 'true',
                pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },

                breakpoints:{
                    0: {
                        slidesPerView: 1,
                    },
                    520: {
                        slidesPerView: 1,
                    },
                    950: {
                        slidesPerView: 3,
                    },
                },
            });
        </script>
    </body>
</html>
