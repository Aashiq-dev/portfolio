<?php
include '../include/config.php';
session_start();
$title = "Update Service";
include 'header.php';
$icon_upload = 0;

$id = base64_decode($_GET['id']);
$encoded_id = base64_encode($id);
$service_data_from_db = $con->query("SELECT *FROM services WHERE id=$id");
$service_data = $service_data_from_db->fetch_assoc();

$iconError = $titleError = $descriptionError = '';
$iconE = $titleE = $descriptionE = '';

if (isset($_POST['submit'])) {
	$service_title = $_POST['title'];
	$description = $_POST['description'];
	$icon = $_FILES['icon']['name'];

	if (empty($service_title)) {
		$titleError = 'Required Field';
		$titleE = 'red';
		echo "<script>window.location.href='service_update.php?id=$encoded_id#title';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $service_title)) {
			$titleError = "Title should contain only letters and numbers";
			$titleE = 'red';
			echo "<script>window.location.href='service_update.php?id=$encoded_id#title';</script>";
		}
	}

	if (empty($description)) {
		$descriptionError = 'Required Field';
		$descriptionE = 'red';
		echo "<script>window.location.href='service_update.php?id=$encoded_id#description';</script>";
	}

	if (!empty($icon)) {
		move_uploaded_file($_FILES['icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/' . $icon);
		$target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/' . $icon;
		$iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
			$iconError = 'Please upload icon having extension .jpg/ .jpeg/ .png';
			$iconE = 'red';
			echo "<script>window.location.href='service_update.php?id=$encoded_id#icon';</script>";
		} else if ($_FILES['icon']['size'] > 2000000) {
			$iconError = "Your icon exceed the size limit of 2MB";
			$iconE = 'red';
			echo "<script>window.location.href='service_update.php?id=$encoded_id#icon';</script>";
		}
	} else {
		$icon = $service_data['icon'];
	}

	if (empty($titleError) && empty($descriptionError)) {
		$service_update = $con->query("UPDATE services SET icon='$icon',title='$service_title',description='$description' WHERE id='$id'");
		$_SESSION['status'] = "Service Updated Successfully!";
		echo "<script>window.location.href='services.php';</script>";
		exit;
	} else {
		$_SESSION['error'] = "Please check your inputs";
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
	<!-- aleart end -->
	<div class="content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-6 m-auto">
					<div class="card-box">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Curent Icon</label><br>
								<img src="../Images/service/<?php echo $service_data['icon'] ?>" alt="" width="100px"><br>
								<i class="<?php echo $service_data['icon'] ?>"></i>
							</div>
							<div class="form-group">
								<label for="icon" id="icon">Upload New Icon</label>
								<br><span class="text-danger"><?= $iconError ?></span>
								<input type="file" class="form-control-file <?= $iconE ?>" name="icon">
							</div>
							<div class="form-group">
								<label for="title" id="title">Title</label>
								<br><span class="text-danger"><?= $titleError ?></span>
								<input type="text" class="form-control <?= $titleE ?>" name="title" value="<?= isset($service_title) ? $service_title : $service_data['title'] ?>">
							</div>
							<div class="form-group">
								<label for="description" id="description">Short Description</label>
								<br><span class="text-danger"><?= $descriptionError ?></span>
								<textarea rows="3" name="description" class="form-control <?= $descriptionE ?>" id=""><?= isset($description) ? $description : $service_data['description'] ?></textarea>
							</div>
							<div class="form-group">
								<input class="btn btn-block btn-primary" type="submit" value="Update" name="submit">
								<a class="btn btn-block btn-danger" href="services.php">Go Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</div> <!-- content -->
</div><!-- col -->

<?php include 'footer.php'; ?>