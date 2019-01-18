@extends('layouts.app')

@section('content')
	<header class="flex items-center mb-3 pb-4">
		<div class="flex justify-between items-end w-full">
			<p class="text-grey text-sm font-normal">
				<a href="{{ url('projects') }}" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
			</p>
			<a href="{{ url('projects/create') }}" class="button">New Project</a>
		</div>
	</header>
	
	<main>
		<div class="lg:flex -mx-3">
			<div class="lg:w-3/4 px-3 mb-6">
				<div class="mb-8">
					<h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
					@foreach($project->tasks as $task)
						<div class="card mb-3">
							<form method="POST" action="{{ $task->path() }}">
								@method('PATCH')
								@csrf
							
								<div class="flex">
									<input name="body" type="text" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey':'' }}">
									<input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked':'' }} >
								</div>
							</form>
						</div>
					@endforeach
					<div class="card mb-3">
						<form action="{{ $project->path() . '/tasks' }}" method="POST">
							@csrf
							<input type="text" placeholder="Add a new task..." class="w-full" name="body">
						</form>
					</div>
				</div>
				<div >
					<h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
					<form action="{{ $project->path() }}" method="POST">
						@csrf
						@method('PATCH')

						<textarea
							name="notes"
							class="card w-full mb-4" 
							style="min-height: 200px" 
							placeholder="Anything special that you want to make a note of?"
						>{{ $project->notes }}</textarea>

						<button type="submit" class="button">Save</button>
					</form>
				</div>
			</div>

			<div class="lg:w-1/4 px-3 mt-8">
				@include('projects.card')
			</div>
		</div>

	</main>
	
@endsection