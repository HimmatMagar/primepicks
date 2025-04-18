<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Seller Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Seller Application</h1>
        <h4>User Id: {{ $id }}</h4>
        <p><strong>Full Name:</strong> {{ $name }}</p>
        <p><strong>Email Address:</strong> {{ $email }}</p>
        <p><strong>Phone Number:</strong> {{ $phone }}</p>
        <p><strong>Business Name:</strong> {{ $business }}</p>
        <p><strong>Business Category:</strong> {{ $category }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $requestmessage }}</p>
    </div>
</body>
</html>