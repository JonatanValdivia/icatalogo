<?php
  include("../database/conexao.php");

  switch($_POST['acao']){
    case 'inserir':
        if(isset($_POST['descricao'])){
          $descricao = $_POST['descricao'];
          $sqlInsert = "INSERT INTO tbl_categoria (descricao) VALUES ('$descricao');";

          $resultado = mysqli_query($conexao, $sqlInsert);
          header('location: index.php');
        }

      break;
    
    case 'deletar':
      if(isset($_POST['categoriaId'])){
        $categoriaId = $_POST['categoriaId'];
        $sqlDelete = "DELETE FROM tbl_categoria WHERE id = $categoriaId";

        $resultado = mysqli_query($conexao, $sqlDelete);
        header('location: index.php');
      }
  }
?>