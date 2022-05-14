
    <!DOCTYPE html>
    <html lang="en">
    <head>
        @include('page/head')
    </head>
    <body class="goto-here">
    @include('sweetalert::alert')
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
<script>
    $('#datatable').DataTable({
        "lengthChange": false,
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
        } ],
        order: [[ 0, 'asc' ]],
        "bDestroy": true,
        "iDisplayLength": 15,
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/vi.json'
        }
    });
</script>
