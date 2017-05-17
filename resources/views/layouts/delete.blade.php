<button class="btn red btn-delete-{{ $id }} btn-sm btn btn-social btn-danger"><i class="fa ion ion-android-remove-circle"></i> Remove</button>
{!! Form::open(['url' => url()->current().'/'.$id, 'id' => 'delete-form-'.$id, 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
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
                swal('Done!', '{{ $name }} was deleted successfully!', 'success');
            }else{
                swal('Cancelled', 'Operation aborted', 'error');
            }
        });
    });
});
</script>