@extends('layouts.pdf')

@section('content')
    <header class="clearfix">
        <div id="logo">
            {{ Html::image('img/brands-logo.png', '') }}
        </div>
        <h1>INVOICE {{ $invoice->id }}</h1>
        <div id="company" class="clearfix">
            <div>BANTU BRANDS</div>
            <div>B25 Point Bastille,<br /> 21 Signal street, Durban, 4001</div>
            <div>+27 81-778-7702</div>
            <div><a href="mailto:accounts@bantubrands.co.za">accounts@bantubrands.co.za</a></div>
        </div>
        <div id="project">
            <div><span>CLIENT</span> {{ Auth::user()->username }}</div>
            <div></div>
            <div><span>EMAIL</span> <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
            <div><span>DATE</span> {{ $invoice->created_at->format('F d, Y') }}</div>
            <div><span>DUE DATE</span> {{ $invoice->created_at->addDays(14)->format('F d, Y') }}</div>
            <div><span>STATUS</span> {{ $invoice->status_is }}</div>
        </div>
    </header>

    <div id="main">
        <table>
            <thead>
            <tr>
                <th class="service">SERVICE</th>
                <th class="desc">DESCRIPTION</th>
                <th>PRICE</th>
                <th>QTY</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>

            @foreach($invoice->items as $item)
                <tr>
                    <td class="service">{{ $item->name }}</td>
                    <td class="desc">{{ $item->description }}</td>
                    <td class="unit">R{{ number_format($item->pivot->price,2,'.',',') }}</td>
                    <td class="qty">{{ $item->pivot->quantity }}</td>
                    <td class="total">R{{ number_format($item->pivot->quantity * $item->pivot->price,2,'.',',') }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4">SUBTOTAL</td>
                <td class="total">R{{ number_format($invoice->amount,2,'.',',') }}</td>
            </tr>
            <tr>
                <td colspan="4">VAT 14%</td>
                <td class="total">R{{ number_format(0,2,'.',',') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="grand total">GRAND TOTAL</td>
                <td class="grand total">R{{ number_format($invoice->amount,2,'.',',') }}</td>
            </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">An unpaid Invoice will be removed from the system after 14 days.<br><br>
                Payment should be made via direct deposit or EFT to:
                <div id="project">
                    <span>Holder:</span> Ndalokuhle Consulting (Pty) Ltd,<br>
                    <span>Bank:</span> First National Bank,<br>
                    <span>Account:</span> 625-21226-292,<br>
                    <span>Branch:</span> 222-126
                </div>
            </div>
        </div>
    </div>

    <footer>
        Invoice was created on a computer and is valid without company the signature and stamp.
    </footer>
@endsection