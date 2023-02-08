function fillDataset(data: object[]) {
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

function init() {
    let input = document.getElementById('filtro') as HTMLInputElement;
    input.addEventListener('keypress', function () {
        getAlumnos(input.value);
    });
}

init();
