<div class="w-full flex flex-col items-center" x-data="{selected : 0}">
    {{-- bg-gradient-to-b from-green-600 to-green-500 --}}
    <div class="w-full h-72 flex items-start justify-center bg-[#56ab7b]"> 
        <div class="w-full py-7 md:w-8/12 flex flex-col gap-3 md:py-0 md:flex md:flex-row md:gap-14 mt-0 md:mt-10 items-center">
            <div class="w-20 md:w-48">
                <img src="{{ asset('images/shop-logo.png') }}" alt="">
            </div>
            <div class="w-full md:w-3/5 flex flex-col gap-2">
                <div class="flex gap-6 px-10 md:px-0">
                    <div class="w-full">
                        <x-input icon="search-circle" placeholder="Fruits" class="w-full md:w-full rounded-full md:rounded-[200px]">
                            <x-slot name="append">
                                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                    <x-button
                                        class="h-full rounded-full bg-gradient-to-b from-green-600 to-green-500 text-white"
                                        icon="search"
                                        label="{{ __('trans.search') }}"
                                    />
                                </div>
                            </x-slot>
                        </x-input>
                    </div>
                    <div class="h-full rounded-full relative">
                        <a href="/cart" class="w-24 h-10 flex justify-center items-center rounded-full bg-gradient-to-b from-green-600 to-green-500 text-white place-self-start border-white border-2">
                            <x-icon name="shopping-cart" class="w-5 h-5" />
                            <span>{{ __('trans.cart') }}</span>
                        </a>
                        <div class="absolute -top-2 right-0 w-5 h-5 bg-green-500 flex justify-center items-center rounded-full">
                            <span class=" text-white text-center text-sm"> {{ $total_count }} </span>
                        </div>
                    </div>
                    
                </div>
                
                <div class="flex gap-6 px-10 md:px-0">
                    <x-badge orange label="Notice" />
                    <span class="text-sm text-white">New Yeah Fresh app, faster and better!</span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MAIN CONTENT --}}
    <div class="md:w-8/12 w-full h-screen shadow-xl mt-[-100px] md:mt-[-150px] rounded-xl overflow-hidden {{ $selectedCategory || $activeFilter ? 'bg-gray-100' : 'bg-white'}}">
        {{-- FILTER HEADER --}}
        <div class="bg-white">
            <div class="w-full h-20 px-5 flex items-center justify-between shadow-lg">
                <div class="flex justify-center items-center">
                    <x-button icon="view-list" :label="__('trans.category')" class="border-none focus:bg-transparent focus:lg:border-0 focus:lg:ring-0 text-gray-950" x-on:click="selected !== 1 ? selected = 1 : selected = null"/>
                    <span x-show="selected == 1" class="-ml-2"><x-icon name="chevron-up" class="w-4 h-4 text-gray-500" /></span>
                    <span x-show="selected !== 1" class="-ml-2"><x-icon name="chevron-down" class="w-4 h-4 text-gray-500" /></span>
                </div>
                <div class="flex items-center flex-nowrap gap-5 overflow-x-scroll no-scrollbar ml-10 md:ml-auto w-screen md:w-auto">
                    <x-button class="{{$activeFilter == 'is_selected' ? 'bg-green-600 text-white h-8 text-xs md:h-auto md:text-sm' : 'h-8 w-full text-xs md:h-auto md:text-sm md:w-auto text-nowrap'}}" rounded :label="__('trans.selected')" wire:click.prevent="setActiveTab('is_selected')" x-on:click="selected !== 1 ? selected = 0 : selected = 0"/>
                    <x-button class="{{$activeFilter == 'is_promotion' ? 'bg-green-600 text-white h-8 text-xs md:h-auto md:text-sm' : 'h-8 text-xs md:h-auto md:text-sm text-nowrap'}}" rounded :label="__('trans.promotions')" wire:click="setActiveTab('is_promotion')" x-on:click="selected !== 1 ? selected = null : selected = null"/>
                    <x-button class="{{$activeFilter == 'is_preorder' ? 'bg-green-600 text-white h-8 text-xs md:h-auto md:text-sm' : 'h-8 text-xs md:h-auto md:text-sm text-nowrap'}}" rounded :label="__('trans.pre-orders')" wire:click="setActiveTab('is_preorder')" x-on:click="selected !== 1 ? selected = null : selected = null"/>
                    <x-button class="bg-white h-8 text-xs w-fit md:h-auto md:text-sm text-nowrap" rounded :label="__('trans.cash-in')" />
                    <x-button class="bg-white h-8 text-xs w-fit md:h-auto md:text-sm text-nowrap" rounded :label="__('trans.invite')" />
                </div>
            </div>
            <ul class="shadow-box">             
                <li class="relative border-b border-gray-200" :class="{ 'overflow-hidden': selected !== 1}">
                    <div class="relative transition-all max-h-0 duration-500" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px'  : ''">
                        <div class="px-2 py-5 transition ease-in duration-1500 opacity-0" :class="selected == 1 ?'opacity-100':'opacity-0' ">
                            <div class="w-full h-full">
                                <div class="swiper categorySlider w-11/12 h-full z-30" style="overflow: unset;" wire:ignore>
                                    <div class="swiper-wrapper">
                                        @foreach ($categories as $category)
                                            <div class="group swiper-slide w-36 h-20 flex flex-col items-center justify-center gap-2 relative hover:cursor-pointer" wire:key="{{ $category->id }}">
                                                <div class="w-[50px] h-[50px]">
                                                    <img
                                                        class="object-cover w-full h-full"
                                                        src="{{ url('storage', $category->image) }}"
                                                        alt="image"
                                                    />
                                                </div>
                                                <h6>
                                                    {{ $category->name }}
                                                </h6>
                                                <div class="hidden group-hover:block group-hover:z-50 w-32 absolute top-20 left-1/2 transform -translate-x-1/2 py-2 bg-white border border-gray-300 text-gray-700 text-sm rounded-md text-center shadow-md z-50" >
                                                    @foreach ($category->sub_categories as $sub_category)
                                                        {{-- <a wire:navigate href="/products" wire:click="getCategories({{$category->id}}, {{$sub_category->id}})" wire:key="{{ $sub_category->id }}" x-on:click="selected !== 1 ? selected = 1 : selected = null">{{ $sub_category->name }}</a> --}}
                                                        <x-button flat :label="$sub_category->name" class="w-full" wire:click.prevent="getCategories({{$category->id}}, {{$sub_category->id}})" wire:key="{{ $sub_category->id }}" x-on:click="selected !== 1 ? selected = 1 : selected = null"/>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <x-button.circle icon="chevron-right" class="swiper-button-next after:content-[''] z-50" />
                                <x-button.circle icon="chevron-left" class="swiper-button-prev after:content-[''] z-50" />
                            </div>                                
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        {{-- FILTER HEADER END --}}
        
        <div class="w-full h-full overflow-y-scroll no-scrollbar pb-[250px] {{ $selectedCategory || $activeFilter ? 'bg-gray-100' : 'bg-white'}}">
            {{-- HOME CONTENT --}}
            @if ($selectedCategory || $activeSubCategory || $activeFilter || request()->is('products'))
                <aside class="bg-white w-56 h-screen fixed flex flex-col items-center py-7 z-10">
                    @if ($activeFilter)
                        <h1 class="text-lg font-bold">
                            @if ($activeFilter == 'is_selected')
                                {{ __('trans.selected') }}
                            @elseif($activeFilter == 'is_promotion')
                                {{ __('trans.promotions') }}
                            @else
                                {{ __('trans.pre-orders') }}
                            @endif
                        </h1>
                    {{-- @elseif ($search)   
                        <h1 class="text-lg font-bold">
                            all Result
                        </h1> --}}
                    @else
                        @if ($selectedCategory)
                            <h1 class="text-lg font-bold">
                                {{ $selectedCategory->name }}
                            </h1>
                            <div class="w-8 h-1 bg-green-800"></div>
                                <ul class="mt-5">
                                    @foreach ($selectedCategory->sub_categories as $subCategory)
                                        <li wire:key="{{ $subCategory->id }}">
                                            {{-- <a href="/products" wire:click="getProductsBasedOnSubCategory({{ $subCategory->id }})" class="w-40 {{ $activeSubCategory == $subCategory->id ? 'bg-green-500 text-white' : ''}}">{{ $subCategory->name }}</a> --}}
                                            <x-button flat rounded amber :label="$subCategory->name" wire:click="getProductsBasedOnSubCategory({{ $subCategory->id }})"  class="w-40 {{ $activeSubCategory == $subCategory->id ? 'bg-green-500 text-white' : ''}}" x-on:click="selected !== 1 ? selected = null : selected = null"/>
                                        </li>
                                    @endforeach
                                </ul>
                            
                        @endif
                    @endif
                </aside>
                <div class="pl-56 relative overflow-clip h-auto w-full">
                    {{-- BREADCRUMBS --}}
                    <div class="w-full h-10 flex items-center">
                        <div class="w-full bg-gray-100 z-10 pl-5 relative">
                            <nav aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                    <li class="inline-flex items-center">
                                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                        </svg>
                                            {{ __('trans.home') }}
                                        </a>
                                    </li>
                                    @if ($activeFilter)
                                        <li>
                                            <div class="flex items-center">
                                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                </svg>
                                                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                                    @if ($activeFilter == 'is_selected')
                                                        {{ __('trans.selected') }}
                                                    @elseif ($activeFilter == 'is_promotion')
                                                        {{ __('trans.promotions') }}
                                                    @else
                                                        {{ __('trans.pre-orders') }}
                                                    @endif
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        @if ($selectedCategory)
                                            <li>
                                                <div class="flex items-center">
                                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                </svg>
                                                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                                    {{ $selectedCategory->name }}
                                                </a>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                    @if ($activeSubCategory)
                                        <li>
                                            <div class="flex items-center">
                                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                            </svg>
                                            <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                            {{$activeSubCategoryName->name}}
                                            </a>
                                            </div>
                                        </li>
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                    {{-- BREADCRUMB END --}}
                    <div class="w-full h-auto flex bg-gray-100 pt-5">
                        <div class="flex flex-col justify-around px-5 w-full">
                            {{-- CARDS --}}
                            <div class="w-full h-auto flex flex-wrap items-center justify-evenly">
                                @if ($products)
                                    @if ($activeFilter)
                                        @foreach ($products as $product)
                                            <div class="w-60 min-h-[380px] rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2 bg-white my-5" wire:key="{{ $product->id }}">
                                                <div class="py-5">
                                                    <button wire:key="{{$product->id}}" wire:click.prevent="getProductDetails('{{$product->slug}}', {{$product->sub_category_id}})" class="text-left">
                                                        <img src="{{ url('storage', $product->images[0]) }}" alt="" class="w-full h-auto">
                                                        {{ $product->name }}
                                                        <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($product->description), 100) !!}</p>
                                                    </button>
                                                    <div class="flex justify-between items-center pt-5">
                                                        <p class="text-lg text-green-800">{{ Number::currency($product->price, 'PHP') }}<span class="text-xs text-gray-700 capitalize">/{{ $product->specs }}</span></p>
                                                        <a wire:click.prevent="addToCart({{ $product->id }})" href="" class="w-10 h-10 bg-green-400 rounded-full flex justify-center items-center text-white hover:bg-green-800">
                                                            <x-icon name="shopping-cart" class="w-5 h-5" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($products->products as $product)
                                            <div class="w-60 min-h-[380px] rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2 bg-white my-5" wire:key="{{ $product->id }}">
                                                <div class="py-5">
                                                    <button wire:key="{{$product->id}}" wire:click.prevent="getProductDetails('{{$product->slug}}',{{$product->sub_category_id}})" class="text-left">
                                                        <img src="{{ url('storage', $product->images[0]) }}" alt="" class="w-full h-auto">
                                                        {{ $product->name }}
                                                        <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($product->description), 100) !!}</p>
                                                    </button>
                                                    <div class="flex justify-between items-center pt-5">
                                                        <p class="text-lg text-green-800">{{ Number::currency($product->price, 'PHP') }}<span class="text-xs text-gray-700 capitalize">/{{ $product->specs }}</span></p>
                                                        <a wire:click.prevent="addToCart({{ $product->id }})" href="" class="w-10 h-10 bg-green-400 rounded-full flex justify-center items-center text-white hover:bg-green-800">
                                                            <x-icon name="shopping-cart" class="w-5 h-5" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->is('details') || $slug || $details)
                <div class="w-full h-auto overflow-hidden">
                    {{-- BREADCRUMBS --}}
                    <div class="w-full h-10 bg-gray-100 items-center z-10 pl-5 relative">
                        <div class="w-full h-full flex items-center">
                            <nav aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                    <li class="inline-flex items-center">
                                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                        </svg>
                                            {{ __('trans.home' )}}
                                        </a>
                                    </li>
                                    @if ($main_category_name)
                                        <li>
                                            <div class="flex items-center">
                                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                </svg>
                                                <a class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                                    {{ $main_category_name }}
                                                </a>
                                                
                                            </div>
                                        </li>
                                    @endif
                                    @if ($sub_category_name)
                                        <li>
                                            <div class="flex items-center">
                                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                </svg>
                                                <x-button flat :label="$sub_category_name->name" black class="w-full hover:bg-transparent hover:text-blue-500" wire:click.prevent="getCategories({{$main_category_id}}, {{$subCatId}})" x-on:click="selected !== 1 ? selected = 1 : selected = null"/>
                                            </div>
                                        </li>
                                    @endif
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                            </svg>
                                            <a class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                                {{ __('trans.product-info')}}
                                            </a>
                                        </div>
                                    </li>
                                    
                                </ol>
                            </nav>
                        </div>
                        
                    </div>
                    {{-- BREADCRUMB END --}}

                    <div class="flex-col w-full h-[45rem] overflow-y-scroll no-scrollbar px-8 pt-10 relative">
                        <div class="flex w-full">
                            <div class="w-5/12">
                                <img src="{{ url('storage', $details->images[0]) }}" alt="" class="w-full h-auto">
                            </div>
                            @if ($details)
                                <div class="w-9/12 flex flex-col">
                                    <h1 class="text-3xl font-semibold">{{ $details->name }}</h1>
                                    <p class="text-green-500 mb-5">{!! Str::markdown($details->description) !!}</p>
                                    <div class="w-full h-auto bg-gray-200 flex items-center mb-5 px-3 mt-10">
                                        <span class="mr-5 text-gray-500">{{ __('trans.price') }}</span>
                                        <p class="text-green-500 text-4xl">{{ Number::currency($details->price, 'PHP') }}<span class="text-base text-gray-500">/ {{ $details->specs }}</span></p>
                                    </div>
                                    <div class="flex items-center w-full mb-5">
                                        <span class="mr-5">Specs</span>
                                        <x-badge outline emerald :label="$details->specs" size="lg" class="capitalize"/>
                                    </div>
                                    <div class="w-full border-b-2 border-gray-400 border-dashed mb-5">
                                       
                                    </div>
                                    <div class="w-full flex items-center gap-2">
                                        <span>{{ __('trans.quantity') }}</span>
                                        <div class="relative flex flex-row bg-transparent rounded-lg">
                                            <x-button icon="minus" wire:click.prevent="decreaseQtyBtn"/>
 
                                            <span class="bg-teal-600 text-white px-5 py-1.5" wire:model="quantity">{{ $quantity }}</span>
                                        
                                            <x-button icon="plus" wire:click.prevent="increaseQtyBtn"/>
                                        </div>
                                        <x-button rounded emerald icon="shopping-cart" label="{{ __('trans.add-to-cart') }}" class="ml-auto px-10" wire:click.prevent="addToCartWithQuantity({{$details->id}})"/>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center justify-center w-full h-96">
                                    <div role="status">
                                        <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="w-full h-9 bg-gray-100">
                            <div class="h-9 w-[20%] bg-green-500 flex items-center justify-center text-white">
                                <span>{{ __('trans.recommended') }}</span>
                            </div>
                        </div>
                        {{-- RECOMMENDED --}}
                        <div class="w-full h-auto flex flex-wrap items-center justify-evenly">
                            @if ($recommended_products)
                                @foreach ($recommended_products->products as $recommended)
                                        <div class="w-60 h-auto rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2 bg-white my-5" wire:key="{{ $recommended->id }}">
                                            <div class="py-5">
                                                <img src="{{ url('storage', $recommended->images[0]) }}" alt="" class="w-full h-auto">
                                                {{ $recommended->name }}
                                                <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($recommended->description), 120) !!}</p>
                                                <div class="flex justify-between items-center pt-5">
                                                    <p class="text-lg text-green-800">₱{{ $recommended->price }}<span class="text-xs text-gray-700">/{{ $recommended->specs }}</span></p>
                                                    <x-button.circle positive icon="shopping-cart" :href="auth()->check() ? route('category.index') : route('login')"/>
                                                </div>
                                            </div>
                                        </div>  
                                @endforeach
                            @endif
                        </div>
                        {{-- DETAILS --}}
                        <div class="w-full h-9 bg-gray-100">
                            <div class="h-9 w-[20%] bg-green-500 flex items-center justify-center text-white">
                                <span>{{ __('trans.product-details') }}</span>
                            </div>
                        </div>
                        <div class="w-full h-[64px] mt-5">
                            <div class="h-[67px] w-full relative border-2 flex items-center">
                                <img src="{{ asset('images/division/product-details-div.png') }}" alt="" class="w-[228px] h-[64px] absolute z-10">
                                <span class="z-20 absolute left-20 text-lg">{{ __('trans.our-mission') }}</span>
                            </div>
                        </div>
                        <div class="w-full h-auto mt-5 py-7 border-b-[1px]">
                            <div class="h-auto w-full flex items-center gap-10">
                                <div>
                                    <h1 class="text-2xl mb-2">{{ __('trans.wide-range-of-products') }}</h1>
                                    <p class="text-md">{{ __('trans.wide-range-products-content') }}</p>
                                </div>
                                <img src="{{ asset('images/mission/fresh.png') }}" alt="" class="w-[15%] h-auto ml-auto">
                            </div>
                        </div>
                        <div class="w-full h-auto mt-5 py-7 border-b-[1px]">
                            <div class="h-auto w-full flex items-center gap-10">
                                <div>
                                    <h1 class="text-2xl mb-2">{{ __('trans.quality-always-come-first') }}</h1>
                                    <p class="text-md">{{ __('trans.quality-always-come-first-content') }}</p>
                                </div>
                                <img src="{{ asset('images/mission/truck.png') }}" alt="" class="w-[15%] h-auto ml-auto">
                            </div>
                        </div>
        
                        <div class="w-full h-auto mt-5 py-7 border-b-[1px]">
                            <div class="h-auto w-full flex items-center gap-10">
                                <div>
                                    <h1 class="text-2xl mb-2">{{ __('trans.express-delivery') }}</h1>
                                    <p class="text-md">{{ __('trans.express-delivery-content') }}</p>
                                </div>
                                <img src="{{ asset('images/mission/24Oras.png') }}" alt="" class="w-[15%] h-auto ml-auto">
                            </div>
                        </div>
                        <div class="w-full h-auto mt-5 py-7 border-b-[1px]">
                            <div class="h-auto w-full flex items-center gap-10">
                                <div>
                                    <h1 class="text-2xl mb-2 text-gray-400">{{ __('trans.terms-&-conditions')}}</h1>
                                    <p class="text-md">
                                        {{ __('trans.terms-&-condition-content-one') }}
                                    </p>
                                    <p>*  {{ __('trans.terms-&-condition-content-two') }}</p>
                                    <p>* {{ __('trans.terms-&-condition-content-three') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->is('cart') || $is_cart_active == true)
                @if ($cart_items)
                    <div class="w-full max-w-[85rem] h-auto py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-gray-100">
                        <div class="container mx-auto px-4">
                            <h1 class="text-2xl font-semibold mb-4">{{ __('trans.shopping-cart') }}</h1>
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="md:w-3/4">
                                    <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                                        <table class="w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-left font-semibold">{{ __('trans.product') }}</th>
                                                    <th class="text-left font-semibold">{{ __('trans.price') }}</th>
                                                    <th class="text-left font-semibold">{{ __('trans.quantity') }}</th>
                                                    <th class="text-left font-semibold">{{ __('trans.total') }}</th>
                                                    <th class="text-left font-semibold">{{ __('trans.remove') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($cart_items as $item)
                                                    <tr wire:key="{{ $item['product_id'] }}">
                                                        <td class="py-4">
                                                            <div class="flex items-center">
                                                                <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['images'])}}" alt="Product image">
                                                                <span class="font-semibold">{{ $item['name'] }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="py-4">{{ Number::currency($item['unit_amount'], 'PHP') }}</td>
                                                        <td class="py-4">
                                                            <div class="flex items-center">
                                                                <a href="" wire:click.prevent="increaseQty({{ $item['product_id'] }})" class="w-8 h-8 rounded-full bg-green-400 flex items-center justify-center text-white">
                                                                    <x-icon name="plus-sm" class="w-4 h-4" />
                                                                </a>
                                                                <span class="text-center w-8">{{ $item['quantity'] }}</span>
                                                                <a href="" wire:click.prevent="decreaseQty({{ $item['product_id'] }})" class="w-8 h-8 rounded-full bg-green-400 flex items-center justify-center text-white">
                                                                    <x-icon name="minus-sm" class="w-4 h-4" />
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="py-4">{{ Number::currency($item['total_amount'], 'PHP') }}</td>
                                                        <td>
                                                            {{-- <button wire:click.prevent="removeItem({{$item['product_id']}})" class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                                                                <span wire:loading.remove wire:target="removeItem({{$item['product_id']}})">Remove</span>
                                                                <span wire:loading wire:target="removeItem({{$item['product_id']}})">
                                                                <div class="animate-spin inline-block size-4 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                                Removing...
                                                                </span>
                                                            </button> --}}
                                                            <x-button.circle sm negative icon="x" wire:click.prevent="removeItem({{$item['product_id']}})" />
                                                        </td>
                                                    </tr>
                                                    <!-- More product rows -->
                                                @empty
                                                    <tr>
                                                        <td colspan="$" class="text-center py-4 text-4xl text-semibold text-slate-500">
                                                            No Items Available!
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="md:w-1/4">
                                    <div class="bg-white rounded-lg shadow-md p-6">
                                        <h2 class="text-lg font-semibold mb-4">{{ __('trans.summary') }}</h2>
                                        <div class="flex justify-between mb-2">
                                            <span>{{ __('trans.subtotal') }}</span>
                                            <span>{{ Number::currency($grand_total, 'PHP') }}</span>
                                        </div>
                                        <div class="flex justify-between mb-2">
                                            <span>{{ __('trans.taxes') }}</span>
                                            <span>{{ Number::currency(0, 'PHP') }}</span>
                                        </div>
                                        <div class="flex justify-between mb-2">
                                            <span>{{ __('trans.shipping') }}</span>
                                            <span>{{ Number::currency(0, 'PHP') }}</span>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-between mb-2">
                                            <span class="font-semibold">{{ __('trans.grand-total') }}</span>
                                            <span class="font-semibold">{{ Number::currency($grand_total, 'PHP') }}</span>
                                        </div>
                                        @if ($cart_items)
                                            <a href="/checkout" class="w-full h-10 mt-4 flex justify-center items-center gap-3 rounded-full bg-gradient-to-b from-green-600 to-green-500 text-white place-self-start border-white border-2">
                                                <x-icon name="check-circle" class="w-5 h-5" />
                                                <span>{{ __('trans.checkout') }}</span>
                                            </a>
                                            {{-- <x-button icon="check-circle" rounded positive label="{{ __('trans.checkout') }}" class="w-full mt-4"/> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full max-w-[85rem] h-full py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-gray-100 flex items-center flex-col">
                        <img src="{{ asset('images/no-cart-items.png')}}" alt="">
                        <span>{{ __('trans.empty-cart') }}</span>
                    </div>
                @endif
            @elseif(request()->is('checkout') || $is_checkout_active == true)
                <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto bg-gray-100">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                        Checkout
                    </h1>
                    <form wire:submit.prevent="checkout">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                                <!-- Card -->
                                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                                    <!-- Shipping Address -->
                                    <div class="mb-6">
                                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                                            Shipping Address
                                        </h2>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <x-input label="First Name" placeholder="your first name" wire:model="first_name" />
                                            </div>
                                            <div>
                                                <x-input label="Last Name" placeholder="your last name" wire:model="last_name" />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <x-input label="Mobile No." placeholder="ex: 093345657766" wire:model="phone" />
                                        </div>
                                        <div class="mt-4">
                                            <x-input label="Street Address" placeholder="ex: xyz st. Brgy. Maryland" wire:model="street_address" />
                                        </div>
                                        <div class="mt-4">
                                            <x-input label="City" placeholder="ex: Taguig City" wire:model="city" />
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 mt-4">
                                            <div>
                                                <x-input label="State" placeholder="ex: Philippines" wire:model="state" />
                                            </div>
                                            <div>
                                                <x-input label="Zip Code" placeholder="ex: 4327" wire:model="zip_code" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-lg font-semibold mb-4">
                                        Select Payment Method
                                    </div>
                                    <ul class="grid w-full gap-6 md:grid-cols-2">
                                        <li>
                                            <input wire:model="payment_method" class="hidden peer" id="hosting-small" required="" type="radio" value="cod" />
                                            <label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold">
                                                        Cash on Delivery
                                                    </div>
                                                </div>
                                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    </path>
                                                </svg>
                                            </label>
                                        </li>
                                        <li>
                                            <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio" value="stripe">
                                            <label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold">
                                                        Stripe
                                                    </div>
                                                </div>
                                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    </path>
                                                </svg>
                                            </label>
                                            </input>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Card -->
                            </div>
                            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                                        ORDER SUMMARY
                                    </div>
                                    <div class="flex justify-between mb-2 font-bold">
                                        <span>
                                            Subtotal
                                        </span>
                                        <span>
                                            {{ Number::currency($grand_total, 'PHP') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between mb-2 font-bold">
                                        <span>
                                            Taxes
                                        </span>
                                        <span>
                                            {{ Number::currency(0, 'PHP') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between mb-2 font-bold">
                                        <span>
                                            Shipping Cost
                                        </span>
                                        <span>
                                            {{ Number::currency(0, 'PHP') }}
                                        </span>
                                    </div>
                                    <hr class="bg-slate-400 my-4 h-1 rounded">
                                    <div class="flex justify-between mb-2 font-bold">
                                        <span>
                                            Grand Total
                                        </span>
                                        <span>
                                            {{ Number::currency($grand_total, 'PHP') }}
                                        </span>
                                    </div>
                                    </hr>
                                </div>
                                {{-- <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                                    Place Order
                                </button> --}}
                                {{-- <x-button rounded positive label="{{__('Place Order')}}" class="w-full mt-8 text-xl" type="submit" /> --}}
                                <x-button rounded positive class="w-full mt-8 text-xl" type="submit"
                                    wire:loading.attr="disabled" wire:target="placeOrder">
                                    <span wire:loading.remove>{{__('Place Order')}}</span>
                                    <span wire:loading>Processing...</span>
                                </x-button>

                                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                                        BASKET SUMMARY
                                    </div>
                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                                        @foreach ($cart_items as $cart_item)
                                            <li class="py-3 sm:py-4" wire:key="{{ $cart_item['product_id'] }}">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <img alt="{{ $cart_item['name'] }}" class="w-12 h-12 rounded-full" src="{{ url('storage', $cart_item['images']) }}">
                                                        </img>
                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $cart_item['name'] }}
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Quantity: {{ $cart_item['quantity'] }}
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{ Number::currency($cart_item['unit_amount'], 'PHP') }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @elseif(request()->is('/') || !$selectedCategory || !$activeSubCategory || !$activeFilter || !$is_checkout_active || !$is_cart_active)
                <div class="w-full h-auto py-8">
                    <div class="swiper promotionsSlider w-11/12 h-auto" wire:ignore>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-1.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-2.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-3.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-4.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-5.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-6.jpg') }}"
                                    alt="image"
                                />
                            </div>
                            <div class="swiper-slide w-full h-64 flex justify-center items-center overflow-hidden rounded-xl">
                                <img
                                    class="object-cover w-full h-auto"
                                    src="{{ asset('images/slider-image-7.jpg') }}"
                                    alt="image"
                                />
                            </div>
                        </div>
                        <x-button.circle icon="chevron-right" class="swiper-button-next after:content-[''] bg-green-700 text-white" />
                        <x-button.circle icon="chevron-left" class="swiper-button-prev after:content-[''] bg-green-700 text-white" />
                    </div>
                </div>
                <div class="w-full h-auto flex items-center justify-center px-10">
                    <div class="flex justify-around px-5 w-full h-16 bg-gradient-to-l from-green-300 to-green-200 rounded-full">
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/icon-1.png') }}" alt="" class="w-10">
                            <span class="text-base text-green-800">{{ __('trans.excellent-customer-service') }}</span>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/icon-2.png') }}" alt="" class="w-10">
                            <span class="text-base text-green-800">{{ __('trans.fresh-and-natural') }}</span>
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/icon-3.png') }}" alt="" class="w-10">
                            <span class="text-base text-green-800">{{ __('trans.guaranteed-quality') }}</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <img src="{{ asset('images/icons/icon-4.png') }}" alt="" class="w-10">
                            <span class="text-base text-green-800">{{ __('trans.express-delivery') }}</span>
                        </div>
                    </div>
                </div>

                {{-- SELECTED PRODUCTS --}}
                <div class="w-full h-auto flex items-center justify-center p-10">
                    <div class="flex flex-col justify-around px-5 w-full">
                        {{-- HEADER --}}
                        <div class="w-full flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl">{{ __('trans.selected') }}</h1>
                                <span class="text-green-500">{{ __('trans.we-all-like') }}</span>
                            </div>
                            <x-button right-icon="chevron-double-right" flat label="{{ __('trans.see-more') }}" />
                        </div>
                        {{-- CARDS --}}
                        <div class="w-full h-auto flex flex-wrap items-center justify-evenly">
                            @foreach ($selectedProducts as $product)
                                <div class="w-60 h-auto rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2" wire:key="{{ $product->id }}">
                                    <div class="py-5">
                                        <button wire:key="{{$product->id}}" wire:click.prevent="getProductDetails('{{$product->slug}}', {{$product->sub_category_id}})" class="text-left">
                                            <img src="{{ url('storage', $product->images[0]) }}" alt="" class="w-full h-auto">
                                            <span class="text-lg font-bold">{{ $product->name }}</span>
                                            <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($product->description), 100) !!}</p>
                                        </button>
                                        <div class="flex justify-between items-center pt-5">
                                            <p class="text-lg text-green-800">{{ Number::currency($product->price, 'PHP') }}<span class="text-xs text-gray-700 capitalize">/{{ $product->specs }}</span></p>
                                            <a wire:click.prevent="addToCart({{ $product->id }})" href="" class="w-10 h-10 bg-green-400 rounded-full flex justify-center items-center text-white hover:bg-green-800">
                                                <x-icon name="shopping-cart" class="w-5 h-5" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- SELECTED PRODUCTS END --}}

                {{-- DIVISION 2 --}}
                <div class="w-full h-auto flex items-center justify-center px-5">
                    <div class="flex justify-around px-5 w-full h-auto gap-5">
                        <div class="flex items-center">
                            <img src="{{ asset('images/division/div-image-1.jpg') }}" alt="" class="rounded-lg">
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/division/div-image-2.jpg') }}" alt="" class="rounded-lg">
                        </div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/division/div-image-3.jpg') }}" alt="" class="rounded-lg">
                        </div>
                    </div>
                </div>

                {{-- PROMOTIONS PRODUCTS --}}
                <div class="w-full h-auto flex items-center justify-center p-10">
                    <div class="flex flex-col justify-around px-5 w-full">
                        {{-- HEADER --}}
                        <div class="w-full flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl">{{ __('trans.promotions') }}</h1>
                                <span class="text-green-500">{{ __('trans.discounted-products') }}</span>
                            </div>
                            <x-button right-icon="chevron-double-right" flat label="{{ __('trans.see-more') }}" />
                        </div>
                        {{-- CARDS --}}
                        <div class="w-full h-auto flex flex-wrap items-center justify-evenly">
                            @foreach ($promorionsProducts as $promProduct)
                                <div class="w-60 h-auto rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2" wire:key="{{ $promProduct->id }}">
                                    <div class="py-5">
                                        <button wire:key="{{$promProduct->id}}" wire:click.prevent="getProductDetails('{{$promProduct->slug}}', {{$promProduct->sub_category_id}})" class="text-left">
                                            <img src="{{ url('storage', $promProduct->images[0]) }}" alt="" class="w-full h-auto">
                                            <span class="text-base">{{ $promProduct->name }}</span>
                                            <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($promProduct->description), 100) !!}</p>
                                        </button>
                                        <div class="flex justify-between items-center pt-5">
                                            <p class="text-lg text-green-800">{{ Number::currency($promProduct->price, 'PHP') }}<span class="text-xs text-gray-700 capitalize">/{{$promProduct->specs}}</span></p>
                                            <a wire:click.prevent="addToCart({{ $promProduct->id }})" href="" class="w-10 h-10 bg-green-400 rounded-full flex justify-center items-center text-white hover:bg-green-800">
                                                <x-icon name="shopping-cart" class="w-5 h-5" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- PROMOTIONS PRODUCTS END--}}

                {{-- DIVISION 3 --}}
                <div class="w-full h-auto flex items-center justify-center px-5">
                    <div class="flex justify-around px-5 w-full h-auto gap-5">
                        <img src="{{ asset('images/division/div.png') }}" alt="" class="rounded-lg">
                    </div>
                </div>

                {{-- PRE-ORDERS PRODUCTS --}}
                <div class="w-full h-auto flex items-center justify-center p-10">
                    <div class="flex flex-col justify-around px-5 w-full">
                        {{-- HEADER --}}
                        <div class="w-full flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl">{{ __('trans.pre-orders') }}</h1>
                                <span class="text-green-500">{{ __('trans.nextday-delivery') }}</span>
                            </div>
                            <x-button right-icon="chevron-double-right" flat label="{{ __('trans.see-more') }}" />
                        </div>
                        {{-- CARDS --}}
                        <div class="w-full h-auto flex flex-wrap items-center justify-evenly">
                            @foreach ($preOrderProducts as $preProduct)
                                <div class="w-60 h-auto rounded-lg hover:border-green-600 hover:border-2 hover:cursor-pointer overflow-hidden px-2" wire:key="{{ $preProduct->id }}">
                                    <div class="py-5">
                                        <button wire:key="{{$preProduct->id}}" wire:click.prevent="getProductDetails('{{$preProduct->slug}}', {{$preProduct->sub_category_id}})" class="text-left">
                                            <img src="{{ url('storage', $preProduct->images[0]) }}" alt="" class="w-full h-auto">
                                            <span class="text-base">{{ $preProduct->name }}</span>
                                            <p class="text-sm text-green-500">{!! Str::limit(Str::markdown($preProduct->description), 100) !!}</p>
                                        </button>
                                        <div class="flex justify-between items-center pt-5">
                                            <p class="text-lg text-green-800">{{ Number::currency($preProduct->price, 'PHP') }}<span class="text-xs text-gray-700 capitalize">/{{ $preProduct->specs }}</span></p>
                                            <a wire:click.prevent="addToCart({{ $preProduct->id }})" href="" class="w-10 h-10 bg-green-400 rounded-full flex justify-center items-center text-white hover:bg-green-800">
                                                <x-icon name="shopping-cart" class="w-5 h-5" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                {{-- PRE-ORDERS PRODUCTS END--}}
            
            
                
            @endif
            {{-- HOME CONTENT END--}}

        </div>
    </div>
</div>
