@if($level == 'success')
    <script>
        iziToast.success({title: '{{ $title }}',message: '{{ $message}}'}); 
    </script>
@elseif($level == 'warning')
    <script>
        iziToast.warning({title: '{{ $title }}',message: '{{ $message}}'}); 
    </script>
@elseif($level == 'error' || $level == 'danger')
    <script>
        iziToast.error({title: '{{ $title }}',message: '{{ $message}}'}); 
    </script>
@else
    <script>
        iziToast.info({title: '{{ $title }}',message: '{{ $message}}'}); 
    </script>
@endif