    <?php

    $Name = $_POST['Name'];
    $Type = $_POST['Type'];
    $Category = $_POST['Category'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $Address = $_POST['Address'];
    $ID = $_POST['ID'];
    $localPhoneNum = $_POST['localPhNum'];
    $internationalPhoneNum = $_POST['internationalPhNum'];
    $website = $_POST['website'];

    $jsonUrl = "https://data.melbourne.vic.gov.au/resource/dtpv-d4pf.json";
    $data = file_get_contents($jsonUrl);
    $jsonRows = json_decode($data);

    
    
    include('database_connection.php');


 

    
?>
<doctype html!>
<html>
	<head>
		<title><?php echo $Name ?></title>
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
		<!--script-->
        <script src="js/jquery.circlechart.js"></script>
        <!--    add for review    -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 450px;  
        width: 100%;  /* The width is the width of the web page */
       }
        
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        font-size: 12px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: #3e8e41;}

    </style>
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
                          
<!--                          <li><a href="contact.html">Contact</a></li>-->
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
    <!--header nav-->
    <div class="about">
        <div class="container">
            <h3><?php echo $Name ?></h3>
            <div class="about-grids">
                <div class="col-xs-6 about-grid1">
                   <br/>
                    <h4>Type: </h4>
                    <p><?php echo $Type ?></p>
                    <br/>
                    <h4>Facilities Available: </h4>
                    <p><?php 
    $query = "SELECT DISTINCT Type as Type FROM places WHERE Name = '".$Name."'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
            if($total_row > 0)
            {
                      foreach($result as $row)
                      {
                          echo $row['Type']."<br/>";
                      }
            }
                        ?></p>
                     <br/>
                    <h4>Address: </h4>
                     <p><?php echo $Address ?></p>
                    <br/>
                    <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <h4>Phone Number: </h4>
                     <p><?php echo $internationalPhoneNum; ?></p>
                    <br/>
                        </div>

                    </div>
                     <h4>Business Hours</h4>
                     <p>
                       <?php 
                        include('database_connection.php');
                         $query = "SELECT * FROM businesshours where Place_Name='".$Name."' LIMIT 7";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $total_row = $statement->rowCount();
                          if($total_row > 0)
                          {
                               foreach($result as $row)
                               {
                                   ?>
                                <p><?php echo $row['Day']; ?>:  
                                <?php echo $row['Opening - Closing']; ?></p>

                        <?php
                               }
                          }
                         else{
                             echo "N/A";
                         }
                         ?>
                    <br/>
                    

                     <h4>Website: </h4>
                    <a href='<?php echo $website; ?>' target="_blank"><?php echo $website; ?></a>
                    <br/>
                    <br />

                    <br/>
                </div>
                
                
                <div class="col-xs-6 about-grid">
                    <br/><br/>
                    <div id="map"></div>
                    <script>
                    // Initialize and add the map
                    function initMap() {
                      // The location of Uluru
                      var location = {lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?>};
                      // The map, centered at Uluru
                      var map = new google.maps.Map(
                          document.getElementById('map'), {zoom: 15, center: location});
                      // The marker, positioned at Uluru
                      var marker = new google.maps.Marker({position: location, map: map});
                        
                         marker.content = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h5><b><?php echo $Name ?></b></h5>'+
                            '</div>';
                        
                     var infoWindow = new google.maps.InfoWindow;
                        google.maps.event.addListener(marker,'click', function(){
                            infowindow.setContent(this.content);
                            infowindow.open(this.getMap(),this);
                        });             
                        
                        var image = "images/parking2.png";
                        
                          <?php 
                            include('database_connection.php');


                            // Select all the rows in the markers table
                            $query = "SELECT * FROM parking ";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();

                            // Iterate through the rows, printing XML nodes for each
                            foreach ($result as $row){
                                ?>

                        
                        
                        var marker = new google.maps.Marker({
                            position: {lat:<?php echo $row['latitude'] ?> , lng:<?php echo $row['longitude'] ?>},
                            map: map, 
                            icon: image
                        });
                        
                        var address = '<?php echo $row['Address'] ?>';
                        var name = "<?php echo $row['Name'] ?>";
                        var phone = '<?php echo $row['Phone'] ?>';
                        var Place_ID = '<?php echo $row['Place_ID'] ?>';
                        var url = '<?php echo $row['URL'] ?>';

                        marker.content = '<div id="content">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<h5><b>' + name +  '</b></h5>'+
                            '<div id="bodyContent">'+
                            '<p><b>Address : </b></p>'+
                            '<p>' + address + '</p>' + 
                            '<p><b>Contact Number:</b></p>'+
                            '<p>' + phone + '</p>' +
                            '</div>'+
                            '<p>' + '<a href="' + url + '"target="_blank">View More Details on Google Map</a></p>' +
                            '</div>';
                        
                        var infowindow = new google.maps.InfoWindow();
                        google.maps.event.addListener(marker,'click', function(){
                            infowindow.setContent(this.content);
                            infowindow.open(this.getMap(),this);
                        });             
                        <?php
                            }

                            ?>

                        
                        <?php 
                            foreach ($jsonRows as $jsonRow)
                            {
                                ?>
                        
                        if ("<?php echo $jsonRow->status ?>" == "Unoccupied"){
                            image = "images/unoccupied.png";
                            
                            }else{
                            image = "images/present.png";
                            }

                        
                        
                        var marker = new google.maps.Marker({
                            position: {lat:<?php echo $jsonRow->lat ?> , lng:<?php echo $jsonRow->lon ?>},
                            map: map, 
                            icon: image
                        });
        
                        <?php
                            }

                            ?>
                        
                        
                        
                        
                        
                        
                    }
                    </script>
                    <!--Load the API from the specified URL
                    * The async attribute allows the browser to render the page while the API loads
                    * The key parameter will contain your own API key (which is not needed for this tutorial)
                    * The callback parameter executes the initMap() function
                    -->
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7JXFzyVe-4DEE81-4sVW7JDOmuHFs7mw&callback=initMap">
                    </script>
                    
                <div>
                   <img src="images/note.png" >
                    
                </div>
                
                </div>
                
                <div class="clearfix"></div>
                

            </div>
            
            
            <div>
    

                    
                 <div class="row">
                            <div class="col-md-6">
                                 <br /><br />
                              <h3>Visited this place before? <br/>Choose a rating here!</h3>
                              
                              <br />
                              <div class="radio">
                                <label><h4><input type="radio" name="poll_option" id="poll_option" value="1 Star" />1 Star: Never choose again! Even not safe!</h4></label>
                              </div><br/>
                              <div class="radio">
                               <label><h4><input type="radio" name="poll_option" id="poll_option" value="2 Star" />2 Star: Bad experience! Not a good choice.</h4></label>
                              </div><br/>
                              <div class="radio">
                               <label><h4><input type="radio" name="poll_option" id="poll_option" value="3 Star" />3 Star: Just so so. I will try others next time.</h4></label>
                              </div><br/>
                              <div class="radio">
                               <label><h4><input type="radio" name="poll_option" id="poll_option" value="4 Star" />4 Star: Not bad for me! Quite like this place.</h4></label>
                              </div><br/>
                              <div class="radio">
                               <label><h4><input type="radio" name="poll_option" id="poll_option" value="5 Star" />5 Star: Impressive! Good sport experience!</h4></label>
                              </div>
                              <br />
                                 <button name="poll_button" id="poll_button" class="btn btn-primary" onclick="rate()">Rate Me</button>
                             
                             <br />
                            </div>
                            <div class="col-md-6">
                             <br />
                             <br />
                             <br />
                             <h3>Live Poll Result</h3>
                              <br /><br /><br />
                             <div id="poll_result">
                                <?php 
    include('database_connection.php');
                        $query = "SELECT * FROM rating where Name ='".$Name."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	
    $php_framework = array("1 Star", "2 Star", "3 Star", "4 Star", "5 Star");

