<div class="w-screen h-screen">
    <div class="w-full h-3/4 bg-[#56ab7b] flex">
        <div class="w-1/2 h-full flex items-center justify-center flex-col gap-2">
            <img src="{{ asset('/images/shop-logo.png')}}" alt="" class="h-auto w-1/4">
            <img src="{{ asset('/images/signup&login-img.png')}}" alt="" class="h-auto w-1/2">
        </div>
        <div class="w-1/2 h-full flex items-center justify-center flex-col gap-2">
            <div class="flex flex-col bg-white border border-t-4 border-t-green-600 shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-700 dark:border-t-blue-500 dark:shadow-slate-700/[.7]">
                <div class="p-4 md:p-5 text-end">
                    <h1 class="text-3xl font-semibold mb-9 text-center">{{ __('trans.forgot') }}</h1>
                    <form wire:submit.prevent="forgot">
                        <div class="w-[380px] flex flex-col gap-8 text-left">
                            <x-input icon="at-symbol" label="{{__('trans.email')}}" wire:model="email" placeholder="example@example.com" />
                        </div>
                        <x-button rounded positive label="{{__('trans.reset-password')}}" class="w-full mt-8 text-xl" type="submit" />
                    </form>
                    <p class="text-center mt-5 text-sm">{{ __('trans.remember-password') }} <a href="/login" class="text-blue-600 underline">{{ __('trans.signin-here')}}</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full h-1/4 bg-white"></div>
</div>
