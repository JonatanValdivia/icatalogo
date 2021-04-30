<?php
  require("../../database/conexao.php");

  switch(isset($_POST["acao"])){

    case "inserir": 
      if(isset($_POST["descricaoInserir"]) && isset($_POST["pesoInserir"]) && isset($_POST["quantidadeInserir"]) && isset($_POST["corInserir"]) && isset($_POST["tamanhoInserir"]) && isset($_POST["valorInserir"]) && isset($_POST["descontoInserir"])){
        $descricao = $_POST["descricaoInserir"];
        $peso = $_POST["pesoInserir"];
        $quantidade = $_POST["quantidadeInserir"];
        $cor = $_POST["corInserir"];
        $tamanho = $_POST["tamanhoInserir"];
        $valor = $_POST["valorInserir"];
        $desconto = $_POST["descontoInserir"];
        //declara o SQL inserção
        $sqlInsert = " INSERT INTO tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto) VALUES ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto ) ";
        //Executa o SQL
        $resultado = mysqli_query($conexao, $sqlInsert);

      }
      break;
      default:
      die("Ops, ação inválida");
      break;
  }
header("location: index.php");

 