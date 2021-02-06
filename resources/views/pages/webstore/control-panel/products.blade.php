@extends('layouts.app-noheader')

@if ($request->intent == 'newitem')
    @section('title', 'Add new product')
    @else
    @section('title', 'Product Items')
    @endif

    @section('nav-links')
        <h3 class="py-5 font-semibold tracking-widest uppercase text-dark-500">Product Categories</h3>
        @if (count($categories) > 0)
            {{-- All categories --}}
            <a href="?allcategories" class="text-dark-500 hover:text-primary-500 focus:outline-none">
                <div
                    class="{{ !$request->category && !$request->intent ? 'px-4 py-3 rounded bg-primary-100 border-l-4 border-primary-500 font-semibold text-primary-500 mb-1 mt-1' : 'px-2 py-3 rounded hover:bg-primary-100' }}">
                    All Categories
                </div>
            </a>
            @foreach ($categories as $category)
                <a href="?category={{ $category->id }}" class="text-dark-500 hover:text-primary-500 focus:outline-none">
                    <div
                        class="{{ $request->category == $category->id ? 'px-4 py-3 rounded bg-primary-100 border-l-4 border-primary-500 font-semibold text-primary-500 mb-1 mt-1' : 'px-2 py-3 rounded hover:bg-primary-100' }}">
                        {{ $category->name }}
                    </div>
                </a>
            @endforeach
        @else
            <div class="flex flex-col items-center justify-center">
                <img src="/assets/no-data.png" width="200" height="auto" />
                <p class="py-5 font-semibold tracking-widest text-dark-400">
                    No categories created yet. <a
                        href="/{{ $webstore[0]->id }}/categories?utm_ref=productitems&utm_action=no_categories_found"
                        class="text-secondary-500 hover:text-secondary-400 focus:outline-none">Create
                        categories</a>
                </p>
            </div>
        @endif
    @endsection

    @section('body')
        <!-- Page Heading -->
        <div class="flex justify-between px-2 py-3 bg-gray-100 max-w-7xl md:px-6 lg:px-8 mt-14">
            <h2 class="text-3xl font-semibold leading-normal text-dark-500">
                {{ $request->intent == 'newitem' ? 'Add new product' : 'Products' }}
            </h2>
            {{-- If no newitem request --}}
            @if (!$request->intent == 'newitem')
                <div>
                    <a href="?intent=newitem&utm_ref=additembutton">
                        <button
                            class="bg-primary-300 hover:bg-primary-400 text-primary-600 tracking-widest text-xs font-semibold uppercase px-5 py-2.5 sm:py-3 rounded-md shadow-md focus:ring focus:outline-none">
                            <i class="fa fa-plus"></i>
                            Add Item
                        </button>
                    </a>
                </div>
            @endif
        </div>
        <!-- </header> -->


        <div class="max-w-7xl mx-auto py-1.5 sm:py-2 sm:px-6 lg:px-8">

            @if ($request->intent == 'newitem')
                <livewire:webstore.control-panel.products.add-new-item :webstoreId="$webstore[0]->id"
                    :categories="$categories" />
            @else
                <livewire:webstore.control-panel.products :webstoreId="$webstore[0]->id"
                    :categoryId="$request->category ? $request->category : null" :products="$products" />
            @endif

        </div>
    @endsection
