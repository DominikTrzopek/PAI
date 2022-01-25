const form = document.querySelector("form");
const button = form.querySelector('p[name="upladButton"]');
const quizTime = form.querySelector('input[name="time"]')

function getFileData(myFile){
    const file = myFile.files[0];
    button.innerHTML = "Uploaded: "+file.name;
}

function isNumber(quizTime){
    return !isNaN(quizTime);
}


quizTime.addEventListener('keyup', function (){
    setTimeout(function (){
        markValidation(quizTime, isNumber(quizTime.value));
    },100);
});