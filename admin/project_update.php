<?php
include '../include/config.php';
session_start();
$title = "Update Project";
include 'header.php';
$image_upload = 0;

$id = base64_decode($_GET['id']);
$encoded_id = base64_encode($id);
$project_data_from_db = $con->query("SELECT * FROM project WHERE id=$id");
$project_data = $project_data_from_db->fetch_assoc();

$projectnameForIcon = $project_data['projectName'];
$projecticon_query = "SELECT * FROM projecticon WHERE project = '$projectnameForIcon'";
$projecticon_data = mysqli_query($con, $projecticon_query);

$imageError = $nameError = $categoryError = $descriptionError = $linkError = '';
$imageE = $nameE = $categoryE = $descriptionE = $linkE =  '';
$iconError = ['icon0Error', 'icon1Error', 'icon2Error', 'icon3Error'];
$iconE = ['icon0E', 'icon1E', 'icon2E', 'icon3E'];
$icon0Error = $icon1Error = $icon2Error = $icon3Error = "";
$icon0E = $icon1E = $icon2E = $icon3E = "";


if (isset($_POST['submit'])) {
	$projectName = $_POST['projectName'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$projectLink = $_POST['projectLink'];
	$image = $_FILES['image']['name'];

	if (empty($projectName)) {
		$nameError = 'Required Field';
		$nameE = 'red';
		echo "<script>window.location.href='project_update.php?id=$encoded_id#name';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $projectName)) {
			$nameError = "Name should contain only letters and numbers";
			$nameE = 'red';
			echo "<script>window.location.href='project_update.php?id=$encoded_id#name';</script>";
		}
	}

	if (empty($description)) {
		$descriptionError = 'Required Field';
		$descriptionE = 'red';
		echo "<script>window.location.href='project_update.php?id=$encoded_id#description';</script>";
	}

	if (empty($category)) {
		$categoryError = 'Required Field';
		$categoryE = 'red';
		echo "<script>window.location.href='project_update.php?id=$encoded_id#category';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $category)) {
			$categoryError = "Category should contain only letters and numbers";
			$categoryE = 'red';
			echo "<script>window.location.href='project_update.php#category';</script>";
		}
	}

	if (!empty($projectLink)) {
		if (filter_var($projectLink, FILTER_VALIDATE_URL) == false) {
			$linkError = 'Please make sure URL is correctly formatted';
			$linkE = 'red';
			echo "<script>window.location.href='project_update.php?id=$encoded_id#link';</script>";
		}
	}

	if (empty($image)) {
		$image = $project_data['image'];
	} else if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_main/' . $image)) {
		$target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_main/' . $image;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
			$imageError = "Please upload a photo with the extension .jpg, .jpeg, or .png";
			$imageE = 'red';
			echo "<script>window.location.href='project_update.php?id=$encoded_id#image';</script>";
		} else if ($_FILES['image']['size'] > 2000000) {
			$imageError = "Your photo exceeds the size limit of 2MB";
			$imageE = 'red';
			echo "<script>window.location.href='project_update.php?id=$encoded_id#image';</script>";
		}
	}

	// Handle icons upload
	$icons = [];
	$existingIcons = [];
	while ($iconRow = $projecticon_data->fetch_assoc()) {
		$existingIcons[] = $iconRow;
	}

	for ($i = 0; $i < 4; $i++) {
		$iconName = !empty($_FILES["icon$i"]['name']) ? $_FILES["icon$i"]['name'] : null;
		if ($iconName) {
			move_uploaded_file($_FILES["icon$i"]['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_icons/' . $iconName);
			$target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_icons/' . $iconName;
			$iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
				${"icon{$i}Error"} = "Please upload an icon with extension .jpg, .jpeg, or .png";
				${"icon{$i}E"} = 'red';
				echo "<script>window.location.href='project_update.php?id=$encoded_id#icon';</script>";
			} else if ($_FILES["icon$i"]['size'] > 2000000) {
				${"icon{$i}Error"} = "Your icon exceeds the size limit of 2MB";
				${"icon{$i}E"} = 'red';
				echo "<script>window.location.href='project_update.php?id=$encoded_id#icon';</script>";
			} else {
				$icons[$i] = $iconName;
			}
		} else {
			$icons[$i] = $existingIcons[$i]['icon'] ?? '';
		}
	}

	if (empty($imageError) && empty($nameError) && empty($categoryError) && empty($descriptionError) && empty($linkError) && empty($icon0Error) && empty($icon1Error) && empty($icon2Error) && empty($icon3Error)) {
		$project_update = $con->query("UPDATE project SET image='$image', projectName='$projectName', layerTitle='$category', layerDescription='$description', projectLink='$projectLink' WHERE id='$id'");
		// Update project icons
		foreach ($icons as $i => $iconName) {
			if (!empty($iconName)) {
				if (isset($existingIcons[$i])) {
					$icon_id = $existingIcons[$i]['id'];
					$projecticon_update = $con->query("UPDATE projecticon SET icon='$iconName' WHERE id='$icon_id'");
				} else {
					$con->query("INSERT INTO projecticon (project, icon) VALUES ('$projectName', '$iconName')");
				}
			}
		}
		$_SESSION['status'] = "Project Updated Successfully!";
		echo "<script>window.location.href='projects.php';</script>";
		exit;
	} else {
		$_SESSION['error'] = 'Please check your inputs';
	}
}
?>

