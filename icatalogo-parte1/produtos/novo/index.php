<?php
  include ("../../database/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../styles-global.css" />
  <link rel="stylesheet" href="./novo.css" />
  <title>Administrar Produtos</title>
</head>

<body>
  <header>
    <input type="search" placeholder="Pesquisar" />
  </header>
  <div class="content">
    <section class="produtos-container">
      <main>
        <form method="POST" class="form-produto" action="icatalogoActions.php">
          <h1>Cadastro de produto</h1>
          <div class="input-group span2">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricaoInserir" id="descricao" placeholder="Digite a descrição do produto" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="peso">Peso</label>
            <input type="text" name="pesoInserir" id="peso" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="quantidade">Quantidade</label>
            <input type="text" name="quantidadeInserir" id="quantidade" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="cor">Cor</label>
            <input type="text" name="corInserir" id="cor" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="tamanho">Tamanho</label>
            <input type="text" name="tamanhoInserir" id="tamanho">
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="valor">Valor</label>
            <input type="text" name="valorInserir" id="valor" required>
          </div>
          <div class="input-group">
            <input type="hidden" name="acao" value="inserir"/>
            <label for="desconto">Desconto</label>
            <input type="text" name="descontoInserir" id="desconto">
          </div>
          <button onclick="javascript:window.location.href = '../'">Cancelar</button>
          <button>Salvar</button>
        </form>
      </main>
    </section>
  </div>
  <footer>
    SENAI 2021 - Todos os direitos reservados
  </footer>
</body>

</html>