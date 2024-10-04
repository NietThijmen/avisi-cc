<div x-data="{'user_id': null}">
    <div class="max-w-6xl mx-auto mt-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{__("Students")}}</h1>
            <x-primary-button
                x-on:click.prevent="$dispatch('open-modal', 'add-student')"
            >Add Student</x-primary-button>
        </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($students as $student)
                    <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{$student['first_name']}} {{$student['middle_name']}} {{$student['last_name']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student['email']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-primary-button
                                x-on:click.prevent="
                                user_id = '{{$student['id']}}';
                                $dispatch('open-modal', 'add-assignment')
                                "
                            >New assignment</x-primary-button>
                        </td>
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

    <x-modal name="add-assignment">
        <form wire:submit="add-assignment" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create a new teacher') }}
            </h2>

            <div class="mt-6">
                <input type="hidden" x-value="user_id">

                <div class="mt-4">
                    <x-input-label for="assignment">Assignment</x-input-label>
                    <x-select name="assignment" wire:model="assignment" class="w-full">
                        <option value="1">Assignment 1</option>
                        <option value="2">Assignment 2</option>
                        <option value="3">Assignment 3</option>
                    </x-select>

                    <x-input-error :messages="$errors->get('assignment')" class="mt-2" />
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
