<?php

    $con=mysqli_connect("localhost","root","1234","db_upload");
    $sql="SELECT * FROM docs";
    $result = mysqli_query($con,$sql);

    if (!isset($_GET['pg']))
    {
        $pg = 1;
    } else {
        $pg = $_GET['pg'];
    }

    $total_reg = "5"; // número de registros por página
    $inicio = $pg -1;
    $inicio = $inicio * $total_reg;



    $busca_perso =  "SELECT * FROM docs LIMIT $inicio, $total_reg";
    $limite = mysqli_query($con,$busca_perso);
    $todos = mysqli_query($con,$sql);
    $tr = mysqli_num_rows($todos); // verifica o número total de registros

    $tp = $tr / $total_reg; // verifica o número total de páginas
    $total_paginas = ceil($tr / $total_reg);

    $anterior = $pg -1;
    $proximo = $pg +1;



?>
