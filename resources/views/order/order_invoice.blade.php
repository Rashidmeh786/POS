<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #1a936f;
            font-size: 24px;
            margin: 0;
        }

        .invoice-details {
            font-size: 12px;
            line-height: 1.4;
            text-align: right;
        }
        .customer-details {
            font-size: 12px;
            line-height: 1.4;
        }

        .invoice-details h3 {
            color: #1a936f;
            font-size: 18px;
            margin: 0 0 8px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .product-table th,
        .product-table td {
            padding: 8px;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }

        .product-table th {
            background-color: #1a936f;
            color: #ffffff;
        }

        .totals {
            text-align: right;
            font-size: 14px;
            line-height: 1.6;
            margin-top: 30px;
        }

        .totals p,
        .totals h4 {
            margin: 0;
        }

        .thanks {
            color: #1a936f;
            font-size: 14px;
            font-weight: bold;
            margin-top: 16px;
        }

        .signature {
            text-align: right;
            margin-top: 32px;
        }

        .signature p {
            margin: 0;
        }

        .signature h5 {
            color: #1a936f;
            margin: 8px 0 0;
        }

        .footer {
            font-size: 12px;
            color: #111111;
            text-align: center;
            padding: 8px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <h2>EasyShop</h2>
                <div class="invoice-details">
                    <h3>Invoice: {{ $order->invoice_no }}</h3>
                    <p>
                        Order Date: {{ $order->order_date }}<br>
                        Order Status: {{ $order->order_status }}<br>
                        Payment Status: {{ $order->payment_status }}<br>
                        Total Pay: {{ $order->pay }}<br>
                        Total Due: {{ $order->due }}
                    </p>
                </div>
            </div>

            <div class="customer-details" style="display: flex; justify-content: space-between;">
                <div>
                    <p>
                        <span>Customer Name:</span>  {{ $order->customer->name }}<br>
                        <span>Customer Email:</span> {{ $order->customer->email }}<br>
                        <span>Customer Phone:</span> {{ $order->customer->phone }}<br>
                        <span>Address:</span> {{ $order->customer->address }}<br>
                        <span>Shop Name:</span> {{ $order->customer->shopname }}
                    </p>
                </div>
            </div>

            <h3>Products</h3>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Return</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItem as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ $item->product->selling_price }}</td>
                        <td>
                            <!-- Access the corresponding value from $orderreturnItem using the $index -->
                            @if(isset($orderreturnItem[$index]))
                                {{ $orderreturnItem[$index] }}
                            @else
                                0
                            @endif
                        </td>
                        <td>Rs. {{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals">
                <p>Subtotal: Rs {{ ($order->sub_total) }}</p>
                <p>Discount: Rs {{ $order->discount ?? 0.00 }} </p>
                <p>Tax Chg: Rs {{ $order->vat ?? 0.00 }} </p>
                <p>Shipping Chg: Rs {{ $order->shipping ?? 0.00 }} </p>

                <h4>Total: Rs {{ $order->total }}</h4>
                <p>Returned: Rs {{ $orderreturn->total ?? 0}} </p>
                <h4>Grand Total: Rs {{ ($order->total ?? 0 )- ($orderreturn->total ?? 0)}}</h4>
            </div>

            <div class="thanks">
                <p>Thanks For Buying Products!</p>
            </div>

            <div class="signature">
                <p>-----------------------------------</p>
                <h5>Authority Signature:</h5>
            </div>
        </div>

        <div class="footer">
            <p>This invoice is not replaceable and does not include any warranty.</p>
            <p>EasyShop Head Office | Email: support@abc.com | Mob: 1245454545 | Hayatabad 1207, Peshawar:#4</p>
        </div>
    </div>
</body>

</html>
