<!DOCTYPE html>
<html>
<head>
<title>fetch_data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">    
     <link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">
<link rel="icon" href="images/webLogo.png" type="image/jpg" sizes="16*16">
		<!--coustom css-->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="js/jquery-2.1.4.min.js"></script>

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

    
if(isset($_POST["action"]))
{
  //Order Distance: add for order distance


$searchText = explode(' ',$_POST["SearchText"]);
    
      if(isset($_COOKIE['latCookie']) && isset($_COOKIE['lngCookie'])){
//        echo "Inside Cookie set <br/>";
        if($_COOKIE['latCookie'] != '' and $_COOKIE['lngCookie']!=''){
//           echo "Cookie";
            $userLat = $_COOKIE['latCookie'];
            $userLng = $_COOKIE['lngCookie'];
        }
//        echo "userLat ".$userLat." userLng ".$userLng."<br/>";
         
         
    }
    
 $query = "SELECT * FROM places WHERE Status =1 AND ((Category LIKE '%".$searchText[0]."%' OR Name LIKE '%".$searchText[0]."%'  OR Type LIKE '%".$searchText[0]."%')";
    for($i=1;$i<count($searchText); $i++){
    if(!empty($searchText[$i])){
        $query.="OR (Category LIKE '%".$searchText[$i]."%' OR Name LIKE '%".$searchText[$i]."%' OR Type LIKE '%".$searchText[$i]."%')";
    }
}
    $query.=")";
 
    if(isset($_POST['suburbLocation'])){
        if($_POST['suburbLocation'] != ''){
          $query.= "AND Address LIKE '%".$_POST['suburbLocation']."%'" ; 
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
    
$query.=" LIMIT 5";
 
//  echo $query;
        include('database_connection.php');
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();
        $output = '';

     if($total_row > 0)
     {
         $i=0;
         ?>

  
    <br/>
    <form action ="compareList.php" method="post" onsubmit="return validate(this)">
        <center><input type="submit" class = "btn btn-lg" name="Compare" value="Compare"></center><br/><br/>
        <?php
      foreach($result as $row)
      {      
              $output .= '   
       <div class="col-md-6 col-md-6">
        <div style="border:1px solid #ff7f3b; border-radius:5px; padding:16px; margin-bottom:16px; height:350px;" name = "sports[]">

         <h4 align="center" style="color:MediumSeaGreen;"><strong>'. $row['Name'] .'</strong></h4>
       
         <p>
         <b>Type :</b> <br />'. $row['Type'] .' <br /><br />
         <b>Category :</b> <br />'. $row['Category'] .' <br /><br />
         <b>Address :</b> <br />'. $row['Address'] .'<br /><br />
         
       
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
         <b><center>
         <input type="checkbox" name="compare[]"  value="'.$row['Name'].'" onclick = "return check()">
                                
                       
                        </center></b>
         
         </p>

        </div>
       </div>
       ';  
          
      }}
     else
     {
      $output = '<br/><br/><center><h4>No Places Found. Please Extend Scope!</h4></center>';
     }
     echo $output;

    }
?> 
        </form>
    <script>
        var flag = 0;
    function check(){
//        console.log("Hi");
        var a = document.getElementsByName('compare[]');
        var div = document.getElementsByName('sports[]');
//        console.log(div);
//        console.log(a);
        var newvar = 0;
        var count;     
        for(count = 0; count<div.length; count++){
            if(a[count].checked==true){
                if(flag == 0)
//                console.log(a[count]);
                $(div[count]).css("background-color","#ede3ef");
                newvar = newvar+1;
                if(newvar > 2){
                    $(div[count]).css("background-color","#ffffff");
                }
            }
            else{
                $(div[count]).css("background-color","#ffffff");
            }
        }
        if(newvar>2){
            flag = 1;
            window.alert("Please select two places to compare!!");
            $(div[count]).css("background-color","#ffffff");
            return false;
        }
    }
        
        function validate(){
            var a = document.getElementsByName('compare[]');
            var newvar = 0;
            for(var i=0;i<a.length;i++){
                if(a[i].checked == true){
                    newvar = newvar +1;
                }
            }
//            console.log(newvar);
            if(newvar != 2){
//                console.log("Should Return False");
                window.alert("Please select two places to compare!!");
                return false;
            }
            return true;
        }
    </script>
    </body>
</html>

    

