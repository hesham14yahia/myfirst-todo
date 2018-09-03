@isAdmin
<div class="input-field col s12">
    <select>
        <option value="" disabled selected>Assign to:</option>
        <option value="{{ Auth::user()->id }}">Myself</option>
        @foreach($coworkers as $coworker)
            @if(isset($task) && $coworker->worker->id == $task->users->id)
                <option selected value="{{ $coworker->worker->id }}">{{ $coworker->worker->name }}</option>        
            @else
                <option value="{{ $coworker->worker->id }}">{{ $coworker->worker->name }}</option>
            @endif
        @endforeach
    </select>
    <label>Assign Task</label>
</div>
@endisAdmin