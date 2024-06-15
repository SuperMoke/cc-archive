<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset("be/images/12.png") }}">
    <title>CC ARCHIVE - Login</title>
    @include("layouts/styles")
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">

                        @include("main.util.alerts")

                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <center>
                                    <div class="brand-logo pb-5">
                                        <a href="#" class="logo-link">
                                            <img class="logo-light logo-img logo-img-lg" src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo">
                                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo-dark">
                                        </a>
                                    </div>
                                </center>

                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Sign-In</h5>
                                        <div class="nk-block-des">
                                            <p>Access the CCARCHIVE panel using your email and password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route("authenticate") }}" class="form-validate is-alter" autocomplete="off" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input autocomplete="off"
                                                   type="text"
                                                   class="form-control form-control-lg"
                                                   required="true"
                                                   id="email"
                                                   name="email"
                                                   placeholder="Enter your email address"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            {{-- <a class="link link-primary link-sm" tabindex="-1" href="html/pages/auths/auth-reset.html">Forgot Password?</a> --}}
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input autocomplete="new-password"
                                                   type="password"
                                                   class="form-control form-control-lg"
                                                   required="true"
                                                   id="password"
                                                   name="password"
                                                   placeholder="Enter your password"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="teacher" class="btn btn-lg btn-primary btn-block" value="Sign in As Teacher">
                                        <input type="submit" name="student" class="btn btn-lg btn-primary btn-block mt-2" value="Sign in As Student">
                                        <input type="submit" name="admin" class="btn btn-lg btn-primary btn-block mt-2" value="Sign in As Admin">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("layouts/scripts")

</html>
