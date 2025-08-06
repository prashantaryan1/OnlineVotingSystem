<?php
session_start();
include 'db_connect.php'; // Database connection

$loginStatus = "";  // Message for status
$loginSuccess = false; // To track if login is successful

// When user submits login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get voter by email
    $sql = "SELECT * FROM voter WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $voter = $result->fetch_assoc();

        // Check hashed password
        if (password_verify($password, $voter['password'])) {
            $_SESSION['voter_id'] = $voter['voter_id'];
            $_SESSION['name'] = $voter['name'];
            $loginStatus = "✅ Login Successful!";
            $loginSuccess = true;
        } else {
            $loginStatus = "❌ Invalid password.";
        }
    } else {
        $loginStatus = "❌ No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voter Login</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 1px;
        }
        .center-button a {
            text-decoration: none;
        }
        .center-button button {
            padding: 12px;
            font-size: 1em;
            background-color:rgb(208, 240, 29);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .center-button button:hover {
            background-color:rgb(201, 211, 62);
        }
    </style>
</head>
<body>
    <header>Online Voting System</header>

    <div class="links">
        <a href="../index.html">Home</a>
        <a href="../index.html">Login</a>
        <a href="../register.html">Register</a>
    </div>

    <div class="container">
        <h2>Voter Login</h2>

        <?php if ($loginStatus == ""): ?>
            <!-- Show login form initially -->
            <form method="POST">
                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
            </form>

        <?php else: ?>
            <!-- Show login status -->
            <p style="text-align:center; color: <?php echo $loginSuccess ? 'green' : 'red'; ?>">
                <?php echo $loginStatus; ?>
            </p>

            <?php if ($loginSuccess): ?>
                <!-- Only show if login is successful -->
                <div class="center-button">
                    <a href="../dashboard.html"><button>Go to Vote<button></a>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>

    <footer>Developed By Prashant| RN College| Guided By R Ranjan Sir </footer>
</body>
</html>
