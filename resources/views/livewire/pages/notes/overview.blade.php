<x-slot name="header">
	<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
		{{ __('Your Notes') }}
	</h2>
</x-slot>

<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900 dark:text-gray-100">
				@foreach($notes as $note)
					<div class="flex text-gray-800 dark:text-gray-300">
						<h1 class="text-xl text-gray-800 dark:text-gray-300 truncate hover: mr-2" title="{{ $note->title }}">{{ $note->title }}</h1>
						<span class="flex ml-auto bg-gray-100 text-gray-800 text-sm font-medium px-2.5 items-center rounded dark:bg-gray-700 dark:text-gray-300">
							<p class="block">{{ $note->read ? 'Read' : 'Unread' }}</p>
						</span>
					</div>
					<button class="text-sm text-slate-500" wire:click="toggleRead({{ $note->id }})">Mark {{ $note->read ? 'unread' : 'read' }}</button>
				@endforeach
			</div>
		</div>
	</div>
</div>
