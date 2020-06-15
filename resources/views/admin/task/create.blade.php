@extends('layouts.app')

@section('single-page-with-out-side-and-content')
    <div class="container">
        @include('alerts.errors')
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title text-capitalize">Create Task</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="task_title" class="col-sm-12 control-label text-capitalize">title</label>

                        <div class="col-sm-12">
                            <input type="text" name="task_title" class="form-control" id="task_title"
                                   placeholder="Task Name" value="{{old('task_title')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="project_id" class="col-sm-2 control-label text-capitalize">project</label>

                        <div class="col-sm-12">
                            <select class="form-control" name="project_id" id="project_id">
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info pull-right">create</button>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <!-- Scripts -->
        <script src="{{ asset('js/admin/projects/create.js')}}"></script>
    @endpush
@endsection
