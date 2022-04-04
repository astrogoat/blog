@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="New Article"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Articles', 'url' => route('lego.blog.article.index')],
            ['title' => 'New'],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
    >
        <livewire:astrogoat.blog.article-form :location="\Astrogoat\Blog\Models\BlogArticle::make()"/>
    </x-fab::layouts.page>
@endsection
