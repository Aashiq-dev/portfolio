<?php
include '../include/config.php';
session_start();
$title = "Update Certificate";
include 'header.php';
$icon_upload = 0;

$id = base64_decode($_GET['id']);
$encoded_id = base64_encode($id);
$certificate_data_from_db = $con->query("SELECT * FROM certificate WHERE id='$id'");
$certificate_data = $certificate_data_from_db->fetch_assoc();

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
        echo "<script>window.location.href='certificate_update.php?id=$encoded_id#title';</script>";
    }

    if (empty($description1) && empty($description2)) {
        $descriptionError = 'Fill atleast a Description';
        $descriptionE = 'red';
        echo "<script>window.location.href='certificate_update.php?id=$encoded_id#description1';</script>";
    }

    if (empty($icon)) {
        $icon = $certificate_data['icon'];
    } else if (move_uploaded_file($_FILES['icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/course/' . $icon)) {
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/course/' . $icon;
        $iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
            $iconError = "Please upload photo having extension .jpg/ .jpeg/ .png";
            $iconE = 'red';
            echo "<script>window.location.href='certificate_update.php?id=$encoded_id#icon';</script>";
        } else if ($_FILES['icon']['size'] > 2000000) {
            $iconError = "Your photo exceed the size limit of 2MB";
            $iconE = 'red';
            echo "<script>window.location.href='certificate_update.php?id=$encoded_id#icon';</script>";
        }
    }


    if (empty($titleError) && empty($descriptionError) && empty($iconError)) {
        $certificate_update = $con->query("UPDATE certificate SET icon='$icon', title='$certificate_title', description1='$description1', description2='$description2' WHERE id='$id'");
        if ($certificate_update) {
            $_SESSION['status'] = "Certificate Updated Successfully!";
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
                                <label>Curent Icon</label><br>
                                <img src="../Images/course/<?php echo $certificate_data['icon'] ?>" alt="" width="100px"><br>
                            </div>
                            <div class="form-group">
                                <label for="icon" id="icon">Upload New Icon</label>
                                <br><span class="text-danger"><?= $iconError ?></span>
                                <input type="file" class="form-control-file <?= $iconE ?>" name="icon">
                            </div>
                            <div class="form-group">
                                <label for="title" id="title">Title</label>
                                <br><span class="text-danger"><?= $titleError ?></span>
                                <input type="text" class="form-control <?= $titleE ?>" name="title" value="<?= isset($certificate_title) ? $certificate_title : $certificate_data['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="description1" id="description1">Description - 1</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <textarea rows="4" name="description1" class="form-control <?= $descriptionE ?>" id=""><?= isset($description1) ? $description1 : $certificate_data['description1'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description2" id="description2">Description - 2</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <textarea rows="4" name="description2" class="form-control <?= $descriptionE ?>" id=""><?= isset($description2) ? $description2 : $certificate_data['description2'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-primary" type="submit" value="Update" name="submit">
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