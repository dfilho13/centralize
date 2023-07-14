<?php 

session_start();

// apaga todas as variáveis da sessão
$_SESSION = array();

// se é preciso matar a sessão, então os cookies de sessão também deverão ser apagados. 

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// por último, destrói a sessão
session_destroy();

header("Location: ../index.php");

?>