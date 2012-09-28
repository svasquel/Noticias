<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="base.css"/>
<script type="text/javascript" src="functions.js"></script>
<title>Pàgina de notícies</title>
</head>
<body>
    <form class="box" id="news" action="function.php" method="post" enctype="multipart/form-data">
        <label>El teu nom</label> <input name="author" id="author">
        <fieldset>
        	<label>Posa un títol</label><input name="title" id="title">
        	<label>Escriu el cos</label><textarea name="content" id="content"></textarea>
        </fieldset>
        
        <label>Enllaç o vídeo</label> <textarea name="link" id="link"></textarea>
      
        <label>Imatge</label><input name="image" id="image" type="file">
       
   <label>Arxius per pujar amb nom (petit comentari):</label>
   <div id="adjuntos">
   	<div class="archivo">
       <input type="file" name="archivos[]" />
       <input name="archivo_title[]" class="input_file"/>
   	</div>
   </div>
   <a href="#" onClick="addCampo()">Pujar un altre arxiu</a>

    <button type="submit" name="enviar">Enviar</button>
    </form>
</body>
</html>
