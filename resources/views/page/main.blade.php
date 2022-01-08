
    <!DOCTYPE html>
    <html lang="en">
    <head>
        @include('page/head')
    </head>
    <body class="goto-here">
    @include('page/navbar')
        <!-- END nav -->

        @include('page/banner')

        @yield('content')
        
        @include('page/footer')
    
    @include('page/chatbot')
    <!-- loader -->
    @include('page/lib')
        
    </body>
    </html>