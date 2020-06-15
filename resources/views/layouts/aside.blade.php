@section('aside')
    <div class="card">
        <div class="card-header"><h3 class="text-success">{{env('APP_NAME')}}</h3></div>

        <div class="card-body">

            <ul class="list-unstyled">
                <li><a href="{{route('home')}}" class="text-secondary text-capitalize">Home</a></li>
                <li><a href="{{route('projects.index')}}" class="text-secondary text-capitalize">projects</a></li>
                <li><a href="{{route('tasks.index')}}" class="text-secondary text-capitalize">tasks</a></li>
             </ul>
        </div>
    </div>
@endsection
