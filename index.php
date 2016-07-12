<?php

//require('config/mysqli.php');


if(isset($_POST['submit']))
{
	include('config/upload.php');
	$upload = new Upload($_FILES['arquivo']['name'] , $_FILES['arquivo']['size'] , $_FILES['arquivo']['tmp_name'] , $_FILES['arquivo']['type']);

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Upload</title>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link href="css/estilo.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>



    <div class="container">

        <div>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                    <h2>Upload </h2>
                    <div class="editor-label">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class=" btn btn-default btn-file">
                                    Carregar <input type="file" name="arquivo" id="data">
                                </span>
                            </span>
                            <input type="text" id="carregar" class="form-control" readonly />
                        </div>
                    </div>
                    <span class="bt-enviar ">
                        <input type="submit" name="submit" class="btn btn-primary" value="Upload" id="submit"/>
                    </span>
            </form>
        </div>
        <h2>Lista dos Arquivos </h2>
        <table class="table table-striped">


            <tbody>
                <?php

                    include('config/paginacaoConfig.php');
                    while($arquivo = $limite->fetch_array()) {

                ?>

                  <tr>
                        <td><?php echo $arquivo["nome"] ; ?></td>
                        <td><?php echo "<a href='".$arquivo["nomeFinal"]."'> Visualizar </a><br />"; ?></td>
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
    });

</script>

</body>
</html>
