@extends("layouts.app")
@section("title", "Teachers")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Teachers</h4>
        </div>
    </div>
    <a href="{{ route("teachers.create") }}" class="btn btn-primary mb-2">Add Teacher</a>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>
                                <a href="{{ route("teachers.show", $teacher) }}">{{ $teacher->fullname }}</a>
                            </td>
                            <td>{{ $teacher->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
