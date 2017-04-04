@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Invoice # {{ $invoice->id }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ url('/invoices') }}">Invoices</a></li>
                <li class="active">View Event</li>
            </ol>
        </section>

        <section class="invoice">
            <!-- title row -->
            <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="{{ url('/img/full-black-and-white-logo.png') }}"  alt="User Image" style="width: 20%">&nbsp;
                    <small class="pull-right">Date: {{ Carbon\Carbon::now()->toDateString() }} </small>
                </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Payment Method:</strong><br>
                        Deposit to: <br>
                        AJ HASTIBEER<br>
                        FIRST NATIONAL BANK<br>
                        626-06406-909<br>
                        250-655
                    </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm-4 invoice-col col-sm-offset-2">
                <b>Invoice #{{ $invoice->id }}</b><br>
                <br>
                <b>Invoice Date:</b> {{ $invoice->created_at->format('F d, Y') }} <br>
                <b>Paid On:</b> {{ $invoice->created_at->format('F d, Y') }}<br>
                <b>Status:</b> {{ $invoice->status_is }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th><strong>Item</strong></th>
                        <th class="text-center"><strong>Price</strong></th>
                        <th class="text-center"><strong>Quantity</strong></th>
                        <th class="text-right"><strong>Totals</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">R{{ number_format($item->pivot->price,2,'.',',') }}</td>
                                <td class="text-center">{{ $item->pivot->quantity }}</td>
                                <td class="text-right">R{{ number_format($item->pivot->quantity * $item->pivot->price,2,'.',',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                {{--<p class="lead">Payment Methods:</p>
                    <address>
                        Deposit to: <br>
                        First National Bank<br>
                        622390929382<br>
                        250655
                    </address>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>--}}
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                <p class="lead">Amount Due {{ $invoice->created_at->addDays(7)->format('F d, Y') }}</p>

                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>R{{ number_format($invoice->amount,2,'.',',') }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>R{{ number_format(0,2,'.',',') }}</td>
                    </tr>
                    <tr>
                        <th>VAT @14%</th>
                        <td>R{{ number_format(0,2,'.',',') }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>R{{ number_format($invoice->amount,2,'.',',') }}</td>
                    </tr>
                    </table>
                </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
@stop