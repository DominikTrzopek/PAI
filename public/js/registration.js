const form = document.querySelector('form[name="formJS"]');
const emailInput = form.querySelector('input[name="email"]');
const confirmPassword  = form.querySelector('input[name="passwordRepeat"]');

function isEmail(email){
    return /\S+@\S+\.\S/.test(email);
}

function arePassSame(password,confirmPassword){
    return password === confirmPassword;
}

emailInput.addEventListener('keyup', function (){
    setTimeout(function (){
        markValidation(emailInput, isEmail(emailInput.value));
    },100);
});


function validatePassword(){
    setTimeout(function (){
        console.log(confirmPassword.previousElementSibling.value);
        const condition = arePassSame(
            confirmPassword.previousElementSibling.value,
            confirmPassword.value
        )
        markValidation(confirmPassword, condition);
    },100);
}


confirmPassword.addEventListener('keyup', validatePassword);
setInterval(validatePassword, 200);