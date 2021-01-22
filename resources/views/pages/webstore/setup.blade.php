@extends('layouts.app-light')

@section('title', 'Set up your webstore')

@section('body')
    <div>
        <div class="max-w-7xl mx-auto py-1.5 sm:py-2 sm:px-6 lg:px-8">
            <livewire:webstore.setup :webstore="$webstore" />
        </div>
    </div>
@endsection
