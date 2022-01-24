const container = document.getElementById('container')
const answerA = document.getElementById('A');
const answerB = document.getElementById('B');
const answerC = document.getElementById('C');
const answerD = document.getElementById('D');
const question = document.getElementById('qu');
const stats = document.getElementById('stats');
var loaded = true;

answerA.addEventListener("click", function() {
    fetchQuestion(answerA.value, answerA);
});

answerB.addEventListener("click", function() {
    fetchQuestion(answerB.value, answerB);
});

answerC.addEventListener("click", function() {
    fetchQuestion(answerC.value, answerC);
});

answerD.addEventListener("click", function() {
    fetchQuestion(answerD.value, answerD);
});

function fetchQuestion(data, button){

    if(!loaded){
        return;
    }
    loaded = false;


    fetch("/nextQuestion",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (toSet){
        validateAnswer(toSet, button);
        setTimeout(function () {
            if(end()){
                endQuiz(toSet);
            }
            else {
                let id = loadQuestion(toSet);
                fetchAnswers(id, button);
            }
        }, 2000);
    });
}

function end(){
    var numberOfQuestion = getCookieValue("numberOfQuestion");
    var maxQuestion = getCookieValue("maxQuestion");
    return numberOfQuestion + 1 >= maxQuestion;

}


function fetchAnswers(id, button){


    fetch("/nextAnswers",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(id)
    }).then(function (response) {
        return response.json();
    }).then(function (toSet){
        loadAnswers(toSet, button);

        timer = getCookieValue("time");
        loaded = true;


    });
}

function validateAnswer(toSet,button){

    let isCorrect = toSet.isCorrect;
    if(isCorrect){
        button.classList.add("correct")
    }
    else{
        button.classList.add("inCorrect")
    }

}

function loadQuestion(toSet){

    const numberOfQuestion = toSet.numberOfQuestion + 1;
    question.innerHTML = toSet.question;
    stats.innerHTML = numberOfQuestion + "/" + toSet.maxQuestion;

    return toSet.questionId;

}

function loadAnswers(answers, button){

    answerA.innerHTML = answers.textA;
    answerB.innerHTML = answers.textB;
    answerC.innerHTML = answers.textC;
    answerD.innerHTML = answers.textD;

    answerA.value = answers.valueA;
    answerB.value = answers.valueB;
    answerC.value = answers.valueC;
    answerD.value = answers.valueD;

    button.classList.remove("correct");
    button.classList.remove("inCorrect");

}

function endQuiz(toSet){

    container.innerHTML = "";

    const template = document.querySelector("#endTemplate");
    const clone = template.content.cloneNode(true);

    const text = clone.querySelector("p");
    text.innerHTML = "Your final score: " + toSet.score + "/" + toSet.maxQuestion;

    const button = clone.querySelector("button");
    button.value = toSet.score + " " + toSet.quizId + " " + toSet.maxQuestion;

    container.appendChild(clone);

}