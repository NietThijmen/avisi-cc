<div>
    <div class="max-w-6xl mx-auto mt-4">
        <h1 class="text-2xl font-bold text-gray-800">{{ $crebo->name . " ($crebo->crebo_number)" }}</h1>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{__("Education Rubrics")}}</h1>
            <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'add-education-rubric')">
                {{ __('Add education rubric') }}
            </x-primary-button>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">{{ __('Name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">{{ __('Created At') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider w-1/5">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($crebo->educationRubrics as $educationRubric)
                    <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $educationRubric->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $crebo->created_at->format('j-M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.education-rubric.edit', ['educationRubric' => $educationRubric->id]) }}">
                                <x-secondary-button>
                                    {{ __('Edit') }}
                                </x-secondary-button>
                            </a>

                            <x-danger-button wire:click.prevent="startCreboDeletion({{ $crebo['id'] }})">
                                {{ __('Delete') }}
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <x-modal name="add-education-rubric">
            <form wire:submit="createEducationRubric" class="p-6">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Create a new education rubric') }}
                </h2>

                <div class="mt-6">
                    <div class="mt-4">
                        <x-input-label for="crebo_number">{{ __('Name') }}</x-input-label>
                        <x-text-input type="text" wire:model="create.name" class="w-full" />
                        <x-input-error :messages="$errors->get('crebo_number')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Add Education Rubric') }}
                        </x-primary-button>
                    </div>

                    <x-action-message class="ml-auto" on="crebo-saved">
                        {{ __('Saved') }}
                    </x-action-message>
                </div>
            </form>
        </x-modal>
    </div>
</div>
