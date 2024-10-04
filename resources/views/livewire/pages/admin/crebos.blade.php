<div>
    <div class="max-w-6xl mx-auto mt-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{__("Crebos")}}</h1>
            <x-primary-button
                x-on:click.prevent="$dispatch('open-modal', 'add-crebo')"
            >Add Crebo</x-primary-button>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Crebo number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider w-1/5">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($crebos as $crebo)
                    <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $crebo['name'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $crebo['crebo_number'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $crebo['created_at'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.crebo.edit', ['crebo' => $crebo['id']]) }}">
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
    </div>

    <x-modal name="delete-crebo">
        <form wire:submit="destroyCrebo" class="p-6">
            @unless(empty($currentCrebo))
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete crebo ') . $currentCrebo['crebo_number'] . '?' }}
                </h2>

                <h2 class="text-md font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Deletion is permanent and can\'t be undone!') }}
                </h2>

                <x-input-error :messages="$errors->get('crebo')"></x-input-error>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Confirm') }}
                    </x-danger-button>
                </div>
            @endunless
        </form>
    </x-modal>

    <x-modal name="add-crebo">
        <form wire:submit="createCrebo" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create a new crebo') }}
            </h2>

            <div class="mt-6">
                <div class="mt-4">
                    <x-input-label for="name">{{ __('Name') }}</x-input-label>
                    <x-text-input type="text" wire:model="state.name" class="w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="crebo_number">{{ __('Crebo Number') }}</x-input-label>
                    <x-text-input type="number" wire:model="state.crebo_number" class="w-full" />
                    <x-input-error :messages="$errors->get('crebo_number')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                       {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Add Crebo') }}
                    </x-primary-button>
                </div>

                <x-action-message class="ml-auto" on="crebo-saved">
                    {{ __('Saved') }}
                </x-action-message>
            </div>
        </form>
    </x-modal>
</div>
