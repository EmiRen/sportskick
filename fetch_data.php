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
  //Order Distance: add for order distance
  if(isset($_POST["Distance"])){
    $Distance_filter = $_POST["Distance"];
    $distance = (int)$Distance_filter;
 
  }else
  {
      $distance = 15;
  }

$searchText = explode(' ',$_POST["SearchText"]);
$query = "SELECT * FROM places WHERE Status =1 AND ((Category LIKE '%".$searchText[0]."%' OR Name LIKE '%".$searchText[0]."%'  OR Type LIKE '%".$searchText[0]."%')";
    for($i=1;$i<count($searchText); $i++){
    if(!empty($searchText[$i])){
        $query.="OR (Category LIKE '%".$searchText[$i]."%' OR Name LIKE '%".$searchText[$i]."%' OR Type LIKE '%".$searchText[$i]."%')";
        
    }
}
    
//print_r($searchText);

    $query.=")";
    
    if(isset($_POST['userLat']) && isset($_POST['userLng'])){
        $current_lat = $_POST['userLat'];
        $current_lon = $_POST['userLng'];
        //echo "Inside set".$current_lat;
    }
    else{
        $current_lat = '';
        $current_lon = '';
    }
    if(isset($_POST['suburbLocation'])){
        if($_POST['suburbLocation'] != ''){
          $query.= "AND Address LIKE '%".$_POST['suburbLocation']."%'" ; 
        } 
    }
    if(isset($_POST['quickLinks'])){
        if($_POST['quickLinks']!=''){
            $query.="AND Category LIKE '%".$_POST['quickLinks']."%'";
        }
        else{
            $_POST['quickLinks']='';
        }
    }
 if(isset($_POST["Type"]))
 {
  $Type_filter = implode("','", $_POST["Type"]);
  $query .= "AND Type IN('".$Type_filter."')";
 }
 if(isset($_POST["Category"]))
 {
  $Category_filter = implode("','", $_POST["Category"]);
  $query .= "AND Category IN('".$Category_filter."')";
 }

    
  //add for distance radius
    if($current_lat!='' and $current_lon!=''){
        $query.=" HAVING ( 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )) <=".$distance;
        $query .= " ORDER BY 6371 * (acos( cos( radians(".$current_lat.") ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(".$current_lon.") ) + sin( radians(".$current_lat.") ) * sin(radians(Latitude)) ) )"; 
    }

    
