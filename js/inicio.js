//==============================Login=======================================
//Carga el DOM de la pagina primero
document.addEventListener("DOMContentLoaded", function() {
    //Espera a que el elemento formulario mande el formulario para llamar a la funcion validarFormulario
    document.getElementById("formulario").addEventListener('submit', validarFormulario); 
  });

function validarFormulario(evento) {
    evento.preventDefault();
    //Obteber los valores de usuario y contraseña
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('password').value;

    //Validaciones, en su momento será con base de datos, de momento se hara con admin/admin
    if(usuario == "admin" && password=="admin"){
        alert("Usuario correcto");
        window.location = "pagina_principal.html";
        return;
    }
    else{
        alert("Usuario incorrecto");

    }
    this.submit();
  }
//=======================Registra usuario=====================================

document.addEventListener("DOMContentLoaded", function() {
    //Espera a que el elemento formulario mande el formulario para llamar a la funcion validarFormulario
    document.getElementById("form").addEventListener('submit', validarRegistro); 
  });

function validarRegistro(evento){
    var nombre = document.getElementById("name");
    var email = document.getElementById("email");
    var pass = document.getElementById("password2");
    var repass = document.getElementById("repassword");
    var parrafo =  document.getElementById("warnings");

    evento.preventDefault();//Prevenir que se envíe el formulario al inicio
    let warnings = "";
    let entrar=false;
    let regexEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let regexPass= /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/
    parrafo.innerHTML ="";

    if(nombre.value.length < 6){//El nombre de usuario tiene que tener al menos 6 caracteres
        alert("Usuario incorrecto, debe de tener minimo 6 caracteres. ");
        warnings += `El nombre es muy corto <br>`;//Esto es para añadir texto a la página
        entrar=true;
    }
    if(!regexEmail.test(email.value)){//Evalua el email con la expresion regular
        alert("Email incorrecto, ingrese nuevamente. ");
        warnings += `El email no es valida <br>`;
        entrar=true;
    } 
    if(!regexPass.test(pass.value)){
        alert("Contraseña incorrecta, debe ser de al menos 8 caracteres y debe tener numeros y letras. ");
        warnings += ` Contraseña incorrecta. <br>`;
        entrar=true;
    }
    if(repass.value != pass.value){
        alert("Contraseñas no coinciden ");
        warnings += `Las contraseñas no coinciden <br>`;
        entrar=true;
    }

    if(!entrar){
        alert("Usuario registrado con exito.");
        window.location="pagina_principal.html";
        return;
    }
    else{
        parrafo.innerHTML = warnings;
        return false;
    }

    this.submit();
}
