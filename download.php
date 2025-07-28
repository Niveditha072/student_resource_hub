<?php
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$file = basename($_GET['file']);
$filePath = __DIR__ . '/uploads/' . $file;

if (!file_exists($filePath)) {
    die("File not found.");
}

// Force download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
?>
