let alumnos = [];
function fillDataset(data: object[]) {
    alumnos = data;
    let dataset = document.getElementById('alumnoList') as HTMLDataListElement;
    dataset.innerHTML = '';
    for (let item of data) {
        let option = document.createElement('option');
        option.value = item['id'];
        option.innerText = item['nombre'];
        dataset.appendChild(option)
    }
}

function getAlumnos(filtro:string) {
    let url = '/alumnos/search?filtro=' + filtro;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            fillDataset(data.data);
        });
}


function hideDatalist() {
    // Hide datalist and show input text with id alumnoInputText
    let filtro = document.getElementById('filtro') as HTMLInputElement;
    let alumnoInputText = document.getElementById('alumnoInputText') as HTMLInputElement;
    let alumnoList = document.getElementById('alumnoList') as HTMLDataListElement;
    let alumnoId = filtro.value;

    if (alumnoId !== '') {
        //find in global array alumnos the id
        let alumno = alumnos.filter(alumno => alumno.id == alumnoId);
        if (alumno.length > 0) {
            alumnoInputText.value = alumno[0].nombre;
            alumnoInputText.style.display = 'block';
            filtro.style.display = 'none';
            filtro.focus();
        }

    }

}


function init() {
    let input = document.getElementById('filtro') as HTMLInputElement;
    let alumnoInputText = document.getElementById('alumnoInputText') as HTMLInputElement;
    let alumnoList = document.getElementById('alumnoList') as HTMLDataListElement;
    //On alumnoInputText click call showDatalist
    alumnoInputText.addEventListener('click', function () {
       alumnoInputText.value = '';
       input.value = '';
       alumnoInputText.style.display = 'none';
       input.style.display = 'block';
    });


    //Event when datalist element changes value by clicking on it
    input.addEventListener('input', function () {
        if (input.value !== '') {
            //Check if a value is selected from the datalist
            let option = document.querySelector('option[value="' + input.value + '"]') as HTMLOptionElement;
            if (option) {
                hideDatalist();
            }
        }
    });
    input.addEventListener('keypress', function () {
        getAlumnos(input.value);
    });
}

init();
