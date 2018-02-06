@extends('layouts.app')

@section('content')
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Items
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Bank Accounts</li>
			</ol>
		</section>

		<!-- Main Content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <a href="{{ route('bank_accounts.create')}}" class="btn btn-sm pull-right btn-primary btn-social" rel="tooltip" title="View"><i class="fa fa-plus-circle"></i> Create Bank Account
                            </a>
							<h3 class="box-title">All Bank Accounts
							</h3>
						</div>
						<div class="box-body">
							<table class="nowrap table table-hover table-striped table-condensed" id="items">
								<thead>
								<tr>
									<th>ID</th>
									<th>Account Holder</th>
									<th>Account Number</th>
									<th>Bank</th>
									<th>Branch</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								@foreach($bank_accounts as $bank_account)
									<tr>
										<td class='hidden-350'>{{ $bank_account->id }}</td>
										<td>{{ $bank_account->account_holder }}</td>
										<td>{{ $bank_account->account_number }}</td>
										<td>{{ $bank_account->bank }}</td>
										<td>{{ $bank_account->branch }}</td>
										<td>{{ ucfirst($bank_account->status_is) }}</td>
										<td>
											<div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="ion ion-gear-a"></i> Choose
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ route('bank_accounts.show', $bank_account->id) }}"><i class="ion ion-eye"></i> View</a></li>
                                                    <li><a href="{{ route('bank_accounts.edit', $bank_account->id) }}"><i class="ion ion-ios-compose"></i> Edit</a></li>
                                                </ul>
                                                @if($bank_account->id != 1)
                                                    {!! Btn::delete($bank_account->id, url('bank_accounts'),'', true,  $bank_account->account_holder, 'Any event linked to this Bank Account will default to the primary bank account (i.e Bank Account with and ID of 1)')!!}
                                                @endif
                                            </div>
										</td>
									</tr>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
@stop

@section('javascript')
    {{ Html::script('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js') }}

    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}
    {{ Html::script('https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js') }}
    <script>
        $(document).ready(function() {
            $('#items').DataTable({responsive: true});
        } );
    </script>
@stop