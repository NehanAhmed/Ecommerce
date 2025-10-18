<?php
// Quick DB connection test — safe to run from project root
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include the DB connection used by the app
include __DIR__ . '/admin/include/db.php';

if (isset($conn) && $conn instanceof mysqli) {
    if ($conn->connect_errno) {
        echo "DB connection error: " . $conn->connect_error;
    } else {
        echo "DB connected successfully to database: " . htmlspecialchars($dbname);
    }
} else {
    echo "\$conn not available or not a mysqli instance.\n";
}

?>
