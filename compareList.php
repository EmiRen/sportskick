<doctype html!>
<html>
	<head>
		<title>Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Play-Offs Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<meta charset utf="8"> 
        <link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">
        
		<!--fonts-->
		<!--link css-->
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<!--bootstrap-->
			<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!--coustom css-->
			<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<!--default-js-->
			<script src="js/jquery-2.1.4.min.js"></script>
		<!--bootstrap-js-->
			<script src="js/bootstrap.min.js"></script>
        <!-- totop button   -->
        <script src="//code.jquery.com/jquery.min.js"></script>
        
        <!--  suggestion    -->
        <link rel="stylesheet" href="css/jquery-ui.css"> <!-- CSS Link -->
        <script src="js/jquery-ui.js"></script>
        <style>
            #compare {
                
            }
            #sectors{
                margin-top: 7vh;
                margin-left: 12vw;
                
                margin-bottom: 5vh;
            }
            #sectors_1{
                margin-top : 16vh;
                margin-bottom: auto;
                }
            #name{
                margin-top: 15vh;
            }
            h5{
                margin-left: 12vw;
            }
            hr{
                background-color: aquamarine;
            }
        </style>
    </head>
    <body>
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
                          
<!--                          <li><a href="contact.html">Contact</a></li>-->
                         <li><a href="compare.php">Compare</a></li>
                                    <li><a href="eventsList.php">Sports Events</a></li> 
                        <li><a href="about.html">About Us</a></li>
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
        <?php 
        $places = $_POST['compare'];
        
        $place_1 = $places[0];
        $place_2 = $places[1];
        
            include('database_connection.php');
        ?>
        <div class="container-fluid">
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <center><h2 id="name"><?php echo $place_1; ?></h2></center>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="compare">
            <center><h2 id="name"><?php echo $place_2; ?></h2></center>
            </div>
            </div>
<!--            Facility Comparison-->
            <div class = "row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php 
            
            $query = "Select * from places where Name LIKE '%". $place_1 ."%'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
         ?>
                    <h3 id = "sectors">Facilities</h3>
                    <hr/>
            <?php
         foreach($result as $row)
                      { ?>
            
                     <?php 
             echo "<h5>".$row['Type']."</h5><br/>"; ?>
              <?php
                      }
     }
            ?>
                </div>
                <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <?php 
            
            $query = "Select * from places where Name LIKE '%". $place_2 ."%'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
         ?>
                    <h3 id = "sectors_1"></h3>
                    <hr/>
            
            <?php
         foreach($result as $row)
                      { ?>
             
                     <?php 
             echo "<h5>".$row['Type']."</h5><br/>"; ?>
             <?php
                      }
     }
            ?>
                
                </div>
            </div>
            
<!--            Rating Compariosn-->
                <div class= "row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h3 id = "sectors">Ratings</h3>
                        <hr/>
            <?php 
            $query = "SELECT AVG(Rating) as Rating FROM `rating` WHERE Name LIKE '%". $place_1 ."%'";
            $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
        foreach($result as $row){
            
                if($row['Rating'] != '')
            echo "<h5>".$row['Rating']."/5</h5>";
            else{
                echo "<h5> N/A </h5>";
            }
        }
     }
            ?>
                    </div>
                    <div class = "col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h3 id = "sectors_1"></h3>
                        <hr/>
            <?php 
            $query = "SELECT AVG(Rating) as Rating FROM `rating` WHERE Name LIKE '%". $place_2 ."%'";
            $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
        foreach($result as $row){
            if($row['Rating'] != '')
            echo "<h5>".$row['Rating']."/5</h5>";
            else{
                echo "<h5> N/A </h5>";
            }
        }
     }
            ?>
                    </div>
                
                    
            
            
            </div>
            
<!--            Parking Comparison-->
            <div class = "row">
                    <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                        <h3 id = "sectors">Public Parking</h3>
                        <hr/>
                         <?php 
                        $query = "Select * from places where Name LIKE '%". $place_1 ."%'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
         foreach($result as $row){
             $name = $row['Name'];
             $current_lat = $row['Latitude'];
             $current_lon = $row['Longitude'];
             
         }
         $distance = 13;
//         echo $placeLat."<br/>";
//         echo $placeLng;
         $query = "SELECT COUNT(*) as Count FROM parking  WHERE  ( 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )) <=".$distance;
        $query .= " ORDER BY 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )"; 
             $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
//         echo $query;
         if($total_row > 0)
         {
             foreach($result as $row){
                 if($row['Count']!=0)
                 echo "<h5>".$row['Count']."</h5>";
                 else{
                     echo "<h5>N/A</h5>";
                 }
             }
         }
         
     }
                
                 ?>
                </div>
             <div class="col-xs-4 col-sm-6 col-md-6 col-lg-6">
                <h3 id = "sectors_1"></h3>
                 <hr/>
                 
                 <?php 
                 
                 $query = "Select * from places where Name LIKE '%". $place_2 ."%'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
         foreach($result as $row){
             $name = $row['Name'];
             $current_lat = $row['Latitude'];
             $current_lon = $row['Longitude'];
             
         }
         $distance = 2;
//         echo $placeLat."<br/>";
//         echo $placeLng;
         $query = "SELECT COUNT(*) as Count FROM parking  WHERE  ( 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )) <=".$distance;
        $query .= " ORDER BY 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )"; 
             $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
            $total_row = $statement->rowCount();
//         echo $query;
         if($total_row > 0)
         {
             foreach($result as $row){
                 if($row['Count']!=0)
                 echo "<h5>".$row['Count']."</h5>";
                 else{
                     echo "<h5>N/A</h5>";
                 }
             }
         }
         
     }
                
                
                 ?>
                 <br/><br/><br/>
                </div>
                
                
                    </div>
            </div>
          <div class="footer">
            <div class="container">
                <div class="col-md-4 ft logo">
                    <div class="logo fot">
                        <h1><a href="index.php">Sports Kick</a></h1>
                    </div>
                </div>
                <div class="col-md-4 ft cpyrt">
                    <p>Copyright &copy; 2018 Fantastic Quattro <br />All rights reserved</p>
                </div>
                <div class="col-md-4 ft soc">
                    <ul class="social">
                        <li><a href="https://www.instagram.com/fantasticquattro/" class="inst"></a></li>

                        <li><a href="https://www.facebook.com/Sports-Kick-233559260654719/?modal=admin_todo_tour" class="face"></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </body>
    </html>