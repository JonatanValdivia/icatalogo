<?php

?>
<link rel="stylesheet" href="/PWBE/Aula10PHP/icatalogo-parte1/componentes/header/header.css">
<header class="header">
  <figure>
    <img src="../imgs/logo.png" alt="Logo">
  </figure>
  <input type="search" placeholder="Pesquisar" />
  <nav>
    <ul>
      <a id="menu-admin">Administrar</a>
    </ul>
  </nav>
  <div class="container-login" id="container-login">
    <h1>Fazer Login</h1>
    <form method="POST" action="/PWBE/Aula10PHP/icatalogo-parte1/componentes/header/acoesLogin.php">
      <input type="hidden" name="acao" value="login"/>
      <input type="text" name="usuario" placeholder="Usuário" />
      <input type="password" name="senha" placeholder="Senha" />
      <button>Entrar</button>
    </form>
  </div>
</header>

<script lang="javascript">
  document.querySelector("#menu-admin").addEventListener("click", toggleLogin);
  function toggleLogin() {
    let containerLogin = document.querySelector("#container-login");
    //se estiver oculto, mostra 
    if (containerLogin.style.opacity == 0) {
      containerLogin.style.opacity = 1;
      containerLogin.style.height = "200px";
      //se não, oculta
    } else {
      containerLogin.style.opacity = 0;
      containerLogin.style.height = "0px";
    }
  }
</script>