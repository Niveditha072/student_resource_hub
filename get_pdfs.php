<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "dept_resource_hub";

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get filters
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : "";
$year = isset($_POST['year']) ? $conn->real_escape_string($_POST['year']) : "";
$regulation = isset($_POST['regulation']) ? $conn->real_escape_string($_POST['regulation']) : "";

// Query
$sql = "SELECT id, subject, year, regulation, file_path FROM pdfs WHERE 1=1";
if (!empty($search)) $sql .= " AND subject LIKE '%$search%'";
if (!empty($year)) $sql .= " AND year = '$year'";
if (!empty($regulation)) $sql .= " AND regulation = '$regulation'";
$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);
$pdfs = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['file_path'] = 'uploads/' . basename($row['file_path']);
        $row['file_path'] = str_replace('\\', '/', $row['file_path']);
        $pdfs[] = $row;
    }
}

$conn->close();
echo json_encode($pdfs);
?>
