<?php
    include('database.php');

    if(isset($_POST['cantidad'])){
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $query = "INSERT into pedidos(cantidad, descripcion) VALUES ('$cantidad','$descripcion')";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die('Query failed');
        }
        echo 'pedido agregado';
    }

?>

