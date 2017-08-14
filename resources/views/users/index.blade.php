@extends('layouts.app')

@section('content')
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Users
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Users</li>
			</ol>
		</section>

		<!-- Main Content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <a href="{{ url('users/create') }}" class="btn btn-sm pull-right btn-primary btn-social" rel="tooltip" title="View"><i class="fa fa-plus-circle"></i> Create User
                            </a>
							<h3 class="box-title">All Users
							</h3>
						</div>
						<div class="box-body">
							<table class="nowrap table table-hover table-striped table-condensed" id="users">
								<thead>
								<tr>
									<th>Verified</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Username</th>
									<th>Email</th>
									<th>Cell No.</th>
									<th>Location</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach($users as $user)
                                    @if( $user != Auth::user())
									<tr>
										<td>
											<input class="bstoggle verify" type="checkbox" data-onstyle="success" data-offstyle="danger" data-on="<i class='fa fa-check'><i>" data-off="<i class='fa fa-times'><i>" data-size="mini" data-toggle="toggle" name="rd-{{ $user->id }}" data-id="{{ $user->id }}"  {{ $user->verified ? 'checked' : ''}}></td>
										<td>{{ $user->firstname }}</td>
										<td>{{ $user->lastname }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->cell }}</td>
										<td>{{ $user->location }}</td>
										<td>
											<div class="btn-group btn-group-sm">
												<button type="button" class="btn btn-default">Choose Action</button>
												<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li><a href="{{ url('/users/' . $user->id) }}"> <i class="fa fa-eye"></i> View / Edit</a></li>
													<li><a href="#!" data-id="{{ $user->id  }}" data-action="{{ $user->status_is == 'Blocked' ? 'activate' : 'block' }}"><i class="fa fa-ban"></i> {{ $user->status_is == 'Blocked' ? 'Unblock' : 'Block' }}</a></li>
												</ul>
											</div>
										</td>
									</tr>
                                    @endif
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js') }}

    <script>
        $(document).ready(function() {
            $('#users').DataTable({responsive: true}).on('click','.toggle-group' , function(e){
                $('.bstoggle.verify').on('change', function(ev){
                    var source = this;
                    var formData = {
                        id: $(source).attr('data-id'),
                        state: $(source).prop('checked')
                    };

                    var a = "{{ url('/') }}",
                        t = $('meta[name="csrf-token"]').attr("content");
                    $.ajax({
                        url: a + "/ajax/verify",
                        type: "POST",
                        data: formData,
                        headers: {
                            "X-CSRF-TOKEN": t
                        },
                        success: function(e) {
                            switch ((e = e.data).level) {
                                case "success":
                                    toastr.success(e.data + ' ' + e.message,e.title);
                                    break;
                                case "warning":
                                    toastr.warning(e.data + ' ' + e.message,e.title);
                                    break;
                            }
                        },
                        error: function(e) {

                        }
                    });
                });
                $('a[data-action]').on('click', function(){
                    var el = this;
                    var data = {
                        id: $(el).attr('data-id'),
                        action: $(el).attr('data-action')
                    };


                    var a = "{{ url('/') }}",
                        t = $('meta[name="csrf-token"]').attr("content");
                    $.ajax({
                        url: a + "/ajax/block",
                        type: "POST",
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": t
                        },
                        success: function(e) {
                           toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-center",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                                }

                            switch ((e = e.data).level) {
                                case "success":
                                    toastr.success(e.data.username + ' ' + e.message,e.title);
                                    break;
                                case "warning":
                                    toastr.warning(e.data.username + ' ' + e.message,e.title);
                                    break;
                            }


                            $(el).html("<i class='fa fa-ban'></i> " + (e.data.status == 'Active' ? 'Block' : 'Unblock'));
                            $(el).attr('data-action', e.data.status.toLowerCase());
                        },
                        error: function(e) {

                        }
                    });
                });
            });
        });
    </script>
@stop