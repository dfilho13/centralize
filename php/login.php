<?php

$link = mysqli_connect("localhost", "root", "", "db_clinica") or die($link);

$login = strtoupper(mysqli_real_escape_string($link, $_POST["login"]));
$senha = mysqli_real_escape_string($link, $_POST["senha"]);

$resultado = $link->query("select * from tb_usuarios where dsc_login = '$login' and  dsc_senha = '$senha'");
$linhas = mysqli_num_rows($resultado);

if ($linhas == 0) { 
    echo"<script language='javascript' type='text/javascript'>
    alert('Usuario ou senha invalidos!');
    window.location.href='../login.php';</script>";
}

while($dados = mysqli_fetch_array($resultado)): 

    $perfil = $dados['cod_tipo_usuario'];

    if ($linhas == 0) { 
        echo"<script language='javascript' type='text/javascript'>
        alert('Usuario ou senha invalidos!');
        window.location.href='../index.php';</script>";
    }
    else{
        if($perfil == 1){
            session_start();
            $_SESSION["login_usuario"] = $login;
            $_SESSION["senha_usuario"] = $senha;	
    
            header("Location: ../index-adm.php");
            exit();
        }
    }
endwhile;

?>