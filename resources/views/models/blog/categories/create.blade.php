@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="New Category"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Categories', 'url' => route('lego.blog.category.index')],
            ['title' => 'New'],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
    >
        <livewire:astrogoat.blog.categories-form :category="\Astrogoat\Blog\Models\Category::make()"/>
    </x-fab::layouts.page>
@endsection
