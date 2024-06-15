@extends("layouts.app")
@section("title", "Edit Template")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Template</h4>
        </div>
    </div>
    <div class="btn-group mb-2">
        <a href="{{ route("templates.edit", $template) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('templates.destroy', $template) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
        </form>
    </div>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Template Form</span>
                <form action="{{ route("templates.update", $template) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="is_teacher" value="1"/>
                    <div class="row g-4">
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
                                           disabled="true"
                                           >
                                           @foreach ($projects as $project)
                                               <option value="{{ $project->id }}" {{ $template->project_id == $project->id ? "selected" : "" }}>
                                                {{ $project->title }}
                                                </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user-list"></em>
                                    </div>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           name="name"
                                           placeholder="Enter name"
                                           disabled="true"
                                           value="{{ $template->name }}"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
