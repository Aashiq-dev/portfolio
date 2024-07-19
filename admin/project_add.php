<?php
include '../include/config.php';
session_start();
$title = "Add project";
include 'header.php';
$pic_upload = 0;

$imageError = $nameError = $categoryError = $descriptionError = $linkError = $iconError = '';
$imageE = $nameE = $categoryE = $descriptionE = $linkE = $iconE = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $layerTitle = $_POST['category'];
    $projectLink = $_POST['projectLink'];
    $image = $_FILES['image']['name'];

    if (empty($image)) {
        $imageError = 'Please choose an image';
        $imageE = 'red';
    } else if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_main/' . $image)) {
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_main/' . $image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $imageError = "Please upload a photo with the extension .jpg, .jpeg, or .png";
            $imageE = 'red';
            echo "<script>window.location.href='project_add.php#image';</script>";
        } else if ($_FILES['image']['size'] > 2000000) {
            $imageError = "Your photo exceeds the size limit of 2MB";
            $imageE = 'red';
            echo "<script>window.location.href='project_add.php#image';</script>";
        }
    }

    if (empty($name)) {
        $nameError = 'Required Field';
        $nameE = 'red';
        echo "<script>window.location.href='project_add.php#name';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $name)) {
            $nameError = "Name should contain only letters and numbers";
            $nameE = 'red';
            echo "<script>window.location.href='project_add.php#name';</script>";
        }
    }

    if (empty($layerTitle)) {
        $categoryError = 'Required Field';
        $categoryE = 'red';
        echo "<script>window.location.href='project_add.php#category';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $layerTitle)) {
            $categoryError = "Category should contain only letters and numbers";
            $categoryE = 'red';
            echo "<script>window.location.href='project_add.php#category';</script>";
        }
    }

    if (empty($description)) {
        $descriptionError = 'Required Field';
        $descriptionE = 'red';
        echo "<script>window.location.href='project_add.php#description';</script>";
    }

    if (!empty($projectLink)) {
        if (preg_match($projectLink, FILTER_VALIDATE_URL) == false) {
            $linkError = 'Ivalid URL';
            $linkE = 'red';
            echo "<script>window.location.href='project_add.php#link';</script>";
        }
    }

    $icons = [];
    for ($i = 1; $i <= 4; $i++) {
        if (!empty($_FILES["icon$i"]['name'])) {
            $iconName = $_FILES["icon$i"]['name'];
            if (move_uploaded_file($_FILES["icon$i"]['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_icons/' . $iconName)) {
                $target_file = $_SERVER['DOCUMENT_ROOT'] . '/Portfolio/Images/project/project_icons/' . $iconName;
                $iconFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($iconFileType != "jpg" && $iconFileType != "jpeg" && $iconFileType != "png") {
                    $iconError = "Please upload an icon with the extension .jpg, .jpeg, or .png";
                    $iconE = 'red';
                    echo "<script>window.location.href='project_add.php#icon';</script>";
                } else if ($_FILES["icon$i"]['size'] > 2000000) {
                    $iconError = "Your icon exceeds the size limit of 2MB";
                    $iconE = 'red';
                    echo "<script>window.location.href='project_add.php#icon';</script>";
                } else {
                    $icons[] = $iconName;
                }
            } else {
                $_SESSION['error'] = "Failed to upload icon $i";
            }
        }
    }

    if (empty($imageError) && empty($nameError) && empty($categoryError) && empty($descriptionError) && empty($linkError) && empty($iconError)) {
        // Project Insert
        $project_insert = $con->query("INSERT INTO project (projectName, image, layerTitle, layerDescription, projectLink) VALUES ('$name', '$image', '$layerTitle', '$description', '$projectLink')");
        if ($project_insert) {
            for ($i = 0; $i < count($icons); $i++) {
                $projecticon_insert = $con->query("INSERT INTO projecticon (project, icon) VALUES ('$name', '$icons[$i]')");
            }
            $_SESSION['status'] = "Project added successfully!";
            echo "<script>window.location.href='projects.php';</script>";
            exit;
        } else {
            $_SESSION['error'] = "Failed to insert project data into the database";
        }
    } else {
        $_SESSION['error'] = 'Please check your inputs';
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
                                <label for="image" id="image">Image</label>
                                <br><span class="text-danger"><?= $imageError ?></span>
                                <input type="file" class="form-control-file <?= $imageE ?>" name="image">
                            </div>
                            <div class="form-group">
                                <label for="name" id="name">Project Name</label>
                                <br><span class="text-danger"><?= $nameError ?></span>
                                <input type="text" class="form-control <?= $nameE ?>" value="<?php if (!empty($name)) {
                                                                                                    echo $name;
                                                                                                } ?>" name="name" placeholder="Name of your Project">
                            </div>
                            <div class="form-group">
                                <label for="category" id="category">Project Category</label>
                                <br><span class="text-danger"><?= $categoryError ?></span>
                                <input type="text" class="form-control <?= $categoryE ?>" value="<?php if (!empty($layerTitle)) {
                                                                                                        echo $layerTitle;
                                                                                                    } ?>" name="category" placeholder="Ex: Web Application / Desktop Application">
                            </div>
                            <div class="form-group">
                                <label for="description" id="description">Short Description</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <input type="text" class="form-control <?= $descriptionE ?>" value="<?php if (!empty($description)) {
                                                                                                        echo $description;
                                                                                                    } ?>" name="description" placeholder="Ex: An E-commerce site for ABC Mobileshop">
                            </div>
                            <div class="form-group">
                                <label for="project-link" id="link">Project Link</label>
                                <br><span class="text-danger"><?= $linkError ?></span>
                                <input type="text" class="form-control <?= $linkE ?>" value="<?php if (!empty($projectLink)) {
                                                                                                    echo $projectLink;
                                                                                                } ?>" name="projectLink" placeholder="Project link to view the project">
                            </div>
                            <div class="form-group">
                                <label for="icon" id="icon">Upload Icon <mark>You can Upload Maximum 4 Icons</mark></label>
                                <div class="icon">
                                    <table class="table table-bordered text-center">
                                        <?php for ($i = 1; $i <= 4; $i++) { ?>
                                            <tr>

                                                <td>
                                                    <span class="text-danger"><?= $iconError ?></span>
                                                    <input type="file" class="form-control-file <?= $iconE ?>" name="icon<?= $i ?>">
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-success" type="submit" value="Add" name="submit">
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