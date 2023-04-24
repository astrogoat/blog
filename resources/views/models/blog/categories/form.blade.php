<x-fab::layouts.page
        title="{{ $model->name ?: 'Untitled' }}"
        :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Categories', 'url' => route('lego.blog.categories.index')],
            ['title' => $model->name ?: 'New Category' ],
        ]"
        x-data=""
        x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
        x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
    >
    <x-slot name="actions">
        @include('lego::models._includes.forms.page-actions')
    </x-slot>

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Category name"
                wire:model="model.name"
            />

            <x-fab::forms.input
                wire:model="model.slug"
                label="URL and handle (slug)"
                addon="{{ url('') . '/' . Route::getRoutes()->getByName('blog.categories.show')->getPrefix() . '/' }}"
                help="The URL where this category can be viewed. Changing this will break any existing links users may have bookmarked."
                :disabled="! $model->exists"
            />

            <x-fab::forms.editor
                wire:model="model.description"
                label="Description"
                help="Use this field to format the category description"
            />

            <x-fab::forms.checkbox
                id="should_index"
                label="Should be indexed"
                wire:model="model.indexable"
                help="If checked this will allow search engines (i.e. Google or Bing) to index the category so it can be found when searching on said search engine."
            />
        </x-fab::layouts.panel>

        @include('lego::metafields.define', ['metafieldable' => $model])

        <x-slot name="aside">
            <x-fab::layouts.panel heading="Structure" class="mb-4">
                <x-fab::forms.select
                    wire:model="model.layout"
                    label="Layout"
                    help="The base layout for the page."
                >
                    <option disabled>-- Select layout</option>
                    @foreach(siteLayouts() as $key => $layout)
                        <option value="{{ $key }}">{{ $layout }}</option>
                    @endforeach
                </x-fab::forms.select>

                <x-fab::forms.select
                    wire:model="model.footer_id"
                    label="Footer"
                >
                    <option value="">No footer</option>
                    @foreach($this->footers() as $id => $footer)
                        <option value="{{ $id }}">{{ $footer }}</option>
                    @endforeach
                </x-fab::forms.select>
            </x-fab::layouts.panel>

            @if($model->exists)
                <x-lego::media-panel :model="$model" />
            @else
                <x-fab::feedback.alert type="info">
                    Please save the category before you can attach media to it.
                </x-fab::feedback.alert>
            @endif
        </x-slot>

        <x-fab::layouts.panel
            title="Articles"
            description="Link articles to this category"
            class="blog-mt-4"
            allow-overflow
        >

            @if($model->exists)
                <x-fab::lists.stacked
                    x-sortable="updateArticlesOrder"
                    x-sortable.tag="articles"
                >
                    @foreach($this->selectedArticles as $article)
                        <div x-sortable.articles.item="{{ $article->id }}">
                            <x-fab::lists.stacked.grouped-with-actions
                                :title="$article->title"
                                :description="$article->title"
                            >
                                <x-slot name="avatar">
                                    <div class="flex">
                                        <x-fab::elements.icon icon="dots-vertical" x-sortable.articles.handle class="blog-h-5 blog-w-5 blog-text-gray-300 blog--mr-2" />
                                        <x-fab::elements.icon icon="dots-vertical" x-sortable.articles.handle class="blog-h-5 blog-w-5 blog-text-gray-300 blog--ml-1.5" />
                                    </div>
                                </x-slot>
                                <x-slot name="actions">
                                    <x-fab::elements.button
                                        size="xs"
                                        type="link"
                                        :url="route('lego.blog.articles.edit', $article)"
                                    >
                                        View
                                    </x-fab::elements.button>

                                </x-slot>
                            </x-fab::lists.stacked.grouped-with-actions>
                        </div>
                    @endforeach
                </x-fab::lists.stacked>
            @else
                <x-fab::feedback.alert type="info">
                    Please save the tag before you can attach articles to it.
                </x-fab::feedback.alert>
            @endif
        </x-fab::layouts.panel>

    </x-fab::layouts.main-with-aside>
</x-fab::layouts.page>

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush
