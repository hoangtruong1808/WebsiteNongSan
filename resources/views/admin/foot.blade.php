<!-- jQuery -->
{{--<script src="{{ asset('admin_template/plugins/jquery/jquery.min.js') }}"></script>--}}
<!-- Bootstrap 4 -->
<script src="{{ asset('admin_template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('admin_template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin_template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin_template/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">abc
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "112152961328448");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    $(".fiter-form li div").hide();
    $(".fiter-form li").click(function(){
        if ($(this).find('*').is(":hidden")){
            $(this).find('*').show();
        }
        // else{
        //     $(this).find('*:not(label)').hide();
        // }
    });
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

  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
