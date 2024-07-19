<?php include 'include/config.php';
session_start();
$sql = "SELECT * FROM `users` WHERE `users`.`id` = 1";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['name'] ?> | <?php echo $data['title1'] ?></title>
    <link rel="stylesheet" href="style.css">
    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- header design -->
    <header class="header sticky">
    <div class="hamburger-menu" id="hamburger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="index.php" class="logo">Portfolio.</a>
        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#skills">Skills</a>
            <a href="#education">Education</a>
            <a href="#services">Services</a>
            <a href="#project">Projects</a>
            <a href="#courses">Certificates</a>
            <a href="#contact">Contact</a>
        </nav>
        <div class="bx bx-moon" id="darkMode-icon"></div>
    </header>

    <!-- home section design -->
    <section class="home" id="home">
        <div class="home-content">
            <h3>Hello, I am</h3>
            <h1><?php echo $data['name']; ?></h1>
            <h2>Web Developer</h2><br><br>
            <p><?php echo $data['intro1']; ?></p><br>
            <p><?php echo $data['intro2']; ?></p><br>
            <p><?php echo $data['intro3']; ?></p>
            <div class="social-media">
                <a href="<?php echo $data['facebook']; ?>" target="_blank" title="facebook.com/Aashiq.web"><i class='bx bxl-facebook'></i></a>
                <a href="<?php echo $data['github']; ?>" target="_blank" title="github.com/Aashiq76"><i class='bx bxl-github'></i></a>
                <a href="<?php echo $data['instagram']; ?>" target="_blank" title="instagram.com/Aashiq.web"><i class='bx bxl-instagram-alt'></i></a>
                <a href="<?php echo $data['linkedin']; ?>" target="_blank" title="linkedin.com/in/aashiq76"><i class='bx bxl-linkedin'></i></a>
                <a href="https://wa.me/<?php echo $data['whatsapp']; ?>" target="_blank" title="077 4028 771"><i class='bx bxl-whatsapp'></i></a>
                <a href="mailto:<?php echo $data['gmail']; ?>" target="_blank" title="Aashiq76asq@gmail.com"><i class='bx bxl-gmail'></i></a>
            </div>
            <a href="cv/<?php echo $data['cv']; ?>" class="btn" download="<?php echo $data['cv']; ?>">Download CV</a>
        </div>
        <div class="profession-container">
            <div class="profession-box">
                <div class="profession" style="--i:0;">
                    <i class='bx bx-code-alt'></i>
                    <h3><?php echo $data['title1']; ?></h3>
                </div>
                <div class="profession" style="--i:2;">
                    <i class='bx bx-palette'></i>
                    <h3><?php echo $data['title2']; ?></h3>
                </div>
                <div class="circle"></div>
            </div>
            <div class="overlay"></div>
        </div>
        <div class="home-img">
            <img src="Images/main_image/Aashiq.png" alt="">
            <div class="img-mobile">
                <img src="images/main_image/mobile.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- home section end -->

    <!-- Skill section design -->
    <section class="skills" id="skills">
        <h2 class="heading">Skills</h2>
        <div class="skills-container">
            <?php
            $skills = "SELECT * FROM `skills`";
            $skills_result = mysqli_query($con, $skills);
            if ($skills_result->num_rows > 0) {
                while ($row = $skills_result->fetch_assoc()) {
            ?>
                    <div class="skills-box">
                        <img src="Images/skill/<?php echo $row['image']; ?>" alt="">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <!-- skills section end -->

    <!-- Education Section -->
    <section id="education">
        <div class="education">
            <h2 class="heading">Education</h2>
            <ul>
                <?php
                $education = "SELECT * FROM `education`";
                $education_result = mysqli_query($con, $education);
                if ($education_result->num_rows > 0) {
                    while ($row = $education_result->fetch_assoc()) {
                ?>
                        <li style="--accent-color:#<?php echo $row['color'] ?>">
                            <div class="date"><?php echo $row['year'] ?></div>
                            <div class="title"><?php echo $row['title'] ?></div>
                            <div class="descr"><?php echo $row['description'] ?></div>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </section>
    <!-- education section end -->

    <!-- services section design -->
    <div>
        <section class="services" id="services">
            <h2 class="heading">My <span>Services</span></h2>
            <div class="services-container">
                <?php
                $services = "SELECT * FROM `services`";
                $services_result = mysqli_query($con, $services);
                if ($services_result->num_rows > 0) {
                    while ($row = $services_result->fetch_assoc()) {
                ?>
                        <div class="services-box">
                            <img src="Images/service/<?php echo $row['icon'] ?>" alt="" width="50px">
                            <h3><?php echo $row['title'] ?></h3>
                            <p><?php echo $row['description'] ?></p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </div>
    <!-- services end -->

    <!-- project section design -->
    <section class="project" id="project">
        <h2 class="heading">Latest <span>Project</span></h2>
        <div class="project-container">
            <?php
            $project = "SELECT * FROM `project`";
            $project_result = mysqli_query($con, $project);
            if ($project_result->num_rows > 0) {
                while ($row = $project_result->fetch_assoc()) {
            ?>
                    <div class="project-box">
                        <div class="background">
                            <div class="border">
                                <h1 class="project-title"><?php echo $row['projectName'] ?></h1>
                                <img class="project-image" src="Images/project/project_main/<?php echo $row['image'] ?>" alt="">
                                <div class="image">
                                    <?php
                                    $category = $row['projectName'];
                                    $projecticon = "SELECT * FROM `projecticon` WHERE `project` = '$category'";
                                    $projecticon_data = mysqli_query($con, $projecticon);
                                    if ($projecticon_data->num_rows > 0) {
                                        while ($iconrow = $projecticon_data->fetch_assoc()) {
                                    ?>
                                            <img src="Images/project/project_icons/<?php echo $iconrow['icon'] ?>">
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="project-layer">
                            <h4><?php echo $row['layerTitle'] ?></h4>
                            <p><?php echo $row['layerDescription'] ?></p>
                            <a class="project-link" href="<?php echo $row['projectLink'] ?>" target="_blank"><i class='bx bx-link-external'></i></a><br><br><br>
                            <a href="<?php echo $row['projectDetailsLink'] ?>" target="_blank"><button class="project-button">About ThisProject</button></a>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
    <!-- project section end -->
    <!-- courses section design -->
    <?php include "course.php" ?>
    <!-- <section>
        <div class="courses-container">
            <h2 class="heading">Certificates and <span>Courses</span></h2>
            <div class="courses">
                <?php
                $certificate = "SELECT * FROM `certificate`";
                $certificate_result = mysqli_query($con, $certificate);
                if ($certificate_result->num_rows > 0) {
                    while ($row = $certificate_result->fetch_assoc()) {
                ?>
                        <div class="courses-box">
                            <img src="Images/<?php echo $row['icon'] ?>" alt="" width="50px">
                            <h3><?php echo $row['title'] ?></h3>
                            <p><?php echo $row['description1'] ?><br><br><?php echo $row['description2'] ?></p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section> -->
    <!-- courses end -->

    <!-- contact section design -->
    <section class="contact" id="contact">
        <h2 class="heading">Contact <span>Me!</span></h2>
        <div class="social-media">
            <a href="<?php echo $data['facebook']; ?>" target="_blank" title="facebook.com/Aashiq.web"><i class='bx bxl-facebook'></i></a>
            <a href="<?php echo $data['github']; ?>" target="_blank" title="github.com/Aashiq76"><i class='bx bxl-github'></i></a>
            <a href="<?php echo $data['instagram']; ?>" target="_blank" title="instagram.com/Aashiq.web"><i class='bx bxl-instagram-alt'></i></a>
            <a href="<?php echo $data['linkedin']; ?>" target="_blank" title="linkedin.com/in/aashiq76"><i class='bx bxl-linkedin'></i></a>
            <a href="https://wa.me/<?php echo $data['whatsapp']; ?>" target="_blank" title="077 4028 771"><i class='bx bxl-whatsapp'></i></a>
            <a href="mailto:<?php echo $data['gmail']; ?>" target="_blank" title="Aashiq76asq@gmail.com"><i class='bx bxl-gmail'></i></a>
        </div>

        <!-- data add message alert  -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['error'] ?></strong>
            </div>
        <?php }
        unset($_SESSION['error']);
        ?>
        <!-- aleart end -->

        <form method="post" action="send_email.php">
            <div class="error-box">
                <div class="error-box-left">
                    <?php if (!empty($_SESSION['name_error'])) {
                        echo '<span class="error">' . $_SESSION['name_error'] . '</span><br>';
                    } ?>
                </div>
                <div class="error-box-right">
                    <?php if (!empty($_SESSION['email_error'])) {
                        echo '<span class="error">' . $_SESSION['email_error'] . '</span>';
                    } ?>
                </div>
            </div>
            <div class="input-box">
                <input name="name" class="<?php if (!empty($_SESSION['name_error'])) {
                                                echo 'red';
                                            } ?>" type="text" placeholder="Full Name" value="<?php if (!empty($_SESSION['name'])) {
                                                                                                    echo $_SESSION['name'];
                                                                                                } ?>">

                <input name="email" class="<?php if (!empty($_SESSION['email_error'])) {
                                                echo 'red';
                                            } ?>" type="email" placeholder="Email Address" value="<?php if (!empty($_SESSION['email'])) {
                                                                                                        echo $_SESSION['email'];
                                                                                                    } ?>">
            </div>
            <div class="error-box">
                <div class="error-box-left">
                    <?php if (!empty($_SESSION['number_error'])) {
                        echo '<span class="error">' . $_SESSION['number_error'] . '</span><br>';
                    } ?>
                </div>
                <di v class="error-box-right">
                    <?php if (!empty($_SESSION['subject_error'])) {
                        echo '<span class="error">' . $_SESSION['subject_error'] . '</span>';
                    } ?>
            </div>
            </div>
            <!-- inputs -->
            <div class="input-box">
                <input name="mobile" class="<?php if (!empty($_SESSION['number_error'])) {
                                                echo 'red';
                                            } ?>" type="tel" placeholder="Mobile Number" value="<?php if (!empty($_SESSION['number'])) {
                                                                                                    echo $_SESSION['number'];
                                                                                                } ?>">
                <input name="subject" class="<?php if (!empty($_SESSION['subject_error'])) {
                                                    echo 'red';
                                                } ?>" type="text" placeholder="Email Subject" value="<?php if (!empty($_SESSION['subject'])) {
                                                                                                            echo $_SESSION['subject'];
                                                                                                        } ?>">
            </div>
            <div class="error-box">
                <?php if (!empty($_SESSION['message_error'])) {
                    echo '<span class="error">' . $_SESSION['message_error'] . '</span>';
                } ?>
            </div>
            <textarea name="message" class="<?php if (!empty($_SESSION['message_error'])) {
                                                echo 'red';
                                            } ?>" cols="20" rows="10" placeholder="Your Message"><?php if (!empty($_SESSION['message'])) {
                                                                                                        echo $_SESSION['message'];
                                                                                                    } ?></textarea>
            <input name="send" type="submit" value="Send Message" class="btn">
        </form>
        <!-- Clear session errors after displaying them -->
        <?php
        unset($_SESSION['name_error']);
        unset($_SESSION['email_error']);
        unset($_SESSION['number_error']);
        unset($_SESSION['subject_error']);
        unset($_SESSION['message_error']);

        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['number']);
        unset($_SESSION['subject']);
        unset($_SESSION['message']);
        ?>
    </section>
    <!-- contact end -->

    <!-- footer design -->
    <footer class="footer">
        <div class="footer-text">
            <center>
                <p>Copyright &copy; 2024 by | All Rights Reserved By <?php echo $data['name'] ?></p>
            </center>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class='bx bx-up-arrow-alt'></i></a>
        </div>
    </footer>
</body>

<script src="script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="sweetalert.js"></script>
<?php
if (isset($_SESSION['status'])) {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status'] ?>",
            //text: "You clicked the button!",
            icon: "success",
            button: "OK. Done",
        });
    </script>
<?php
    unset($_SESSION['status']);
}
?>

</html>