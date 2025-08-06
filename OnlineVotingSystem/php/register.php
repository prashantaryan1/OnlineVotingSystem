<?php
include 'db_connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$gender = $_POST['gender'];
$dob = $_POST['dob'];

$sql = "INSERT INTO voter (name, email, password, gender, dob, status) 
        VALUES ('$name', '$email', '$password', '$gender', '$dob', 'not voted')";
?>

<?php
include 'db_connect.php';

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$gender = $_POST['gender'];
$dob = $_POST['dob'];

// Prepare SQL to insert voter
$sql = "INSERT INTO voter (name, email, password, gender, dob, status) 
        VALUES ('$name', '$email', '$password', '$gender', '$dob', 'not voted')";

// Try to execute the query
$success = false;
$message = "";

if ($conn->query($sql)) {
    $success = true;
    $message = "✅ Registration successful!";
} else {
    $message = "❌ Error: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Status</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .result-box {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            color: <?php echo $success ? 'green' : 'red'; ?>;
        }
        .center-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .center-button a {
            text-decoration: none;
        }
        .center-button button {
            padding: 12px 25px;
            font-size: 1em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .center-button button:hover {
            background-color: #0056b3;
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
        <h2>Registration Result</h2>
        <div class="result-box">
            <?php echo $message; ?>
        </div>
        <?php if ($success): ?>
            <div class="center-button">
                <a href="../index.html"><button>Go to Login</button></a>
            </div>
        <?php endif; ?>
    </div>

    <footer>Developed by Prashant | RN College | R Ranjan Sir</footer>
</body>
</html>
