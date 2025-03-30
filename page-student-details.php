<?php
    // Include the database connection file
    include 'dbconnect.php';

    // Get the student ID from the URL
    $id = $_GET['id'];

    // Check if the ID is set and is a valid value
    if (!isset($id) || empty($id)) {
        die("Invalid Student ID.");
    }

    // Prepare the SQL query to fetch student details
    $sql = "SELECT * FROM student WHERE stu_id = ?";
    
    // Initialize a prepared statement
    if ($stmt = mysqli_prepare($db, $sql)) {
        
        // Bind the parameter to the statement
        mysqli_stmt_bind_param($stmt, "s", $id);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result set
        $result = mysqli_stmt_get_result($stmt);
        
        // Fetch the data if it exists
        if ($row = mysqli_fetch_assoc($result)) {
            $stu_name = $row['stu_name'];
            $stu_id = $row['stu_id'];
            $stu_ic = $row['stu_ic'];
            $stu_sex = $row['stu_sex'];
            $stu_category = $row['stu_category'];
            $stu_email = $row['stu_email'];
            $stu_address = $row['stu_address'];
            $stu_phone_num = $row['stu_phone_num'];
            $stu_parent_phone_num = $row['stu_parent_phone_num'];
        } else {
            die("Student not found.");
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        die("Failed to prepare SQL query.");
    }

    // Close the database connection
    mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page-Student-Details</title>
    <meta name="keywords" content="HTML5,CSS3,Template" />
    <meta name="description" content="" />
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/superslides.css" rel="stylesheet" type="text/css" />

    <!-- REVOLUTION SLIDER -->
    <link href="assets/plugins/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />

    <!-- THEME CSS -->
    <link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout-responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/color_scheme/orange.css" rel="stylesheet" type="text/css" />

    <!-- Morenizr -->
    <script type="text/javascript" src="assets/plugins/modernizr.min.js"></script>
</head>
<body background="assets/images/coverpage4.jpg">
    <!-- TOP NAV -->
    <header id="topNav">
        <div class="container">

            <!-- Mobile Menu Button -->
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Logo text or image -->
            <a class="logo scrollTo" href="#wrapper">
                <img src="assets/images/logo.png"/>
            </a>

            <!-- Top Nav -->
            <div class="navbar-collapse nav-main-collapse collapse pull-right">
                <nav class="nav-main mega-menu">
                    <ul class="nav nav-pills nav-main scroll-menu" id="topMain">
                        <li class="active"><a href="page-student-details.php?id=<?php echo $stu_id;?>">Student Details</a></li>
                        <li ><a href="page-student-subject-reg.php?id=<?php echo $stu_id;?>">Subject Registration</a></li>
                        <li><a href="page-student-timetable.php?id=<?php echo $stu_id;?>">Timetable</a></li>
                        <li><a href="index.html">Log Out</a></li>
                    </ul>
                </nav>
            </div>
            <!-- /Top Nav -->
        </div>
    </header>

    <span id="header_shadow"></span>
    <!-- /TOP NAV -->

    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- ABOUT US -->
        <section id="" class="padding60">
            <h2 align="center"><b>Student's Details</b></h2>
            <div class="container">
                <div align="center">
                    
                </div>
                <div align="center" class="container">
                    <table border="2" id="tablestyle">
                        <tr>
                            <td>Student Name</td>
                            <td><?php echo $stu_name; ?></td>
                        </tr>
                        <tr>
                            <td>Student ID</td>
                            <td><?php echo $stu_id; ?></td>
                        </tr>
                        <tr>
                            <td>Student IC</td>
                            <td><?php echo $stu_ic; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo $stu_sex; ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo $stu_category; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $stu_email; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $stu_address; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo $stu_phone_num; ?></td>
                        </tr>
                        <tr>
                            <td>Parent Phone Number</td>
                            <td><?php echo $stu_parent_phone_num; ?></td>
                        </tr>
                    </table>
                </div>
                <div align="right"><br>
                    <a href="page-student-update.php?id=<?php echo $stu_id;?>" class="btn btn-primary">Update</a>
                </div>
            </div>
        </section>
        <!-- /ABOUT US -->
    </div>
    <!-- /WRAPPER -->
    
    <!-- FOOTER -->
    <footer>
        <!-- copyright , scrollTo Top -->
        <div class="footer-bar">
            <div class="container">
                <span class="copyright">Copyright &copy; AK TUITION CENTER . All Rights Reserved.</span>
                <a class="toTop" href="#topNav">BACK TO TOP <i class="fa fa-arrow-circle-up"></i></a>
            </div>
        </div>
        <!-- copyright , scrollTo Top -->

        <!-- footer content -->
        <div class="footer-content">
            <div class="container">

                <div class="row">

                    <!-- FOOTER CONTACT INFO -->
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
                                    Tel    : 06-9681107<br>
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
                            <p class="text-justify">ABOUT <strong>US</strong><br/><br/>Tuisyen Anjung Firasat is an established tuition center since the year 2006. Now, they have one kindergarten in Kandang Duyong that called Little Caliphs Anjung Firasat.</p>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer content -->
    </footer>
    <!-- /FOOTER -->
</body>
</html>
