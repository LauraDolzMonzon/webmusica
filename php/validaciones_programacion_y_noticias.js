              document.addEventListener("DOMContentLoaded", function () { /*Sirve para ejecutar JavaScript cuando el DOM de la página ya está cargado.*/
                /*noticias y progamacion*/
                const input6 = document.getElementById("noticiainventario");
                    input6.oninvalid = function () {
                            input6.setCustomValidity("Se requiere como mínimo 5 caracteres"); 

                    };
                    input6.oninput = function () {
                        input6.setCustomValidity("");
                    };
                
            
                const input7 = document.getElementById("lugar");
                input7.oninvalid = function () {
                        input7.setCustomValidity("Se requiere como mínimo 5 caracteres");       
                };
                input7.oninput = function () {
                        input7.setCustomValidity("");
                };
                //
               
                const input8 = document.getElementById("textoprogamacion");
                input8.oninvalid = function () {
                    input8.setCustomValidity("Se requiere como mínimo 8 caracteres");       
                };
                input8.oninput = function () {
                    input8.setCustomValidity("");
                };
                
                const input10 = document.getElementById("ano");
                input10.oninvalid = function () {
                    input10.setCustomValidity("Tiene que Tiene que tener 4 caracteres y solo números");       
                };
                input10.oninput = function () {
                    input10.setCustomValidity("");
                };
            
             
                

                const inputachivo = document.getElementById("achivo");
                inputachivo.oninvalid = function () {
                    inputachivo.setCustomValidity("Solo permite PDF");       
                };
                inputachivo.oninput = function () {
                   inputachivo.setCustomValidity("");
                 };
});                 