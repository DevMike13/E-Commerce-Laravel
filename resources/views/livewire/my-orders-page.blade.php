<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500 mb-5"> {{ __('trans.my-orders') }}</h1>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('trans.order') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                      {{ __('trans.date') }}
                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                      </svg></a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                      {{ __('trans.order-status') }}
                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg></a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                      {{ __('trans.payment-status') }}
                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg></a>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                  <div class="flex items-center">
                    {{ __('trans.order-amount') }}
                      <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                      </svg></a>
                  </div>
              </th>
                <th scope="col" class="px-6 py-3 text-center">
                    <span>{{ __('trans.action') }}</span>
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order_item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ $order_item->id }}
                </th>
                <td class="px-6 py-4">
                  {{ $order_item->created_at->format('m-d-Y') }}
                </td>
                <td class="px-6 py-4">
                  @if ($order_item->status == 'new')
                    <div class="flex items-center justify-center bg-blue-500 py-1 px-2 shadow gap-1 rounded w-1/2">
                      <x-icon name="sparkles" class="w-5 h-5 text-white" />
                      <span class="text-white">New</span>
                    </div>
                  @elseif ($order_item->status == 'processing')
                    <div class="flex items-center justify-center bg-orange-500 py-1 px-2 shadow gap-1 rounded w-1/2">
                      <x-icon name="refresh" class="w-5 h-5 text-white" />
                      <span class="text-white">Processing</span>
                    </div>
                  @elseif ($order_item->status == 'shipped')
                    <div class="flex items-center justify-center bg-blue-800 py-1 px-2 shadow gap-1 rounded w-1/2">
                      <x-icon name="truck" class="w-5 h-5 text-white" />
                      <span class="text-white">Shipped</span>
                    </div>
                  @elseif ($order_item->status == 'delivered')
                    <div class="flex items-center justify-center bg-green-600 py-1 px-2 shadow gap-1 rounded w-1/2">
                      <x-icon name="badge-check" class="w-5 h-5 text-white" />
                      <span class="text-white">Delivered</span>
                    </div>
                  @endif
                </td>
                <td class="px-6 py-4">
                  @if ($order_item->payment_status == 'failed')
                    <div class="flex items-center justify-center border-2 border-red-600 py-1 px-2 gap-1 rounded w-1/3">
                      <x-icon name="information-circle" class="w-5 h-5 text-red-600" />
                      <span class="text-red-600">Failed</span>
                    </div>
                  @elseif ($order_item->payment_status == 'paid')
                    <div class="flex items-center justify-center border-2 border-green-400 py-1 px-2 gap-1 rounded w-1/3">
                      <x-icon name="credit-card" class="w-5 h-5 text-green-400" />
                      <span class="text-green-400">Paid</span>
                    </div>
                  @endif
                </td>
                <td class="px-6 py-4">
                  {{ Number::currency($order_item->grand_total, 'PHP') }}
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="/my-orders/{{$order_item->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('trans.view-order') }}</a>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>