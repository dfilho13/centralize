<?php

$link = mysqli_connect("localhost", "root", "", "db_clinica") or die($link);

$nome = $_POST['nom_atendente'];
$pcl = $_POST['pcl_comissao'];
date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d H:i:s', time());

$sql = "INSERT INTO tb_atendente (
            nom_atendente,
            pcl_comissao,
            dat_cadastro
        )
        VALUES(
            '$nome',
            '$pcl',
            '$hoje'
         )";
mysqli_query($link, $sql);

header("Location: ../main-atendente.php");

?>