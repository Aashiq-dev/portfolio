<?php
include '../include/config.php';
session_start();
$title = "Add Certificate";
include 'header.php';
$pic_upload = 0;

$titleError = $iconError = $descriptionError = '';
$titleE = $iconE = $descriptionE = '';

if (isset($_POST['submit'])) {
    $certificate_title = $_POST['title'];
    $description1 = $_POST['description1'];
    $description2 = $_POST['description2'];
    $icon = $_FILES['icon']['name'];

    if (empty($certificate_title)) {
        $titleError = 'Required Field';
        $titleE = 'red';
        echo "<script>window.location.href='certificate_add.php#title';</script>";
    }

    if (empty($description1) && empty($description2)) {
        $descriptionError = 'Fill atleast a Description';
        $descriptionE = 'red';
        echo "<script>window.location.href='certificate_add.php#description1';</script>";
    }

    if (empty($icon)) {
        $iconError = 'Required Field';
        $iconE = 'red';
    } else if (move_uploaded_file($_FILES['icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/course/' . $icon)) {
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/course/' . $icon;
        $iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
            $iconError = "Please upload photo having extension .jpg/ .jpeg/ .png";
            $iconE = 'red';
        } else if ($_FILES['icon']['size'] > 2000000) {
            $iconError = "Your photo exceed the size limit of 2MB";
            $iconE = 'red';
        }
    }


    if (empty($titleError) && empty($descriptionError) && empty($iconError)) {
        $certificate_insert = $con->query("INSERT INTO certificate(icon,title,description1,description2) VALUES('$icon','$certificate_title','$description1','$description2')");
        if ($certificate_insert) {
            $_SESSION['status'] = "Certificate Added Successfully!";
            echo "<script>window.location.href='certificates.php';</script>";
            exit;
        }
    } else {
        $_SESSION['error'] = "Please check your inputs";
    }
}
?>

<div class="col">

    <?php if (isset($_SESSION['error'])) { ?><!--alert  -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['error'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }
    unset($_SESSION['error']);
    ?><!-- aleart end -->

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
                                <input type="text" class="form-control <?= $titleE ?>" value="<?php if (!empty($certificate_title)) {
                                                                                                    echo $certificate_title;
                                                                                                } ?>" name="title" placeholder="Certificate Title Here">
                            </div>
                            <div class="form-group">
                                <label id="description1">Description - 1</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <textarea class="form-control <?= $descriptionE ?>" rows="3" name="description1" placeholder="Briefly Describe about your service"><?php if (!empty($description1)) {
                                                                                                                                                                        echo $description1;
                                                                                                                                                                    } ?></textarea>
                            </div>
                            <div class="form-group">
                                <label id="description2">Description - 2</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <textarea class="form-control <?= $descriptionE ?>" rows="3" name="description2" placeholder="Briefly Describe about your service"><?php if (!empty($description2)) {
                                                                                                                                                                        echo $description2;
                                                                                                                                                                    } ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-success" type="submit" value="Add" name="submit">
                                <a class="btn btn-block btn-danger" href="certificates.php">Go Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div><!-- col -->

<?php include 'footer.php'; ?>