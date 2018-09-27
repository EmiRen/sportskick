<?php 
echo "hi <br/>";
if(isset($_COOKIE["cookie"])){
    echo $_COOKIE["cookie"];
}
else{
    echo "Not set";
}

?>