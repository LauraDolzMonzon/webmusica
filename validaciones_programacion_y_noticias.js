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
                const inputfecha = document.getElementById("Fechainventario");
                inputfecha.addEventListener("change", function() {
                  const min = "1900-01-01";
                  const max = "2100-12-31";
                  if (inputfecha.value < min || inputfecha.value > max) {
                    inputfecha.setCustomValidity("Fecha entre 1900-01-01 y 2100-12-31");
                  } else {
                    inputfecha.setCustomValidity("");
                  }
                }); 
                 const inputtextonoticia = document.getElementById("textonoticia");
                inputtextonoticia.oninvalid = function () {
                        inputtextonoticia.setCustomValidity("Se requiere como mínimo 8 caracteres");       
                };
                inputtextonoticia.oninput = function () {
                        inputtextonoticia.setCustomValidity("");
                };  
            

               
                // 
               
                const input8 = document.getElementById("textoprogamacion");
                input8.oninvalid = function () {
                    input8.setCustomValidity("Se requiere como mínimo 8 caracteres");       
                };
                input8.oninput = function () {
                    input8.setCustomValidity("");
                };
                
                const input102 = document.getElementById("ano");
                input102.oninvalid = function () {
                    input102.setCustomValidity("Tiene que Tiene que tener 4 caracteres y solo números");       
                };
                input102.oninput = function () {
                    input102.setCustomValidity("");
                };
                
            
             
                

                const inputachivo = document.getElementById("achivo");
                inputachivo.oninvalid = function () {
                    inputachivo.setCustomValidity("Solo permite PDF");       
                };
                inputachivo.oninput = function () {
                   inputachivo.setCustomValidity("");
                 };
    
    document.getElementById("formularionoticiaid").addEventListener("submit", function(e) {
    if (!validarAno()) {
        e.preventDefault();
    }
});

document.getElementById("formularionoticiaid").addEventListener("submit", function(e) {
    if (!validarPDF()) {
        e.preventDefault();
    }
});
});

          