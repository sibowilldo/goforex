@extends('backend.master')

@section('content')
	@include('backend.page-header', ['header'=>'View User', 'level'=>'users', 'resource'=>'View'])

	<section class="content"> 
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					<div class="box-content">
						<table id="user" class="table table-bordered table-striped table-force-topborder" style="clear: both">
							<tbody>
								<tr>
									<td width="25%">Name</td>
									<td width="50%">
										<a href="{{ url('users/'.$user->id.'/edit') }}">{{ $user->name }}</a>
									</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>
										{{ $user->email }}
									</td>
								</tr>	
								<tr>
									<td>Password</td>
									<td>
										{{ $user->password }}
									</td>
								</tr>	
								<tr>
									<td>Created On</td>
									<td>
										{{ $user->created_at }}
									</td>
								</tr>
								<tr>
									<td>Modified On</td>
									<td>
										{{ $user->updated_at }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop