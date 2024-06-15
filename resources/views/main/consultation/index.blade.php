@extends("layouts.app")
@section("title", "Consultations")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Consultations</h4>
        </div>
    </div>
    @if (!auth()->user()->is_student)
    <a href="{{ route("consultations.create") }}" class="btn btn-primary mb-2">Add Consultation</a>
    @endif
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultations as $consultation)
                        <tr>
                            <td>
                                @if (auth()->user()->is_student)
                                {{ $consultation->project->title }}
                                @else
                                <a href="{{ route("consultations.show", $consultation) }}">{{ $consultation->project->title }}</a>
                                @endif
                            </td>
                            <td>{{ $consultation->date_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
