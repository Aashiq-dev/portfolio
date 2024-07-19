<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$con->query("DELETE FROM project WHERE id=$id");
$_SESSION['project_deleted'] = "Project Deleted Successfully!";
echo "<script>window.location.href='projects.php'</script>";