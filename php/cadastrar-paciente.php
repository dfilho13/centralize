<?php

$link = mysqli_connect("localhost", "root", "", "db_clinica") or die($link);

$nome = $_POST['nom_paciente'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$dataNascimento = $_POST['dataNascimento'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$obs = $_POST['obs'];

date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d H:i:s', time());

$sql = "INSERT INTO tb_pacientes (
            nom_paciente,
            dat_cadastro,
            dat_nascimento,
            email_paciente,
            telefone,
            cpf,
            rg,
            obs_cadastro
        )
        VALUES(
            '$nome',
            '$hoje',
            '$dataNascimento',
            '$email',
            '$telefone',
            '$cpf',
            '$rg',
            '$obs'
         )";
mysqli_query($link, $sql);

header("Location: ../main-paciente.php");

?>