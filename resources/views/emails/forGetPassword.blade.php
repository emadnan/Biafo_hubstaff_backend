<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>For Get PAssword</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            width : 100vh;
        }

        .card {
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 300px;
            text-align: center;
            width: 100%; /* Added width property */

        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Hi {{ $data['name'] }}!</h1>
        <p>Your Password is updated.</p>
        
        <p>Your Username and password are below:</p>
        <p>Username: {{ $data['email'] }} </p>
        <p>Password: {{ $data['password'] }}</p>

        <p><b>Please keep this information safe and secure.</b></p>
    </div>
</body>
</html>
