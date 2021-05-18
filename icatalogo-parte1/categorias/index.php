<?php
     include("../database/conexao.php");
     $sqlSelect = "SELECT * FROM tbl_categoria;";
     $resultado = mysqli_query($conexao, $sqlSelect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Administrar Categorias</title>
</head>

<body>
    <?php
    include("../componentes/header/header.php");
    ?>
    <div class="content">
        <section class="categorias-container">
            <main>
                <form method="POST" class="form-categoria" action="actionCategoria.php">
                    <h1 class="span2">Adicionar Categorias</h1>
                    <div class="input-group span2">
                        <label for="descricao">Descrição</label>
                        <input type="hidden" name="acao" value="inserir">
                        <input type="text" name="descricao" id="descricao" placeholder="Insira a descrição" required/>
                    </div>
                    <button onclick="javascript:window.location.href = '../../icatalogo-parte1/categorias/index.php'">Cancelar</button>
                    <button>Salvar</button>
                </form>
                <h1>Lista de Categorias</h1>
                <?php
                    while($categoria = mysqli_fetch_array($resultado)){
                ?>
                <div class="card-categorias">
                    <?= $categoria['descricao']?>
                    <form method="POST" action="actionCategoria.php">
                        <input type="hidden" name="acao" value="deletar">
                        <input type="hidden" name="categoriaId" value="<?= $categoria['id'] ?>"/>
                        <button>
                            <img src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png"/>
                        </button>
                    </form>
                </div>
                <?php
                    }
                ?>
            </main>
        </section>
    </div>
</body>

</html>