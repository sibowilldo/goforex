@if($size)
    <a class="btn btn-danger btn-delete-{{ $id }} btn-sm btn-social"><i class="fa ion ion-android-remove-circle"></i> Remove</a>
@else
    <a class="btn  btn-danger btn-delete-{{ $id }} btn-sm"><i class="fa fa-trash"></i></a>
@endif

{!! Form::open(['url' => $url.'/'.$id, 'id' => 'delete-form-'.$id, 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
<input type="hidden" name="_method" value="DELETE">
@php $name = empty($name) ? 'item' : $name @endphp
{!! Form::close() !!}

<script> 
jQuery(document).ready(function(){

    jQuery('.btn-delete-{{ $id }}').on('click', function(e){
        e.preventDefault();
        swal({
            title: 'Caution!',
            text: '{{ $message }}',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete this!',
            closeOnConfirm: false,
            closeOnCancel: false
        },        
        function(isConfirm){
            if(isConfirm){
                jQuery('#delete-form-{{$id}}').submit();
            }else{
                swal('Cancelled', 'Operation aborted', 'error');
            }
        });
    });
});
</script>