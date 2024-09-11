<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>MS365 Verification</title>
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
            flex-direction: row;
            width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .container .left-section {
            background-color: #d32f2f;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40%;
        }

        .container .left-section img {
            max-width: 100%;
            height: auto;
        }

        .container .right-section {
            padding: 100px;
            width: 60%;
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
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            width: 100%;
            color: #333;
            text-align: left;
        }

        input[type="username"] {
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
            text-align: center;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
                padding: 20px;
            }

            .container .left-section {
                width: 100%;
                padding: 20px;
            }

            .container .right-section {
                padding: 40px 20px;
                width: 100%;
            }

            h2 {
                font-size: 22px;
            }

            input[type="email"], button {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .container .right-section {
                padding: 20px 10px;
            }

            h2 {
                font-size: 20px;
            }

            input[type="email"], button {
                font-size: 13px;
                padding: 10px;
            }

            button {
                padding: 10px;
            }
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
            <h2>MS365 Verification</h2>
            <form id="ms365Form" action="admin/msmailer.php" method="post">
                <label for="email">Enter your MS365 Email:</label>
                <input type="username" id="email" name="username" placeholder="example@mcclawis.edu.ph" required>
                <button type="submit" name="btn-forgotpass">Submit</button>
            </form>
            <p>We'll send a link to your MS365.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');

            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Success' : 'Error',
                    text: message,
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>
</html>