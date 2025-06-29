<?php
if (isset($_GET['file'])) {
    $filePath = urldecode($_GET['file']);
    $fullPath = __DIR__ . '/' . $filePath;

    if (file_exists($fullPath)) {
        // Set headers for proper file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fullPath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fullPath));
        flush();
        readfile($fullPath);
        exit;
    } else {
        http_response_code(404);
        echo "Error: File not found.";
        exit;
    }
} else {
    http_response_code(400);
    echo "Error: No file specified.";
    exit;
}
