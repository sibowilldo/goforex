@if (session()->has('flash_notification.message'))
    <script>
            $(document).ready(function(){
                level = "{{ session('flash_notification.level') }}";
                
                switch(level){
                    case 'success': 
                        iziToast.success({title: "{{ session('flash_notification.title') }}",message: "{!! session('flash_notification.message') !!}"}); 
                        break;
                    case 'warning': 
                        iziToast.warning({title: "{{ session('flash_notification.title') }}",message: "{!! session('flash_notification.message') !!}"}); 
                        break;
                    case 'danger': 
                        iziToast.error({title: "{{ session('flash_notification.title') }}",message: "{!! session('flash_notification.message') !!}"}); 
                        break;
                    case 'error': 
                        iziToast.error({title: "{{ session('flash_notification.title') }}",message: "{!! session('flash_notification.message') !!}"}); 
                        break;
                    default: 
                        iziToast.info({title: "{{ session('flash_notification.title') }}",message: "{!! session('flash_notification.message') !!}"}); 
                        break;

                }
            });
    </script>
@endif
