@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="Blog Categories"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Blog Categories'],
        ]"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.blog.categories.create')">Create
            </x-fab::elements.button>
        </x-slot>

        <x-fab::lists.table>
            <x-slot name="headers">
                <x-fab::lists.table.header>name</x-fab::lists.table.header>
                <x-fab::lists.table.header>Last updated</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Customize</x-fab::lists.table.header>
            </x-slot>

            @foreach($categories as $category)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.categories.edit', $category) }}">{{ $category->name }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column
                        align="right">{{ $category->updated_at->toFormattedDateString() }}</x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right" slim>
                        <a href="{{ route('lego.blog.categories.edit', $category) }}">Edit</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">
                        <a href="{{ route('lego.blog.categories.editor', $category) }}">Customize</a>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        <div class="pt-6">
            {{ $categories->links() }}
        </div>
    </x-fab::layouts.page>
@endsection
