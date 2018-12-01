@extends('partials.nav')

@section('body')
<section>
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content">
					<h1>{{ isset($indicator) ? $tasks[0]->user->name.'\'s Tasks' : 'My Tasks' }}</h1>
					<table class="table">
						<thead class="is-primary">
							<tr class="card">
								<th>Project Name</th>
								<th>Task</th>
								<th>Progress</th>
								<th>Deadline</th>
								<th>Start Date</th>
								<th>Notes</th>
								<th>Issues</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tasks as $task)
							<tr class="card">
								<td>{{ $task->project->name }}</td>
								<td>{{ $task->name }}</td>
								<td>{{ $task->progress }} </td>
								<td>{{ $task->target }}</td>
								<td>{{ $task->created_at }} </td>
								<td><a href="/tasks/{{$task->id}}">Notes</a></td>
								<td>
									@if(count($task->issues) > 0)
									<a href="/tasks/{{$task->id}}/issues">View</a>
									@else
									No Issues
									@endif
								</td>
								
								<td>
									<a href="/issues/{{$task->id}}/create" class="button is-outlined">Create Issue</a>
									@if( isset($indicator) )
										<a href="/task/create/{{$task->project_id}}" class="button is-outlined">Create Task
										</a>
									@endif
								</td>

							</tr>
							@if( isset($indicator) )
							<tr class="card"><td><h4>Progress:</h4></td>
								<!-- <div id="progress"></div> -->
								<td colspan="7"><progress class="progress is-warning is-large" data-label="{{$task->progress}}% Complete" value="{{$task->progress}}" max="100">

								</progress>
								<p class="pull-right">100</p>
								<p class="pull-left">0</p>	
								</td>
							</tr>
							<tr class="card"><td><h4>Timeline:</h4></td>
								<!-- <div id="progress"></div> -->
								<td colspan="7"><?php 
								$date1 = new DateTime($task->target);
								$date2 = new DateTime($task->created_at);
								$currentDate = NOW();
								$interval = $date2->diff($currentDate);
								$interva2 = $date1->diff($date2);

								?>
								<div>
									<progress class="progress is-warning is-large"  value="{{$interval->days}}" max="{{$interva2->days}}">
									</progress>
									<div>
										<p class="pull-right">{{$task->target}}</p>
										<p class="pull-left">{{$task->created_at}}</p>
										<br>
									</div>
								</div>
								</td>
							</tr>
							@endif
					@endforeach	
				</tbody>
			</table>
		</div>	
	</div>
</div>
</div>
</section>
@endsection