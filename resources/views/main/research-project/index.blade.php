@extends("layouts.app")
@section("title", "Projects")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Projects</h4>
        </div>
    </div>
    @if (!auth()->user()->is_student)
    <a href="{{ route("projects.create") }}" class="btn btn-primary mb-2">Add Project</a>
    @endif
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Adviser</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                @if (auth()->user()->is_student)
                                {{ $project->title }}
                                @else
                                <a href="{{ route("projects.show", $project) }}">{{ $project->title }}</a>
                                @endif

                            </td>
                            <td>{{ $project->adviser->fullname }}</td>
                            <td>{{ $project->task_total_percentage_done }}</td>
                            <td>
                                <a href="{{ route("projects.kanban", $project) }}" class="btn btn-primary">View Kanban</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
