<?php
if($_SESSION['admin'] != 'admin'){
	// header('location: ../login.php');
	echo "<script>window.location.href='../login.php'</script>";
}