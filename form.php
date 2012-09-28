<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="base.css"/>

<title>Pàgina de notícies</title>
<script type="text/javascript">
var numero = 0;
evento = function(evt){return (!evt) ? event : evt;}
addCampo = function () { 
   nDiv = document.createElement('div');
   nDiv.className = 'archivo';
   nDiv.id = 'file' + (++numero);
   nCampo = document.createElement('input');
   nCampo.name = 'archivos[]';
   nCampo.type = 'file';
   nTitle = document.createElement('input');
   nTitle.name = 'archivo_title[]';
   nTitle.className = 'input_file';
   a = document.createElement('a');
   a.name = nDiv.id;
   a.href = '#';
   a.onclick = elimCamp;
   a.innerHTML = 'Eliminar';
   nDiv.appendChild(nCampo);
   nDiv.appendChild(nTitle);
   nDiv.appendChild(a);
   container = document.getElementById('adjuntos');
   container.appendChild(nDiv);
}
elimCamp = function (evt){
   evt = evento(evt);
   nCampo = rObj(evt);
   div = document.getElementById(nCampo.name);
   div.parentNode.removeChild(div);
}
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}
</script>   
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
