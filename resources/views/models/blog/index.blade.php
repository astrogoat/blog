@extends('lego::layouts.lego')

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush

@section('content')
    <x-fab::layouts.page
        title="Blog Overview"
    >

        <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <x-fab::layouts.panel>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-fab::elements.icon icon="collection" class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ Str::plural('Category', $categoriesCount) }}
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ $categoriesCount }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>

                <x-slot name="footer">
                    <a href="{{ route('lego.blog.categories.index') }}"
                       class="flex items-center justify-end text-sm text-gray-600">View all
                        <x-fab::elements.icon icon="arrow-narrow-right" class="ml-2 h-5 w-5 text-gray-400"/>
                    </a>
                </x-slot>
            </x-fab::layouts.panel>

            <x-fab::layouts.panel>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-fab::elements.icon icon="document-text" class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                {{ Str::plural('Article', $articlesCount) }}
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900">
                                    {{ $articlesCount }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <x-slot name="footer">
                    <a href="{{ route('lego.blog.articles.index') }}"
                       class="flex items-center justify-end text-sm text-gray-600">View all
                        <x-fab::elements.icon icon="arrow-narrow-right" class="ml-2 h-5 w-5 text-gray-400"/>
                    </a>
                </x-slot>
            </x-fab::layouts.panel>


        </div>

    </x-fab::layouts.page>
@endsection
