<x-fab::layouts.page
    title="Categories"
    :breadcrumbs="[
        ['title' => 'Home', 'url' => route('lego.dashboard')],
        ['title' => 'Blog Categories', 'url' => route('lego.blog.categories.index')],
    ]"
    x-data="{ showColumnFilters: false }"
>
    <x-slot name="actions">
        <x-fab::elements.button type="link" :url="route('lego.blog.categories.create')">Create</x-fab::elements.button>
    </x-slot>

    @include('lego::models._includes.indexes.filters')

    <x-fab::lists.table>
        <x-slot name="headers">
            @include('lego::models._includes.indexes.headers')
            <x-fab::lists.table.header :hidden="true">Edit</x-fab::lists.table.header>
            <x-fab::lists.table.header :hidden="true">Customize</x-fab::lists.table.header>
        </x-slot>

        @include('lego::models._includes.indexes.header-filters')
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />
        <x-fab::lists.table.header x-show="showColumnFilters" x-cloak class="bg-gray-100" />

        @foreach($models as $category)
            <x-fab::lists.table.row :odd="$loop->odd">
                @if($this->shouldShowColumn('name'))
                    <x-fab::lists.table.column primary full class="blog-truncate">
                        <a href="{{ route('lego.blog.categories.edit', $category) }}">{{ $category->name }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('slug'))
                    <x-fab::lists.table.column>
                        <a href="{{ route('lego.blog.categories.edit', $category) }}">{{ $category->slug }}</a>
                    </x-fab::lists.table.column>
                @endif

                @if($this->shouldShowColumn('updated_at'))
                    <x-fab::lists.table.column align="right">
                        {{ $category->updated_at->toFormattedDateString() }}
                    </x-fab::lists.table.column>
                @endisset

                <x-fab::lists.table.column align="right" slim>
                    <a href="{{ route('lego.blog.categories.edit', $category) }}">Edit</a>
                </x-fab::lists.table.column>

                <x-fab::lists.table.column align="right">
                    <a href="{{ route('lego.blog.categories.editor', $category) }}">Customize</a>
                </x-fab::lists.table.column>
            </x-fab::lists.table.row>
        @endforeach
    </x-fab::lists.table>

    @include('lego::models._includes.indexes.pagination')
</x-fab::layouts.page>
