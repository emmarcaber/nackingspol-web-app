<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()"
    :hint="$getHint()" :hint-color="$getHintColor()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($getProducts() as $product)
            <div x-on:click="state = {{ json_encode(['id' => $product->id, 'name' => $product->name]) }}"
                class="border rounded-lg p-4 cursor-pointer transition duration-200 ease-in-out"
                :class="{
                    'border-primary-600 bg-primary-500 text-white': state?.id === {{ $product->id }},
                    'hover:bg-gray-200': state?.id !== {{ $product->id }}
                }">
                <h3 class="font-bold text-lg text-white">{{ $product->name }}</h3>
                <p class="text-sm font-semibold mt-2">₱{{ $product->price }}</p>
            </div>
        @endforeach
    </div>
</x-dynamic-component>
