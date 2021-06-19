<div>
    @if (!$readyToLoad)
        <x-loader />
    @endif

    <div wire:init="loadProducts">
        @if (count($products) > 0)
            <div class="flex flex-col justify-between sm:flex-row md:mb-4">
                <span class="inline-grid grid-cols-6 mb-2 gap-x-1 text-dark-500 sm:w-4/5 md:w-2/5">
                    <span class="col-span-3">
                        <span class="flex">
                            <span class="p-3 px-1 mr-0 max-w-max">Show</span>
                            <span class="inline col-span-2">
                                <x-select wire:model="limit" class="w-16 ml-0">
                                    <option value="5" {{ $limit == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $limit == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20</option>
                                    <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25</option>
                                    <option value="30" {{ $limit == 30 ? 'selected' : '' }}>30</option>
                                    <option value="40" {{ $limit == 40 ? 'selected' : '' }}>40</option>
                                    <option value="50" {{ $limit == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $limit == 100 ? 'selected' : '' }}>100</option>
                                </x-select>
                            </span>
                        </span>
                    </span>
                    {{-- <span class="p-3 px-1">entries</span> --}}
                    <span class="col-span-3">
                        <span class="flex">
                            <span class="p-3 px-1 text-dark-500">Filter:</span>
                            <span class="col-span-2">
                                <x-select wire:model="filter">
                                    <option value="">Select</option>
                                    <option value="1">Available</option>
                                    <option value="0">Out of stock</option>
                                </x-select>
                            </span>
                        </span>
                    </span>
                </span>

                <div class="px-2">
                    <div class="flex justify-end mb-1">
                        <div class="p-3 text-dark-500">Search:</div>
                        <div>
                            <x-jet-input type="search" wire:model="search" placeholder="name..." />
                        </div>
                    </div>
                </div>
            </div>
            <!--Container-->
            <div class="w-full overflow-x-scroll">
                <!--Card-->
                <div class="">
                    <table class="p-8 px-2 mt-6 overflow-x-scroll bg-white rounded shadow lg:mt-0"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr class="text-left border-b border-gray-200 text-dark-500">
                                <th class="px-3">Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Discount price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Date added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b border-gray-200 md:border-gray-100 text-dark-400 hover:bg-gray-50">
                                    <td class="px-3 py-3" title="{{ $product->name }}">
                                        <a class="text-secondary-500 hover:text-secondary-400 hover:underline"
                                            href="/{{ $webstoreId }}/product/{{ $product->id }}?utm_ref=productitem&utm_medium=productitemdatatable">{{ strlen($product->name) > 20 ? substr($product->name, 0, 18) . '...' : $product->name }}</a>
                                    </td>
                                    <td title="{{ $product->description }}">
                                        {{ strlen($product->description) > 20 ? substr($product->description, 0, 18) . '...' : $product->description }}
                                    </td>
                                    <td>&#8358; {{ number_format($product->price, 2) }}</td>
                                    <td>&#8358; {{ number_format($product->discount_price, 2) }}</td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>{!! $product->is_in_stock == 0
                                        ? '<i class="text-green-500 fa fa-check"></i> Available'
                                        : '<i class="text-red-500 fa fa-times"></i> Out of
                                        stock' !!}
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($product->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--/Card-->
            </div>
            <!--/container-->
            {{ $products->links() }}
        @else
            No data found
        @endif
    </div>
</div>
