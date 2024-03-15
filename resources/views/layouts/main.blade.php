<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    @include('layouts.head')
    <title>Jurnal Guru MUTIL | @yield('title')</title>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')
            <div class="layout-page">
                @include('layouts.navbar')
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('main')
                    </div>
                    @include('layouts.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @include('layouts.script')
</body>

</html>
