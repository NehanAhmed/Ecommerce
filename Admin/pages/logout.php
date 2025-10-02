<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging out...</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <script>
    // 2 second baad redirect
    setTimeout(function(){
      window.location.href = "../auth/sign-in.php";
    }, 1000);
  </script>
</head>
<body class="d-flex justify-content-center align-items-center" style="height:100vh;">
  <div class="alert alert-success text-center" role="alert">
    You have been logged out successfully!<br>
    <!-- Redirecting to sign-in page in ... -->
  </div>
</body>
</html>
