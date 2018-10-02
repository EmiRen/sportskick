<!DOCTYPE html>
<html>
<head>
<title>fetch_data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">
        <link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">
		<!--coustom css-->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>


<style>
.button {
    color: #494949  !important;
    text-transform: uppercase;
    background: #ffffff;
    padding: 15px;
    border: 2px solid #494949  !important;
    border-radius: 2px;
    display: inline-block;
    }
.button:hover {
    color: #20bf6b !important;
    border-radius: 15px;
    border-bottom: 15px;
    border-color: #20bf6b !important;
    transition: all 0.3s ease 0s;
    }
p{    
   
    font-family: 'Nunito';
    font-size: 15px;
    font-weight: 400;
    padding: 10px 10px;
}
h4{    
    
    font-family: 'Nunito';
    font-size: 21px;
    font-weight: 400;
    padding: 5px;
}
    
</style>

</head> 
    
<!--DISTANCE 1: get current location-->
<script> 
    navigator.geolocation.getCurrentPosition(function(location) {
    current_lat=location.coords.latitude;
    current_lon=location.coords.longitude;

    });
</script>
    

<?php  
    
     $record_per_page = 8;
     $page = '';
    
    
     if(isset($_POST["page"]))  
         {  
              $page = $_POST["page"];  
         }  
         else  
         {  
              $page = 1;  
         }  
    
    $start_from = ($page - 1)*$record_per_page; 



    
if(isset($_POST["action"]))
{
$query = "SELECT * FROM events WHERE Status =1";
 if(isset($_POST["Year"]))
 {
  $Type_filter = implode("','", $_POST["Year"]);
  $query .= " AND Year IN('".$Type_filter."')";
 }
 if(isset($_POST["Type"]))
 {
  $Category_filter = implode("','", $_POST["Type"]);
  $query .= " AND Category IN('".$Category_filter."')";
 }

   $query.=" ORDER BY Year, Month";  
// echo $query;
    

    
        include('database_connection.php');
    //    <!--    pagenate -->   
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
     if($total_row > 0)
     {
         ?>

    <center><h4>We have found <?php echo $total_row ?> result(s)
       <?php 
             
             
         if(isset($_POST["Type"])){
            $Type_filter = implode(", ", $_POST["Type"]);
            echo "about ";
            echo "$Type_filter";
          }
          else
          { 
            echo NULL;
          }
         
        ?>
        </h4></center>
    <br/>
    <?php
                  


         foreach($result as $row)
      {              
             if($row['Min_Price'] != 'No Information'){
                 $row['Min_Price']="A$".$row['Min_Price'];
             }
             
             if($row['Max_Price'] != 'No Information'){
                 $row['Max_Price']="A$".$row['Max_Price'];
             }
                  $output = '   
       <div class="col-md-6 col-md-6">
        <div style="border:1px solid #ff7f3b; border-radius:5px; padding:16px; margin-bottom:16px; height:550px;">

         <h4 align="center" style="color:MediumSeaGreen;"><strong>'. $row['Name'] .'</strong></h4>
       
         <p>
         <b>Type :</b> <br />'. $row['Category'] .' <br /><br />
         <b>Venue :</b> <br />'. $row['Venue'] .' <br /><br />
         <b>Address :</b> <br />'. $row['Address'] .'<br /><br />
         <b>Start Date :</b> <br />'. $row['Start_Date'] .'<br /><br />
         <b>Start Time :</b> <br />'. $row['Start_Time'] .'<br /><br />
         <b>Ticket Price(Min) :</b> <br />'. $row['Min_Price'] .'<br /><br />
         <b>Ticket Price(Max) :</b> <br />'. $row['Max_Price'] .'<br /><br />
         </p>

        </div>    
       </div>
         
             ';
     echo $output;
      }
     }
     else
     {
      $output = '<br/><br/><center><h4>No Places Found. Please Extend Scope!</h4></center>';
         echo $output;

     }
     
    }

?> 



</html>
       


