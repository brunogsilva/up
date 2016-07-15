<?php

//require('config/mysqli.php');


if(isset($_POST['submit']))
{
	include('config/upload.php');
    $estado =  $_POST['uf'];
	$upload = new Upload($_FILES['arquivo']['name'] , $_FILES['arquivo']['size'] , $_FILES['arquivo']['tmp_name'] , $_FILES['arquivo']['type'], $estado);


}



?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Upload</title>
	<link href="css/estilo.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>



    <div class="container">

        <div>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                    <h2>Upload </h2>
                    <div class="editor-label form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class=" btn btn-default btn-file">
                                    Carregar <input type="file" name="arquivo" id="data">
                                </span>
                            </span>
                            <input type="text" id="carregar" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="editor-label">
                        <div class="form-group">
                            <select class="form-control select-estado" name="uf" id="uf">
                                <option value="">Selecione o Estado</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AM">AM</option>
                                <option value="AP">AP</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MG">MG</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="PR">PR</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SE">SE</option>
                                <option value="SP">SP</option>
                                <option value="TO">TO</option>
                             </select>
                        </div>
                    </div>
                    <span class="bt-enviar ">
                        <input type="submit" name="submit" class="btn btn-primary" value="Enviar" id="submit"/>
                    </span>
            </form>
        </div>
        <h2>Lista dos Arquivos </h2>
        <div class="jumbotron">
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <select class="form-control select-filtro" name="select" id="select">
                        <option value="">Filtrar</option>

                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AM">AM</option>
                        <option value="AP">AP</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="PR">PR</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                        <option value="TO">TO</option>
                     </select>
                </div>
                <div id="testee"></div>
            </form>

        </div>
        <table class="table table-striped">


            <tbody>
                <?php

                    include('config/paginacaoConfig.php');
                    while($arquivo = $limite->fetch_array()) {

                ?>

                  <tr>
                        <td><?php echo $arquivo["nome"] ; ?></td>
                        <?php
                            if($arquivo["tipo"] == "xlsx" || $arquivo["tipo"] == "xls") {
                        ?>
                            <td><?php echo "<a disabled class='link-disabled'> Visualizar </a><br />"; ?></td>
                        <?php
                            } else {
                        ?>
                            <td><?php echo "<a href='".$arquivo["nomeFinal"]."'> Visualizar </a><br />"; ?></td>
                        <?php
                            }
                        ?>
                        <td><?php echo "<a href='config/download.php?arquivo=../".$arquivo["nomeFinal"]."'> Baixar </a><br />"; ?></td>
                  </tr>

                <?php

                    }

                ?>

            </tbody>
        </table>
        <?php
            include("config/paginacao.php");
        ?>
    </div>





    <script type="text/javascript">

        $(document).ready(function () {
            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
                console.log(numFiles);
                console.log(label);
                $("#carregar").val(label);
            });


            $('#select').change(
                function()
                {
                    $.post(
                        'config/paginacaoConfig.php',{select:$(this).val()},function(resposta)
                        {
                            $('#testee').html(resposta);
                        }
                    );
                }
            );

        });

    </script>

</body>
</html>
