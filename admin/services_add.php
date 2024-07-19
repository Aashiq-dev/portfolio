<?php
include '../include/config.php';
session_start();
$title = "Add Service";
include 'header.php';

$iconError = $titleError = $descriptionError = '';
$iconE = $titleE = $descriptionE = '';

if (isset($_POST['submit'])) {
    $service_title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_FILES['icon']['name'];

    if (empty($service_title)) {
        $titleError = 'Required Field';
        $titleE = 'red';
        echo "<script>window.location.href='services_add.php#title';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $service_title)) {
            $titleError = "Title should contain only letters and numbers";
            $titleE = 'red';
            echo "<script>window.location.href='services_add.php#title';</script>";
        }
    }

    if (empty($description)) {
        $descriptionError = 'Required Field';
        $descriptionE = 'red';
        echo "<script>window.location.href='services_add.php#description';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $description)) {
            $descriptionError = "Description should contain only letters and numbers";
            $descriptionE = 'red';
            echo "<script>window.location.href='services_add.php#description';</script>";
        }
    }

    if (empty($icon)) {
        $iconError = 'Required Field';
        $iconE = 'red';
    } else if (move_uploaded_file($_FILES['icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/service/' . $icon)) {
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/service' . $icon;
        $iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
            $iconError = "Please upload photo having extension .jpg/ .jpeg/ .png";
            $iconE = 'red';
            echo "<script>window.location.href='services_add.php#icon';</script>";
        } else if ($_FILES['icon']['size'] > 2000000) {
            $iconError = "Your photo exceed the size limit of 2MB";
            $iconE = 'red';
            echo "<script>window.location.href='services_add.php#icon';</script>";
        }
    }

    if (empty($iconError) && empty($titleError) && empty($descriptionError)) {
        $service_insert = $con->query("INSERT INTO services(icon,title,description) VALUES('$icon','$service_title','$description')");
        if ($service_insert) {
            $_SESSION['status'] = "Service added Successfully!";
            echo "<script>window.location.href='services.php'</script>";
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="icon" id="icon">Icon</label>
                                <br><span class="text-danger"><?= $iconError ?></span>
                                <input type="file" class="form-control-file <?= $iconE ?>" name="icon">
                            </div>
                            <div class="form-group">
                                <label for="title" id="title">Title</label>
                                <br><span class="text-danger"><?= $titleError ?></span>
                                <input type="text" class="form-control <?= $titleE ?>" value="<?php if (!empty($service_title)) {
                                                                                                    echo $service_title;
                                                                                                } ?>" name="title" placeholder="Service Name">
                            </div>
                            <div class="form-group">
                                <label id="description">Description</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <textarea class="form-control <?= $descriptionE ?>" rows="3" name="description" placeholder="Briefly Describe about your service"><?php if (!empty($description)) {
                                                                                                                                                                        echo $description;
                                                                                                                                                                    } ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-success" type="submit" value="Add" name="submit">
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