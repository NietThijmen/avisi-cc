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
						<a href="{{ route('notes.show', $note) }}" class="text-xl text-gray-800 dark:text-gray-300 truncate hover:cursor-pointer hover:underline mr-2" title="{{ $note->title }}">{{ $note->title }}</a>
						<span class="flex items-center text-sm text-gray-400 dark:text-gray-500">
							<p class="block">- {{ $note->created_at->longAbsoluteDiffForHumans() }} ago</p>
						</span>
						<span class="flex ml-auto bg-gray-100 text-gray-800 text-sm font-medium px-2.5 items-center rounded dark:bg-gray-700 dark:text-gray-300">
							<p class="block">{{ $note->read ? 'Read' : 'Unread' }}</p>
						</span>
					</div>
					<div class="flex text-sm text-gray-400 dark:text-gray-500">
						@switch($user->role)
						@case(\App\Enums\Role::Student)
							<p class="block">From: {{ $note->teacher->user->fullName }}</p>
							@break
						@case(\App\Enums\Role::Teacher)
							<p class="block">To: {{ $note->student->user->fullName }}</p>
							@break
						@endswitch <span class="px-2">|</span> <button class="hover:text-gray-500 hover:dark:text-gray-400" wire:click="toggleRead({{ $note->id }})">Mark {{ $note->read ? 'unread' : 'read' }}</button>
					</div>
					@unless($loop->last)
						<hr class="h-px my-2 bg-slate-200 dark:bg-slate-600 border-0 flex-1">
					@endunless
				@endforeach
				{{ $notes->links() }}
			</div>
		</div>
	</div>
</div>
