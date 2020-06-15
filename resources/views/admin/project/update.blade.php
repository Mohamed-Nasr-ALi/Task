@extends('layouts.app')

@section('single-page-with-out-side-and-content')
    <div class="container">
        @include('alerts.errors')
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title text-capitalize">Update Project</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form  class="form-horizontal" method="POST" action="{{ route('projects.update',$project->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$project->id}}">
                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label text-capitalize">title</label>

                        <div class="col-sm-12">
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="Project Name" value="{{$project->title}}">
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
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
