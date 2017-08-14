@if($level == 'success')
    <script>
        toastr.success('{{ $message}}','{{ $title }}'); 
    </script>
@elseif($level == 'warning')
    <script>
        toastr.warning('{{ $message}}','{{ $title }}'); 
    </script>
@elseif($level == 'error' || $level == 'danger')
    <script>
        toastr.error('{{ $message}}','{{ $title }}');     
    </script>
@else
    <script>
        toastr.info('{{ $message}}','{{ $title }}'); 
    </script>
@endif