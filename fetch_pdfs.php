<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default MySQL username for XAMPP
$password = ""; // Default password for XAMPP MySQL
$dbname = "dept_resource_hub"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all necessary columns from the database
$sql = "SELECT id, subject, file_path, year, regulation FROM pdfs"; // Make sure your 'pdfs' table has 'year' and 'regulation' columns
$result = $conn->query($sql);

$pdfs = array();

// Fetch all PDFs into an array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdfs[] = [
            'id' => $row['id'],
            'subject' => $row['subject'],
            'file_path' => $row['file_path'],
            'year' => $row['year'],
            'regulation' => $row['regulation']
        ];
    }
}

// Close the connection
$conn->close();

// Output as JSON
header('Content-Type: application/json');
echo json_encode($pdfs);
?>