$total_poll_row = $statement->rowCount();
    $output = '';
if($total_poll_row > 0)
{
	foreach($php_framework as $row)
	{
		$query = "SELECT * FROM rating WHERE Rating = '".$row."' and Name = '".$Name."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$total_row = $statement->rowCount();
		$percentage_vote = round(($total_row/$total_poll_row)*100);
		$progress_bar_class = '';
		if($percentage_vote >= 40)
		{
			$progress_bar_class = 'progress-bar-success';
		}
		else if($percentage_vote >= 25 && $percentage_vote < 40)
		{
			$progress_bar_class = 'progress-bar-info';
		}
		else if($percentage_vote >= 10 && $percentage_vote < 25)
		{
			$progress_bar_class = 'progress-bar-warning';
		}
		else
		{
			$progress_bar_class = 'progress-bar-danger';
		}

         ?>                       
		<div class="row">
			<div class="col-md-2" align="right">
				<label><?php echo $row;?></label>
			</div>
			<div class="col-md-10">
				<div class="progress">
					<div class="progress-bar <?php echo $progress_bar_class; ?>" role="progressbar" aria-valuenow="<?php echo $percentage_vote; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage_vote; ?>">
						<?php echo $percentage_vote; ?> % Voted 
					</div>
				</div>
			</div>
		</div>
		
        <?php
	}
}
else{
    ?>
                               
                                 <h4>No rating available. Be the first to rate the place.</h4>
                                 <?php
}



?></div>
                            </div>
                           </div>
            </div>
            <br/><br/><br/>
                            <a class="btn btn-default cont-btn" href="javascript:history.back()">Go Back</a>
        </div>    
    </div>        

    <!--footer-->
    <div class="footer">
            <div class="container">
                <div class="col-md-4 ft logo">
                    <div class="logo fot">
                       <h1><a href="index.php">Sports Kick</a></h1>
                    </div>
                </div>
                <div class="col-md-4 ft cpyrt">
                    <p>Copyright &copy; 2018 Fantastic Quattro <br/>All rights reserved</p>
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
    
<!--  add for review  -->
<script>  
function rate(){
        var rating = document.querySelector('input[name="poll_option"]:checked').value;
        var Name = '<?php echo $Name; ?>';
        $.ajax({
           type: "POST",
            url: "fetch_poll_data.php",
            data:{rating: rating, name:Name},
            success:function(data){
                document.getElementById('poll_result').innerHTML=data;
            }
            
        });
        }
    
        function downloadUrl(url,callback) {
         var request = window.ActiveXObject ?
             new ActiveXObject('Microsoft.XMLHTTP') :
             new XMLHttpRequest;

         request.onreadystatechange = function() {
           if (request.readyState == 4) {
             request.onreadystatechange = doNothing;
             callback(request, request.status);
           }
         };

         request.open('GET', url, true);
         request.send(null);
        }
    
    

</script>
</html>
    


