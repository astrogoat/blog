

@extends('lego::layouts.lego')

@section('content')
    <x-fab::layouts.page
        title="Tags"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Tags'],
        ]"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.blog.tags.create')">Create</x-fab::elements.button>
        </x-slot>

        <x-fab::lists.table>
            <x-slot name="headers">
                <x-fab::lists.table.header>Title</x-fab::lists.table.header>
                <x-fab::lists.table.header>Last updated</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
            </x-slot>

            @foreach($tags as $tag)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.tags.edit', $tag) }}">{{ $tag->title }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">{{ $tag->updated_at->toFormattedDateString() }}</x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right" slim>
                        <a href="{{ route('lego.blog.tags.edit', $tag) }}">Edit</a>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        <div class="pt-6">
            {{ $tags->links() }}
        </div>
    </x-fab::layouts.page>
@endsection
