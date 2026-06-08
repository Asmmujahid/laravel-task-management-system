<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Poppins', sans-serif;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        h1 {
            font-size: 120px;
            margin: 0;
            animation: fadeInDown 1s ease-in-out;
        }
        h2 {
            font-size: 32px;
            margin: 10px 0;
        }
        p {
            font-size: 18px;
            max-width: 500px;
            margin-bottom: 30px;
        }
        .btn {
            background: white;
            color: #764ba2;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover {
            background: #222;
            color: white;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <p>Oops! The page you are looking for doesn’t exist or has been moved.</p>
    <a href="{{ url('/') }}" class="btn">Back to Home</a>
</body>
</html>
