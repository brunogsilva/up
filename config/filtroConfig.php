<?php

    $con=mysqli_connect("localhost","root","1234","db_upload");


    /*
    $sql="SELECT * FROM docs";
    $result = mysqli_query($con,$sql);

    if (!isset($_GET['pg']))
    {
        $pg = 1;
    } else {
        $pg = $_GET['pg'];
    }


    if (!isset($_GET['filer']))
    {
        $pg = 1;
    } else {
        $pg = $_GET['filter'];
    }

    $sqlfilter =  "SELECT * FROM docs ";
    $filter = mysqli_query($con,$sqlfilter);
 */

        $select = $_POST["select"];
        $sqlll = "SELECT * FROM docs WHERE uf='$select'";

        $varResult= mysqli_query($con,$sqlll) or die( mysql_error() );

        $varContent = "<option value=''>-- Select --</option>\n";
		for($i=0;$row= $varResult->fetch_array() ;$i++)
		{
			$varCod=$row['uf'];
			$varContent = "<option value='".$varCod."'></option>\n";

		}
			echo $varContent;

?>
