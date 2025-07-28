<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true) {
    header("Location: login.php");
    exit();
}

// Optional: Auto logout after 15 minutes of inactivity
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) > 900) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
$_SESSION["last_activity"] = time(); // Reset activity timer

// Handle file upload if POST method
$uploadSuccess = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "dept_resource_hub");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $year = $_POST["year"] ?? "";
    $regulation = $_POST["regulation"] ?? "";
    $subject = $_POST["subject"] ?? "";
    $file = $_FILES["pdfFile"] ?? null;

    if (!$file || $file["error"] !== UPLOAD_ERR_OK) {
        $uploadSuccess = false;
    } else {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = basename($file["name"]);
        $filePath = $uploadDir . $filename;

        if (move_uploaded_file($file["tmp_name"], $filePath)) {
            $stmt = $conn->prepare("INSERT INTO pdfs (year, regulation, subject, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $year, $regulation, $subject, $filePath);
            $stmt->execute();
            $stmt->close();
            $uploadSuccess = true;
        } else {
            $uploadSuccess = false;
        }
    }

    $conn->close();
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upload PDFs</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
    header { text-align: center; margin-bottom: 20px; }
    header h1 { margin-bottom: 10px; }
    form, #search-section { margin: 10px auto; width: 80%; max-width: 800px; display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
    input, select, button { padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
    table { width: 90%; margin: 20px auto; border-collapse: collapse; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    th, td { padding: 12px; border: 1px solid #ccc; text-align: left; }
    th { background-color: #007bff; color: #fff; }
    .btn { padding: 6px 12px; margin: 2px; border: none; border-radius: 5px; color: white; cursor: pointer; }
    
  </style>
<link rel="icon" href="img/favicon_io/favicon.ico1" type="image/x-icon">


</head>
<body>
  <header>
    <h1>ADMINS</h1>
    <a href="logout.php">Logout</a>

    <!-- Upload Form -->
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <select name="year" required>
        <option value="1st Year">1st Year</option>
        <option value="2nd Year">2nd Year</option>
        <option value="3rd Year">3rd Year</option>
        <option value="4th Year">4th Year</option>
      </select>

      <select name="regulation" required>
        <option value="R20">R20</option>
        <option value="R23">R23</option>
      </select>

      <input type="text" name="subject" placeholder="Enter Subject Name" required />
      <input type="file" name="pdfFile" accept="application/pdf" required />
      <button type="submit">Upload</button>
    </form>

    <?php
      if ($uploadSuccess === true) {
          echo "<p style='color: green;'>File uploaded successfully!</p>";
      } elseif ($uploadSuccess === false) {
          echo "<p style='color: red;'>File upload failed. Try again.</p>";
      }
    ?>

    <!-- Search Section -->
    <div id="search-section">
      <select id="year">
        <option value="">Select Year</option>
        <option value="1st Year">1st Year</option>
        <option value="2nd Year">2nd Year</option>
        <option value="3rd Year">3rd Year</option>
        <option value="4th Year">4th Year</option>
      </select>

      <select id="regulation">
        <option value="">Select Regulation</option>
        <option value="R20">R20</option>
        <option value="R23">R23</option>
      </select>

      <input type="text" id="search" placeholder="Enter Subject">
      <button id="search-btn">Search</button>
    </div>
    
  </header>

  <!-- Table for Displaying PDFs -->
  <table>
  <tr>
    <th>Subject</th>
    <th>Year</th>
    <th>Regulation</th>
    <th>PDF</th>
    <th>Actions</th>
  </tr>
  <tbody id="pdf-container"></tbody>
</table>

<!-- PDF viewer will load here -->
<div id="pdfViewerContainer"></div>
<script src="index.js"></script>
<section id="development-team" style="padding: 20px; background-color: #f0f4ff; border-radius: 12px; margin-top: 20px;">
  <h2 style="text-align: center; color: #333;">💻 Development Team</h2>
  <ul style="list-style: none; padding: 0; text-align: center; font-size: 18px; color: #555;">
    <li>👤 D.Niveditha</li>
    <li>👤 K.Dolly Ganya </li>
    
    <!-- Add or remove members as needed -->
  </ul>
</section>
</body>
</html>
