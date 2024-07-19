<?php
include '../include/config.php';
session_start();
$title = "Add Skill";
include 'header.php';

$titleError = $descriptionError = $imageError = "";
$titleE = $descriptionE = $imageE = "";

if (isset($_POST['submit'])) {
    $skill_title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    //Validation
    if (empty($skill_title)) {
        $titleError = "Required Field";
        $titleE = 'red';
        echo "<script>window.location.href='skills_add.php#title';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $skill_title)) {
            $titleError = "Title should contain only letters and numbers";
            $titleE = 'red';
            echo "<script>window.location.href='skills_add.php#title';</script>";
        }
    }

    if (empty($description)) {
        $descriptionError = "Required Field";
        $descriptionE = 'red';
        echo "<script>window.location.href='skills_add.php#description';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $description)) {
            $descriptionError = "Description should contain only letters and numbers";
            $descriptionE = 'red';
            echo "<script>window.location.href='skills_add.php#description';</script>";
        }
    }
    if (empty($image)) {
        $imageError = "Please upload an image!";
        $imageE = "red";
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/skill/' . $image)) {
            $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/skill/' . $image;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                $imageError = "Please Upload a file having extension jpg/jpeg/png";
                $imageE = 'red';
                echo "<script>window.location.href='skills_add.php#image';</script>";
            } else if ($_FILES['image']['size'] > 2000000) {
                $imageError = "Please Upload a file having extension jpg/jpeg/png";
                $imageE = 'red';
                echo "<script>window.location.href='skills_add.php#image';</script>";
            }
        }
    }

    if (empty($titleError) && empty($descriptionError) && empty($imageError)) {
        $skill_insert = $con->query("INSERT INTO skills(image,title,description) VALUES('$image','$skill_title','$description')");
        if ($skill_insert) {
            $_SESSION['status'] = 'Skill added succesfully!';
            echo "<script>window.location.href='skills.php';</script>";
            exit;
        }
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
    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 m-auto">
                    <div class="card-box">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image" id="image">Image</label>
                                <br><span class="text-danger"><?= $imageError ?></span>
                                <input type="file" class="form-control-file <?= $imageE ?>" name="image">
                            </div>
                            <div class="form-group">
                                <label for="title" id="title">Title</label>
                                <br><span class="text-danger"><?= $titleError ?></span>
                                <input type="text" class="form-control <?= $titleE ?>" value="<?php if (!empty($skill_title)) {
                                                                                                    echo $skill_title;
                                                                                                } ?>" name="title" placeholder="Enter your skill here">
                            </div>
                            <div class="form-group">
                                <label for="description" id="description">Short Description</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <input type="text" class="form-control <?= $descriptionE ?>" value="<?php if (!empty($description)) {
                                                                                                        echo $description;
                                                                                                    } ?>" name="description" placeholder="Short Description">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-success" type="submit" value="Add" name="submit">
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