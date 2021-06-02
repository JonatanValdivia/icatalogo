<?php
    session_start();
    //require("../../database/conexao.php");
    if(isset($_POST['pesquisar'])){
        $consulta = $_POST['pesquisar'];

        $sql = "SELECT p.*, c.descricao as categoria FROM tbl_produto p
        INNER JOIN tbl_categoria c ON p.categoria_id = c.id
        WHERE p.descricao LIKE '%$consulta%'
        OR c.descricao LIKE '%$consulta%'
        ORDER BY p.id DESC";
        $resultado = mysqli_query($conexao, $sql);
    }
?>
<link href="/PWBE/Aula10PHP/icatalogo/icatalogo-parte1/componentes/header/header.css" rel="stylesheet" />
<?php
    if(isset($_SESSION['mensagem'])){
?>
<div class="mensagens">
    <?$_SESSION['mensagem']?>
</div>
<script lang="javascript">
    setTimeout(() => {
        document.querySelector(".mensagens").style.display = "none";
    }, 4000);
</script>
   <?php
    unset($_SESSION['mensagem']);
    }
    ?>
 
<header class="header">
    <figure>
        <a href="PWBE/Aula10PHP/icatalogo/icatalogo-parte1/produtos"><img src="../imgs/logo.png" /></a>
    </figure>
    <form method="POST" action="">    
        <input type="search" name="pesquisar" placeholder="Pesquisar" />
        <button>
            <img src="../../imgs/lupa-de-pesquisa.svg" alt="">
        </button>
    </form>
    <?php
    if (!isset($_SESSION["usuarioId"])) {
    ?>
        <nav>
            <ul>
                <a id="menu-admin">Administrar</a>
            </ul>
        </nav>
        <div id="container-login" class="container-login">
            <h1>Fazer Login</h1>
            <form method="POST" action="/PWBE/Aula10PHP/icatalogo/icatalogo-parte1/componentes/header/acoesLogin.php">
                <input type="hidden" name="acao" value="login" />
                <input type="text" name="usuario" placeholder="Usuário" />
                <input type="password" name="senha" placeholder="Senha" />
                <button>Entrar</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <a id="menu-admin" onclick="logout()">Sair</a>
            </ul>
        </nav>
        <form id="form-logout" style="display:none" method="POST" action="/PWBE/Aula10PHP/icatalogo/icatalogo-parte1/componentes/header/acoesLogin.php">
            <input type="hidden" name="acao" value="logout" />
        </form>
    <?php
    }
    ?>
</header>
<script lang="javascript">
    document.querySelector("#menu-admin").addEventListener("click", toggleLogin);
    function logout(){
        document.querySelector("#form-logout").submit();
    }
    function toggleLogin() {
        let containerLogin = document.querySelector("#container-login");
        let h1Form = document.querySelector("#container-login > h1");
        let form = document.querySelector("#container-login > form");
        //se estiver oculto, mostra 
        if (containerLogin.style.opacity == 0) {
            h1Form.style.display = "block";
            form.style.display = "flex";
            containerLogin.style.opacity = 1;
            containerLogin.style.height = "200px";
            //se não, oculta
        } else {
            h1Form.style.display = "none";
            form.style.display = "none";
            containerLogin.style.opacity = 0;
            containerLogin.style.height = "0px";
        }
    }
</script>