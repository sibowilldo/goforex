@extends('layouts.app')

@section('content')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				View Bank Account
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">View Bank Account</li>
			</ol>
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="box">
						<div class="box-header">
							<a href="{{ route('bank_accounts.edit', $bank_account->id) }}" class="btn btn-primary pull-right btn-sm"><i class="ion ion-ios-compose"></i> Make Changes</a>
                            @if($bank_account->id != 1)
                                {!! Btn::delete($bank_account->id, url('bank_accounts'),'', true,  $bank_account->account_holder, 'Any event linked to this Bank Account will default to the primary bank account (i.e Bank Account with and ID of 1)')!!}
                            @endif
						</div>
						<div class="box-content">
                            @if($bank_account->id == 1)
                                <div class="alert alert-danger">
                                   <i class="ion ion-alert-circled"></i> This is a Primary Bank Account. Delete is STRICTLY PROHIBITED!
                                </div>
                            @endif
							<table id="item" class="table table-bordered table-striped table-force-topborder" style="clear: both">
								<tbody>
								<tr>
									<td>Bank</td>
									<td>
										{{ $bank_account->bank }}
									</td>
								</tr>
								<tr>
									<td>Account Holder</td>
									<td>
										{{ $bank_account->account_holder }}
									</td>
								</tr>
								<tr>
									<td>Account Number</td>
									<td>
										{{ $bank_account->account_number }}
									</td>
								</tr>
								<tr>
									<td>Branch</td>
									<td>
										{{ $bank_account->branch }}
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td>
										{{ ucfirst($bank_account->status_is) }}
									</td>
								</tr>
								<tr>
									<td>Created On</td>
									<td>
										{{ $bank_account->created_at }}
									</td>
								</tr>
								<tr>
									<td>Modified On</td>
									<td>
										{{ $bank_account->updated_at }}
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@stop