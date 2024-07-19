<?php
include '../include/config.php';
session_start();
$title = "Update Skill";
include 'header.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
	$id = base64_decode($_GET['id']);
	$encoded_id = base64_encode($id);

	// Sanitize the decoded 'id' to prevent SQL injection
	$id = mysqli_real_escape_string($con, $id);

	// Fetch skill details from the database
	$skill_data_from_db = $con->query("SELECT * FROM skills WHERE id='$id'");

	if ($skill_data_from_db->num_rows > 0) {
		$skill_data = $skill_data_from_db->fetch_assoc();
	} else {
		$_SESSION['error'] = "Skill not found.";
		// header("Location: skills.php");
		echo "<script>window.location.href='skill_update.php?id=$encoded_id</script>";
		exit;
	}
} else {
	$_SESSION['error'] = "No skill ID provided.";
	// header("Location: skills.php");
	echo "<script>window.location.href='skill_update.php?id=$encoded_id'</script>";
	exit;
}

$titleError = $descriptionError = $imageError = "";
$titleE = $descriptionE = $imageE = "";

if (isset($_POST['submit'])) {
	$skill_title = $_POST['title'];
	$description = $_POST['description'];
	$image = $_FILES['image']['name'];

	// Validation
	if (empty($skill_title)) {
		$titleError = "Required Field";
		$titleE = 'red';
		echo "<script>window.location.href='skill_update.php?id=$encoded_id#title';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $skill_title)) {
			$titleError = "Title should contain only letters and numbers";
			$titleE = 'red';
			echo "<script>window.location.href='skill_update.php?id=$encoded_id#title';</script>";
		}
	}

	if (empty($description)) {
		$descriptionError = "Required Field";
		$descriptionE = 'red';
		echo "<script>window.location.href='skill_update.php?id=$encoded_id#description';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $description)) {
			$descriptionError = "Description should contain only letters and numbers";
			$descriptionE = 'red';
			echo "<script>window.location.href='skill_update.php?id=$encoded_id#description';</script>";
		}
	}

	if (!empty($_FILES['image']['name'])) {
		if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/skill/' . $image)) {
			$target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/skill/' . $image;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
				$imageError = "Please Upload a JPG, JPEG, or PNG File";
				$imageE = 'red';
				echo "<script>window.location.href='skill_update.php?id=$encoded_id#image';</script>";
			} else if ($_FILES['image']['size'] > 2000000) {
				$imageError = "Your photo exceeds the size limit of 2MB";
				$imageE = 'red';
				echo "<script>window.location.href='skill_update.php?id=$encoded_id#image';</script>";
			}
		}
	} else {
		$image = $skill_data['image']; // Use the current image if no new image is uploaded
	}

	if (empty($imageError) && empty($titleError) && empty($descriptionError)) {
		$skills_update = $con->query("UPDATE skills SET image='$image', title='$skill_title', description='$description' WHERE id='$id'");
		if ($skills_update) {
			echo "<script>window.location.href='skills.php'</script>";
			$_SESSION['status'] = "Skill Updated Successfully!";
			echo "<script>window.location.href='skills.php'</script>";
			exit;
			// header("Location: skills.php");
			// exit;
		} else {
			$_SESSION['error'] = "Failed to update skill";
		}
	} else {
		$_SESSION['error'] = "Check the inputs!";
	}
}
?>

<div class="col">
	<!-- data delete message alert  -->
	<?php if (isset($_SESSION['error'])) { ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong><?= $_SESSION['error'] ?></strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }
	unset($_SESSION['error']);
	?>
	<!-- alert end -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6 m-auto">
					<div class="card-box">
						<form action="<?= $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Current Image</label><br>
								<img src="../Images/skill/<?php echo $skill_data['image'] ?>" alt="" width="100px"><br>
							</div>
							<div class="form-group">
								<label for="image" id="image">Upload New Image</label>
								<br><span class="text-danger"><?= $imageError ?></span>
								<input type="file" class="form-control-file <?= $imageE ?>" name="image" id="image">
							</div>
							<div class="form-group">
								<label for="title" id="title">Title</label>
								<br><span class="text-danger"><?= $titleError ?></span>
								<input type="text" class="form-control <?= $titleE ?>" name="title" value="<?= isset($skill_title) ? $skill_title : $skill_data['title'] ?>">
							</div>
							<div class="form-group">
								<label for="description" id="description">Short Description</label>
								<br><span class="text-danger"><?= $descriptionError ?></span>
								<input type="text" class="form-control <?= $descriptionE ?>" name="description" value="<?= isset($description) ?  $description : htmlspecialchars($skill_data['description']); ?>">
							</div>
							<div class="form-group">
								<input class="btn btn-block btn-primary" type="submit" value="Update" name="submit">
								<a class="btn btn-block btn-danger" href="skills.php">Go Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</div> <!-- content -->
</div><!-- col -->

<?php include 'footer.php'; ?>