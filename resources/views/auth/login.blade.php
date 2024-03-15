<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide">
<head>
    @include('layouts.head')
    @section('title', 'Start Your Day!')
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">
</head>
<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card bg-transparent" style="backdrop-filter: blur(3px)">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('images/RPL.png') }}" alt="halo, ga ke load ya?"
                                        style="width: 2.5rem" class="h-auto">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">APP UKK</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to APP UKK! 👋</h4>
                        <p class="mb-4">Silahkan Login untuk memulai hari anda!</p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('login.process') }}" method="POST">
                          @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan Username Anda" autofocus />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-warning d-grid w-100" type="submit">Mulai Hari Anda!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- / Content -->
    @include('layouts.script')
</body>
</html>