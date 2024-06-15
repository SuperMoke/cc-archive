@extends("layouts.app")
@section("title", "Templates")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Templates</h4>
        </div>
    </div>
    @if (!auth()->user()->is_student)
    <a href="{{ route("templates.create") }}" class="btn btn-primary mb-2">Add Template</a>
    @endif
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $template)
                        <tr>
                            <td>
                                @if (auth()->user()->is_student)
                                {{ $template->name }}
                                @else
                                <a href="{{ route("templates.show", $template) }}">{{ $template->name }}</a>
                                @endif
                            </td>
                            <td>{{ $template->project->title }}</td>
                            <td>
                                <a href="{{ $template->src }}" class="btn btn-primary" download>Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
