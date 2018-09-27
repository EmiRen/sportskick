<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sports Kick</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel = "stylesheet" href="styles.css" type="text/css">
  
    
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
  
  <script src ="scripts.js"></script>
  
  </head>
  
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php include('db.php');
        $page = $_POST["page"];
        $uplimit = $_POST["limit"];
      
        $order = $_POST['order'];
        
        
      ?>
  <nav class="navbar navbar-expand-lg fixed-top" style="background-color: black">
<a class="navbar-brand" href="index.php" style="color: white;">Sports Kick</a>
</nav>
<br/><br/><br/>

<div class = "container sports">
<h3>Sport Centres around you</h3>
    </div>
      <div class="row" style="margin-top: 8vh">
<div class = "col-sm-2 col-md-3" style="border-right-style: groove">
    <div>
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">No of places to display</button>
        <div class = "dropdown-menu">
        <a class="dropdown-item" href="sportsCentre.php?page=1&limit=10&order=<?php echo$order; ?>">10</a>
        <a class="dropdown-item" href="sportsCentre.php?page=1&limit=50&order=<?php echo$order; ?>">50</a>    
        </div>
    </div>
    <br/><br/><br/>
    <div>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Sort places by</button>
        <div class = "dropdown-menu">
        <a class="dropdown-item" href="sportsCentre.php?page=1&limit=<?php echo $uplimit; ?>&order=1">Ascending (A to Z)</a>
        <a class="dropdown-item" href="sportsCentre.php?page=1&limit=<?php echo $uplimit; ?>&order=2">Descending (Z to A)</a>    
        </div>
    </div>
          </div>
    <div class = "col-sm-10 col-md-9">
    <h4>Places around you</h4>
        <?php 
        
        if($page == "" || $page==1){
            $page1=0;
        }
        else{
            $page1 = ($page*$uplimit)-$uplimit;
        }
        if($order == 1){
            $orderQuery = "SELECT * FROM places WHERE TYPE = 'SPORTS' ORDER BY Name LIMIT $page1,$uplimit ";
            $result1 = $db->query($orderQuery);
        }
        else if ($order == 2){
            $orderQuery = "SELECT * FROM places WHERE TYPE = 'SPORTS' ORDER BY Name DESC LIMIT $page1,$uplimit ";
            $result1 = $db->query($orderQuery);
       }
        else{
            $sql = "SELECT * FROM places WHERE TYPE = 'SPORTS' LIMIT $page1,$uplimit";
        $result1 = $db->query($sql);
        
        }
        $sql1 = "SELECT * FROM places WHERE TYPE = 'SPORTS'";
        $result = $db->query($sql1);
        $totalCount = $result->num_rows;
        $totalCount = $result->num_rows;
        $pageCount = ceil($totalCount/$uplimit);
        
if($result1->num_rows > 0){
    ?>
        <ul class = "collapsible popout" data-collapsible = "accordion">
    <!-- echo "<table border = '1'>"; -->
            <?php
    while($row = $result1->fetch_assoc()){
        ?>
            <li>
                <div class = "collapsible-header">
                <?php echo $row['Name']; ?>
                </div>
                <div class ="collapsible-body" style="color:grey">
                    <table class = "responsive-table">
                    <tr>
                        <td>
                            <h6>Address</h6>
                            
                        </td>
                        <td>
                        <h6>Category</h6>
                        </td>
                    <td>
                        <h6>Facilities</h6>
                        </td>
                        <tr><td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Category']; ?></td>
                        <td><?php echo $row['Type']; ?></td>
                        </tr>
                        
                        </tr>
                   
                    </table>    
                </div>
            </li>
            <?php
    }
    
}

mysqli_close($db);
        
        ?>
            <br/><br/>
        <ul class = "pagination justify-content-center">
            <li class = "page-item"><a id = "first" class = "page-link" href = "sportsCentre.php?page=1&limit=<?php echo $uplimit; ?>&order=<?php echo $order; ?>">First</a></li>
            <li class = "page-item"><a class = "page-link" href = "sportsCentre.php?page=<?php echo $page-1; ?>&limit=<?php echo $uplimit; ?>&order=<?php echo $order; ?>"><</a></li>
        
            <li class = "page-item"><a class = "page-link" href = "sportsCentre.php?page=<?php echo $page+1 ?>&limit=<?php echo $uplimit; ?>&order=<?php echo $order; ?>">></a></li>
            
            <li class = "page-item"><a id = "last" class = "page-link" href = "sportsCentre.php?page=<?php echo $pageCount ?>&limit=<?php echo $uplimit; ?>&order=<?php echo $order; ?>">Last</a></li>
            <li class = "page-item"><?php echo $page."of".$pageCount; ?></li>
        </ul>
    </div>

      </div>
    
      
  
  <div class="footer">
<div class="container"><center>Copyright &copy; 2018 Sports Kick</center></div>        
</div>

  </body>
  </html>