<?php
session_start();
require 'config.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $news_id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        $stmt = $conn->prepare("UPDATE news SET status = 'approved' WHERE id = ?");
    } elseif ($action == 'denied') {
        $stmt = $conn->prepare("UPDATE news SET status = 'denied' WHERE id = ?");
    } elseif ($action == 'delete') {
        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    } else {
        header("Location: 404.php");
        exit();
    }

    $stmt->bind_param("i", $news_id);

    if ($stmt->execute()) {
        header("Location: editor-dashboard.php");
        exit();
    } else {
        header("Location: 404.php");
        exit();
    }

} else {
    header("Location: 404.php");
    exit();
}
?>
