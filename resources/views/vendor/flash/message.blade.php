@if (session()->has('flash_notification.message'))
    <script>
        swal({
            title: "{{ session('flash_notification.title') }}", 
            text: "{!! session('flash_notification.message') !!}",
            type: "{{ session('flash_notification.level') }}"});
    </script>
@endif
