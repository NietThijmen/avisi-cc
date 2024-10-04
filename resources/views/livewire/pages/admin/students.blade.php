<div>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wider">Created At</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($students as $student)
                    <tr class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                        <td class="px-6 py-4 whitespace-nowrap">{{$student['first_name']}} {{$student['middle_name']}} {{$student['last_name']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student['email']}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$student['created_at']}}</td>
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

    <x-modal name="add-student">
        <form wire:submit="createStudent" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create a new student') }}
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

                <div class="mt-4">
                    <x-input-label for="class">{{ __('Class') }}</x-input-label>
                    <x-text-input type="text" wire:model="class" class="w-full"/>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="crebo_number">{{ __('Crebo Number') }}</x-input-label>
                    <x-select wire:model.change="crebo_number" class="w-full">
                        @foreach(\App\Models\Crebo::all() as $crebo)
                            <option value="{{$crebo->id}}">{{$crebo->__toString()}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('crebo_number')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="career_coach">{{__("Career coach")}}</x-input-label>
                    <x-select wire:model="career_coach" class="w-full">
                        @foreach(\App\Models\Teacher::join('users', 'teachers.user_id', '=', 'users.id')->get() as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('career_coach')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="student_number">{{ __('Student number') }}</x-input-label>
                    <x-text-input type="text" wire:model="student_number" class="w-full"/>
                    <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="cohort">{{ __('Cohort') }}</x-input-label>
                    <x-text-input type="date" wire:model="cohort" class="w-full"/>
                    <x-input-error :messages="$errors->get('cohort')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="date_of_birth">{{ __('Date of birth') }}</x-input-label>
                    <x-text-input type="date" wire:model="date_of_birth" class="w-full"/>
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>
