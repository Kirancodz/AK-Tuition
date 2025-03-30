<?php
    include "dbconnect.php";

    $id = $_GET['id'] ?? '';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $subject_code = $_POST['subject'] ?? '';
        
        if ($subject_code != 'choose') {
            // Check if the student is already enrolled in this subject
            $stmt = $db->prepare("SELECT * FROM learn WHERE stu_id = ? AND subject_code = ?");
            $stmt->bind_param("is", $id, $subject_code);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                // Insert the new subject registration
                $stmt = $db->prepare("INSERT INTO learn (stu_id, subject_code) VALUES (?, ?)");
                $stmt->bind_param("is", $id, $subject_code);
                if ($stmt->execute()) {
                    echo "Subject registered successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "You are already registered for this subject.";
            }
        } else {
            echo "Please select a subject.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page-Student-Subject-Registration</title>
	<meta charset="utf-8" />
    <title>Page-Student-Subject-Registration</title>
    <meta name="keywords" content="HTML5,CSS3,Template" />
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/superslides.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout-responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/color_scheme/orange.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="assets/plugins/modernizr.min.js"></script>
</head>
<body background="assets/images/coverpage4.jpg">
<header id="topNav">
        <div class="container">
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="logo scrollTo" href="#wrapper">
                <img src="assets/images/logo.png"/>
            </a>
            <div class="navbar-collapse nav-main-collapse collapse pull-right">
                <nav class="nav-main mega-menu">
                    <ul class="nav nav-pills nav-main scroll-menu" id="topMain">
                        <li><a href="page-student-details.php?id=<?php echo $id; ?>">Student Details</a></li>
                        <li class="active"><a href="page-student-subject-reg.php?id=<?php echo $id; ?>">Subject Registration</a></li>
                        <li><a href="page-student-timetable.php?id=<?php echo $id; ?>">Timetable</a></li>
                        <li><a href="index.html">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
	<span id="header_shadow"></span>
    <div id="wrapper">
        <section id="" class="padding60">
            <h2 align="center"><b>Subject Registration</b></h2>
            <div class="container">
                <div align="center">
                    <form name="subject-registration-form" action="page-student-subject-reg.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                        <select name="subject">
                            <option value="choose">Choose Subject</option>
                            <?php
                            $sql = "SELECT * FROM subject";
                            $result = mysqli_query($db, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . htmlspecialchars($row['subject_code']) . '">' . htmlspecialchars($row['subject_name']) . '</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>
                <br>
                <div align="center">
                    <table border="2" id="tablestyle">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Subject Price (RM)</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $sql = "SELECT S.stu_id, P.subject_code, P.subject_name, P.subject_price
                                FROM student S
                                JOIN learn L ON S.stu_id = L.stu_id
                                JOIN subject P ON L.subject_code = P.subject_code
                                WHERE S.stu_id = ?";
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        $count = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($row['subject_code']) . '</td>
                                    <td>' . htmlspecialchars($row['subject_name']) . '</td>
                                    <td>' . htmlspecialchars($row['subject_price']) . '</td>
                                    <td><a href="student-delete-subject.php?id=' . urlencode($id) . '&code=' . urlencode($row['subject_code']) . '">Drop</a></td>
                                  </tr>';
                            $count += $row['subject_price'];
                        }
                        $stmt->close();
                        ?>
                        <tr>
                            <th>Total Price (RM)</th>
                            <td colspan="3" style="text-align: left;"><?php echo htmlspecialchars($count); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <footer>
	<div class="footer-bar">
            <div class="container">
                <span class="copyright">Copyright &copy; Pusat Tuisyen Anjung Firasat. All Rights Reserved.</span>
                <a class="toTop" href="#topNav">BACK TO TOP <i class="fa fa-arrow-circle-up"></i></a>
            </div>
        </div>
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="column col-md-6">
                        CONTACT <strong>US</strong><br><br>
                        <address class="font-opesans">
                            <ul>
                                <li class="footer-sprite address">
                                    No.3, Jalan Seri Duyong 1/2,<br>
                                    Ayer Molek 75460,<br>
                                    Melaka, Malaysia.<br>
                                </li>
                                <li class="footer-sprite phone">
                                    Tel : 06-9681107<br>
                                    Fax : 06-8961107<br>
                                </li>
                                <li class="footer-sprite email">
                                    <a href="mailto:hadriizz@gmail.com">hadriizz@gmail.com</a>
                                </li>
                            </ul>
                        </address>
                    </div>
                    <div class="column col-md-6">
                        <ul>
                            <p class="text-justify">ABOUT <strong>US</strong><br/><br/>Tuisyen Anjung Firasat is an established tuition center since the year 2006...</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </footer>
	<script type="text/javascript" src="assets/plugins/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.cookie.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.appear.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.isotope.js"></script>
    <script type="text/javascript" src="assets/plugins/masonry.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/plugins/stellar/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="assets/plugins/knob/js/jquery.knob.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.backstretch.min.js"></script>
    <script type="text/javascript" src="assets/plugins/superslides/dist/jquery.superslides.min.js"></script>
    <script type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script><!-- STYLESWITCHER - REMOVE ON PRODUCTION/DEVELOPMENT -->
    <script type="text/javascript" src="assets/plugins/mediaelement/build/mediaelement-and-player.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/slider_revolution.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery.nav.min.js"></script>
    <script type="text/javascript">
        jQuery('#topMain').onePageNav({
            currentClass: 'active',
            changeHash: false,
            scrollSpeed: 750,
            scrollThreshold: 0.5,
            filter: ':not(.external)',
            easing: 'easeInOutExpo'
        });
    </script>
</body>
</html>
