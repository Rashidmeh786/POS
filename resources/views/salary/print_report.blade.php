<!DOCTYPE html>
<html>
<head>
    <title>Printable Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            position: relative; /* Added position property */
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .employee-image {
            width: 100px;
            height: 100px;
            border-radius: 5%;
            object-fit: cover;
            float: right;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 3px;
            color: #fff;
        }

        .status-paid {
            background-color: #28a745;
        }

        .status-pending {
            background-color: #ffc107;
        }

        .status-overdue {
            background-color: #dc3545;
        }

        .header {
            display: flex;
            justify-content: space-between; /* Added justify-content property */
            align-items: center;
            margin-bottom: 20px;
        }

        .company-info {
            text-align: center;
        }

        .header-line {
            border-top: 1px solid black;
            margin-bottom: 10px;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            left: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="company-info">
                <h2  style="text-align: center;"">Company Name</h2>
                <h2>Company Address</h2>
            </div>
            <div>
                <p style="text-align: right;">{{ date('Y-m-d') }}</p>
            </div>
            
        </div>
        <div class="header-line"></div>
        <div style="text-align: right;">
            <img height="50px" width="50px" style="margin-left: 200px;margin-top:-5px " src="{{ (!empty($salaryHistory[0]['employee']['image'])) ? url('upload/employee/'.$salaryHistory[0]->employee->image) : url('upload/no_image.jpg') }}" class="employee-image">
        </div>
        <div>
            <div style="display: flex; justify-content: space-between;">
                <p>Emp Code: {{ $salaryHistory[0]['employee']['code'] }}</p>
                <p>Department: {{ $salaryHistory[0]['employee']['department']['name'] ?? 'N/A' }}</p>

            </div>
            <div style="display: flex; justify-content: space-between;">
                <p>Name: {{ $salaryHistory[0]['employee']['name'] }}</p>

                <p>Designation: {{ $salaryHistory[0]['employee']['designation']['name'] ?? 'N/A' }}</p>
            </div>
        </div>
        <div class="header-line"></div>
        
        <h2> Salary Slip</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>Name</th> --}}
                    <th>Month</th>
                    <th>Salary</th>
                    <td>Advance</td>
                    <th>Salary Paid</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaryHistory as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    {{-- <td>{{ $item['employee']['name'] }}</td> --}}
                    <td>{{ $item->salary_month }} {{ $item->salary_year }}</td>
                    <td>{{ $item['employee']['salary'] }}</td>
                    <td>{{ $item->advance_salary ?? 0 }}</td>
                    <td>{{ $item->due_salary }}</td>
                    <td>
                        <span style="font-weight:bold">{{ $item->salary_status }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        
        <div class="footer">
        <div class="header-line"></div>
            
            <p>Company Address | Phone: 1234567890 | Email: info@company.com</p>
        </div>
    </div>
</body>
</html>
