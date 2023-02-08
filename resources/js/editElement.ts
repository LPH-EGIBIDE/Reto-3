function enableFields(form : HTMLFormElement){
    form.querySelectorAll('input, select, textarea, button').forEach((element) => {
        if (element.getAttribute('disabled') != null){
            element.removeAttribute('disabled');
        }
    });
}


function disableFields(form : HTMLFormElement){
    form.querySelectorAll('input, select, textarea, button').forEach((element) => {
        if (element.getAttribute('disabled') == null){
            element.setAttribute('disabled', 'disabled');
        }
    });
}

function initEditElement(){
    let form = document.getElementById('editForm') as HTMLFormElement;
    let editButton = document.getElementById('editButton') as HTMLButtonElement;

    editButton.addEventListener('click', function(){
        let buttonSpan = editButton.querySelector('span') as HTMLSpanElement;
        if (buttonSpan.innerText == 'Editar'){
            editButton.classList.add('btn-danger');
            editButton.classList.remove('btn-primary');
            buttonSpan.innerText = 'Dejar de editar';
            enableFields(form);
        }else{
            editButton.classList.add('btn-primary');
            editButton.classList.remove('btn-danger');
            buttonSpan.innerHTML = 'Editar';
            disableFields(form);
        }
    });
}

window.addEventListener('load', initEditElement);
