<div>
    <div class="max-w-6xl mx-auto mt-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{__("Administrators")}}</h1>
            <x-primary-button
                x-on:click.prevent="$dispatch('open-modal', 'add-admin')"
            >Add admin</x-primary-button>
        </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Created At</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($administrators as $admin)
                    <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{$admin['first_name']}} {{$admin['middle_name']}} {{$admin['last_name']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$admin['email']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$admin['created_at']}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800">
                <tr>
                    <th>
                        <x-primary-button wire:click="pageMin()">-</x-primary-button>
                    </th>
                    <th class="text-center font-medium text-gray-600 dark:text-gray-400 uppercase">{{$page}}</th>
                    <th>
                        <x-primary-button wire:click="pagePlus()">+</x-primary-button>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <x-modal name="add-admin">
        <form wire:submit="createAdministrator" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create a new teacher') }}
            </h2>

            <div class="mt-6">
                <div class="mt-4">
                    <x-input-label for="first_name">{{ __('First Name') }}</x-input-label>
                    <x-text-input type="text" wire:model="first_name" class="w-full"/>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="middle_name">{{ __('Middle Name') }}</x-input-label>
                    <x-text-input type="text" wire:model="middle_name" class="w-full"/>
                    <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="last_name">{{ __('Last Name') }}</x-input-label>
                    <x-text-input type="text" wire:model="last_name" class="w-full"/>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email">{{ __('Email') }}</x-input-label>
                    <x-text-input type="email" wire:model="email" class="w-full"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password">{{ __('Password') }}</x-input-label>
                    <x-text-input type="password" wire:model="password" class="w-full"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Create Account') }}
                    </x-primary-button>
                </div>
        </form>
    </x-modal>
</div>
