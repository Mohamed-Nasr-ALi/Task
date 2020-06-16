@section('aside')
{{--    <div class="card">--}}
{{--        <div class="card-header"><h3 class="text-success">{{env('APP_NAME')}}</h3></div>--}}

{{--        <div class="card-body">--}}

{{--            <ul class="list-unstyled">--}}
{{--                <li><a href="{{route('home')}}" class="text-secondary text-capitalize">Home</a></li>--}}
{{--                <li><a href="{{route('projects.index')}}" class="text-secondary text-capitalize">projects</a></li>--}}
{{--                <li><a href="{{route('tasks.index')}}" class="text-secondary text-capitalize">tasks</a></li>--}}
{{--             </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
<div class="card">
    <div class="card-header"><h3 class="text-success">{{env('APP_NAME')}}</h3></div>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt blue"></i>
                            <p>
                                Home

                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/projects" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>projects</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <router-link to="/tasks" class="nav-link">
                            <i class="nav-icon fas fa-user orange"></i>
                            <p>
                                tasks
                            </p>
                        </router-link>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
</div>

@endsection
