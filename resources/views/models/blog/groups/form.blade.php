<x-fab::layouts.page
    :title="$group->title ?: 'Untitled'"
    :breadcrumbs="[
            ['title' => 'Home', 'url' => route('lego.dashboard')],
            ['title' => 'Blog', 'url' => route('lego.blog.index')],
            ['title' => 'Groups', 'url' => route('lego.blog.groups.index')],
            ['title' => $group->title ?: 'Untitled'],
        ]"
    x-data=""
    x-on:keydown.meta.s.window.prevent="$wire.call('save')" {{-- For Mac --}}
    x-on:keydown.ctrl.s.window.prevent="$wire.call('save')" {{-- For PC  --}}
>
    <x-lego::feedback.errors class="sh-mb-4" />

    <x-fab::layouts.main-with-aside>
        <x-fab::layouts.panel>
            <x-fab::forms.input
                label="Title"
                wire:model="group.title"
            />

        </x-fab::layouts.panel>

        <x-fab::layouts.panel
            title="Articles"
            description="Link articles to this group"
            class="sh-mt-4"
            allow-overflow
            x-on:fab-added="$wire.call('selectArticle', $event.detail[1].key)"
            x-on:fab-removed="$wire.call('unselectArticle', $event.detail[1].key)"
        >

            @if($group->exists)
                <x-fab::forms.combobox
                    :items="$this->getArticlesForGroupCombobox()"
                ></x-fab::forms.combobox>

                <x-fab::lists.stacked
                    x-sortable="updateArticlesOrder"
                    x-sortable.group="articles"
                >
                    @foreach($this->selectedArticles as $article)
                        <div
                            x-sortable.products.item="{{ $article->id }}"
                        >
                            <x-fab::lists.stacked.grouped-with-actions
                                :title="$article->title"
                                :description="$article->title"
                            >
                                <x-slot name="avatar">
                                    <div class="flex">
                                        <x-fab::elements.icon icon="dots-vertical" x-sortable.products.handle class="sh-h-5 sh-w-5 sh-text-gray-300 sh--mr-2" />
                                        <x-fab::elements.icon icon="dots-vertical" x-sortable.products.handle class="sh-h-5 sh-w-5 sh-text-gray-300 sh--ml-1.5" />
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
                    Please save the group before you can attach articles to it.
                </x-fab::feedback.alert>
            @endif

        </x-fab::layouts.panel>
        <x-slot name="aside">

            @if($group->exists)
                <x-fab::layouts.panel class="">
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
</x-fab::layouts.page>

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush
