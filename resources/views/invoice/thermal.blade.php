<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'PT Sans', sans-serif;
        }

        @page {
            size: 80mm 297mm; /* Thermal paper size */
            margin: 2px;
        }

        table {
            width: 100%;
        }

        tr {
            width: 100%;
        }

        h1 {
            text-align: center;
            vertical-align: middle;
        }

        #logo {
            width: 100%;
            text-align: center;
            padding: 5px;
            margin: 2px;
            display: block;
            margin: 0 auto;
        }

        header {
            width: 100%;
            text-align: center;
            vertical-align: middle;
        }

        .items thead {
            text-align: center;
        }

        .center-align {
            text-align: center;
        }

        .bill-details td {
            font-size: 10px;
        }

        .receipt {
            font-size: medium;
        }

        .items .heading {
            font-size: 10px;
            text-transform: uppercase;
            border-top: 1px solid black;
            margin-bottom: 4px;
            border-bottom: 1px solid black;
            vertical-align: middle;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 47%;
            min-width: 47%;
            max-width: 47%;
            word-break: break-all;
            text-align: left;
        }

        .items td {
            font-size: 10px;
            text-align: right;
            vertical-align: bottom;
        }

        .price::before {
            content: "Rs ";
            font-family: Arial;
            text-align: right;
        }

        .sum-up {
            text-align: right !important;
        }

        .total {
            font-size: 11px;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        .total.text,
        .total.price {
            text-align: right;
        }

        .total.price::before {
            content: "Rs ";
        }

        .line {
            border-top: 1px solid black !important;
        }

        .heading.rate {
            width: 20%;
        }

        .heading.amount {
            width: 25%;
        }

        .heading.qty {
            width: 5%
        }

        p {
            padding: 1px;
            margin: 0;
        }

        section,
        footer {
            font-size: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div id="logo">
            <img src="logo.png" alt="Shop Logo" style="max-width: 100%; max-height: 80px;">
        </div>
    </header>
   
    <table class="bill-details">
        <tbody>
            <tr>
                <td>Date: <span>{{ \Carbon\Carbon::now()->toDateString() }}</span></td>
                <td>Time: <span> {{ now()->format('H:i:s') }}</span></td>
            </tr>
            <tr>
                <td>Customer #: <span>{{ $customer->name }}</span></td>
                <td>Contact #: <span>{{ $customer->phone }}</span></td>
            </tr>
            <tr>
                <th class="center-align" colspan="2"><span class="receipt">Original Receipt</span></th>
            </tr>
        </tbody>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th class="heading qty">Sno.</th>
                <th class="heading name">Item</th>
                <th class="heading qty">Qty</th>
                <th class="heading rate">Rate</th>
                <th class="heading amount">Price</th>
                <th class="heading rate">Discount</th>

            </tr>
        </thead>

        <tbody>
            @php
            $sl = 1;
            @endphp

            @foreach($contents as $key=> $item)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->qty }}</td>
                <td class="price">{{ $item->price }}</td>

                <td class="price">{{ $item->price * $item->qty }}</td>
                <td class="price">{{ $item->options->discount  ?? 0 }}</td>

            </tr>
            @endforeach
            <tr>
                <td colspan="5"  class="sum-up line">Subtotal</td>
                <td class="line price">{{ Cart::priceTotal() - 0 }}</td>
            </tr>
            <tr>
                <td colspan="5"  class="sum-up">Discount</td>
                <td class="price">{{ $totaldiscountv ?? 0 }}</td>
            </tr>
            <tr>
                <td colspan="5"  class="sum-up">Tax</td>
                <td class="price">0.00</td>
            </tr>
            <tr>
                <td colspan="5"  class="sum-up">Other Charges</td>
                <td class="price">0.00</td>
            </tr>
            <tr>
                <th colspan="5"  class="total text">Total</th>
                <th class="total price">{{ Cart::total()-$totaldiscountv }}</th>
            </tr>
            <tr>
                <td colspan="5"  class="sum-up">Paid
            </td>
            <td class="price">0</td>
        </tr>
        <tr>
            <td colspan="5"  class="sum-up">Due</td>
            <td class="price">0</td>
        </tr>
    </tbody>
   
  
</table>
<section>
    <p>
        Paid by: <span>CASH</span> 

    </p>
    <p style="text-align:center">
        Thank you for your visit!
    </p>
</section>
<footer style="text-align:center">
    <p>Technology Partner Isoft Technologies</p>
    <p>www.isoft.com</p>
    Operator <span>{{ Auth::user()->name }}</span>- {{ now()->format('Y-m-d H:i:s') }}
</footer>
</body>

</html>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    // In your invoice view file (invoice.thermal.blade.php)


    $(document).ready(function() {
        window.print();
       
    });
</script>