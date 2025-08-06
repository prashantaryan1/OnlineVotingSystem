<?php
session_start();
session_unset();
session_destroy();

// ✅ Redirect to logout message page
header("Location: ../logged_out.html"); // File must exist
exit();
?>
