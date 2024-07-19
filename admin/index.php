<?php
include '../include/config.php';
session_start();
$title = "Home";
include 'header.php';
$query = "SELECT * FROM `users`";
$run = mysqli_query($con, $query);
$users_data = mysqli_fetch_array($run);

$nameError = $profession1Error = $profession2Error = $intro1Error = $intro2Error = $intro3Error = $facebookError = $githubError = $instagramError = $linkedinError = $whatsappError = $gmailError = $cvError = "";
$nameE = $profession1E = $profession2E = $intro1E = $intro2E = $intro3E = $facebookE = $githubE = $instagramE = $linkedinE = $whatsappE = $gmailE = "";

if (isset($_POST['update-home'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $title1 = mysqli_real_escape_string($con, $_POST['title1']);
  $title2 = mysqli_real_escape_string($con, $_POST['title2']);
  $intro1 = mysqli_real_escape_string($con, $_POST['intro1']);
  $intro2 = mysqli_real_escape_string($con, $_POST['intro2']);
  $intro3 = mysqli_real_escape_string($con, $_POST['intro3']);
  $facebook = mysqli_real_escape_string($con, $_POST['facebook']);
  $github = mysqli_real_escape_string($con, $_POST['github']);
  $instagram = mysqli_real_escape_string($con, $_POST['instagram']);
  $linkedin = mysqli_real_escape_string($con, $_POST['linkedin']);
  $whatsapp = mysqli_real_escape_string($con, $_POST['whatsapp']);
  $gmail = mysqli_real_escape_string($con, $_POST['gmail']);
  $cv = $_FILES['cv']['name'];

  // Validation
  if (empty($name)) {
    $nameError = "Required Field";
    $nameE = 'red';
    echo "<script>window.location.href='index.php#name'</script>";
  } else {
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
      $nameError = "Name should contain only letters and spaces";
      $nameE = 'red';
      echo "<script>window.location.href='index.php#name'</script>";
    }
  }

  if (empty($title1)) {
    $profession1Error = "Required Field";
    $profession1E = 'red';
    echo "<script>window.location.href='index.php#profession1'</script>";
  } else {
    if (!preg_match("/^[a-zA-Z ]+$/", $title1)) {
      $profession1Error = "Profession should contain only letters and spaces";
      $profession1E = 'red';
      echo "<script>window.location.href='index.php#profession1'</script>";
    }
  }

  if (empty($title2)) {
    $profession2Error = "Required Field";
    $profession2E = 'red';
    echo "<script>window.location.href='index.php#profession2'</script>";
  } else {
    if (!preg_match("/^[a-zA-Z ]+$/", $title2)) {
      $profession2Error = "Profession should contain only letters and spaces";
      $profession2E = 'red';
      echo "<script>window.location.href='index.php#profession2'</script>";
    }
  }

  if (empty($intro1)) {
    $intro1Error = "Required Field";
    $intro1E = 'red';
    echo "<script>window.location.href='index.php#intro1'</script>";
  }

  if (empty($intro2)) {
    $intro2Error = "Required Field";
    $intro2E = 'red';
    echo "<script>window.location.href='index.php#intro2'</script>";
  }

  if (empty($intro3)) {
    $intro3Error = "Required Field";
    $intro3E = 'red';
    echo "<script>window.location.href='index.php#intro3'</script>";
  }

  if (empty($facebook)) {
    $facebookError = "Required Field";
    $facebookE = 'red';
    echo "<script>window.location.href='index.php#facebook'</script>";
  } else if (filter_var($facebook, FILTER_VALIDATE_URL) == false) {
    $facebookError = "Please enter valid facebook URL";
    $facebookE = 'red';
    echo "<script>window.location.href='index.php#facebook'</script>";
  }

  if (empty($github)) {
    $githubError = "Required Field";
    $githubE = 'red';
    echo "<script>window.location.href='index.php#github'</script>";
  } else if (filter_var($github, FILTER_VALIDATE_URL) == false) {
    $githubError = "Please enter valid github URL";
    $githubE = 'red';
    echo "<script>window.location.href='index.php#github'</script>";
  }

  if (empty($instagram)) {
    $instagramError = "Required Field";
    $instagramE = 'red';
    echo "<script>window.location.href='index.php#instagram'</script>";
  } else if (filter_var($instagram, FILTER_VALIDATE_URL) == false) {
    $instagramError = "Please enter valid instagram URL";
    $instagramE = 'red';
    echo "<script>window.location.href='index.php#instagram'</script>";
  }

  if (empty($linkedin)) {
    $linkedinError = "Required Field";
    $linkedinE = 'red';
    echo "<script>window.location.href='index.php#linkedin'</script>";
  } else if (filter_var($linkedin, FILTER_VALIDATE_URL) == false) {
    $linkedinError = "Please enter valid likedin URL";
    $linkedinE = 'red';
    echo "<script>window.location.href='index.php#linkedin'</script>";
  }

  if (empty($whatsapp)) {
    $whatsappError = "Required Field";
    $whatsappE = 'red';
    echo "<script>window.location.href='index.php#whastapp'</script>";
  } else {
    if (!preg_match("/^([0-9]{10})$/", $whatsapp)) {
      $whatsappError = "Invalid whatsapp number";
      $whatsappE = 'red';
      echo "<script>window.location.href='index.php#whatsapp'</script>";
    }
  }

  if (empty($gmail)) {
    $gmailError = "Required Field";
    $gmailE = 'red';
    echo "<script>window.location.href='index.php#gmail'</script>";
  } else if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    $gmailError = "The email address '$gmail' is invalid!";
    $gmailE = 'red';
    echo "<script>window.location.href='index.php#gmail'</script>";
  }

  if (!empty($cv)) {
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $cvFileType = strtolower(pathinfo($cv, PATHINFO_EXTENSION));

    if ($cvFileType != "pdf") {
      $cvError = "Please upload a CV in PDF format.";
      echo "<script>window.location.href='index.php#cv'</script>";
    } else if ($_FILES['cv']['size'] > 5000000) {
      $cvError = "Your CV exceeds the size limit of 5MB!";
      echo "<script>window.location.href='index.php#cv'</script>";
    } else {
      $cv_target = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/cv/' . basename($cv);
      if (!move_uploaded_file($cv_tmp, $cv_target)) {
        $cvError = "Error uploading file!";
        echo "<script>window.location.href='index.php#cv'</script>";
      }
    }
  } else {
    $cv = $users_data['cv'];
  }

  if (empty($nameError) && empty($profession1Error) && empty($profession2Error) && empty($intro1Error) && empty($intro2Error) && empty($intro3Error) && empty($facebookError) && empty($githubError) && empty($instagramError) && empty($linkedinError) && empty($whatsappError) && empty($gmailError) && empty($cvError)) {
    $query = "UPDATE users SET 
      name='$name', 
      title1='$title1', 
      title2='$title2', 
      intro1='$intro1', 
      intro2='$intro2', 
      intro3='$intro3', 
      facebook='$facebook', 
      github='$github', 
      instagram='$instagram', 
      linkedin='$linkedin', 
      whatsapp='$whatsapp', 
      gmail='$gmail'";

    if (!empty($cv)) {
      $query .= ", cv='$cv'";
    }

    $run = mysqli_query($con, $query);
    if ($run) {
      $_SESSION['status'] = "Details Updated Successfully!";
      // echo "<script>window.location.href='home.php';</script>";
      // exit();
    } else {
      $_SESSION['error'] = "Error updating details! " . mysqli_error($con);
    }
  } else {
    $_SESSION['error'] = "Please check your inputs!";
  }
}
?>

