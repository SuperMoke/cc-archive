@extends("layouts.app")
@section("title", "Create Template")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Create Template</h4>
        </div>
    </div>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Template Form</span>
                <form action="{{ route("templates.store") }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                           required="true"
                                           >
                                           @foreach ($projects as $project)
                                               <option value="{{ $project->id }}">
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
                                           required="true"
                                           value="{{ request()->old("name") }}"/>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="src">File</label>
                                <div class="form-control-wrap">
                                    <input type="file"
                                           class="form-control"
                                           id="src"
                                           name="src"
                                           placeholder="Enter src"
                                           required="true"/>
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
