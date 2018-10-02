<doctype html!>
    <html>

    <head>
        <title>Home</title>
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
        <!-- totop button   -->
        <script src="//code.jquery.com/jquery.min.js"></script>

        <!--  suggestion    -->
        <link rel="stylesheet" href="css/jquery-ui.css"> <!-- CSS Link -->
        <script src="js/jquery-ui.js"></script> <!-- JS Link -->

        <script>
            $(document).ready(function(){
                
            $("#homesearch_category").autocomplete({
                source:'suggestionType.php'
            });
            $("#search_suburb").autocomplete({
                source:'suggestionSub.php'
            });
               
                //add for totop button
                //   jQuery.goup();
        navigator.geolocation.getCurrentPosition(function(location) {
         userLat = location.coords.latitude;
         userLng = location.coords.longitude;
       if(userLat != '' && userLng != ''){
         console.log(userLat+" "+userLng);
         document.getElementById('latitude').value = userLat;
         document.getElementById('longitude').value = userLng;
           if(userLat!='' && userLng!=''){
               latCookie = "latCookie";
           longCookie = "lngCookie";
               document.cookie = latCookie+"="+userLat;
           document.cookie = longCookie+"="+userLng;
           }
               
       }
   });
    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var Type = get_filter('Type');
        console.log("Inside Filter Data"+Type);
        var Category = get_filter('Category');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, Category:Category, Type:Type},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        console.log("Inside get_filter()"+filter)
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });
            
            });
        </script>

        <!--script-->
    </head>

    <body>
        <div class="header-top">
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

                                    <!--                                  <li><a href="contact.html">Contact</a></li>-->
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
            <!--header-text-->
            <div class="head-top-text">
                <div class="container">
                    <div class="border-text">
                        <br /><br /><br />
                        <h2>Explore sports around you.</h2>

                        <!--     search box      -->
                        <form method="post" action="tlisting.php">

                            <input type="text" id="homesearch_category" name="homesearch_category" class="form-control" placeholder="Search for sport centres, gyms and parks" style="width:38%;" autocomplete="off" />

                            <br />
                            <input type="text" id="search_suburb" name="search_suburb" class="form-control" placeholder="Enter the suburb you are looking for" style="width:38%;" autocomplete="off"/>
                            <br />

                            <input type="hidden" name="userLat" id="latitude">
                            <input type="hidden" name="userLng" id="longitude">

                            <input class="btn btn-default cont-btn" type="submit" value="Start your journey">
                            <br /><br />
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!--trainers-->

        <div class="our-trainers">
            <div class="container">
                <h3>what are you looking for?</h3>
                <div class="row">
                    <a class="col-md-4 trainer-grid-text" href="tlisting.php?quickLink=1">
                        <div class="ch-item ch-img-1">
                            <div class="ch-info">
                                <h3>Sports Centers Around You</h3>
                                <p>Explore!</p>
                            </div>
                        </div>
                        <h4>Sports Centers</h4>
                    </a><!-- /.col-lg-4 -->
                    <a class="col-md-4 trainer-grid-text" href="tlisting.php?quickLink=2">
                        <div class="ch-item ch-img-2">
                            <div class="ch-info">
                                <h3>Gyms Around You</h3>
                                <p>Explore!</p>
                            </div>
                        </div>
                        <h4>Gyms</h4>
                    </a><!-- /.col-lg-4 -->
                    <a class="col-md-4 trainer-grid-text" href="tlisting.php?quickLink=3">
                        <div class="ch-item ch-img-3">
                            <div class="ch-info">
                                <h3>Parks Around You</h3>
                                <p>Explore!</p>
                            </div>
                        </div>
                        <h4>Parks</h4>
                    </a><!-- /.col-lg-4 -->
                    <div class="clearfix"></div>
                </div><!-- /.row -->
            </div>
        </div>
        <div class="stats-tabs">
            <div class="container">
                <h3>You are not alone!</h3>
                <div class="col-md-6 pd stats">
                    <h4>International Students in Aussie per Year</h4>
                    <div class="progress mr">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            <span class="sr-only">80% Complete</span>
                        </div>
                    </div>
                    <div class="border-text">
                        <h5>2017 Data: 800, 000 +</h5>
                    </div>
                    <div class="progress mr">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div>
                    <div class="border-text">
                        <h5>2016 Data: 700, 000 +</h5>
                    </div>
                    <div class="progress mr">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                    <div class="border-text">
                        <h5>2015 Data: 650, 000 +</h5>
                    </div>
                    <div class="progress mr">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                            <span class="sr-only">50% Complete</span>
                        </div>
                    </div>
                    <div class="border-text">
                        <h5>2014 Data: 580, 000 +</h5>
                    </div>
                </div>
                <div class="col-md-6 pd tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav2" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Rahul</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Putin</a></li>
                        <li role="presentation" class="2t"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Jennifer</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active re-pad2" id="home">
                            <div class="col-md-6 re-flt">
                                <img src="./images/tb1.jpg" alt="/" class="img-responsive">
                            </div>
                            <div class="col-md-6 re-flt re-xt">
                                <h4>22 Years Old, from India</h4>
                                <p>I am a basketball lover and want to explore a basketball court near my university or house so that I can play basketball with other people at weekends.</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane re-pad2" id="profile">
                            <div class="col-md-6 re-flt">
                                <img src="./images/tb3.jpg" alt="/" class="img-responsive">
                            </div>
                            <div class="col-md-6 re-flt re-xt">
                                <h4>26 Years Old, from Russia</h4>
                                <p>Hi, I have put on some weight recently, so I want to explore one or more available gyms around Melbourne city to work out or find a personal trainer to help me loss weight.<p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane re-pad2" id="messages">
                            <div class="col-md-6 re-flt">
                                <img src="./images/jennifer.jpg" alt="/" class="img-responsive">
                            </div>
                            <div class="col-md-6 re-flt re-xt">
                                <h4>2o Years Old, from Brazil</h4>
                                <p>I am preparing for a marathon competition of my university, so I want to find a nice public park near my house. I also need to jog at night so the reviews of a park is one of the most important information. </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
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
