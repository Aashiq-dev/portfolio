<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$con->query("DELETE FROM education WHERE id=$id");
$_SESSION['education_deleted'] = "Degree Deleted Successfully!";
header('location: education.php');