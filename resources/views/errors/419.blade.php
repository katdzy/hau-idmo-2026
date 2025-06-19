<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired</title>
    <style>
        /* Basic Reset and Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #7f1d1d; /* Dark red background */
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            max-width: 500px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #7f1d1d;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            color: #555555;
            margin-bottom: 30px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .button {
            padding: 12px 20px;
            font-size: 1rem;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .button.go-back {
            background-color: #555555; /* Gray button */
        }

        .button.go-back:hover {
            background-color: #444444;
        }

        .button.log-in {
            background-color: #7f1d1d; /* Dark red button */
        }

        .button.log-in:hover {
            background-color: #a83232;
        }

        .dashboard-link {
            display: block;
            margin-top: 20px;
            font-size: 1rem;
            color: #7f1d1d;
            text-decoration: underline;
            cursor: pointer;
        }

        .dashboard-link:hover {
            color: #a83232;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Session Expired</h1>
        <p>Your session has expired due to inactivity. Please log in again to continue.</p>
        
        <div class="buttons">
            <a href="{{ url()->previous() }}" class="button go-back">Go Back</a>
            <a href="{{ route('login') }}" class="button log-in">Log In</a>
        </div>

        <a href="{{ route('dashboard') }}" class="dashboard-link">Go to Dashboard</a>
    </div>
</body>
</html>
