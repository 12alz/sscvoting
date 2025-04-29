<?php 
// Prevent browser caching
header("Cache-control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Include your database connection
include "includes/conn.php";

// Dummy values for demonstration – replace with real logic if needed
// $email = "student@mcclawis.edu.ph";
// $firstname = "John";
// $lastname = "Doe";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Sign Up</title>
    <style>
        /* Add your CSS here (same as your original, shortened for clarity) */
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/color4.jpg') no-repeat center center fixed;
            margin: 0;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            background: #fff;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        /* Additional form styling... */
        /* Copy your styles as needed */
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align: center; color: #333;">Register</h2>
    <form method="POST" action="sign_up.php" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form-wrap">
            <label for="voters_id">Student ID</label>
            <input type="text" class="form-control" id="voters_id" name="voters_id" required pattern="\d{4}-\d{4}" title="Format: XXXX-XXXX (8 digits total)">
        </div>

        <div class="form-wrap">
            <label for="email">MS365 Email</label>
            <input type="email" name="email" id="email" required 
                   pattern="^[a-zA-Z0-9._%+-]+@mcclawis\.edu\.ph$" 
                   value="<?php echo htmlspecialchars($email); ?>" 
                   title="Please enter a valid email address from the mcclawis.edu.ph domain."
                   readonly>
        </div>

        <div class="form-wrap">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($firstname); ?>" readonly>
        </div>

        <div class="form-wrap">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" required pattern="[A-Za-z\s-]+" value="<?php echo htmlspecialchars($lastname); ?>" title="Only letters and spaces are allowed" readonly>
        </div>

        <div class="form-wrap">
            <label for="password">Password</label>
            <div style="position: relative;">
                <input type="password" id="password" name="password" required minlength="8" 
                       pattern="(?=.*[!@#$%^&*])(?=.*[A-Za-z])(?=.*\d).+" 
                       title="Minimum 8 characters, at least one letter, one number, and one special character">
                <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
            </div>
        </div>

        <div class="form-wrap">
            <label for="confirm_password">Confirm Password</label>
            <div style="position: relative;">
                <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
                <span class="eye-icon" onclick="togglePassword('confirm_password')">👁️</span>
            </div>
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

        <div class="form-wrap">
            <label>
                <input type="checkbox" name="terms" required>
                I agree to the terms of use and <a href="privacy-policy" target="_blank">Privacy Policy</a>
            </label>
        </div>

        <button class="btn button-primary" type="submit" name="add">Register</button>
    </form>

    <div class="login-link">
        <p>Have an account? <a href="sign_in.php">Login here</a></p>
    </div>
</div>

<script>
    // Format Student ID as XXXX-XXXX
    document.getElementById('voters_id').addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        var formattedValue = '';
        for (var i = 0; i < value.length; i += 4) {
            if (i > 0) formattedValue += '-';
            formattedValue += value.substring(i, i + 4);
        }
        e.target.value = formattedValue;
    });

    // Toggle password visibility
    function togglePassword(id) {
        const passwordField = document.getElementById(id);
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    }

    // Client-side form validation
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const fileInput = document.querySelector('input[name="photo"]');
        const file = fileInput.files[0];

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        if (file) {
            const allowedExtensions = ['.jpg', '.jpeg', '.png'];
            const fileName = file.name.toLowerCase();
            const fileExtension = fileName.substring(fileName.lastIndexOf('.'));
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Only JPG, JPEG, and PNG files are allowed.");
                return false;
            }
        }

        const email = document.getElementById('email').value;
        const domain = email.substring(email.lastIndexOf('@') + 1).toLowerCase();
        if (domain !== "mcclawis.edu.ph") {
            alert("Please enter a valid email address with the domain mcclawis.edu.ph");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
