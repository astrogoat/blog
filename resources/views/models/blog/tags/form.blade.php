<x-fab::layouts.page
    :title="$model->title ?: 'Untitled'"
    :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Tags', 'url' => route('lego.blog.tags.index')],
            ['title' => $model->title ?: 'Untitled'],
        ]"
    x-data=""
    x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
    x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
>
    <x-slot name="actions">
        @include('lego::models._includes.forms.page-actions')
    </x-slot>

    <x-lego::feedback.errors class="blog-mb-4" />

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Title"
                wire:model="model.title"
            />

        </x-fab::layouts.panel>

        <x-fab::layouts.panel
            title="Articles"
            description="Link articles to this tag"
            class="blog-mt-4"
            allow-overflow
            x-on:fab-added="$wire.call('selectArticle', $event.detail[1].key)"
            x-on:fab-removed="$wire.call('unselectArticle', $event.detail[1].key)"
        >

            @if($model->exists)
                <x-fab::forms.combobox :items="$this->getArticlesForTagCombobox()" />

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

                                    <x-fab::elements.button
                                        size="xs"
                                        wire:click="unselectArticle({{ $article->id }})"
                                    >
                                        Remove
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
