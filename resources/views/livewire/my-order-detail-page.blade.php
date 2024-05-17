<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto h-auto">
    <h1 class="text-4xl font-bold text-slate-500">{{ __('trans.order-details') }}</h1>
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
      <!-- Card -->
      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
        <div class="p-4 md:p-5 flex gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
            <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500">
                {{ __('trans.customer') }}
              </p>
            </div>
            <div class="mt-1 flex items-center gap-x-2">
              <div>{{ $order->user->name }}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
        <div class="p-4 md:p-5 flex gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
            <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 22h14" />
              <path d="M5 2h14" />
              <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
              <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500">
                {{ __('trans.order-date') }}
              </p>
            </div>
            <div class="mt-1 flex items-center gap-x-2">
              <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                {{ $order->created_at->format('m-d-Y') }}
              </h3>
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
        <div class="p-4 md:p-5 flex gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
            <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
              <path d="m12 12 4 10 1.7-4.3L22 16Z" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500">
                {{ __('trans.order-status') }}
              </p>
            </div>
            <div class="mt-1 flex items-center gap-x-2">
              {{-- <span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span> --}}
              @if ($order->status == 'new')
                <div class="flex items-center justify-center bg-blue-500 py-1 px-2 shadow gap-1 rounded w-8/12">
                  <x-icon name="sparkles" class="w-5 h-5 text-white" />
                  <span class="text-white">New</span>
                </div>
              @elseif ($order->status == 'processing')
                <div class="flex items-center justify-center bg-orange-500 py-1 px-2 shadow gap-1 rounded w-8/12">
                  <x-icon name="refresh" class="w-5 h-5 text-white" />
                  <span class="text-white">Processing</span>
                </div>
              @elseif ($order->status == 'shipped')
                <div class="flex items-center justify-center bg-blue-800 py-1 px-2 shadow gap-1 rounded w-8/12">
                  <x-icon name="truck" class="w-5 h-5 text-white" />
                  <span class="text-white">Shipped</span>
                </div>
              @elseif ($order->status == 'delivered')
                <div class="flex items-center justify-center bg-green-600 py-1 px-2 shadow gap-1 rounded w-8/12">
                  <x-icon name="badge-check" class="w-5 h-5 text-white" />
                  <span class="text-white">Delivered</span>
                </div>
              @else 
                <div class="flex items-center justify-center bg-red-600 py-1 px-2 shadow gap-1 rounded w-8/12">
                  <x-icon name="x-circle" class="w-5 h-5 text-white" />
                  <span class="text-white">Cancelled</span>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
  
      <!-- Card -->
      <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
        <div class="p-4 md:p-5 flex gap-x-4">
          <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
            <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
              <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
              <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
              <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
            </svg>
          </div>
  
          <div class="grow">
            <div class="flex items-center gap-x-2">
              <p class="text-xs uppercase tracking-wide text-gray-500">
                {{ __('trans.payment-status') }}
              </p>
            </div>
            <div class="mt-1 flex items-center gap-x-2">
              {{-- <span class="bg-green-500 py-1 px-3 rounded text-white shadow">Paid</span> --}}
              @if ($order->payment_status == 'failed')
                <div class="flex items-center justify-center border-2 border-red-600 py-1 px-2 gap-1 rounded w-8/12">
                  <x-icon name="information-circle" class="w-5 h-5 text-red-600" />
                  <span class="text-red-600">Failed</span>
                </div>
              @elseif ($order->payment_status == 'paid')
                <div class="flex items-center justify-center border-2 border-green-400 py-1 px-2 gap-1 rounded w-8/12">
                  <x-icon name="credit-card" class="w-5 h-5 text-green-400" />
                  <span class="text-green-400">Paid</span>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- End Card -->
    </div>
    <!-- End Grid -->
  
    <div class="flex flex-col md:flex-row gap-4 mt-4">
      <div class="md:w-3/4">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-semibold">{{ __('trans.product') }}</th>
                <th class="text-left font-semibold">{{ __('trans.price') }}</th>
                <th class="text-left font-semibold">{{ __('trans.quantity') }}</th>
                <th class="text-left font-semibold">{{ __('trans.total') }}</th>
              </tr>
            </thead>
            <tbody>
  
              <!--[if BLOCK]><![endif]-->
              @foreach ($order_items as $item)
                <tr wire:key="{{ $item->id }}">
                  <td class="py-4">
                    <div class="flex items-center">
                      <img class="h-16 w-16 mr-4" src="{{ url('storage', $item->product->images[0]) }}" alt="Product image">
                      <span class="font-semibold">{{ $item->product->name }}</span>
                    </div>
                  </td>
                  <td class="py-4">{{ Number::currency($item->product->price, 'PHP') }}</td>
                  <td class="py-4">
                    <span class="text-center w-8">{{ $item->quantity }}</span>
                  </td>
                  <td class="py-4">{{ Number::currency($item->total_amount, 'PHP') }}</td>
                </tr>
              @endforeach
              <!--[if ENDBLOCK]><![endif]-->
  
            </tbody>
          </table>
        </div>
  
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
          <h1 class="font-3xl font-bold text-slate-500 mb-3">{{ __('trans.shipping-address') }}</h1>
          <div class="flex justify-between items-center">
            <div>
              <p>{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}</p>
            </div>
            <div>
              <p class="font-semibold">{{ __('trans.receiver') }}:</p>
              <p>{{ $address->last_name }}, {{ $address->first_name }}</p>
            </div>
            <div>
              <p class="font-semibold">{{ __('trans.phone') }}:</p>
              <p>{{ $address->phone }}</p>
            </div>
          </div>
        </div>
  
      </div>
      <div class="md:w-1/4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">{{ __('trans.summary') }}</h2>
          <div class="flex justify-between mb-2">
            <span>{{ __('trans.subtotal') }}</span>
            <span>{{ Number::currency($item->total_amount, 'PHP') }}</span>
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
            <span class="font-semibold">{{ Number::currency($item->total_amount, 'PHP') }}</span>
          </div>
  
        </div>
      </div>
    </div>
  </div>