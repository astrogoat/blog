<x-fab::layouts.page
    title="{{ $model->title ?: 'Untitled' }}"
    :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Articles', 'url' => route('lego.blog.articles.index')],
            ['title' => $model->title ?: 'New Article' ],
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
                label="Article title"
                wire:model="model.title"
            />

            <x-fab::forms.input
                wire:model="model.slug"
                label="URL and handle (slug)"
                addon="{{ url('') . '/' . Route::getRoutes()->getByName('blog.articles.show')->getPrefix() . '/' }}"
                help="The URL where this article can be viewed. Changing this will break any existing links users may have bookmarked."
                :disabled="! $model->exists"
            />

        </x-fab::layouts.panel>
       
        
        <x-fab::layouts.panel title="SEO">
            <x-fab::forms.input
                name="model.meta.article_page_title"
                label="Page Title"
                wire:model="model.meta.article_page_title"
                help="The text displayed in the browser tab/window."
            />

            <x-fab::forms.textarea
                name="model.meta.article_page_description"
                wire:model="model.meta.article_page_description"
                label="Description"
                help="Meta description for search engines like Google and Bing."
            />

        </x-fab::layouts.panel>

        @include('lego::metafields.define', ['metafieldable' => $model])

        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Author"
                wire:model="model.author"
            />

            <x-fab::forms.checkbox
                id="should_index"
                label="Should be indexed"
                wire:model="model.indexable"
                help="If checked this will allow search engines (i.e. Google or Bing) to index the page so it can be found when searching on said search engine."
            />
        </x-fab::layouts.panel>

        <x-fab::layouts.panel>
            <x-fab::forms.select
                wire:model="model.category_id"
                label="Category"
                help="Choose a category for this model. Or <a href='{{ route('lego.blog.categories.create') }}' target='_blank'>create a new category</a>."
            >
                <option value="">-- Select category</option>
                @foreach($this->categories() as $id => $category)
                    <option value="{{ $id }}">{{ $category }}</option>
                @endforeach
            </x-fab::forms.select>
        </x-fab::layouts.panel>

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
                    Please save the article before you can attach media to it.
                </x-fab::feedback.alert>
            @endif
        </x-slot>

    </x-fab::layouts.main-with-aside>
</x-fab::layouts.page>

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush
