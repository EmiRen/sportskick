
<?php
include('database_connection.php');
$postDetails = array();

$search_key = $_GET['term'];

//get rows query
$query = "SELECT DISTINCT(Type) FROM places WHERE Type LIKE '%$search_key%' GROUP BY Type LIMIT 5";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();


if($result){
    foreach($result as $row){
			$postDetails[] = ucfirst($row['Type']);
	}
}
echo json_encode($postDetails);
?>

