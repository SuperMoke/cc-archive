@extends("layouts.app")
@section("title", "Students")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Students</h4>
        </div>
    </div>
    <a href="{{ route("students.create") }}" class="btn btn-primary mb-2">Add Student</a>
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
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <a href="{{ route("students.show", $student) }}">{{ $student->fullname }}</a>
                            </td>
                            <td>{{ $student->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
