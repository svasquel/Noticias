<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="title" content="" />
<title>Pàgina de notícies</title>
<script type="text/javascript">
var numero = 0; //Esta es una variable de control para mantener nombres diferentes de cada campo creado dinamicamente.
evento = function (evt) { //esta funcion nos devuelve el tipo de evento disparado
   return (!evt) ? event : evt;
}

//Aqui se hace lamagia... jejeje, esta funcion crea dinamicamente los nuevos campos file
addCampo = function () { 
//Creamos un nuevo div para que contenga el nuevo campo
   nDiv = document.createElement('div');
//con esto se establece la clase de la div
   nDiv.className = 'archivo';
//este es el id de la div, aqui la utilidad de la variable numero
//nos permite darle un id unico
   nDiv.id = 'file' + (++numero);
//creamos el input para el formulario:
   nCampo = document.createElement('input');
//le damos un nombre, es importante que lo nombren como vector, pues todos los campos
//compartiran el nombre en un arreglo, asi es mas facil procesar posteriormente con php
   nCampo.name = 'archivos[]';
//Establecemos el tipo de campo
   nCampo.type = 'file';
   nTitle = document.createElement('input');
   nTitle.name = 'archivo_title[]';
//Ahora creamos un link para poder eliminar un campo que ya no deseemos
   a = document.createElement('a');
//El link debe tener el mismo nombre de la div padre, para efectos de localizarla y eliminarla
   a.name = nDiv.id;
//Este link no debe ir a ningun lado
   a.href = '#';
//Establecemos que dispare esta funcion en click
   a.onclick = elimCamp;
//Con esto ponemos el texto del link
   a.innerHTML = 'Eliminar';
//Bien es el momento de integrar lo que hemos creado al documento,
//primero usamos la función appendChild para adicionar el campo file nuevo
   nDiv.appendChild(nCampo);
   nDiv.appendChild(nTitle);
//Adicionamos el Link
   nDiv.appendChild(a);
//Ahora si recuerdan, en el html hay una div cuyo id es 'adjuntos', bien
//con esta función obtenemos una referencia a ella para usar de nuevo appendChild
//y adicionar la div que hemos creado, la cual contiene el campo file con su link de eliminación:
   container = document.getElementById('adjuntos');
   container.appendChild(nDiv);
}
//con esta función eliminamos el campo cuyo link de eliminación sea presionado
elimCamp = function (evt){
   evt = evento(evt);
   nCampo = rObj(evt);
   div = document.getElementById(nCampo.name);
   div.parentNode.removeChild(div);
}
//con esta función recuperamos una instancia del objeto que disparo el evento
rObj = function (evt) { 
   return evt.srcElement ?  evt.srcElement : evt.target;
}
</script>   
</head>

<body>
    <form id="news" action="function.php" method="post" enctype="multipart/form-data">
        <label>El teu nom</label> <input name="author" id="author" placeholder=" " required="">
        <fieldset>
        	<label>Posa un títol</label><input name="title" id="title" placeholder=" " required="">
        	<label>Escriu el cos</label><textarea name="content" id="content" placeholder=" " required=""></textarea>
        </fieldset>
        
        <label>Enllaç o vídeo</label> <textarea name="link" id="link" placeholder=" "></textarea>
      
        <label>Imatge</label><input name="image" id="image" type="file">
       
   <dt><label>Archivos a Subir:</label></dt>
        <!-- Esta div contendrá todos los campos file que creemos -->
   <dd><div id="adjuntos">
        <!-- Hay que prestar atención a esto, el nombre de este campo debe siempre terminar en []
        como un vector, y ademas debe coincidir con el nombre que se da a los campos nuevos 
        en el script -->
   <input type="file" name="archivos[]" /><br />
   <input name="archivo_title[]" /><br />
   </div></dd>
   <dt><a href="#" onClick="addCampo()">Subir otro archivo</a></dt>      
     </dl>
         
        <br>
        <div class="form-ex" style="margin-top:21px">Si vols que aquesta notícia, juntament amb els seus arxius, tingui més rellevància a la secció Documents, marca la casella</div><input type="checkbox" name="important" value="ok"> 
        <br>
 	          
        <div class="form-ex">
        Finalment, determina la posició de la notícia en la plana principal de la web segons la seva rellevància. Si escolleixes l'opció <b>Notícia secundària</b>, aquesta no ocuparà l'espai ampliat de l'inici.
        </div>
       
        <select name="main">
            <option value="_main">Notícia principal</option>
            <option value="">Notícia secundària</option>
        </select>
        
        <div class="upload form-submit">Enviar<button type="submit" name="enviar">Enviar</button></div>
    </form>
</body>
</html>