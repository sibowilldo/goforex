@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Invoice
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">View Invoice</li>
            </ol>
        </section>

        <section class="content">
            <div class="container">
            <div class="row">
                <div class="col-md-12 animated fadeInLeft visible" data-animation="fadeInLeft">
                    <div class="col-xs-12">
                        <div class="invoice-title">
                            <h2>Invoice # {{ $invoice->id }}</h2></p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <strong>Billed To:</strong><br>

                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <strong>Posted To:</strong><br>

                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    Deposit to: <br>
                                    AJ HASTIBEER<br>
                                    FIRST NATIONAL BANK<br>
                                    626-06406-909<br>
                                    250-655
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <strong>Invoice Date:</strong><br>
                                    {{ $invoice->created_at->format('F d, Y') }}<br><br>
                                    <strong>Paid On:</strong><br>
                                    {{ $invoice->created_at->format('F d, Y') }}<br><br>
                                    <strong>Status:</strong><br>
                                    {{ $invoice->status_is }}<br>
                                </address>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table cart-table">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
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

                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">R{{ number_format($invoice->amount,2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Discount</strong></td>
                                    <td class="no-line text-right">R{{ number_format(0,2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>VAT @14%</strong></td>
                                    <td class="no-line text-right">R{{ number_format(0,2,'.',',') }}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">R{{ number_format($invoice->amount,2,'.',',') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>

    </div>
@stop