<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #ff6a00, #ee0979);
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
            color: #ee0979;
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
    <h1>403</h1>
    <h2>Access Denied</h2>
    <p>Sorry, you don’t have permission to view this page. Please contact the administrator if you think this is a mistake.</p>
    <a href="{{ url()->previous() }}" class="btn">Go Back</a>
</body>
</html>
