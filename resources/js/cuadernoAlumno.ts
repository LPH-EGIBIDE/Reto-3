
function getWeek(){
    let form = document.getElementById("formWeek") as HTMLFormElement;
    let formData = new FormData(form);
    const params = new URLSearchParams((<string[][] | Record<string, string> | string | URLSearchParams>formData));

    fetch(form.action + "?" + params).then(function(response){
        return response.json();
    }).then(function(data){
        if (!data.error){
            fillData(data);
        }
    });
}

function fillData(data){
    let observaciones = document.getElementById("textAreaObservaciones") as HTMLTextAreaElement;
    let actividades = document.getElementById("textAreaActividades") as HTMLTextAreaElement;
    let reflexiones = document.getElementById("textAreaReflexion") as HTMLTextAreaElement;
    let problemas = document.getElementById("textAreaProblemas") as HTMLTextAreaElement;
    let semanaHidden = document.getElementById("semanaHidden") as HTMLInputElement;

    observaciones.value = data.observaciones;
    actividades.value = data.contenido_actividades;
    reflexiones.value = data.contenido_reflexion;
    problemas.value = data.contenido_problemas;
    semanaHidden.value = data.semana;

}

function initEvents(){
    let form = document.getElementById("formWeek") as HTMLFormElement;
    form.addEventListener("change", function(event){
        getWeek();
    });
}

window.addEventListener("load", initEvents);
