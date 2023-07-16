<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styles for the report */
        body {
            font-family: Arial, sans-serif;
        }
        
        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .report-header h2 {
            margin: 0;
        }
        
       
    .report-footer {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
        color: #888;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .report-footer p {
        margin: 0 10px;
    }


        
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .report-table th, .report-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        
        .report-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        
        .report-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <img src="path/to/company-logo.png" alt="Company Logo">
        <h2>Adjustment Details Report</h2>
        <p> Adjustment Date:{{ $dateString }}</p>
        <p>Reference Number: {{ $referenceNumbersString }}</p>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Product Name</th>
                <th>Adjusted Quantity</th>
                <th>Adjustment Type</th>
                <th>Adjusted By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adjustedItem as $key => $detail)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $detail->products['product_name'] }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->adjustment_type }}</td>
                    <td>{{ $detail->users['name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <label for="" class="form-label">Reason</label>
<textarea name="" class="form-textarea mt-2" id="" cols="30" rows="10">
    {{ $reasonString }}
</textarea>
    <div class="report-footer">
        {{-- <p>Company Name</p>
        <p>Company Address</p> --}}
        <p>Current Date: {{ date('Y-m-d') }}</p>
        <span>Current User: {{ Auth::user()->name }}</span>
    </div>
</body>
</html>
