@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="{{ $article->title }}"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Articles', 'url' => route('lego.blog.article.index')],
            ['title' => $article->title],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
    >
        <livewire:astrogoat.blog.articles-form :article="$article"/>
    </x-fab::layouts.page>
@endsection
