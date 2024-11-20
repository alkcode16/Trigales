<script type="text/javascript">

function soloNumeros(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    numeros="1234567890";
    especiales="8-37-38-46";//array
    teclado_especial=false;

    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial=true;
        }
    }

    if(numeros.indexOf(teclado)==-1 && !teclado_especial){
        return false;

    }
}


function myFunction2() {
  if (confirm("¿Seguro que quere Salir?")) {
      location.href='cerrar_session.php';
  } else {

  }
  document.getElementById("demo").innerHTML = txt;
}

// Borrar Clientes
function borrarClientes(idCliente){
    if(confirm("¿Seguro que quiere eliminar a este usuario?")){
        //href="<?php //echo "eliminar.php?id=" . $datos->id_nombre?>"
        window.location=("eliminar.php?id="+ idCliente);
    }
}

function borrarPastel(idPastel){
    if(confirm("Seguro que quieres eliminar el siguiente pastel?")){
        window.location=("eliminar.php?id="+ idPastel);
    }
    
}


function deshabilitaRetroceso(){
     window.location.hash="no-back-button";
     window.location.hash="Again-No-back-button" //chrome
     window.onhashchange=function(){window.location.hash="no-back-button";}
}


function myFunction() {
  if (confirm("¿Seguro que quere volver al Menú?")) {
      location.href='../Menu2.php';
  } else {

  }
  document.getElementById("demo").innerHTML = txt;
}

//Esta funcion sirve para la hora y que se vaya a la salida

function myFunctionClientes() {
  if (confirm("¿Seguro que quere volver al Menú?")) {
      location.href='./redireccionar.php';
  } else {

  }
  document.getElementById("demo").innerHTML = txt;
}






</script>
