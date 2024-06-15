@extends("layouts.app")
@section("title", "Edit Teacher")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Teacher</h4>
        </div>
    </div>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Teacher Form</span>
                <form action="{{ route('teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="row g-4">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-mail"></em>
                                    </div>
                                    <input type="email"
                                           class="form-control"
                                           id="email"
                                           name="email"
                                           placeholder="Enter email"
                                           required="true"
                                           value="{{ $teacher->email }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="fullname">Full Name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user-list"></em>
                                    </div>
                                    <input type="text"
                                           class="form-control"
                                           id="fullname"
                                           name="fullname"
                                           placeholder="Enter full name"
                                           required="true"
                                           value="{{ $teacher->fullname }}"/>
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
