function markValidation(element, condition){
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
    if(!element.value){
        element.classList.remove('no-valid');
    }
}