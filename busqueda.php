<?php

    include('database.php');

    $search = $_POST['search'];

    if(!empty($search)){
        $query = "SELECT * FROM pedidos WHERE descripcion LIKE '$search%'";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die('Query error'. mysqli_error($connection));
        }
        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                'id' => $row['id'],
                'cantidad' => $row['cantidad'],
                'fecha_hora' => $row ['fecha_hora']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString; 
    }

?>