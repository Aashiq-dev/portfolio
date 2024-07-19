<?php
session_start();
include '../include/config.php';

$id = base64_decode($_GET['id']);
$con->query("DELETE FROM skills WHERE id=$id");
$_SESSION['skill_deleted'] = "Skill Deleted Successfully!";
header('location: skills.php');