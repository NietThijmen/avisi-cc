<div>
    <div class="max-w-6xl mx-auto mt-4">
        <h1 class="text-2xl font-bold text-gray-800">{{ $educationRubric->name . " - " . $crebo->name . " ($crebo->crebo_number)" }}</h1>

        <hr class="my-3" />

        <h1 class="text-2xl font-bold text-gray-800">{{ __('Edit Education Rubric') }}</h1>
        <div>
            <div class="flex justify-between items-center mt-4">
                <section>
                    <x-input-label for="name" value="{{ __('Name') }}" />
                    <x-text-input type="text" wire:model="state.name" class="w-full" />
                    <x-input-error :messages="$errors->get('name')" />
                </section>

                <x-secondary-button wire:click="editEducationRubric()" class="mt-4">{{ __('Save') }}</x-secondary-button>
            </div>
            <x-action-message class="ml-auto w-min" on="education-rubric-saved">
                {{ __('Saved') }}
            </x-action-message>
        </div>

        <hr class="my-3" />


    </div>
</div>
