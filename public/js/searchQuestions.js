const search = document.querySelector(".searchJS");
const questionsContainer = document.querySelector(".questions");

search.addEventListener("keyup", function (event){
    if(event.key === "Enter"){
        event.preventDefault();


        const data = {search: this.value};
        fetch("/searchQuestions",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (questions){
            questionsContainer.innerHTML = "";
            loadQuestions(questions)

        });
    }

});

function loadQuestions(questions){
    questions.forEach(question => {
        console.log(question);
        createQuestion(question);
    })
}

function createQuestion(question){
    const template = document.querySelector("#questionTemplate");
    const clone = template.content.cloneNode(true);

    const questionText = clone.querySelector('p');
    questionText.innerHTML = "Question: " + '<br>' + question.content;

    const ids = clone.querySelector('button');
    ids.value = question.question_id + question.quiz_id_fk;

    questionsContainer.appendChild(clone);
}