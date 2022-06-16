<div x-data>

    <x-slot name="actions">
        @if($category->exists)
            <x-fab::elements.button
                type="link"
                :url="url('') . '/' . Route::getRoutes()->getByName('blog.categories.show')->getPrefix() . '/' . $category->slug"
                target="_blank"
                class="mb-4 mr-2"
            >
                <x-fab::elements.icon
                    icon="eye"
                    type="solid"
                    class="-ml-1 mr-2 h-5 w-5"
                />
                View
            </x-fab::elements.button>

            <x-fab::elements.button
                type="link"
                :url="route('lego.blog.categories.editor', $category)"
                class="mb-4"
            >
                <x-fab::elements.icon
                    icon="adjustments"
                    type="solid"
                    class="-ml-1 mr-2 h-5 w-5"
                />
                Customize
            </x-fab::elements.button>
        @endif
    </x-slot>

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Category name"
                wire:model="category.name"
            />

            <x-fab::forms.input
                wire:model="category.slug"
                label="URL and handle (slug)"
                addon="{{ url('') . '/' . Route::getRoutes()->getByName('blog.categories.show')->getPrefix() . '/' }}"
                help="The URL where this category can be viewed. Changing this will break any existing links users may have bookmarked."
                :disabled="! $category->exists"
            />

            <x-fab::forms.editor
                wire:model="category.description"
                label="Description"
                help="Use this field to format the category description"

            />

            <x-fab::forms.checkbox
                id="should_index"
                label="Should be indexed"
                wire:model="category.indexable"
                help="If checked this will allow search engines (i.e. Google or Bing) to index the category so it can be found when searching on said search engine."
            />

        </x-fab::layouts.panel>

        @include('lego::metafields.define', ['metafieldable' => $category])

        <x-slot name="aside">

            <x-fab::layouts.panel heading="Structure" class="mb-4">
                <x-fab::forms.select
                    wire:model="category.layout"
                    label="Layout"
                    help="The base layout for the page."
                >
                    <option disabled>-- Select layout</option>
                    <option value="">Default</option>
                    @foreach(siteLayouts() as $key => $layout)
                        <option value="{{ $key }}">{{ $layout }}</option>
                    @endforeach
                </x-fab::forms.select>

                <x-fab::forms.select
                    wire:model="category.footer_id"
                    label="Footer"
                >
                    <option value="">No footer</option>
                    @foreach($this->footers() as $id => $footer)
                        <option value="{{ $id }}">{{ $footer }}</option>
                    @endforeach
                </x-fab::forms.select>
            </x-fab::layouts.panel>

            @if($category->exists)
                <x-fab::layouts.panel>
                    <x-lego::media-panel :model="$category" />
                </x-fab::layouts.panel>
            @else
                <x-fab::layouts.panel>
                    <p class="text-sm text-blue">You have to save the article before you can add an image to it.</p>
                </x-fab::layouts.panel>
            @endif

            @if($category->exists)
                <x-fab::layouts.panel class="mt-4">
                    <x-fab::elements.button
                        wire:click="delete"
                        class="text-red-500"
                    >
                        <x-fab::elements.icon
                            icon="trash"
                            type="solid"
                            class="-ml-1 mr-2 h-5 w-5 text-red-500"
                        />
                        Delete Category
                    </x-fab::elements.button>
                </x-fab::layouts.panel>
            @endif
        </x-slot>

    </x-fab::layouts.main-with-aside>
    @push('styles')
        <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
    @endpush
</div>

