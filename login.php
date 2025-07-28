<?php
session_start();

// Auto-expire session after 10 minutes (600 seconds)
$expireAfter = 600;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $expireAfter) {
    // Session has expired
    session_unset();
    session_destroy();
    session_start(); // start fresh session
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

// Redirect logged-in users to the upload page
if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] === true) {
    header("Location: upload.php");
    exit();
}
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    // Replace with your actual authentication logic
    $validUsername = "admin"; // Example username
    $validPassword = "password"; // Example password

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION["isAdmin"] = true;
        header("Location: upload.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #ff7e5f;
    }
    .container {
      background: #fff;
      padding: 50px;
      border-radius: 4px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 600px;
      text-align: center;
    }
    .container h1 {
      font-weight: bold;
      margin-bottom: 15px;
      color: rgb(12, 1, 1);
    }
    .form-row {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 15px;
    }
    .form-group {
      display: flex;
      align-items: center;
      flex: 1;
    }
    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .password-container {
      position: relative;
      display: flex;
      align-items: center;
      flex: 1;
    }
    .password-container input { padding-right: 40px; }
    .eye-icon {
      position: absolute;
      right: 10px;
      cursor: pointer;
      font-size: 18px;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: hsl(255, 97%, 48%);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover { background-color: #b36e00; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Login</h1>
    <?php if (isset($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <div class="form-row">
        <div class="form-group">
          <input type="text" id="username" name="username" placeholder="Enter Username" required>
        </div>
        <div class="form-group password-container">
          <input type="password" id="password" name="password" placeholder="Enter Password" required>
          <span class="eye-icon" onclick="togglePassword()">🙈</span>
        </div>
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.querySelector(".eye-icon");
      input.type = input.type === "password" ? "text" : "password";
      icon.textContent = input.type === "password" ? "🙈" : "👁️";
    }
  </script>
  
</body>
</html>
