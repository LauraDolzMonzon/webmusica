              document.addEventListener("DOMContentLoaded", function () { /*Sirve para ejecutar JavaScript cuando el DOM de la página ya está cargado.*/

                
                const inputinstrumetro = document.getElementById("Intrumetroivenatario");
                inputinstrumetro.oninvalid = function () {
                    inputinstrumetro.setCustomValidity("Solo puede conterne letras");       
                };
                inputinstrumetro.oninput = function () {
                   inputinstrumetro.setCustomValidity("");
                };
                const input22 = document.getElementById("invetariounidades");
                input22.oninvalid = function () {
                    input22.setCustomValidity("Solo puede conterne numeros");       
                };
                input22.oninput = function () {
                    input22.setCustomValidity("");
                };
                const input23 = document.getElementById("invetarioanodeadquision");
                input23.oninvalid = function () {
                    input23.setCustomValidity("Solo puede conterne numeros y cuarto caraceteres");       
                };
                input23.oninput = function () {
                    input23.setCustomValidity("");
                };
});                      