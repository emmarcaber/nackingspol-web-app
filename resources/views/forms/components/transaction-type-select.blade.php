<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()"
    :hint="$getHint()" :hint-color="$getHintColor()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }" class="flex gap-4">
        @foreach ($getTransactionTypes() as $type)
            <div x-on:click="state = { id: '{{ $type }}', name: '{{ $type }}' }"
                class="w-full border rounded-lg p-4 cursor-pointer transition duration-200 ease-in-out"
                :class="{ 'ring-2 ring-offset-2': state?.id === '{{ $type }}' }">
                <div class="flex items-center justify-between">
                    <span class="font-medium">{{ $type }}</span>
                    <span x-show="state?.id === '{{ $type }}'" class="text-primary-500">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</x-dynamic-component>
