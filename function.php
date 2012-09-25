<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="Fundació Esportiva L'Hospitalet Atlètic" />
<meta name="keywords" content="FELHA, L'Hospitalet, Atlètic, Fundació, Esportiva, valors, equip, futbol, Llobregat, Javier Río Romero" />

<title>Fundació Esportiva L'Hospitalet Atlètic</title>
<link rel="stylesheet" type="text/css" href="../../css/reset.css"/>
<link rel="stylesheet" type="text/css" href="../../css/base.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../js/jquery.tipsy.js"></script>
<style type="text/css">html{background:#f8f8f8}</style>
</head>

<body>
	<div id="container">
	<div id="content">
	
		<div class="box alerts">
		<h2>Accions realitzades amb èxit</h2>
<?
//VARIABLES//
if (isset($_POST['title'])){
$author = stripslashes($_POST['author']);
$title = stripslashes($_POST['title']);
$content = stripslashes($_POST['content']);
$main =$_POST['main'];
$file=date("U");
$file= 9999999999-$file;

$link = stripslashes($_POST['link']);
if ($link !==""){
	if(strpos($link,'youtube')!==FALSE){
	$link_content='
	<div class="box" style="width:470px; height:300px; padding:10px">
		'.$link.'
	</div>';
	$link_content_es=$link_content;
	$fp=fopen("../../youtube/$file.txt","w+");
	fwrite($fp,$link);
	fclose($fp);
		}
	else{
		$link_content = '<p><a href="'.$link.'" target="_blank">Veure enllaç</a></p>';
		}
}
else{$link_content = "";}
if($main=="_main"){$change_main="selected"; $change_second=" ";}
else{$change_main=" "; $change_second="selected";}

$href = "news/".$file."/index.php";
$list_name = ','.$file.$main;

//DATE FORMAT//
$date_num = date("d/m/y");
$dateS = date ("Ymd");
$tieneCeroDiaMes = substr($dateS,6,1); 

if ($tieneCeroDiaMes == 0) { $diaMes = substr($dateS,7,1); } 
else { $diaMes = substr($dateS,6,2); }
$Mes_es = substr($dateS,4,2); 
$Mes_es = str_replace("01","Enero",$Mes_es); 
$Mes_es = str_replace("02","Febrero",$Mes_es); 
$Mes_es = str_replace("03","Marzo",$Mes_es); 
$Mes_es = str_replace("04","Abril",$Mes_es); 
$Mes_es = str_replace("05","Mayo",$Mes_es); 
$Mes_es = str_replace("06","Junio",$Mes_es); 
$Mes_es = str_replace("07","Julio",$Mes_es); 
$Mes_es = str_replace("08","Agosto",$Mes_es); 
$Mes_es = str_replace("09","Septiembre",$Mes_es); 
$Mes_es = str_replace("10","Octubre",$Mes_es); 
$Mes_es = str_replace("11","Noviembre",$Mes_es); 
$Mes_es = str_replace("12","Diciembre",$Mes_es);

$Mes = substr($dateS,4,2); 
$Mes = str_replace("01","Gener",$Mes); 
$Mes = str_replace("02","Febrer",$Mes); 
$Mes = str_replace("03","Març",$Mes); 
$Mes = str_replace("04","Abril",$Mes); 
$Mes = str_replace("05","Maig",$Mes); 
$Mes = str_replace("06","Juny",$Mes); 
$Mes = str_replace("07","Juliol",$Mes); 
$Mes = str_replace("08","Agost",$Mes); 
$Mes = str_replace("09","Setembre",$Mes); 
$Mes = str_replace("10","Octubre",$Mes); 
$Mes = str_replace("11","Novembre",$Mes); 
$Mes = str_replace("12","Desembre",$Mes);

$Anio = substr($dateS,0,4); 

$date =  $diaMes." de ".$Mes." de ".$Anio."";
$date_es = $diaMes." de ".$Mes_es." de ".$Anio."";
if($Mes=='Abril'||$Mes=='Agost'||$Mes=='Octubre'){
	$date = $diaMes." d'".$Mes." de ".$Anio."";	
}

//GENERATE  DIRECTORY//

mkdir("$file", 0777,true);

//GENERATE IMAGES & PDFs//
?>
<p>Si has adjuntat imatge per a la notícia, aquest element se't mostrarà en verd:</p>
<ul>
<?
$image = "/pics/".$file.".jpg";
if(is_uploaded_file($_FILES['image']['tmp_name'])){
	if(move_uploaded_file($_FILES['image']['tmp_name'], $image)) {echo '<li class="positive">La imatge s\'ha pujat correctament</li>'; $image_class = " "; $noimage = "style=\"display:none\" ";}
	else	{	echo "<li class='negative'>Hi ha hagut un problema en la pujada de la imatge, torna-ho a intentar.</li>";}
	}
else {echo '<li class="negative">No has seleccionat cap imatge</li>'; $image_class = "style=\"display:none\" "; $noimage = " ";}
?>
</ul>
<p>Informació detallada dels arxius penjats:</p>
<ul>

<?php 
   //Preguntamos si nuetro arreglo 'archivos' fue definido
         if (isset ($_FILES["archivos"])) {
         //de se asi, para procesar los archivos subidos al servidor solo debemos recorrerlo
         //obtenemos la cantidad de elementos que tiene el arreglo archivos
         $tot = count($_FILES["archivos"]["name"]);
         //este for recorre el arreglo
         for ($i = 0; $i < $tot; $i++){
         //con el indice $i, poemos obtener la propiedad que desemos de cada archivo
         //para trabajar con este
            $tmp_name = $_FILES["archivos"]["tmp_name"][$i];
            $name = $_FILES["archivos"]["name"][$i];  
			$archivo_title = stripslashes($_POST['archivo_title'][$i]);
			if($archivo_title ==NULL){$archivo_title =$_FILES["archivos"]["name"][$i];}
			$destino = "/docs/".$file."_".$i.".pdf";
			$check[$i]='';
				if(is_uploaded_file($_FILES["archivos"]["tmp_name"][$i])){
					if(move_uploaded_file($_FILES["archivos"]["tmp_name"][$i],$destino))
						{echo "<li class='positive'>S'ha penjat correctament <i>".$archivo_title."</i></li>"; $display[$i] = " "; $create = $destino; $hr[$i]="yes";}
					else{
						echo "<li class='negative'>Hi ha hagut un problema en la pujada de <i>".$archivo_title."</i>, torna-ho a intentar.</li>";}
		}
else {	echo "<li class='negative'>No s'ha seleccionat cap fitxer per al <i>PDF número ".$i."</i></li>"; $display[$i] = "style=\"display:none\" "; $hr[$i]="no";}
}
}      
?>





</ul>
<?
//GENERATE INDEX.HTML//
?>
<p>Més informació (aquests elements sempre han de mostrar-se en verd):</p>
		<ul>
<?

//GENERATE CHANGE FILE//
		$fp=fopen("$file.php","w+");
		if(fwrite($fp,$change)){echo "<li class='positive'>S'ha penjat el formulari editable de la notícia</li>";}
			else{echo "<li class='negative'> NO s'ha penjat el formulari editable de la notícia</li>";}
		fclose($fp);

//GENERATE FILES CATALA//
		$fp=fopen("../../src/ca/news/$file/title.html","w+");
		if(fwrite($fp,$title)){echo  "<li class='positive'>S'ha penjat el títol (versió català)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el títol (versió català)</li>";}
		fclose($fp);
		$fp=fopen("../../src/ca/news/$file/date.html","w+");
		if(fwrite($fp,$date)){echo  "<li class='positive'>S'ha penjat la data (versió català)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data (versió català)</li>";}
		fclose($fp);
		$fp=fopen("../../src/ca/news/$file/date_num.html","w+");
		if(fwrite($fp,$date_num)){echo  "<li class='positive'>S'ha penjat la data numèrica (versió català)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data numèrica (versió català)</li>";}
		fclose($fp);
		$fp=fopen("../../src/ca/news/$file/content.html","w+");
		if(fwrite($fp,$content)){echo  "<li class='positive'>S'ha penjat el cos (versió català)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el cos (versió català)</li>";}
		fclose($fp);
		$fp=fopen("../../src/ca/news/list.txt","a+");
		fwrite($fp,$list_name);	
		fclose($fp);
		$fp=fopen("../../src/ca/news/$file/href.html","w+");
		fwrite($fp,$href);	
		fclose($fp);
		$fp=fopen("../../src/ca/news/$file/index.php","w+");
		if(fwrite($fp,$index)){echo  "<li class='positive'>S'ha penjat la notícia (versió català)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la notícia (versió català)</li>";}
		fclose($fp);
		
//GENERATE FILES CASTELLA//
		$fp=fopen("../../src/es/news/$file/title.html","w+");
		if(fwrite($fp,$title_es)){echo  "<li class='positive'>S'ha penjat el títol (versió castellà)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el títol (versió castellà)</li>";}
		fclose($fp);
		$fp=fopen("../../src/es/news/$file/date.html","w+");
		if(fwrite($fp,$date_es)){echo  "<li class='positive'>S'ha penjat la data (versió castellà)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data (versió castellà)</li>";}
		fclose($fp);
		$fp=fopen("../../src/es/news/$file/date_num.html","w+");
		if(fwrite($fp,$date_num)){echo  "<li class='positive'>S'ha penjat la data numèrica (versió castellà)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la data numèrica (versió castellà)</li>";}
		fclose($fp);
		$fp=fopen("../../src/es/news/$file/content.html","w+");
		if(fwrite($fp,$content_es)){echo  "<li class='positive'>S'ha penjat el cos (versió castellà)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat el cos (versió castellà)</li>";}
		fclose($fp);
		$fp=fopen("../../src/es/news/list.txt","a+");
		fwrite($fp,$list_name);	
		fclose($fp);
		$fp=fopen("../../src/es/news/$file/href.html","w+");
		fwrite($fp,$href);	
		fclose($fp);
		$fp=fopen("../../src/es/news/$file/index.php","w+");
		if(fwrite($fp,$index_es)){echo  "<li class='positive'>S'ha penjat la notícia (versió castellà)</li>";}
			else{echo  "<li class='negative'>NO s'ha penjat la notícia (versió castellà)</li>";}
		fclose($fp);
}
?>
        
		</ul>
        <a class="gestio-new" href="news-form.php">Enrere</a>
		</div><!--end .box-->
	
	</div><!--end #content-->
	</div><!--end #container-->
</body>
</html>