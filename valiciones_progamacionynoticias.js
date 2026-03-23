              document.addEventListener("DOMContentLoaded", function () { /*Sirve para ejecutar JavaScript cuando el DOM de la página ya está cargado.*/
                /*noticias y progamacion*/
                const input6 = document.getElementById("noticiainventario");
                    input6.oninvalid = function () {
                            input6.setCustomValidity("Se reciere como mínimo 5 caracteres"); 

                    };
                    input6.oninput = function () {
                        input6.setCustomValidity("");
                    };
                
            
                const input7 = document.getElementById("lugar");
                input7.oninvalid = function () {
                        input7.setCustomValidity("Se reciere como mínimo 8 caracteres");       
                };
                input7.oninput = function () {
                        input7.setCustomValidity("");
                };
                
                
                const input8 = document.getElementById("textoprogamacion");
                input8.oninvalid = function () {
                    input8.setCustomValidity("Se reciere como mínimo 8 caracteres");       
                };
                input8.oninput = function () {
                    input8.setCustomValidity("");
                };
                
                const input10 = document.getElementById("ano");
                input10.oninvalid = function () {
                    input10.setCustomValidity("Tiene que tener 4 caracetes y solo numeros");       
                };
                input10.oninput = function () {
                    input10.setCustomValidity("");
                };
            
                const inputprofesor = document.getElementById("profesor");
                inputprofesor.oninvalid = function () {
                    inputprofesor.setCustomValidity("solo debe tener letras y más de 3 letras");       
                };
                inputprofesor.oninput = function () {
                    inputprofesor.setCustomValidity("");
                };
                

                const inputachivo = document.getElementById("achivo");
                inputachivo.oninvalid = function () {
                    inputachivo.setCustomValidity("Solo permite pdf");       
                };
                inputachivo.oninput = function () {
                   inputachivo.setCustomValidity("");
                 };
});                 