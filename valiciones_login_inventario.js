              document.addEventListener("DOMContentLoaded", function () { /*Sirve para ejecutar JavaScript cuando el DOM de la página ya está cargado.*/
                /*noticias y progamacion*/

             
                    /*login formulario invetario*/

                const usuarioInput = document.getElementById("usuarioinventario");
                usuarioInput.oninvalid = function () {
                    usuarioInput.setCustomValidity("Se requiere como mínimo 9 caracteres y solo mayúsculas/números");
                };
                usuarioInput.oninput = function () {
                    usuarioInput.setCustomValidity("");
                };

                const contrasenaInput = document.getElementById("contrasenainventario");
                contrasenaInput.oninvalid = function () {
                    contrasenaInput.setCustomValidity("Se requiere como mínimo 8 caracteres");
                };
                contrasenaInput.oninput = function () {
                    contrasenaInput.setCustomValidity("");
                };

});
