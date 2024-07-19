<?php
include '../include/config.php';
session_start();
$title = "Update Education";
include 'header.php';

$id = base64_decode($_GET['id']);
$encoded_id = base64_encode($id);
$education_data_from_db = $con->query("SELECT * FROM education WHERE id='$id'");
$education_data = $education_data_from_db->fetch_assoc();

$yearError = $titleError = $descriptionError = '';
$yearE = $titleE = $descriptionE = '';

if (isset($_POST['submit'])) {
	$year = $_POST['year'];
	$education_title = $_POST['title'];
	$description = $_POST['description'];
	$color = $_POST['color'];

	if (empty($year)) {
		$yearError = "Required Field";
		$yearE = 'red';
		echo "<script>window.location.href='education_update.php?id=$encoded_id#year';</script>";
	} else {
		if (!preg_match("/^[0-9 ]+$/", $year)) {
			$yearError = "(" . $year . ") cannot be a year";
			$yearE = 'red';
			echo "<script>window.location.href='education_update.php?id=$encoded_id#year';</script>";
		}
	}

	if (empty($education_title)) {
		$titleError = "Required Field";
		$titleE = 'red';
		echo "<script>window.location.href='education_update.php?id=$encoded_id#title';</script>";
	} else {
		if (!preg_match("/^[a-zA-Z0-9 ]+$/", $education_title)) {
			$titleError = "Title should contain only letters and numbers";
			$titleE = 'red';
			echo "<script>window.location.href='education_update.php?id=$encoded_id#title';</script>";
		}
	}

	if (empty($description)) {
		$descriptionError = "Required Filed";
		$descriptionE = 'red';
		echo "<script>window.location.href='education_update.php?id=$encoded_id#description';</script>";
	}

	if (($color == 0)) {
		$color = $education_data['color']; // if user select no color no color updates happen
	}

	if (empty($yearError) && empty($titleError) && empty($descriptionError) && empty($colorError)) {
		$education_update = $con->query("UPDATE education SET year='$year',title='$education_title',description='$description',color='$color' WHERE id='$id'");
		if ($education_update) {
			$_SESSION['status'] = "Degree updated Successfully!";
			echo "<script>window.location.href='education.php';</script>";
			exit;
		}
	} else {
		$_SESSION['error'] = "Please check the inputs";
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
						<form method="post">
							<div class="form-group">
								<label for="year" id="year">Year</label>
								<br><span class="text-danger"><?= $yearError ?></span>
								<input type="text" class="form-control <?= $yearE ?>" name="year" value="<?= isset($year) ? $year : $education_data['year'] ?>">
							</div>
							<div class="form-group">
								<label for="title" id="title">Title</label>
								<br><span class="text-danger"><?= $titleError ?></span>
								<input type="text" class="form-control <?= $titleE ?>" name="title" value="<?= isset($education_title) ? $education_title : $education_data['title'] ?>">
							</div>
							<div class="form-group">
								<label for="description" id="description">Description</label>
								<br><span class="text-danger"><?= $descriptionError ?></span>
								<input type="text" class="form-control <?= $descriptionE ?>" name="description" value="<?= isset($description) ? $description : $education_data['description'] ?>">
							</div>
							<div class="form-group">
								<label for="color" id="color">Color</label>
								<select name="color" id="" class="form-control">
									<option value="0">Select Color</option>
									<option value="41516C" style="background-color: #41516C; color:white;">Dark Gray</option>
									<option value="FBCA3E" style="background-color: #FBCA3E; color:black;">Yellow</option>
									<option value="E24A68" style="background-color: #E24A68; color:white;">Pink</option>
									<option value="1B5F8C" style="background-color: #1B5F8C; color:white;">Navy Blue</option>
								</select>
							</div>
							<div class="form-group">
								<input class="btn btn-block btn-primary" type="submit" value="Update" name="submit">
								<a class="btn btn-block btn-danger" href="education.php">Go Back</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</div> <!-- content -->
</div><!-- col -->

<?php include 'footer.php'; ?>