

@extends('lego::layouts.lego')

@section('content')
    <x-fab::layouts.page
        title="Groups"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => '/admin'],
            ['title' => 'Groups'],
        ]"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.blog.groups.create')">Create</x-fab::elements.button>
        </x-slot>

        <x-fab::lists.table>
            <x-slot name="headers">
                <x-fab::lists.table.header>Title</x-fab::lists.table.header>
                <x-fab::lists.table.header>Last updated</x-fab::lists.table.header>
                <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
            </x-slot>

            @foreach($groups as $group)
                <x-fab::lists.table.row :odd="$loop->odd">
                    <x-fab::lists.table.column full primary>
                        <a href="{{ route('lego.blog.groups.edit', $group) }}">{{ $group->title }}</a>
                    </x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right">{{ $group->updated_at->toFormattedDateString() }}</x-fab::lists.table.column>
                    <x-fab::lists.table.column align="right" slim>
                        <a href="{{ route('lego.blog.groups.edit', $group) }}">Edit</a>
                    </x-fab::lists.table.column>
                </x-fab::lists.table.row>
            @endforeach
        </x-fab::lists.table>

        <div class="pt-6">
            {{ $groups->links() }}
        </div>
    </x-fab::layouts.page>
@endsection
