<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - New Inquiry</title>
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
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Inquiry from {{ $name }}</h1>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Subject:</strong> {{ $subject }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $requestmessage }}</p>
        <h2>User id: {{ $id }}</h2>
    </div>
    <div class="footer">
        <p>Thank you for reaching out to us. We will get back to you shortly.</p>
    </div>
</body>
</html>