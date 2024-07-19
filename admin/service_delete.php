<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$con->query("DELETE FROM services WHERE id=$id");
$_SESSION['service_deleted'] = "Service Deleted Successfully!";
header('location: services.php');