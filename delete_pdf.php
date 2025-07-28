<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    echo "Invalid request";
    exit;
}

$id = intval($_POST['id']);
$conn = new mysqli("localhost", "root", "", "dept_resource_hub");

if ($conn->connect_error) {
    echo "Database connection failed";
    exit;
}

// Get file path
$stmt = $conn->prepare("SELECT file_path FROM pdfs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $filePath = $row['file_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// Delete from DB
$stmt = $conn->prepare("DELETE FROM pdfs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

echo "✅ PDF deleted successfully!";
?>
