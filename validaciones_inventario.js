

              document.addEventListener("DOMContentLoaded", function () { /*Sirve para ejecutar JavaScript cuando el DOM de la página ya está cargado.*/

                
                const inputinstrumetro = document.getElementById("Intrumetroivenatario");
                inputinstrumetro.oninvalid = function () {
                    inputinstrumetro.setCustomValidity("Solo puede contener letras");       
                };
                inputinstrumetro.oninput = function () {
                   inputinstrumetro.setCustomValidity("");
                };
                const input22 = document.getElementById("invetariounidades");
                input22.oninvalid = function () {
                    input22.setCustomValidity("Solo puede contener números");       
                };
                input22.oninput = function () {
                    input22.setCustomValidity("");
                };
                
});                      