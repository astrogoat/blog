@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="Blog Overview"
    >
        <div class="blog-mt-2 blog-grid blog-grid-cols-1 blog-gap-4 sm:blog-grid-cols-2 lg:blog-grid-cols-3">
            <x-fab::layouts.panel>
                <div class="blog-flex blog-items-center">
                    <div class="blog-flex-shrink-0">
                        <x-fab::elements.icon icon="collection" class="blog-h-6blog- w-6 blog-text-gray-400"/>
                    </div>
                    <div class="blog-ml-5 blog-w-0 blog-flex-1">
                        <dl>
                            <dt class="blog-text-sm blog-font-medium blog-text-gray-500 blog-truncate">
                                {{ Str::plural('Category', $categoriesCount) }}
                            </dt>
                            <dd>
                                <div class="blog-text-lg blog-font-medium blog-text-gray-900">
                                    {{ $categoriesCount }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>

                <x-slot name="footer">
                    <a href="{{ route('lego.blog.categories.index') }}"
                       class="blog-flex blog-items-center blog-justify-end blog-text-sm blog-text-gray-600">View all
                        <x-fab::elements.icon icon="arrow-narrow-right" class="blog-ml-2 blog-h-5 blog-w-5 blog-text-gray-400"/>
                    </a>
                </x-slot>
            </x-fab::layouts.panel>

            <x-fab::layouts.panel>
                <div class="blog-flex blog-items-center">
                    <div class="blog-flex-shrink-0">
                        <x-fab::elements.icon icon="document-text" class="blog-h-6 blog-w-6 blog-text-gray-400"/>
                    </div>
                    <div class="blog-ml-5 blog-w-0 blog-flex-1">
                        <dl>
                            <dt class="blog-text-sm blog-font-medium blog-text-gray-500 blog-truncate">
                                {{ Str::plural('Article', $articlesCount) }}
                            </dt>
                            <dd>
                                <div class="blog-text-lg blog-font-medium blog-text-gray-900">
                                    {{ $articlesCount }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <x-slot name="footer">
                    <a href="{{ route('lego.blog.articles.index') }}"
                       class="blog-flex blog-items-center blog-justify-end blog-text-sm blog-text-gray-600">View all
                        <x-fab::elements.icon icon="arrow-narrow-right" class="blog-ml-2 blog-h-5 blog-w-5 blog-text-gray-400"/>
                    </a>
                </x-slot>
            </x-fab::layouts.panel>

        </div>
    </x-fab::layouts.page>

    <x-fab::layouts.page
        title="Tags"
    >
        <x-slot name="actions">
            <x-fab::elements.button type="link" :url="route('lego.blog.tags.create')">Create</x-fab::elements.button>
        </x-slot>
        <div class="blog-mt-2 blog-grid blog-grid-cols-1 blog-gap-4 sm:blog-grid-cols-2 lg:blog-grid-cols-3">

            @foreach($tags as $tag)
                <x-fab::layouts.panel>
                    <div class="blog-flex blog-items-center">
                        <div class="blog-flex-shrink-0">
                            <x-fab::elements.icon icon="document-text" class="blog-h-6 blog-w-6 blog-text-gray-400"/>
                        </div>
                        <div class="blog-ml-5 blog-w-0 blog-flex-1">
                            <dl>
                                <dt class="blog-text-sm blog-font-medium blog-text-gray-500 blog-truncate">
                                    {{ $tag->title }}
                                </dt>
                                <dd>
                                    <div class="blog-text-lg blog-font-medium blog-text-gray-900">
                                        {{ $tag->articles->count() }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <x-slot name="footer">
                        <a href="{{ route('lego.blog.tags.edit', $tag) }}"
                           class="blog-flex blog-items-center blog-justify-end blog-text-sm blog-text-gray-600">Edit
                            <x-fab::elements.icon icon="arrow-narrow-right" class="blog-ml-2 blog-h-5 blog-w-5 blog-text-gray-400"/>
                        </a>
                    </x-slot>
                </x-fab::layouts.panel>
            @endforeach
        </div>
    </x-fab::layouts.page>
@endsection
