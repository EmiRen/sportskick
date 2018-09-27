
<?php
include('database_connection.php');
$postDetails = array();

$search_keyy = $_GET['term'];

//get rows query
$query = "SELECT DISTINCT(Address) FROM places WHERE Address LIKE '%,%$search_keyy%,%' GROUP BY Address LIMIT 3";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();


if($result){
    foreach($result as $row){
            $subb = explode(",", $row['Address']);
			$postDetails[] = ucfirst($subb[1]);
	}
}
echo json_encode($postDetails);
?>

