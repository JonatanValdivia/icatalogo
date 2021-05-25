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
    if(!isset($_POST["valorInserir"]) && $_POST["valorInserir"] != "" && !is_numeric(str_replace(",", ".", $_POST["valorInserir"]))){
      $erros[] = "O campo desconto deve ser um número";
    }
    if(!is_numeric(str_replace(",", ".", $_POST["descontoInserir"]))){
      $erros[] = "O campo desconto deve ser um número";
    }

    //Verificar se o campo foto está vindo e se ele é uma imagem
    if($_FILES["foto"]["error"] == UPLOAD_ERR_NO_FILE){
      $erros = "Você precisa enviar uma imagem";
    } else{
      //Se for um arqivo, verificar se é uma imagem
        $imagemInfos = getimagesize($_FILES["foto"]["tmp_name"]);
    //Se não for uma imagem, exibir o erro
    if(!$imagemInfos){
      $erros = "O arquivo precisa ser uma imagem";
    }
    //Se a imagem for maior que 2MB
    if($_FILES["foto"]["size"] > 1024 * 1024 * 2) {
      $erros[] = "O arquivo não pode ser maior que 2MB";
    }
      //Se a imagem não for quadrada = desafio
      $width = $imagemInfos[0];
      $height = $imagemInfos[1];
    if($width != $height){
      $erros[] = "A imagem precisa ser quadrada!";
    }
      //se a largura e a altura forem iguais, a imagem é quadrada
    }
    if(!isset($_POST['categoria']) || $_POST['categoria'] == ""){
      $erros[] = "O campo categoria é obrigatório";
    }

    return $erros;
  }
  switch(isset($_POST["acao"])){

    case "inserir": 
      $erros = validarErros();
      if(count($erros) > 0){
        $_SESSION["erros"] = $erros;
        header("location: index.php?erros=$erros");
        exit();
      }
        if(isset($_POST["descricaoInserir"]) && isset($_POST["pesoInserir"]) && isset($_POST["quantidadeInserir"]) && isset($_POST["corInserir"]) && isset($_POST["tamanhoInserir"]) && isset($_POST["valorInserir"]) && isset($_POST["descontoInserir"]))
        {
          //Pegamos o nome original do arquivo
          $nomeArquivo = $_FILES["foto"]["name"];
          //Extraímos do nome original a estensão
          $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
          //Geramos um novo nome único para o arquivo, através do md5(criptografia) e também com o microtime
          $novoNomeArquivo = md5(microtime()) . "$extensao";
          //Movemos a foto para a pasta de fotos dentro de produtos/novo
          move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/$novoNomeArquivo");
          //////
          $descricao = $_POST["descricaoInserir"];
          $peso = str_replace(',','.',  $_POST["pesoInserir"]);
          $quantidade = $_POST["quantidadeInserir"];
          $cor = $_POST["corInserir"];
          $tamanho = $_POST["tamanhoInserir"];
          $valor = str_replace(",",".", $_POST["valorInserir"]);
          $desconto = $_POST["descontoInserir"] != "" ? $_POST["descontoInserir"] : 0;
          $categoriaId = $_POST['categoria'];
          //Receber o id da categoria

          //salvar o id da categoria no produto

          //declara o SQL inserção
          $sqlInsert = " INSERT INTO tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto, imagem, categoria_id) VALUES ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto, '$novoNomeArquivo', $categoriaId)";
          //Executa o SQL
          $resultado = mysqli_query($conexao, $sqlInsert) or die (mysqli_error($conexao));

          if($resultado){
            $mensagem = "Produto inserido com sucesso!";
          }else{
            $mensagem = "Erro ao inserir o produto";
          }
          $_SESSION['mensagem'] = $mensagem;
        }
      
      break;
      default:
        die("Ops, ação inválida");
      break;
  }
header("location: index.php");

 