//$query.=" LIMIT 250";
 
    //echo $query;
    

    
        include('database_connection.php');
    //    <!--    pagenate -->   
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        $total_pages = ceil($total_row/$record_per_page);
        $link = 3;
        $start = (($page - $link)>0 ? $page - $link : 1);
        $end = (($page + $link) < $total_pages ? $page + $link : $total_pages);

       $output = '<div>';

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
        near you.
        </h4></center>
    <br/>
    <?php
         
         $query.="LIMIT $start_from, $record_per_page";
         $statement = $connect->prepare($query);
         $statement->execute();
         $result = $statement->fetchAll();
         
         

         foreach($result as $row)
      {
      $distancePlace = getDistance($row['Latitude'],$row['Longitude'], $current_lat, $current_lon);
//          echo $distancePlace;
          //echo "Current Lat ".$current_lat;
          if($current_lat != '' and $current_lon != ''){
              
             
                  $output .= '   
       <div class="col-md-6 col-md-6">
        <div style="border:1px solid #ff7f3b; border-radius:5px; padding:16px; margin-bottom:16px; height:430px;">

         <h4 align="center" style="color:MediumSeaGreen;"><strong>'. $row['Name'] .'</strong></h4>
       
         <p>
         <b>Type :</b> <br />'. $row['Type'] .' <br /><br />
         <b>Category :</b> <br />'. $row['Category'] .' <br /><br />
         <b>Address :</b> <br />'. $row['Address'] .'<br /><br />
         
         <b>Distance :</b> <br /> 
          <font color="green">'. $distancePlace .' KM </font>
         <br /><br />

         <form method="post" action="detailPage.php">
         <input type="hidden" name="Type" value="'. $row['Type'] .'">
         <input type="hidden" name="Category" value="'. $row['Category'] .'" >
         <input type="hidden" name="Address" value="'. $row['Address'] .'">
         <input type="hidden" name="Name" value="'. $row['Name'] .'">
         <input type="hidden" name="longitude" value="'. $row['Longitude'] .'">
         <input type="hidden" name="latitude" value="'. $row['Latitude'] .'">
         <input type="hidden" name="ID" value="'. $row['ID'] .'">
         <input type="hidden" name="localPhNum" value="'.$row['Local_Phone_Number'].'">
         <input type="hidden" name="internationalPhNum" value="'.$row['International_Phone_Number'].'">
         <input type="hidden" name="website" value="'.$row['Website'].'">
         <b><center><input type="submit" class="button" value= "More Details"></center></b>
         </form>

         </p>

        </div>    
       </div>
         
             ';
     
          }
          else {
        $output .= '   
       <div class="col-md-6 col-md-6">
        <div style="border:1px solid #ff7f3b; border-radius:5px; padding:16px; margin-bottom:16px; height:430px;">

         <h4 align="center" style="color:MediumSeaGreen;"><strong>'. $row['Name'] .'</strong></h4>
       
         <p>
         <b>Type :</b> <br />'. $row['Type'] .' <br /><br />
         <b>Category :</b> <br />'. $row['Category'] .' <br /><br />
         <b>Address :</b> <br />'. $row['Address'] .'<br /><br />
         
       
         <form method="post" action="detailPage.php">
         <input type="hidden" name="Type" value="'. $row['Type'] .'">
         <input type="hidden" name="Category" value="'. $row['Category'] .'" >
         <input type="hidden" name="Address" value="'. $row['Address'] .'">
         <input type="hidden" name="Name" value="'. $row['Name'] .'">
         <input type="hidden" name="longitude" value="'. $row['Longitude'] .'">
         <input type="hidden" name="latitude" value="'. $row['Latitude'] .'">
         <input type="hidden" name="ID" value="'. $row['ID'] .'">
         <input type="hidden" name="localPhNum" value="'.$row['Local_Phone_Number'].'">
         <input type="hidden" name="internationalPhNum" value="'.$row['International_Phone_Number'].'">
         <input type="hidden" name="website" value="'.$row['Website'].'">
         <b><center><input type="submit" class="button" value= "More Details"></center></b>
         </form>

         </p>

        </div>
       </div>
       ';  
          }
      }}
     else
     {
      $output = '<br/><br/><center><h4>No Places Found. Please Extend Scope!</h4></center>';
     }
    
    $output .= '</div><br/><div align="center">';
        
    
    $previous_page = ($page == 1) ? 
            "<span>Prev </span>" :
            "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".($page-1)."'>Prev </span>";
    $output .= $previous_page;
    
    if( $start > 1 ){
            $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='1'>1</span>";  
            $output .= "<span> ... </span>";
    }
                
                
        for($i = $start ; $i <= $end; $i++)  
 {    
            
            if ($page == $i){
                      $output .= "<span class='pagination_link' style='cursor:pointer; padding:10px; border:2px solid #ccc; color: coral;' id='".$i."'>".$i."</span>"; 
            }
            else{
                  $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
            }
 }  
    
        if ( $end < $total_pages){
            $output .= '<span> ... </span>';
            $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='". $total_pages ."'>" . $total_pages . "</span>";
            
        }
    
            $next_page = ($page == $total_pages) ? 
            "<span >Next</span>"  :
            "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".($page+1)."'>Next</span>";
    
            $output .= $next_page;
    
 $output .= '</div><br /><br />';
     echo $output;

    }

    function getDistance($current_lat, $current_lon,$latitudeTo, $longitudeTo, $earthRadius = 6371)
    {
    
        $latFrom= deg2rad((double)$current_lat);
        $lonFrom= deg2rad((double)$current_lon);
        $latTo = deg2rad((double)$latitudeTo);
        $lonTo = deg2rad((double)$longitudeTo);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return round($angle * $earthRadius,3);
    }
?> 



</html>
       


