<?php

    include('database.php');

    $query = "SELECT * from pedidos";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query error'. mysqli_error($connection));
    }
       $json = array();
        while($row = mysqli_fetch_array($result)){
        $json[] = array(
        'id' => $row['id'],
        'cantidad' => $row['cantidad'],
        'fecha_hora' => date('d-m-Y H:i:s', strtotime($row['fecha_hora'] . ' -4 hours')),
        'descripcion' => $row ['descripcion']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString; 
  

?>