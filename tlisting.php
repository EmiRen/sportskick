<?php 

$pageno = 1;

include('database_connection.php');
$userLat = '';
$userLng = '';
if(isset($_GET["quickLink"])){
    $value = $_GET["quickLink"];
    $_POST['search_suburb'] ='';
    $_POST['homesearch_category']='';
    
    if(isset($_COOKIE['latCookie']) && isset($_COOKIE['lngCookie'])){
        if($_COOKIE['latCookie'] != '' and $_COOKIE['lngCookie']!=''){
//           echo "Cookie";
            $userLat = $_COOKIE['latCookie'];
            $userLng = $_COOKIE['lngCookie'];
        }
//        echo "userLat ".$userLat." userLng ".$userLng."<br/>";
         
         
    }
    if($value==1){
        $quickFilter = 'SPORTS';
        
    }
    else if($value ==2){
        $quickFilter = 'WORKOUT';
    }
    else if($value == 3){
        $quickFilter = 'LEISURE/RECREATION';
    }
}
else{
    $quickFilter = '';
}
if(isset($_POST['userLat']) && isset($_POST['userLng'])){
   
//    echo "Inside if";
    if($_POST['userLat'] != '' and $_POST['userLng']!=''){
         $userLat = $_POST['userLat'];
    $userLng = $_POST['userLng'];
    }
    
}

    //set cookie for search
    $cookie_name = "cookie_category";
    $cookie_value = $_POST['homesearch_category'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

?>

<html>

<head>

    <title>Search Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Play-Offs Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <meta charset utf="8">
    <link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">

    <!--fonts-->
    <!--link css-->
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <!--bootstrap-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!--default-js-->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!--bootstrap-js-->
    <script src="js/bootstrap.min.js"></script>
    <!--script-->
    <script src="js/jquery.circlechart.js"></script>
    <!-- totop button   -->
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="src/jquery.goup.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.css"> <!-- CSS Link -->
    <script src="js/jquery-ui.js"></script> <!-- JS Link -->


</head>

<style>
    h3 {
    font-family: 'Nunito';
    font-weight: 700;
    font-size: 35px;
    color: #2BC246;
    margin-bottom: 25px;
    text-transform: capitalize;
}
h4 {
        color: coral;
}

    
</style>

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
                            <li><a href="about.html">About Us</a></li>
<!--                            <li><a href="contact.html">Contact</a></li>-->
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
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <br />
            <!--         <h3 align="center" color=green>Places Near You</h3>-->
            <br />
            <div class="col-sm-3">
                <br /><br />
                <div class="list-group">
                    <h4>Category</h4>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php

                    $query = "SELECT DISTINCT(Category) FROM places";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector Category" value="<?php echo $row['Category']; ?>">
                                <?php echo $row['Category']; ?></label>
                        </div>
                        <?php
                    }

                    ?>
                    </div>
                </div>


                <div class="list-group">
                    <h4>Type</h4>
                    <div style="height:400px; overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
                        <?php

                    $query = "
                    SELECT DISTINCT(Type) FROM places
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector Type" value="<?php echo $row['Type']; ?>">
                                <?php echo $row['Type']; ?> </label>
                        </div>
                        <?php    
                    }

                    ?>
                    </div>
                </div>

                <div class="list-group">
                    <br /><br />
                    <h4>Distance</h4>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Distance" value=5> 5 KM Radius</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Distance" value=10> 10 KM Radius</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Distance" value=20> 20 KM Radius</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Distance" value=30> 30 KM Radius</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Distance" value=50> All VIC Radius</label>
                    </div>
                    
                </div>

            </div>

            <div class="col-md-9">
                <br />
                <form method="post" action="tlisting.php" >

                    <div style="overflow: hidden; padding-right: .5em;" class="col-md-5 col-sm-5" >
                        <input type="text" class="form-control" style="width: 90%;" name="homesearch_category" id="homesearch_category" value="<?php echo $_POST['homesearch_category']; ?>" autocomplete="off" placeholder=    "<?php if(!isset($_COOKIE[$cookie_name])) {
                                            echo "Recent search: Basketball, Cricket.";
                                            } else {
                                            echo "You may interested in: " . $_COOKIE[$cookie_name]. " ? ";
                                        } ?>" />        
                    </div>
                    <div style="overflow: hidden; padding-right: .5em;" class="col-md-5 col-sm-5">
                        <input type="text" class="form-control" style="width: 90%;" name="search_suburb" id="search_suburb" value="<?php echo $_POST['search_suburb']; ?>" autocomplete="off" placeholder="Enter the suburb name" />
                        <input type = "hidden" name="userLat" id="latitude">
                         <input type="hidden" name="userLng" id="longitude">
                    </div>
                    <div style="overflow: hidden; padding-right: .5em;" class="col-md-2 col-sm-5">
                        <input class="btn btn-default hd-more" style="float: right" type="submit" value="Search">
                    </div>
                </form>
                <br />
                <br />
                <br />
                <div class="filter_data" id="pagination_data">
                </div>
            
            </div>
            

        </div>

    </div>
    <style>
        #loading {
            text-align: center;
            background: url(loader.gif) no-repeat center;
            height: 300px;
            margin-top: 30px;
        }

    </style>

    <script>
        
        $(document).ready(function() {

            $("#homesearch_category").autocomplete({
                source: 'suggestionType.php'
            });
            $("#search_suburb").autocomplete({
                source: 'suggestionSub.php'
            });

            navigator.geolocation.getCurrentPosition(function(location) {
            userLat = location.coords.latitude;
            userLng = location.coords.longitude;
                document.getElementById('latitude').value = userLat;
                document.getElementById('longitude').value = userLng;
                console.log(userLat+"\t"+userLng);
                
            });
            //add for totop button
            jQuery.goup();

            filter_data();
            
        $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");  
           filter_data(page);  
      });  

            function filter_data(page) {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var Type = get_filter('Type');
                var Category = get_filter('Category');
                var Distance = get_filter('Distance')[get_filter('Distance').length - 1];
                var suburbLocation = document.getElementById("search_suburb").value;
                var searchText = document.getElementById("homesearch_category").value;
                var quickLinks = '<?php echo $quickFilter; ?>';
                var userLat = '<?php echo $userLat; ?>';
                var userLng = '<?php echo $userLng; ?>';
                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        Category: Category,
                        Type: Type,
                        Distance: Distance,
                        SearchText: searchText,
                        suburbLocation: suburbLocation,
                        quickLinks: quickLinks, userLat: userLat, userLng: userLng,
                        page: page
                    },
                    success: function(data) {
                        $('#pagination_data').html(data);
                    }
                });
                window.scrollTo(0, 0);
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                console.log("Inside get_filter()" + filter)
                return filter;
            }

            $('.common_selector').click(function() {
                filter_data();
            });
            


        });
        
    </script>



    <!--footer-->
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
