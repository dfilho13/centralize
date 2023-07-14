<?php
$link = mysqli_connect("localhost", "root", "", "db_clinica") or die($link);


session_start();
 
if (!isset($_SESSION["login_usuario"]) || !isset($_SESSION["senha_usuario"])) {
    // enviar o utilizador para a pagina de login
    header("Location: log?>n.php");
} else {
    // o utilizador tem sessao iniciada e carregamos o resto da pagina
    $loginUsuario = $_SESSION["login_usuario"];
    $senha_usuario = $_SESSION["senha_usuario"];
}


$resultado = $link->query("SELECT nome_usuario
FROM usuarios
WHERE login = '$loginUsuario'");
$nome_usuario = $resultado;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Centralize - ADM</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            #exib{
                transition: .5s all;
            }

            #exib:hover{
                transition: .5s all;
                transform: scale(1.1);
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 p-5 mt-4 ml-5" href="index-adm.php">
                <h5 class="text-warning">CENTRALIZE</h5>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="hidden" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">HOME</div>
                            <a class="nav-link" href="index-adm.php">
                                <div class="sb-nav-link-icon"><i class="material-icons">access_time</i></div>
                                Agendamentos
                            </a>
                            <div class="sb-sidenav-menu-heading">CADASTRO/CONSULTA</div>
                            <a class="nav-link collapsed" href="main-atendente.php">
                                <div class="sb-nav-link-icon"><i class="material-icons">group</i></div>
                                Atendentes
                            </a>
                            <a class="nav-link collapsed" href="main-paciente.php">
                                <div class="sb-nav-link-icon"><i class="material-icons">airline_seat_recline_extra</i></div>
                                Pacientes
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="material-icons">attach_money</i></div>
                                Financeiro
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Comissões
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="register.html">Relatório</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Configurações</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="material-icons">account_circle</i></div>
                                Usuários
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuário:</div>
                        <?=$_SESSION['login_usuario']?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-5">Cadastro de atendentes</h1>
                        <div class="card mb-4">
                            <form action="pesquisa-atendente.php" method="GET">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Novo Atendente
                                    </button>
                                    <div class="input-group w-25">
                                        <input type="text" class="form-control" name="nome" placeholder="Pesquisar">
                                        <button class="btn btn-dark" type="button">
                                            <i class="material-icons">
                                                search
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <div class="container mt-5">
                                    <div class="row">
                                    <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "db_clinica";
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error) {
                                            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                                        }
                                        $sql = "SELECT * FROM Tb_Atendente";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($dados = $result->fetch_assoc()) {
                                        
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mt-5 mr-5">
                                            <a href="view-atendente.php?cod=<?=$dados['cod_atendente']?>" style="color:inherit">
                                                <div class="card" style="width: 18rem;" id="exib">
                                                    <img class="card-img-top mt-3" src="https://cdn-icons-png.flaticon.com/512/16/16363.png" alt="">
                                                    <div class="card-body">
                                                        <h5 class="card-title mt-3"><?=$dados['nom_atendente']?></h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                           }
                                        } else {
                                            echo "Nenhum resultado encontrado.";
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Centralize 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar novo atendente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="php/cadastrar-atendente.php" method="POST">
                            <div class="row">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" placeholder="Nome do Atendente" name="nom_atendente" required="">
                                </div>    
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" placeholder="Comissionamento" name="pcl_comissao">
                                </div>  
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
