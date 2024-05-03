<?php
require_once 'db_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    if (deleteImage($id)) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
