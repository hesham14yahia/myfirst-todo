@extends('layouts.master')

@section('content')
<div class="row">
    <form method="POST" action="{{route('update', ['id'=>$task->id])}}" class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <input id="edit-task" name="task" value="{{$task->content}}" type="text" class="validate">
                <label for="task">Edit Task</label>
            </div>

            @include('inc.coworkers')

            <div class="input-field col s12">
                <button type="submit" class="waves-effect waves-light btn">Edit</button>
            </div>
            @csrf
        </div>
    </form>
</div>
@endsection