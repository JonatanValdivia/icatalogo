 <?php
  session_start();
  //sessão é um vínculo entre o navergador e o servidor.
  require("../../database/conexao.php");

  function validarErros(){
    $erros = [];
    if(!isset($_POST["descricaoInserir"]) && $_POST["descricaoInserir"] == ""){
      $erros[] = "O campo de descrição é obrigatório!";
    }
    if(!isset($_POST["pesoInserir"]) && $_POST["pesoInserir"] == ""){
      $erros[] = "O campo peso é obrigatório!";
              //is_numeric() -> testa para ver se um número é realmente um número. E converte também uma string (apenas com números) em number também
    //Analogia: senão se não for um número que tenha a troca de ponto para vírgula, então exiba a mensagem de erro.
    }if(!is_numeric(str_replace(",", ".", $_POST["pesoInserir"]))){
     $erros[] = "O campo peso deve ser um número";
    }
    if(!isset($_POST["quantidadeInserir"]) && $_POST["quantidadeInserir"] == ""){
      $erros[] = "O campo quantidade é obrigatório!";
    }
    if(!is_numeric(str_replace(",", ".", $_POST["quantidadeInserir"]))){
     $erros[] = "O campo quantidade deve ser um número";
    }
    if(!isset($_POST["corInserir"]) && $_POST["corInserir"] == ""){
      $erros[] = "O campo cor é obrigatório!";
    }
    if(!isset($_POST["tamanhoInserir"]) && $_POST["tamanhoInserir"] == ""){
      $erros[] = "O campo cor é obrigatório!";
    }
    if(isset($_POST["valorInserir"]) && $_POST["valorInserir"] != "" && !is_numeric(str_replace(",", ".", $_POST["valorInserir"]))){
      $erros[] = "O campo desconto deve ser um número";
    }
    return $erros;
  }
  switch(isset($_POST["acao"])){

    case "inserir": 
      $erros = validarErros();
      if(count($erros) > 0){
        $_SESSION["erros"] = $erros;
        header("location: index.php?erros=$erros");
      }
        if(isset($_POST["descricaoInserir"]) && isset($_POST["pesoInserir"]) && isset($_POST["quantidadeInserir"]) && isset($_POST["corInserir"]) && isset($_POST["tamanhoInserir"]) && isset($_POST["valorInserir"]) && isset($_POST["descontoInserir"]))
        {
          $descricao = $_POST["descricaoInserir"];
          $peso = str_replace(',','.',  $_POST["pesoInserir"]);
          $quantidade = $_POST["quantidadeInserir"];
          $cor = $_POST["corInserir"];
          $tamanho = $_POST["tamanhoInserir"];
          $valor = str_replace(",",".", $_POST["valorInserir"]);
          $desconto = $_POST["descontoInserir"] != "" ? $_POST["descontoInserir"] : 0;
          //declara o SQL inserção
          $sqlInsert = " INSERT INTO tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto) VALUES ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto ) ";
          //Executa o SQL
          $resultado = mysqli_query($conexao, $sqlInsert) or die (mysqli_error($conexao));

          if($resultado){
            $mensagem = "Produto inserido com sucesso!";
          }else{
            $mensagem = "Erro ao inserir o produto";
          }
        }
      
      break;
      default:
      die("Ops, ação inválida");
      break;
  }
header("location: index.php");

 