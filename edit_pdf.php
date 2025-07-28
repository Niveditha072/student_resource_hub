<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    echo "Invalid request";
    exit;
}

$conn = new mysqli("localhost", "root", "", "dept_resource_hub");
if ($conn->connect_error) {
    echo "Database connection failed";
    exit;
}

$id = intval($_POST["id"]);
$year = $_POST["year"];
$regulation = $_POST["regulation"];
$subject = $_POST["subject"];

$stmt = $conn->prepare("UPDATE pdfs SET year = ?, regulation = ?, subject = ? WHERE id = ?");
$stmt->bind_param("sssi", $year, $regulation, $subject, $id);

if ($stmt->execute()) {
    echo "✅ PDF updated successfully!";
} else {
    echo "❌ Failed to update PDF!";
}

$stmt->close();
$conn->close();
?>