<div class="col">
	<!-- Start Page content -->
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
				<div class="col-7 m-auto">
					<div class="card-box">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Current Image</label><br>
								<img src="../Images/project/project_main/<?= $project_data['image'] ?>" alt="" width="400px">
							</div>
							<div class="form-group">
								<label for="image" id="image">Upload New Image</label>
								<br><span class="text-danger"><?= $imageError ?></span>
								<input type="file" class="form-control-file <?= $imageE ?>" name="image">
							</div>
							<div class="form-group">
								<label for="projectName" id="name">Project Name</label>
								<br><span class="text-danger"><?= $nameError ?></span>
								<input type="text" class="form-control <?= $nameE ?>" name="projectName" value="<?= isset($projectName) ? $projectName : $project_data['projectName'] ?>">
							</div>
							<div class="form-group">
								<label for="category" id="category">Project Category</label>
								<br><span class="text-danger"><?= $categoryError ?></span>
								<input type="text" class="form-control <?= $categoryE ?>" name="category" value="<?= isset($category) ? $category : $project_data['layerTitle'] ?>">
							</div>
							<div class="form-group">
								<label for="description">Short Description</label>
								<br><span class="text-danger" id="description"><?= $descriptionError ?></span>
								<input type="text" class="form-control <?= $descriptionE ?>" name="description" value="<?= isset($description) ? $description : $project_data['layerDescription'] ?>">
							</div>
							<div class="form-group">
								<label for="projectLink" id="link">Project Link</label>
								<br><span class="text-danger"><?= $linkError ?></span>
								<input type="text" class="form-control <?= $linkE ?>" name="projectLink" value="<?= isset($projectLink) ? $projectLink : $project_data['projectLink'] ?>">
							</div>
							<div class="form-group">
								<label for="icon" id="icon">Upload Icons <mark>You can Upload Maximum 4 Icons</mark></label>
								<div class="icon">
									<table class="table table-bordered text-center">
										<tr>
											<?php
											$pIcon = [];
											if ($projecticon_data->num_rows > 0) {
												while ($iconrow = $projecticon_data->fetch_assoc()) {
													$pIcon[] = $iconrow;
												}
											}
											foreach ($pIcon as $ppIcon) { ?>
												<td><img src="../Images/project/project_icons/<?= $ppIcon['icon'] ?>" alt="" width="50px"></td>
											<?php } ?>
										</tr>
										<tr>
											<?php foreach ($pIcon as $ppIcon) { ?>
												<td><a class="btn btn-sm btn-danger" href="project_icon_delete.php?id=<?= base64_encode($ppIcon['id']) ?>&id2=<?= base64_encode($id) ?>">Delete</a></td>
											<?php } ?>
										</tr>
										<tr>
											<?php
											for ($i = 0; $i < 4; $i++) { ?>
												<td>
													<span class="text-danger"><?= ${$iconError[$i]} ?></span>
													<input type="file" class="form-control-file <?= ${$iconE[$i]} ?>" name="icon<?= $i ?>">
												</td>
											<?php } ?>
										</tr>
									</table>
								</div>
							</div>
							<div class="form-group">
								<input class="btn btn-block btn-primary" type="submit" value="Update" name="submit">
								<a class="btn btn-block btn-danger" href="projects.php">Go Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</div> <!-- content -->
</div><!-- col -->

<?php include 'footer.php'; ?>