<div class="col">
  <!-- Error Alert -->
  <?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?= $_SESSION['error'] ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php unset($_SESSION['error']);
  } ?>

  <section class="content">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <div class="card-body">
        <div class="form-group">
          <label for="name" id="name">Name</label>
          <br><span class="text-danger"><?= $nameError ?></span>
          <input type="text" class="form-control <?= $nameE ?>" value="<?= isset($name) ? $name : $users_data['name'] ?>" name="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="profession1" id="profession1">Profession - 1</label>
          <br><span class="text-danger"><?= $profession1Error ?></span>
          <input type="text" class="form-control <?= $profession1E ?>" value="<?= isset($title1) ? $title1 : $users_data['title1'] ?>" name="title1" placeholder="Enter your Profession">
        </div>
        <div class="form-group">
          <label for="profession1" id="profession2">Profession - 2</label>
          <br><span class="text-danger"><?= $profession2Error ?></span>
          <input type="text" class="form-control <?= $profession2E ?>" value="<?= isset($title2) ? $title2 : $users_data['title2'] ?>" name="title2" placeholder="Enter your Profession">
        </div>
        <div class="form-group">
          <label for="intro1" id="intro1">Intro 1st Paragraph <mark>( Keep the word limit to 30 for better output )</mark></label>
          <br><span class="text-danger"><?= $intro1Error ?></span>
          <textarea cols="100" class="form-control <?= $intro1E ?>" name="intro1" placeholder="Enter your intro"><?= isset($intro1) ? $intro1 : $users_data['intro1'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="intro2" id="intro2">Intro 2nd Paragraph <mark>( Keep the word limit to 30 for better output )</mark></label>
          <br><span class="text-danger"><?= $intro2Error ?></span>
          <textarea cols="100" class="form-control <?= $intro2E ?>" name="intro2" placeholder="Enter your intro"><?= isset($intro2) ? $intro2 : $users_data['intro2'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="intro3" id="intro3">Intro 3rd Paragraph <mark>( Keep the word limit to 30 for better output )</mark></label>
          <br><span class="text-danger"><?= $intro3Error ?></span>
          <textarea cols="100" class="form-control <?= $intro3E ?>" name="intro3" placeholder="Enter your intro"><?= isset($intro3) ? $intro3 : $users_data['intro3'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="facebook" id="facebook">Facebook <mark>( Your profile link )</mark></label>
          <br><span class="text-danger"><?= $facebookError ?></span>
          <input type="text" class="form-control <?= $facebookE ?>" value="<?= isset($facebook) ? $facebook : $users_data['facebook'] ?>" name="facebook" placeholder="Enter your facebook profile link">
        </div>
        <div class="form-group">
          <label for="github" id="github">Github <mark>( Your profile link )</mark></label>
          <br><span class="text-danger"><?= $githubError ?></span>
          <input type="text" class="form-control <?= $githubE ?>" value="<?= isset($github) ? $github : $users_data['github'] ?>" name="github" placeholder="Enter your github link">
        </div>
        <div class="form-group">
          <label for="instagram" id="instagram">Instagram <mark>( Your profile link )</mark></label>
          <br><span class="text-danger"><?= $instagramError ?></span>
          <input type="text" class="form-control <?= $instagramE ?>" value="<?= isset($instagram) ? $instagram : $users_data['instagram'] ?>" name="instagram" placeholder="Enter your instagram link">
        </div>
        <div class="form-group">
          <label for="linkedin" id="linkedin">Linkedin <mark>( Your profile link )</mark></label>
          <br><span class="text-danger"><?= $linkedinError ?></span>
          <input type="text" class="form-control <?= $linkedinE ?>" value="<?= isset($linkedin) ? $linkedin : $users_data['linkedin'] ?>" name="linkedin" placeholder="Enter your linkedin link">
        </div>
        <!-- data update message alert  -->
        <div class="form-group">
          <label for="whatsapp" id="whatsapp">Whatsapp <mark>( Example : 0771231234)</mark></label>
          <br><span class="text-danger"><?= $whatsappError ?></span>
          <input type="text" class="form-control <?= $whatsappE ?>" value="<?= isset($whatsapp) ? $whatsapp : $users_data['whatsapp']; ?>" name="whatsapp" placeholder="Enter your whatsapp Number">
        </div>
        <div class="form-group">
          <label for="gmail" id="gmail">Gmail</label>
          <br><span class="text-danger"><?= $gmailError ?></span>
          <input type="text" class="form-control <?= $gmailE ?>" value="<?= isset($gmail) ? $gmail : $users_data['gmail'] ?>" name="gmail" placeholder="Enter your gmail link">
        </div>
        <div class="form-group">
          <label for="cv" id="cv">Upload your CV <mark>( PDF )</mark></label>
          <br><span class="text-danger"><?= $cvError ?></span>
          <input type="file" class="form-control-file" name="cv">
        </div>
      </div> <!-- Card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary" name="update-home">Save Changes</button>
        <a href="../index.php" class="btn btn-success" target="_blank">Go to Portfolio</a>
      </div>
    </form>
  </section>
</div><!-- col -->

<?php include 'footer.php'; ?>