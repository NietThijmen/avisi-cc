<div>
	<div class="flex text-gray-800 dark:text-gray-300">
		<h1 class="text-xl text-gray-800 dark:text-gray-300 truncate hover: mr-2" title="{{ $note->title }}">{{ $note->title }}</h1>
		<span class="flex ml-auto bg-gray-100 text-gray-800 text-sm font-medium px-2.5 items-center rounded dark:bg-gray-700 dark:text-gray-300">
			<p class="block">{{ $note->read ? 'Read' : 'Unread' }}</p>
		</span>
	</div>
	<div class="flex flex-row items-center backdrop-blur-2xl">
		<hr class="h-px my-1 bg-slate-200 dark:bg-slate-600 border-0 flex-1">
		<h3 class="ml-2 text-slate-900 dark:text-slate-500">{{ $note->teacher->user->fullName }} ({{ $note->created_at->longAbsoluteDiffForHumans() }} ago)</h3>
	</div>
	<p class="text-gray-800 dark:text-gray-200 flex-1">{{ $note->content }}</p>
	@if(auth()->user()?->id === $note->teacher_id)
		<form method="POST" action="{{ route('notes.destroy', ['note' => $note->id]) }}">
			@csrf @method('DELETE')
			<button
				class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-2 rounded dark:bg-red-900 mt-2 w-full dark:text-red-300"
				type="submit"
			>Delete</button>
		</form>
	@endif
</div>
