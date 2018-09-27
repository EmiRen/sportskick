
   <?php 
    include('database_connection.php');
   
    //add for parking markers
    
    function parseToXML($htmlStr)
    {
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
    }

    // Select all the rows in the markers table
    $query = "SELECT * FROM parking ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    

    // Start XML file, echo parent node
    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind=0;
    // Iterate through the rows, printing XML nodes for each
    foreach ($result as $row){
      // Add to XML document node
      echo '<marker ';
      echo 'id="' . $row['ID'] . '" ';
      echo 'name="' . parseToXML($row['Name']) . '" ';
      echo 'address="' . parseToXML($row['Address']) . '" ';
      echo 'lat="' . $row['latitude'] . '" ';
      echo 'lng="' . $row['longitude'] . '" ';
      echo 'phone="' . $row['Phone'] . '" ';
      echo '/>';
      $ind = $ind + 1;
    }

    // End XML file
    echo '</markers>';
    ?>