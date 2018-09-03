@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col s12">
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    @isAdmin
                    <th>Assigned to</th>
                    @endisAdmin
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>
                        <a href="{{ route('updateStatus', $task->id) }}">
                            @if(!$task->status)
                                <p>{{$task->content}}</p>
                            @else
                            <p style="position:relative">{{$task->content}} <i 
                            style="
                            position: absolute;
                            top: 0;
                            margin-left: 10px;
                            border-radius: 17px;
                            border: 0.75px solid #f00;
                            padding: 1px;
                            " class="red-text material-icons">done</i></p>
                            @endif
                        </a>
                    </td>
                    @isAdmin
                    <td>{{ $task->users->name }}</td>
                    @endisAdmin
                    <td><a title="edit" href="{{route('edit', $task->id)}}"><i class="samll material-icons">edit</i></a></td>
                    <td><a title="delete" onclick="return confirm('Delete?');" href="{{route('delete', $task->id)}}"><i class="samll material-icons">delete_forever</i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br><br>

        {{$tasks->links('vendor.pagination.materialize')}}
        {{-- <ul class="pagination">
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
            <li class="active"><a href="#!">1</a></li>
            <li class="waves-effect"><a href="#!">2</a></li>
            <li class="waves-effect"><a href="#!">3</a></li>
            <li class="waves-effect"><a href="#!">4</a></li>
            <li class="waves-effect"><a href="#!">5</a></li>
            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        </ul> --}}
    </div>
    <form method="POST" action="{{ route('store') }}" class="row" style="margin-bottom:20px">
        <div class="input-field col s12">
            <input name="task" id="task" type="text" class="validate">
            <label for="task">New Task</label>
        </div>

        @include('inc.coworkers')

        <div class="col s12">
            <button type="submit" class="waves-effect waves-light btn">Add</button>
            @csrf
        </div>
    </form>

    @isWorker
    <form method="POST" action="{{ route('sendInvitation') }}" class="col s12">
        <div class="input-field">
            <select name="admin">
                <option value="" disabled selected>Send invitation to:</option>
                @foreach($coworkers as $coworker)
                <option value="{{ $coworker->id }}">{{ $coworker->name }}</option>
                @endforeach
            </select>
            <label>Send invitation</label>
        </div>
        <button type="submit" class="waves-effect waves-light btn">Send</button>
        @csrf
    </form>
    @endisWorker

    @isAdmin
    <div class="col s12">
        <ul class="collection with-header">
            <li class="collection-header">
                <h4>My Co-Workers</h4>
            </li>
            @foreach($coworkers as $coworker)
            <li class="collection-item">
                <div>
                    {{ $coworker->worker->name }}<a href="{{ route('deleteWorker', $coworker->id) }}" class="secondary-content"><i class="material-icons">delete</i></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @endisAdmin
</div>
@endsection