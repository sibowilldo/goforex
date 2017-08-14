@if (session()->has('flash_notification.message'))
    <script>
            $(document).ready(function(){
                level = "{{ session('flash_notification.level') }}";
                
                switch(level){
                    case 'success': 
                        toastr.success("{{ session('flash_notification.message') }}","{!! session('flash_notification.title')!!}"); 
                        break;
                    case 'warning': 
                        toastr.warning("{{ session('flash_notification.message') }}","{!! session('flash_notification.title')!!}"); 
                        break;
                    case 'danger': 
                        toastr.error("{{ session('flash_notification.message') }}","{!! session('flash_notification.title')!!}");  
                        break;
                    case 'error': 
                        toastr.error("{{ session('flash_notification.message') }}","{!! session('flash_notification.title')!!}");  
                        break;
                    default: 
                        toastr.info("{{ session('flash_notification.message') }}","{!! session('flash_notification.title')!!}");  
                        break;

                }
            });
    </script>
@endif
