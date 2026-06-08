<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #00b4db, #0083b0);
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
            animation: pulse 1s infinite;
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
            color: #0083b0;
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
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <h1>500</h1>
    <h2>Something Went Wrong</h2>
    <p>Our server encountered an unexpected issue. Please try again later or contact support.</p>
    <a href="{{ url('/') }}" class="btn">Back to Home</a>
</body>
</html>
