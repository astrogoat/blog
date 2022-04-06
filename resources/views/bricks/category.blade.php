<div>
    @php($brickKey = isset($repeaterBrickName) ? "{$repeaterBrickName}.{$index}.{$brickName}" : $brickName)
    @php($categoryInputId = md5($this->_id . '.' . $brickKey))

    <div
        x-on:{{ $categoryInputId }}.window="$wire.set('{{ $brickKey }}', $event.detail)"
    >
        <label for="" class="block text-sm font-medium text-gray-700 pb-1">Category</label>
        @if($this->get($brickKey)->getCategoryModel())
            <span class="blog-inline-flex blog-items-center blog-py-0.5 blog-pl-2.5 blog-pr-1 blog-rounded-md blog-text-sm blog-font-medium blog-bg-gray-100 blog-text-gray-700">
                {{ $this->get($brickKey)->getCategoryModel()->name }}
                <button
                    type="button"
                    class="blog-flex blog-shrink-0 blog-rounded-md blog-ml-1 blog-h-4 blog-w-4 blog-inline-flex blog-items-center blog-justify-center blog-text-gray-400 hover:blog-bg-gray-200 hover:blog-text-gray-500 focus:blog-outline-none focus:blog-bg-gray-500 focus:blog-text-white"
                    x-on:click="$wire.set('{{ $brickKey }}', null)"
                >
                    <span class="blog-sr-only">Remove Category</span>
                    <x-fab::elements.icon icon="x" type="solid" class="blog-h-3 blog-w-3" />
              </button>
            </span>
        @else
            <x-fab::elements.button
                size="sm"
                x-on:click="$modal.open('astrogoat.blog.browse-categories', {{ json_encode([
                'categoryInputId' => $categoryInputId
            ]) }})"
            >
                Select Category
            </x-fab::elements.button>
        @endif
    </div>
</div>

@push('styles')
    <link href="{{ asset('vendor/blog/css/blog.css') }}" rel="stylesheet">
@endpush
