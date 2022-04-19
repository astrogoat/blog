@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="Blog Articles"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Blog Articles'],
        ]"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.blog.articles.create')">Create</x-fab::elements.button>
        </x-slot>

        <x-fab::lists.table>
            <x-slot name="headers">
                <x-fab::lists.table.header>Title</x-fab::lists.table.header>
                <x-fab::lists.table.header>Author</x-fab::lists.table.header>
                <x-fab::lists.table.header>Category</x-fab::lists.table.header>
                <x-fab::lists.table.header>Last updated</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Customize</x-fab::lists.table.header>
            </x-slot>

            @foreach($articles as $article)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.articles.edit', $article) }}">{{ $article->title }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.articles.edit', $article) }}">{{ $article->author }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.articles.edit', $article) }}">{{ $article->category }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column
                        align="right">{{ $article->updated_at->toFormattedDateString() }}</x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right" slim>
                        <a href="{{ route('lego.blog.articles.edit', $article) }}">Edit</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">
                        <a href="{{ route('lego.blog.articles.editor', $article) }}">Customize</a>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        <div class="pt-6">
            {{ $articles->links() }}
        </div>
    </x-fab::layouts.page>
@endsection
