<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$con->query("DELETE FROM certificate WHERE id=$id");
$_SESSION['certificate_deleted'] = "Certificate Deleted Successfullly!";
header('location: certificates.php');