<div id="main" class="layout-navbar navbar-fixed">
        <!-- layout-navbar navbar-fixed or min-vh-100 -->
        <header>
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <a class="burger-btn d-block cursor-pointer">
                        <i class="bi bi-justify fs-3"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-lg-0">
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600">{{ auth()->user()->username }}</h6>
                                        <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->role->name }}</p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('storage/assets/img/' . auth()->user()->avatar_image) }}" />
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem">
                                <li>
                                    <h6 class="dropdown-header">Hello, {{ auth()->user()->username }}!</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/user">
                                        <i class="icon-mid bi bi-person me-2"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/user/change-password">
                                        <i class="icon-mid bi bi-key me-2"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <form action="/signout" method="POST" class="signoutForm">
                                        @csrf
                                        <button type="button" class="dropdown-item">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Signout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div id="main-content">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ $title }}</h3>
                        </div>
                        {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item ative" aria-current="page">Test Breadcrumb</li>
                                </ol>
                            </nav>
                        </div> --}}
                    </div>
                </div>
            </div>