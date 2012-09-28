// JavaScript Document
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