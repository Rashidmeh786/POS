@extends('admin.admin_dashboard')
@section('admin')
<!DOCTYPE html>
<html>
<head>
  <title> Receipt</title>
  <style>
    @media print {
      @page {
        size: 80mm 297mm; /* Set the size of the thermal paper */
        margin: 0; /* Remove default margins */
      }
      body {
        font-family: Arial, sans-serif; /* Set the font family */
        font-size: 12px; /* Set the font size */
        margin: 0; /* Remove default margins */
      }
      .invoice {
        padding: 10px;
      }
      .invoice p {
        margin: 0;
      }
    }
  </style>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: white;
    }
    .receipt {
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      padding: 10px;
      max-width: 400px;
      margin: 0 auto;
    }
    .header {
      text-align: center;
      margin-bottom: 10px;
    }
    .logo {
      width: 80px;
      height: 80px;
      margin: 0 auto;
      display: block;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      font-size: 12px;
    }
    th {
      background-color: #f5f5f5;
      position: relative;
    }
    th::before, th::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      border-bottom: 1px solid #000; /* Line style */
    }
    th::before {
      top: 0;
    }
    th::after {
      bottom: 0;
    }
    .item {
      border-bottom: 1px solid #ccc;
    }
    .item:last-child {
      border-bottom: none;
    }
    .total {
      margin-top: 10px;
      text-align: right;
      font-weight: bold;
    }
    .total p {
      margin: 3px 0;
      font-size: 12px;
    }
    .payment-details {
      margin-top: 10px;
    }
    .payment-row {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
    }
    .payment-label {
      flex-basis: 50%;
    }
    .receiptfooter {
      margin-top: 10px;
      text-align: center;
      font-size: 12px;
    
    line-height: 2px;
    }
    .customer-details {
      margin-bottom: 10px;
      text-align: left;
      font-size: 12px;
    }
    .customer-info {
      text-align: left; /* Align customer name and address to the left */
    }
    .customer-name {
      font-size: 12px; /* Reduced font size for customer name */
      font-weight: bold;
    }
    .customer-address {
      font-size: 12px; /* Reduced font size for customer address */
    }
    .info {
      text-align: right; /* Align date and receipt number to the right */
    }
    .info p {
      font-size: 10px;
      margin: 2px 0;
    }
    .last{
        border-bottom:1px solid ; 

    }

  </style>
</head>
<body>



  <div class="receipt">
    <div class="container">
        <div class="header">
            <img src="" alt="Logo" class="logo">
            <h4>Original Receipt</h4>
            <div class="customer-info">
                <p class="customer-name">Customer: <span>{{ $customer->name }}</span></p>
                {{-- <p class="customer-address">123 Main Street, City, State, ZIP</p> --}}
            </div>
        </div>
        <div class="info">
            <div class="receipt-info">
                <p>Receipt #: {{ $order->invoice_no }}</p>
                <p style="font-size: 10px">Date: <span>{{ \Carbon\Carbon::now()->toDateString() }}</span></p>
                {{-- <td>Time: <span> {{ now()->format('H:i:s') }}</span></td> --}}
            </div>
        </div>
    </div>
    

    <table>
      <thead>
        <tr>
          <th>
            <div>Item Name</div>
            <div></div> <!-- Empty div for the line -->
          </th>
          <th>
            <div>Qty</div>
            <div></div> <!-- Empty div for the line -->
          </th>
          <th>
            <div>Price</div>
            <div></div> <!-- Empty div for the line -->
          </th>
          <th>
            <div>Subtotal</div>
            <div></div> <!-- Empty div for the line -->
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($productdetails as $key=> $item)
        <tr class="item">
            <td>{{ $item->product->product_name }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->unitcost }}</td>
          <td>{{ $item->quantity * $item->unitcost }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="total">
      <p>Subtotal: {{ $order->sub_total }}</p>
      <p>Discount: {{ $order->discount ?? 0}}</p>
      <p>Tax: {{ $order->vat ?? 0}}</p>
      <p>Total: RS {{ $order->total ?? 0}}</p>
    </div>
    <div class="payment-details">
      <div class="payment-row">
        <span class="payment-label">Payment Method:</span>
        <span style="font-weight: bold">Cash</span>
      </div>
      <div class="payment-row">
        <span class="payment-label">Paid Amount:</span>
        <span style="font-weight: bold">{{ $order->pay ?? 0}}</span>
      </div>
      <div class="payment-row last">
        <span class="payment-label"> Due:</span>
        <span style="font-weight: bold">{{ $order->due ?? 0}}</span>
      </div>
    </div>
    <div class="receiptfooter">
      {{-- <p>Thanks for your purchase!</p> --}}
      <p>isoft technologies partner peshawar</p>
      <p>Contact: anc@gmail.com</p>
      <p style="text-align: right; margin-top: 25px;">Operator <span>{{ Auth::user()->name }}</span>- {{ now()->format('Y-m-d H:i:s') }}</p>

    </div>
   
   
  </div>
</body>
</html>

  


<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    // In your invoice view file (invoice.thermal.blade.php)


    $(document).ready(function() {
        window.print();
       
    });
</script>
<script type="text/javascript">
    // JavaScript function to trigger the print operation when the page loads
    window.onload = function() {
      window.print();
    };
  </script>


  @endsection