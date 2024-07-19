<?php
include '../include/config.php';
session_start();
$title = "Add Degree";
include 'header.php';

$yearError = $titleError = $descriptionError = $colorError = "";
$yearE = $titleE = $descriptionE = $colorE = "";

if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $degree_title = $_POST['title'];
    $description = $_POST['description'];
    $color = $_POST['color'];

    if (empty($year)) {
        $yearError = "Required Field";
        $yearE = 'red';
        echo "<script>window.location.href='education_add.php#year';</script>";
    } else {
        if (!preg_match("/^[0-9]+$/", $year)) {
            $yearError = "(" . $year . ") cannot be a valid year";
            $yearE = 'red';
            echo "<script>window.location.href='education_add.php#year';</script>";
        }
    }

    if (empty($degree_title)) {
        $titleError = "Required Field";
        $titleE = 'red';
        echo "<script>window.location.href='education_add.php#title';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $degree_title)) {
            $titleError = "Title should contain only letters and numbers";
            $titleE = 'red';
            echo "<script>window.location.href='education_add.php#title';</script>";
        }
    }

    if (empty($description)) {
        $descriptionError = "Required Filed";
        $descriptionE = 'red';
        echo "<script>window.location.href='education_add.php#description';</script>";
    } else {
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $description)) {
            $descriptionError = "Description should contain only letters and numbers";
            $descriptionE = 'red';
            echo "<script>window.location.href='education_add.php#description';</script>";
        }
    }

    if (empty($color)) {
        $colorError = "Please choose any color";
        $colorE = 'red';
        echo "<script>window.location.href='education_add.php#color';</script>";
    }

    if (empty($yearError) && empty($titleError) && empty($descriptionError) && empty($colorError)) {
        $education_insert = $con->query("INSERT INTO education(year,title,description,color) VALUES('$year','$degree_title','$description','$color')");
        if ($education_insert) {
            $_SESSION['status'] = "Degree added Successfully!";
            echo "<script>window.location.href='education.php';</script>";
            exit;
        }
    } else {
        $_SESSION['error'] = "Please check the inputs";
    }
}
?>

<div class="col"> 
    
    <?php if (isset($_SESSION['error'])) { ?><!-- data delete message alert  -->
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
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="form-group">
                                <label for="year" id="year">Year</label>
                                <br><span class="text-danger"><?= $yearError ?></span>
                                <input type="text" class="form-control <?= $yearE ?>" value="<?php if (!empty($year)) {
                                                                                                    echo $year;
                                                                                                } ?>" name="year" placeholder="Enter the year you completed the degree">
                            </div>
                            <div class="form-group">
                                <label for="title" id="title">Title</label>
                                <br><span class="text-danger"><?= $titleError ?></span>
                                <input type="text" class="form-control <?= $titleE ?>" value="<?php if (!empty($degree_title)) {
                                                                                                    echo $degree_title;
                                                                                                } ?>" name="title" placeholder="Degree Name">
                            </div>
                            <div class="form-group">
                                <label for="description" id="description">Short Description</label>
                                <br><span class="text-danger"><?= $descriptionError ?></span>
                                <input type="text" class="form-control <?= $descriptionE ?>" value="<?php if (!empty($description)) {
                                                                                                        echo $description;
                                                                                                    } ?>" name="description" placeholder="A Short Description">
                            </div>
                            <div class="form-group">
                                <label for="color" id="color">Color</label>
                                <br><span class="text-danger"><?= $colorError ?></span>
                                <select name="color" class="form-control <?= $colorE ?>">
                                    <option value="0">Choose a Color</option>
                                    <option value="41516C" style="background-color: #41516C; color:white">Navy Blue</option>
                                    <option value="FBCA3E" style="background-color: #FBCA3E;">Yellow</option>
                                    <option value="E24A68" style="background-color: #E24A68; color:white">Pink</option>
                                    <option value="1B5F8C" style="background-color: #1B5F8C; color:white">Blue</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-success" type="submit" value="Add" name="submit">
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