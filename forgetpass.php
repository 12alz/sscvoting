<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('images/color4.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: row; /* Set row layout */
            width: 900px; /* Adjust width similar to the login page */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .container .left-section {
            background-color: #d32f2f; /* Matches the red background */
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40%; /* Occupies the left 40% */
        }

        .container .left-section img {
            max-width: 100%;
            height: auto;
        }

        .container .right-section {
            padding: 100px;
            width: 40%; /* Occupies the right 60% */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
            color: #333;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #d32f2f;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b71c1c;
        }

        .container p {
            margin-top: 15px;
            color: #666;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="images/logo-170x172.png" alt="Logo"> <!-- Ensure to use your logo here -->
        </div>
        <div class="right-section">
            <h2>Forgot Password</h2>
            <form action="admin/function.php" method="post">
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                <button type="submit" name="btn-forgotpass">Send Reset Link</button>
            </form>
            <p>We'll send a link to reset your password.</p>
        </div>
    </div>
</body>
</html>
