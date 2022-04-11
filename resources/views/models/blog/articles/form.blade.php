<div x-data>

    <x-slot name="actions">
        @if($article->exists)
            <x-fab::elements.button
                type="link"
                :url="url('') . '/' . Route::getRoutes()->getByName('blog.articles.show')->getPrefix() . '/' . $article->slug"
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
                :url="route('lego.blog.articles.editor', $article)"
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

        @include('blog::models._includes.published-state-select')
    </x-slot>

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Article title"
                wire:model="article.title"
            />

            <x-fab::forms.input
                wire:model="article.slug"
                label="URL and handle (slug)"
                addon="{{ url('') . '/' . Route::getRoutes()->getByName('blog.articles.show')->getPrefix() . '/' }}"
                help="The URL where this article can be viewed. Changing this will break any existing links users may have bookmarked."
                :disabled="! $article->exists"
            />

        </x-fab::layouts.panel>

        @include('lego::metafields.define', ['metafieldable' => $article])

        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Author"
                wire:model="article.author"
                help="Only numbers. For user to be able to click a phone number on their device."
            />

        </x-fab::layouts.panel>

        <x-fab::layouts.panel>

            <x-fab::forms.select
                wire:model="article.category_id"
                label="Category"
                help="Choose a category for this article."
            >
                <option disabled>-- Select category</option>
                <option value="">New category</option>
                @foreach($this->categories() as $id => $category)
                    <option value="{{ $id }}">{{ $category }}</option>
                @endforeach
            </x-fab::forms.select>

        </x-fab::layouts.panel>

        <x-slot name="aside">

            <x-fab::layouts.panel heading="Structure" class="mb-4">

                <x-fab::forms.select
                    wire:model="article.layout"
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
                    wire:model="article.footer_id"
                    label="Footer"
                >
                    <option value="">No footer</option>
                    @foreach($this->footers() as $id => $footer)
                        <option value="{{ $id }}">{{ $footer }}</option>
                    @endforeach
                </x-fab::forms.select>
            </x-fab::layouts.panel>

            @if($article->exists)
                <x-fab::layouts.panel>
                    <x-fab::elements.button
                        wire:click="delete"
                        class="text-red-500"
                    >
                        <x-fab::elements.icon
                            icon="trash"
                            type="solid"
                            class="-ml-1 mr-2 h-5 w-5 text-red-500"
                        />
                        Delete Article
                    </x-fab::elements.button>
                </x-fab::layouts.panel>
            @endif
        </x-slot>

    </x-fab::layouts.main-with-aside>
    @push('styles')
        <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
    @endpush
</div>

