const search = document.querySelector(".searchJS");
const quizContainer = document.querySelector(".manageQuizzes");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchManageOwner", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (quizzes) {
            quizContainer.innerHTML = "";
            searchMember(data);
            loadQuizzesOwner(quizzes)

        });

    }
});

function loadQuizzesOwner(quizzes){
    quizzes.forEach(quiz => {
        console.log(quiz);
        createQuizOwner(quiz);
    })
}

function createQuizOwner(quiz){
    const template = document.querySelector("#quizOwner");
    const clone = template.content.cloneNode(true);

    const name = clone.querySelector('p');
    name.innerHTML = "Quiz (owner): " + '<br>' + quiz.name;

    const buttonAddQuestion = clone.querySelector('#addQuestion');
    buttonAddQuestion.value = quiz.quiz_id;

    const buttonDeleteQuestion = clone.querySelector('#deleteQuestion');
    buttonDeleteQuestion.value = quiz.quiz_id;

    const buttonDeleteQuiz = clone.querySelector('#deleteQuiz');
    buttonDeleteQuiz.value = quiz.quiz_id;

    quizContainer.appendChild(clone);
}