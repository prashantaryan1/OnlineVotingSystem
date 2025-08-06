<?php
session_start();
include 'db_connect.php';

$loginStatus = "";
$loginSuccess = false;

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Secure way using prepared statement recommended, but using basic method per your code
    $sql = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $res = $conn->query($sql);

    if ($res->num_rows == 1) {
        $_SESSION['admin'] = $user;
        $loginStatus = "✅ Success! Welcome Admin.";
        $loginSuccess = true;
    } else {
        $loginStatus = "❌ Invalid admin credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .success-msg {
            color: green;
            font-size: 1.5em;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .error-msg {
            color: red;
            font-size: 1.1em;
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .admin-buttons a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            font-size: 1em;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .admin-buttons a:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <header>Admin Login Panel</header>

    <div class="container">
        <h2>Admin Login</h2>

        <?php if ($loginStatus == ""): ?>
            <form method="POST">
                <label>Username:</label>
                <input type="text" name="username" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
            </form>

        <?php elseif ($loginSuccess): ?>
            <div class="success-msg"><?php echo $loginStatus; ?></div>
            <div class="admin-buttons">
                <a href="../admin/manage_candidates.html">Manage Candidates</a>
                <a href="../admin/results.html">Results</a>
            </div>

        <?php else: ?>
            <div class="error-msg"><?php echo $loginStatus; ?></div>
            <div style="text-align:center;">
                <a href="../admin/admin_login.html">🔁 Try Again</a>
            </div>
        <?php endif; ?>
    </div>

    <footer>Developed By Prashant| RN College| Guided By R Ranjan Sir </footer>
</body>
</html>
