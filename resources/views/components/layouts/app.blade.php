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
            <button onclick="call()">Call</button>
            <button onclick="hangup()">Hang Up</button>
            {{ $slot }}
            <div id="callModal" style="display:none; position: absolute; top: 0; right: 0; background-color: #ffffff">
                <div>
                    <p>Incoming call from TEST</p>
                    <button onclick="acceptCall()">Accept</button>
                    <button onclick="declineCall()">Decline</button>
                </div>
            </div>
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
         <script src="https://sdk.twilio.com/js/client/v1.13/twilio.min.js"></script>
         <script>
            let device;
        
            fetch('/twilio/token')
                .then(response => response.json())
                .then(data => {
                    device = new Twilio.Device(data.token, {
                        codecPreferences: ['opus', 'pcmu'],
                        debug: true
                    });
        
                    device.on('ready', function(device) {
                        console.log('Twilio Device is ready');
                    });
        
                    device.on('error', function(error) {
                        console.error('Twilio Device Error:', error.message);
                    });
        
                    device.on('disconnect', function(connection) {
                        console.log('Connection was disconnected:', connection);
                    });
        
                    device.on('incoming', function(connection) {
                        if (device.connections.length === 0) { // Ensure no active connections
                            document.getElementById('callModal').style.display = 'block';
                            document.getElementById('callerName').innerText = connection.parameters.From;
                            window.currentConnection = connection; // Set the current connection
                        } else {
                            console.log('Device busy; ignoring incoming invite');
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching token:', error);
                });
        
            function call() {
                const params = { To: 'DRRMO' }; // Replace with the actual receiver's identity
                try {
                    const connection = device.connect(params);
                    connection.on('error', function(error) {
                        console.error('Connection Error:', error.message);
                    });
                } catch (error) {
                    console.error('Error during call:', error.message);
                }
            }
        
            function hangup() {
                device.disconnectAll();
            }
        
            function acceptCall() {
            if (window.currentConnection) {
                window.currentConnection.accept(); // Accept the call
                document.getElementById('callModal').style.display = 'none'; // Hide the modal
            } else {
                console.error('No current connection to accept.');
            }
}
        
            function declineCall() {
                window.currentConnection.reject();
                document.getElementById('callModal').style.display = 'none';
            }
        </script>
    </body>
</html>
