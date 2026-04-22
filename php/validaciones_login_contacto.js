document.addEventListener("DOMContentLoaded", function(){
        const usuariocontactos = document.getElementById("usuarioicontacto");
        usuariocontactos.oninvalid = function(){
            usuariocontactos.setCustomValidity("Se requiere 8 números y una letra mayúscula");
        }
        usuariocontactos.oninput = function (){
            usuariocontactos.setCustomValidity("");
        }

        const contrasenacontactos = document.getElementById("contrasenacontacto");
        contrasenacontactos.oninvalid = function (){
            contrasenacontactos.setCustomValidity("Se requiere como mínimo 8 caracteres");
        }
        contrasenacontactos.oninput = function(){
            contrasenacontactos.setCustomValidity("");
        }
})