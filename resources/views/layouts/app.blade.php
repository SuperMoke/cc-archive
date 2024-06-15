<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset("be/images/12.png") }}">
    <title>CC ARCHIVE - @yield("title") </title>
    @include("layouts.styles")
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include("layouts.menus")
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="#" class="logo-link">
                                    <img class="logo-light logo-img"  src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo">
                                    <img class="logo-dark logo-img"  src="{{ asset("be/images/2.png") }}" srcset="{{ asset("be/images/2.png") }} 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">{{ auth()->user()->role}}</div>
                                                    <div class="user-name dropdown-indicator">{{ auth()->user()->fullname }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>{{ auth()->user()->avatar_letter }}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ auth()->user()->fullname }}</span>
                                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="javascript:void(0);" onclick="logout()"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @if (isset($breadcrumbs))
                                <nav>
                                    <ul class="breadcrumb breadcrumb-arrow">
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            <li class="breadcrumb-item {{ $breadcrumb["is_last"] ? "active" : "" }}">
                                                <a href="{{ $breadcrumb["link"] }}">{{ $breadcrumb["name"] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                                @endif
                                @yield("content")
                            </div>
                        </div>
                    </div>
                </div>
                @include("layouts.footer")
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route("logout") }}" id="logoutForm">
        @csrf
    </form>
    @include("layouts.scripts")
    @stack("scripts")
    <script>
        function logout() {
            document.getElementById("logoutForm").submit();
        }
    </script>
</body>

</html>
