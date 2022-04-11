<x-fab::forms.select.branded>
    <x-slot name="label">
        @if($this->getPublishableModel()->hasBeenPublished())
            <x-fab::elements.icon icon="check" type="solid" class="h-5 w-5" />
        @elseif($this->getPublishableModel()->isScheduled())
            <x-fab::elements.icon icon="clock" type="solid" class="h-5 w-5" />
        @else
            <x-fab::elements.icon icon="pencil-alt" type="solid" class="h-5 w-5" />
        @endif
        <p class="ml-2.5 text-sm font-medium">{{ $this->getPublishableModel()->publishedState() }}</p>
    </x-slot>
    <x-fab::forms.select.branded.option
        :title="$this->getPublishableModel()->hasBeenPublished() ? 'Unpublish' : 'Draft'"
        :selected="$this->getPublishableModel()->isDraft()"
        wire:click="unpublish"
        class="cursor-pointer"
    >
        @if($this->getPublishableModel()->isDraft())
            Can only be viewed by anyone logged into Lego.
        @else
            Mark as draft. Will only be viewable by anyone logged into Lego.
        @endif
    </x-fab::forms.select.branded.option>

    <x-fab::forms.select.branded.option
        :title="$this->getPublishableModel()->isDraft() ? 'Publish' : $this->getPublishableModel()->publishedState()"
        :selected="! $this->getPublishableModel()->isDraft()"
    >
        @if(! $this->getPublishableModel()->isDraft() && $this->getPublishableModel()->hasBeenPublished())
            Can be viewed by anyone.
        @elseif(! $this->getPublishableModel()->isDraft() && $this->getPublishableModel()->isScheduled())
            Can only be viewed by anyone logged into Lego and will be published on "{{ $this->getPublishableModel()->published_at->toFormattedDateString() }}".
        @else
            Set the date for when to publish.
        @endif
        <div class="flex mt-2" x-show="{{ ! $this->getPublishableModel()->hasBeenPublished() ? 'true' : 'false' }}">
            <x-fab::forms.date-picker
                :options="[
                    'dateFormat' => 'Y-m-d H:i',
                    'altInput' => true,
                    'altFormat' => 'D, M J Y',
                ]"
                wire:model="article.published_at"
            />
        </div>
    </x-fab::forms.select.branded.option>
</x-fab::forms.select.branded>
