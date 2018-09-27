<doctype html!>
<html>
	<head>
		<title>Contact</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Play-Offs Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8">
		<!--fonts-->
		
        
		<!--fonts-->
		<!--link css-->
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<!--bootstrap-->
			<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!--coustom css-->
			<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<!--default-js-->
			<script src="js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="js/bootstrap.min.js"></script>
		<!--script-->
        <script src="js/jquery.circlechart.js"></script>
	</head>
    <body>
     <!--header-->
    <div class="header-nav">
        <section class="color ss-style-bigtriangle nav-top">
            <nav class="navbar navbar-default">
                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                        <div class="logo displ_stn">
                            <h1><a href="index.php">Sports Kick</a></h1>
                        </div>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav float-nav nav-algn_r">
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="gallery.html">Motivación</a></li>
                    </ul>
                    <div class="logo float-nav nav-algn_c">
                       <h1><a href="index.php">Sports Kick</a></h1>
                    </div>
                    <ul class="nav navbar-nav navbar-right float-nav nav-algn_l">                      
                          <li><a href="contact.html">Contact</a></li>
                          <li><a href="about.html">About</a></li>
                    </ul>
                    <div class="clearfix"></div>
                    </div><!-- /.navbar-collapse -->
                    <div class="clearfix"></div>
                  </div><!-- /.container-fluid -->
                </nav>
            </section>
            <svg id="bigTriangleColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 102" preserveAspectRatio="none">
            <path d="M0 0 L50 100 L100 0 Z" />
            </svg>
        </div>
    <!--header nav-->
        <div class="contact">
            <div class="container">
                <h3>Contact Us</h3>
        
                <?php
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                $formcontent=" From: $name \n Message: $message";
                $recipient = "296402308@qq.com";
                $subject = "Contact Form";
                $mailheader = "From: $email \r\n";
                mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
                echo "Thank You! We will reply your message soon!" . " -" . "<a href='index.php' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
                ?>

            </div>
        </div>
        
        

    </body>

</html>
