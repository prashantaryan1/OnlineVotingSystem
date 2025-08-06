<?php
include 'db_connect.php';

$name = $_POST['name'];
$party = $_POST['party'];
$symbol = $_POST['symbol'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Candidate Added</title>
  <link rel="stylesheet" href="../style.css"> <!-- adjust path if needed -->
  <style>
    body {
      background: linear-gradient(to right, #6dd5ed, #2193b0);
      font-family: 'Poppins', sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 50px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      text-align: center;
      backdrop-filter: blur(10px);
    }

    .card h2 {
      font-size: 28px;
      margin-bottom: 15px;
      color: #fff;
    }

    .card p {
      font-size: 18px;
      margin: 10px 0;
      color: #e0f7fa;
    }

    .card a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 25px;
      background: #ffffffcc;
      color: #007BFF;
      border-radius: 30px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s ease-in-out;
    }

    .card a:hover {
      background: #ffffff;
      color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="card">
    <?php
    if ($conn->query("INSERT INTO candidate (name, party, symbol, votes) VALUES ('$name', '$party', '$symbol', 0)")) {
        echo "<h2>✅ Candidate Added Successfully</h2>";
        echo "<p>Name: <strong>$name</strong></p>";
        echo "<p>Party: <strong>$party</strong></p>";
        echo "<p>Symbol: <strong>$symbol</strong></p>";
    } else {
        echo "<h2>❌ Error Adding Candidate</h2>";
        echo "<p>" . $conn->error . "</p>";
    }
    ?>
    <a href="../admin/manage_candidates.html">← Add Another</a>
  </div>
</body>
</html>
