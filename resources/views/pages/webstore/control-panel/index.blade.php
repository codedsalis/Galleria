@extends('layouts.app-livewire')

@section('title', 'Control Panel')

@section('body')
    <div>
    @section('header', 'Control panel')

        <div class="max-w-7xl mx-auto py-1.5 sm:py-2 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row w-full">
                <div class="w-full lg:w-2/3">
                    {{-- <div class="bg-white rounded-md shadow-md md:mr-7 mb-5 md:mb-0">
                        <div class="text-dark-500 border-b border-gray-200 px-5 py-2.5 font-bold">
                            <i class="fas fa-info-circle"></i> Webstore Information
                        </div>
                        <div class="px-5 py-5 text-sm text-dark-400">
                        </div>
                    </div> --}}
                    <div class="grid grid-cols-2 mb-5 lg:mb-2 lg:mr-7 gap-2 md:gap-4">
                        {{-- Product categories --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/categories">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-pink-100 hover:">
                                    <div class="flex mb-2 w-full">
                                        <div class="max-w-max"><i
                                                class="bg-pink-300 text-pink-700 text-xl fa fa-list-alt rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Product categories <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                Create the different categories of your product here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Product Items --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/products">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-primary-100 hover:">
                                    <div class="flex mb-2">
                                        <div class="max-w-max"><i
                                                class="bg-primary-300 text-primary-500 text-xl fad fa-box rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Product items <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                Upload your products and other services you render here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Reviews --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/reviews">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-yellow-100 hover:">
                                    <div class="flex mb-2">
                                        <div class="max-w-max"><i
                                                class="bg-yellow-300 text-yellow-500 text-xl fa fa-star rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Reviews <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                See customers reviews on your products and about your store
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Statistics --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/statistics">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-secondary-100 hover:">
                                    <div class="flex mb-2">
                                        <div class="max-w-max"><i
                                                class="bg-secondary-300 text-secondary-500 text-xl fas fa-chart-bar rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Statistics <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                See statistics about your store performance and traffic reports
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Settings --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/settings">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-green-100 hover:">
                                    <div class="flex mb-2">
                                        <div class="max-w-max"><i
                                                class="bg-green-300 text-green-700 text-xl fas fa-sliders-h rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Settings <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                Adjust and modify your store settings
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Support center --}}
                        <div class="col-span-3 md:col-span-1">
                            <a href="/{{ $webstore[0]->id }}/support">
                                <div class="bg-white rounded-md shadow-md p-5 h-full hover:bg-blue-100 hover:">
                                    <div class="flex mb-2">
                                        <div class="max-w-max"><i
                                                class="bg-blue-300 text-blue-500 text-xl fas fa-question-circle rounded-lg shadow p-3"></i>
                                        </div>
                                        <div class="px-4 font-roboto text-dark-500 w-full">
                                            <h3 class="font-bold text-lg">Support center <i
                                                    class="fas fa-angle-right float-right mt-2"></i> </h3>
                                            <div class="text-dark-400 text-sm">
                                                If you are having an issue, kindly open a support ticket and you'll be
                                                attended to
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-md shadow-md">
                        <div class="text-dark-500 border-b text-lg border-gray-200 px-5 py-2.5 font-bold">
                            <i class="fas fa-info-circle"></i> Webstore Information
                        </div>
                        <div class="px-5 py-5 text-sm text-dark-400">
                            <table class="table-auto w-full">
                                @foreach ($webstore as $store)
                                    <tr>
                                        <td padding="10px">
                                            URL:
                                        </td>
                                        <td class="text-secondary-500 hover:text-secondary-400 text-right">
                                            <a href="https://galleria.ng/{{ $store->url }}"
                                                target="_blank"><b>https://galleria.ng/</b>{{ $store->url }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Store name:
                                        </td>
                                        <td class="text-right">
                                            {{ $store->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Category:
                                        </td>
                                        <td class="text-right">
                                            {{ $store->category }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            State located:
                                        </td>
                                        <td class="text-right">
                                            {{ $store->state }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            City:
                                        </td>
                                        <td class="text-right">
                                            {{ $store->city }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Address:
                                        </td>
                                        <td class="text-right">
                                            {{ $store->address }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Date created:
                                        </td>
                                        <td class="text-right">
                                            {{ date('d M, Y - h:i A', strtotime($store->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                {{--
                <livewire:webstore.control-panel.index :webstore="$webstore" /> --}}
                {{-- {{ $webstore }} --}}
            </div>
        </div>
    @endsection
