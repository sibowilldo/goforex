@if($size)
    <a class="btn btn-danger text-white waves-effect waves-classic btn-delete {{ $class }} btn-sm" data-message="{{ $message }}" data-resource-id="{{ $id }}" data-toggle="tooltip" data-original-title="{{ $tooltip }}"><i class="icon md-delete"></i> Delete</a>
@else
    <a class="btn btn-danger btn-icon waves-effect waves-classic text-white btn-delete {{ $class }} btn-sm" data-message="{{ $message }}" data-resource-id="{{ $id }}"  data-toggle="tooltip" data-original-title="{{ $tooltip }}"><i class="icon md-delete mr-0"></i></a>
@endif

{!! Form::open(['url' => $url.'/'.$id, 'id' => 'delete-form-'.$id, 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
<input type="hidden" name="_method" value="DELETE">
@php $name = empty($name) ? 'item' : $name @endphp
{!! Form::close() !!}

@section('deleteJS')
    <script>
        jQuery(document).ready(function(){

            jQuery('.btn-delete').on('click', function(e){
                var $resource = $(this);
                e.preventDefault();
                swal({
                        title: 'Caution!',
                        text: $resource.attr('data-message'),
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, Proceed!',
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if(isConfirm){
                            jQuery('#delete-form-'+$resource.attr('data-resource-id')).submit();
                        }else{
                            swal('Cancelled', 'Operation aborted', 'error');
                        }
                    });
            });
        });
    </script>
@stop