@extends('layouts.app')
@include('layouts.aside')
@section('content')
    <div class="container">
        <div class="header">
            <h1>Tasks</h1>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <a href="{{route('tasks.create')}}" class="btn btn-outline-success text-capitalize">Create task</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr class="text-capitalize">
                <th scope="col">#</th>
                <th scope="col">task title</th>
                <th scope="col">project title</th>
                <th scope="col">status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @if (count($tasks)>0)
                @foreach($tasks as $index=>$task)
                    <tr id="{{$task->id}}">
                        <td>{{$index+1}}</td>
                        <td>{{$task->task_title ?? ''}}</td>
                        <td>{{$task->project->title ?? ''}}</td>
                        <td>{{$task->status === 1 ? 'Done' : 'In Progress'}}</td>
                        <td><a href="{{route('tasks.edit',$task->id)}}"
                               class="btn btn-outline-primary text-capitalize">update</a></td>
                        <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal-{{$task->id}}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{$task->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete ?!
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete">Delete</button>
                                            </form><!-- end of form -->
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <mark class="d-inline-block mb-1">total:- {{count($tasks)}}</mark>
            @endif
            </tbody>
        </table>
{{--        {{ $tasks->links() }}--}}
    </div>
@endsection

