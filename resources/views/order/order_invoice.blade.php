<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Arial, sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            /* background-color: #f5f5f5; */
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
            font-size: 26px;
            margin: 0;
        }
        .customer-details {
            font-size: 14px;
            line-height: 1.5;
        }
        .invoice-details {
            font-size: 14px;
            line-height: 1.5;
            text-align: right;
        }
        .invoice-details h3 {
            color: #1a936f;
            font-size: 20px;
            margin: 0 0 10px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-table th,
        .product-table td {
            padding: 10px;
            border-bottom: 1px solid #dddddd;
            text-align: left;
        }
        .product-table th {
            background-color: #1a936f;
            color: #ffffff;
        }
        .totals {
            text-align: right;
            font-size: 16px;
            line-height: 1.5;
        }
        .thanks {
            color: #1a936f;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        .signature {
            text-align: right;
            margin-top: 40px;
        }
        .signature p {
            margin: 0;
        }
        .signature h5 {
            color: #1a936f;
            margin: 10px 0 0;
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
        margin-bottom: 0; /* Remove the default margin-bottom */
    }
    .footer {
        font-size: 14px;
        color: #111111;
        text-align: center;
        /* background-color: lightgray; */
        padding: 10px;
        margin-top: auto; /* Push the footer to the bottom of the container */
    }
</style>






    </style>

  </head>
  <body>
    <div class="container">
        <div class="content">
            <div class="header">
                <h2>EasyShop</h2>
                <div class="invoice-details">
                    <h3>Invoice: #{{ $order->invoice_no }}</h3>
                    <p>
                        Order Date: {{ $order->order_date }}<br>
                        Order Status: {{ $order->order_status }}<br>
                        Payment Status: {{ $order->payment_status }}<br>
                        Total Pay: {{ $order->pay }}<br>
                        Total Due: {{ $order->due }}
                    </p>
                </div>
            </div>

            <div class="customer-details">
                <p>
                    <strong>Customer Name:</strong> {{ $order->customer->name }}<br>
                    <strong>Customer Email:</strong> {{ $order->customer->email }}<br>
                    <strong>Customer Phone:</strong> {{ $order->customer->phone }}<br>
                    <strong>Address:</strong> {{ $order->customer->address }}<br>
                    <strong>Shop Name:</strong> {{ $order->customer->shopname }}
                </p>
            </div>

            <h3>Products</h3>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItem as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->product->product_code }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs. {{ $item->product->selling_price }}</td>
                        <td>Rs. {{ $item->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals">
                <h2>Subtotal: Rs{{ $order->total }}</h2>
                <h2>Total: Rs{{ $order->total }}</h2>
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
            <p>EasyShop Head Office | Email: support@easylearningbd.com | Mob: 1245454545 | Dhaka 1207, Dhanmondi:#4</p>
        </div>
    </div>
  </body>
</html>
