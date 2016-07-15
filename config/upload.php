<?php
class Upload{

	// Diretorio do arquivo onde será feito o Upload
	public $diretorio = "docs/";

	// Enviando 7 Megas
	public $tamanho   = 7000000;

	// Extencao que permitidas no programa
	public $extencao  = array('jpeg','jpg','xls', 'xlsx', 'png','pdf');

	// Separador do nome do Arquivo
	public $separador = '-';




	function upload($arquivo , $tamanho , $tmp_nome , $tipo, $estado){
		$up = Upload::verificaTamanhoArquivo($arquivo , $tamanho , $tmp_nome , $tipo, $estado);
		if($up == 1){
			echo "<script>alert('Enviado com sucesso');</script>";
			return true;
		}else{
			return false;
		}
	}


	function verificaTamanhoArquivo($arquivo , $tamanho , $tmp_nome , $tipo, $estado){

		if($tamanho > $this->tamanho){
			echo "<script>alert('O Arquivo é grande, selecione outro !');</script>";
			return false;
		}else{

			$retorno = Upload::verificaTipoArquivo($arquivo , $tamanho , $tmp_nome , $tipo, $estado);
			if($retorno == 1){
				$nomeIndentificado = date('d-m-Y');
                $arquivo = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($arquivo))));
				$upload = move_uploaded_file($tmp_nome , $this->diretorio.$nomeIndentificado.$this->separador.$arquivo);

                $mysqlArq = addslashes(fread(fopen($this->diretorio.$nomeIndentificado.$this->separador.$arquivo, "r"), $tamanho));
                $nomeFinal = $this->diretorio.$nomeIndentificado.$this->separador.$arquivo;

                $nome = $nomeIndentificado.$this->separador.$arquivo;

                $con=mysqli_connect("localhost","root","1234","db_upload");

                $ext = pathinfo($arquivo, PATHINFO_EXTENSION);
                $tipo = $ext;

                $sql="INSERT INTO docs(arquivo, nomeFinal, nome, tipo, uf) VALUES('$mysqlArq', '$nomeFinal', '$nome', '$tipo', '$estado')";
                $result = mysqli_query($con,$sql);
				return 1;




			}else{
				echo "<script>alert('Extencao do arquivo invalida!!!');</script>";
				return 0;
			}
		}
	}

	function verificaTipoArquivo($arquivo , $tamanho , $tmp_nome , $tipo, $estado){
		$extencaoArquivo['extencao'] = explode('.' , $arquivo);
		if(in_array($extencaoArquivo['extencao'][1] , $this->extencao)){
			return 1;
		}else{
			return 0;
		}
	}

}
?>
