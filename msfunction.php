<?php
include "includes/conn.php";

$showForm = false; 

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM microsoft WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);

    // Check if preparation was successfuls
    if ($stmt === false) {
        die('MySQL prepare error: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $expiration = $row['token_expiration'];

    d
        if (strtotime($expiration) > time()) {
         
            $showForm = true; 
        } else {
            echo "<script>alert('This link has expired. Please request a new registration link.');</script>";
        }
    } else {
        echo "<script>alert('Invalid token.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No token provided.');</script>";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #FBF5DF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            max-width: 400px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-wrap {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"], input[type="password"], select, input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #d32f2f;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #b71c1c;
        }
        p {
            text-align: center;
            color: #333;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php if ($showForm): ?>
    <div class="container">
        <form method="POST" action="sign_up.php" enctype="multipart/form-data">
            <div class="form-wrap">
                <label for="voters_id">Student ID</label>
                <input type="text" class="form-control" id="voters_id" name="voters_id" required>
            </div>
            <div class="form-wrap">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" required>
            </div>
            <div class="form-wrap">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" required>
            </div>
            <div class="form-wrap">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-wrap">
                <label for="course">Course</label>
                <select name="course" required>
                    <option value="">-Select-</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSBA">BSBA</option>
                    <option value="BSED">BSED</option>
                    <option value="BEED">BEED</option>
                    <option value="BSHM">BSHM</option>
                </select>
            </div>
            <div class="form-wrap">
                <label for="photo">Photo</label>
                <input type="file" name="photo" accept=".jpg, .jpeg, .png">
            </div>
            <button class="btn button-primary" type="submit" name="add">Register</button>
        </form>
        <div class="login-link">
            <p>Don’t have an account? <a href="sign_in.php">Login here</a></p>
        </div>
    </div>
<?php else: ?>
    <p>The registration link has expired or is invalid.</p>
<?php endif; ?>

<script>
    // JavaScript for formatting student ID
    document.getElementById('voters_id').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, ''); // Remove all non-numeric characters
        if (value.length > 8) {
            value = value.slice(0, 8); // Limit to 8 digits
        }
        var formattedValue = '';
        for (var i = 0; i < value.length; i += 4) {
            if (i > 0) {
                formattedValue += '-';
            }
            formattedValue += value.substring(i, i + 4);
        }
        e.target.value = formattedValue;
    });
</script>
</body>
</html>
