@extends("layouts.app")
@section("title", "Edit Consultation")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Consultation</h4>
        </div>
    </div>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Consultation Form</span>
                <form action="{{ route("consultations.update", $consultation) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row g-4">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="date_time">Date Time</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-clock"></em>
                                    </div>
                                    <input type="datetime-local"
                                           class="form-control"
                                           id="date_time"
                                           name="date_time"
                                           required="true"
                                           value="{{ $consultation->date_time }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="project_id">Project</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user-list"></em>
                                    </div>
                                    <select
                                           class="form-control"
                                           id="project_id"
                                           name="project_id"
                                           required="true"
                                           >
                                           @foreach ($projects as $project)
                                               <option value="{{ $project->id }}" {{ $consultation->project_id == $project->id ? "selected" : "" }}>
                                                {{ $project->title }}
                                                </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
