<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$id2 = base64_decode($_GET['id2']);
$id3 = base64_encode($id2);

$con->query("DELETE FROM projecticon WHERE id=$id");
echo "<script>window.location.href='project_update.php?id=$id3'</script>";