
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head')
        @yield('style')
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            @include('layout.top_navigation')
            <!-- Header-->
            @yield('content')

        </main>
        <!-- Footer-->
    @include('layout.footer')
    @include('layout.script')
    @yield('script')
    </body>
</html>
