<?php include "include/config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Carousel</title>
    <link rel="stylesheet" href="course.css">
</head>

<body>
    <section id="courses">
        <div class="courses-container">
            <h2 class="heading">Certificates and <span>Courses</span></h2>
            <div class="courses">
                <?php
                $certificate = "SELECT * FROM `certificate`";
                $certificate_result = mysqli_query($con, $certificate);
                if ($certificate_result->num_rows > 0) {
                    while ($row = $certificate_result->fetch_assoc()) {
                ?>
                        <div class="carousel-item <?php if ($row['id'] == 1) {
                                                        echo "active";
                                                    } ?>">
                            <div class="courses-box">
                                <div class="carousel-img">
                                    <img src="Images/course/<?php echo $row['icon'] ?>" alt="" width="50px">
                                </div>
                                <div class="carousel-caption">
                                    <h3><?php echo $row['title'] ?></h3>
                                    <p><?php echo $row['description1'] ?><br><br><?php echo $row['description2'] ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <button class="carousel-control-prev" type="button">
                    <span class="carousel-control-prev-icon" aria-hidden="true">&#9664;</span>
                    <span class="visually-hidden"></span>
                </button>
                <button class="carousel-control-next" type="button">
                    <span class="carousel-control-next-icon" aria-hidden="true">&#9654;</span>
                    <span class="visually-hidden"></span>
                </button>
            </div>
        </div>
    </section>

    <script src="course.js"></script>
</body>

</html>