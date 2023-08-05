<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media print {
            @page {
                size: 80mm 297mm;
                margin: 0;
            }

            body {
                margin: 0;
                font-family: Arial, sans-serif; /* Change font family */
            }

            .invoice-container {
                max-width: 320px;
                margin: 0 auto;
                padding: 20px;
            }

            .invoice-title {
                font-size: 26px; /* Increase font size */
                font-weight: bold;
                text-align: center;
                margin-bottom: 10px; /* Add margin to separate title from details */
            }

            .invoice-details {
                font-size: 14px; /* Increase font size */
                text-align: center;
                margin-bottom: 20px;
            }

            .item-table {
                width: 100%;
                border-collapse: collapse;
            }

            .item-table th,
            .item-table td {
                padding: 8px;
                text-align: left;
                border: 1px solid #ddd; /* Add border around table cells */
            }

            .item-table th {
                text-transform: uppercase;
                font-size: 12px;
            }

            .item-table td {
                font-size: 14px;
            }

            .total-row td {
                text-align: right;
                font-weight: bold;
                font-size: 14px;
            }

            .thank-you {
                font-size: 14px;
                text-align: center;
                margin-top: 20px;
            }

            .technology-partner {
                font-size: 10px;
                text-align: center;
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-title">Your Company Name</div> <!-- Change your company name here -->

        <div class="invoice-details">
            <p>Date: <span>{{ \Carbon\Carbon::now()->toDateString() }}</span></p>
            <p>Invoice #: <span>{{ $order->invoice_no ?? 0 }}</span></p>
            <p>Customer: <span>{{ $customer->name }}</span></p>
            <p>Contact: <span>{{ $customer->phone }}</span></p>
        </div>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contents as $key => $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unitcost }}</td>
                    <td>{{ $item->unitcost * $item->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3">Subtotal</td>
                    <td>{{ $order->sub_total }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Discount</td>
                    <td>{{ $order->discount ?? 0 }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Tax</td>
                    <td>{{ $order->vat ?? 0 }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>{{ $order->total }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Paid</td>
                    <td>{{ $order->pay ?? 0 }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Due</td>
                    <td>{{ $order->due ?? 0 }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="thank-you">Thank you for your business!</div> <!-- Customize the thank you message -->

        <div class="technology-partner">Technology Partner: Your Company Name</div> <!-- Customize the technology partner details -->
        <div class="technology-partner">Operator: {{ Auth::user()->name }} - {{ now()->format('Y-m-d H:i:s') }}</div>

    </div>
</body>

</html>

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).ready(function() {
        window.print();
    });
</script>
