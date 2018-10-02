<?php 

$pageno = 1;

include('database_connection.php');

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
                            <li><a href="compare.php">Compare</a></li>
                                    <li><a href="eventsList.php">Sports Events</a></li>
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
                </div>


                <div class="list-group">
                    <h4>Type</h4>
                    <div style="height:300px; overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
                        <?php

                    $query = "
                    SELECT DISTINCT(Category) FROM events
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector Type" value="<?php echo $row['Category']; ?>">
                                <?php echo $row['Category']; ?> </label>
                        </div>
                        <?php    
                    }

                    ?>
                    </div>
                </div>

                  <div class="list-group">
                    <h4>Year</h4>
                    <div style="overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
                        <?php

                    $query = "
                    SELECT DISTINCT(Year) FROM events
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector Year" value="<?php echo $row['Year']; ?>">
                                <?php echo $row['Year']; ?> </label>
                        </div>
                        <?php    
                    }

                    ?>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
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

            //add for totop button
            jQuery.goup();

            filter_data();
 

            function filter_data(page) {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var Type = get_filter('Type');
                var Year = get_filter('Year');
                $.ajax({
                    url: "eventsFetch.php",
                    method: "POST",
                    data: {
                        action: action,
                        Year: Year,
                        Type: Type,
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
