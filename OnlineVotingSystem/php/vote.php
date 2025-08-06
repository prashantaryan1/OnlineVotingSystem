<?php
include 'db_connect.php';
session_start();

$voter_id = $_SESSION['voter_id'];
$candidate_id = $_POST['candidate_id'];

// Check if already voted
$check = "SELECT status FROM voter WHERE voter_id='$voter_id'";
$res = $conn->query($check)->fetch_assoc();

$alreadyVoted = ($res && $res['status'] == 'voted');
$voteSuccess = false;

if (!$alreadyVoted) {
    // Insert vote
    $sql = "INSERT INTO vote (voter_id, candidate_id, timestamp) VALUES ('$voter_id', '$candidate_id', NOW())";

    // Update vote count and status
    if ($conn->query($sql)) {
        $conn->query("UPDATE candidate SET votes = votes + 1 WHERE candidate_id='$candidate_id'");
        $conn->query("UPDATE voter SET status='voted' WHERE voter_id='$voter_id'");
        $voteSuccess = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Vote Status</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      font-family: 'Montserrat', sans-serif;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px 60px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      text-align: center;
      backdrop-filter: blur(10px);
    }

    .card h1 {
      font-size: 32px;
      margin-bottom: 15px;
      color: #ffffff;
    }

    .card p {
      font-size: 18px;
      color: #e0f7fa;
    }

    .btn {
      margin-top: 25px;
      padding: 12px 25px;
      background: #fff;
      color: #0072ff;
      font-weight: bold;
      text-decoration: none;
      border-radius: 30px;
      transition: 0.3s;
    }

    .btn:hover {
      background: #e3e3e3;
    }

    .emoji {
      font-size: 48px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="card">
    <?php if ($alreadyVoted): ?>
      <div class="emoji">⚠️</div>
      <h1>You Have Already Voted!</h1>
      <p>Each voter can vote only once.</p>
    <?php elseif ($voteSuccess): ?>
      <div class="emoji">✅</div>
      <h1>Thank You for Voting!</h1>
      <p>Your vote has been recorded successfully.</p>
    <?php else: ?>
      <div class="emoji">❌</div>
      <h1>Oops! Something went wrong.</h1>
      <p>Unable to record your vote. Please try again.</p>
    <?php endif; ?>
    <a class="btn" href="../index.html">← Back to Login</a>
  </div>
</body>
</html>
