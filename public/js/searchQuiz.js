const  search = document.querySelector(".searchJS");
const quizContainer = document.querySelector(".quizzes");

search.addEventListener("keyup", function (event){
    if(event.key === "Enter"){
        event.preventDefault();


        const data = {search: this.value};
        fetch("/searchQuiz",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (quizzes){
          quizContainer.innerHTML = "";
          loadQuizzes(quizzes)

        });
    }

});

function loadQuizzes(quizzes){
    quizzes.forEach(quiz => {
        console.log(quiz);
        createQuiz(quiz);
    })
}

function createQuiz(quiz){
    const template = document.querySelector("#quizTemplate");
    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${quiz.image}`;

    const title = clone.querySelector("h2");
    title.innerHTML = quiz.name;

    const description = clone.querySelector("p");
    description.innerHTML = quiz.description;

    const numberOfQuestions = clone.querySelector("#numberOfQuestions");
    numberOfQuestions.innerHTML = quiz.max;

    const time = clone.querySelector("#time");
    time.innerHTML = quiz.time_restriction;

    const button = clone.querySelector("button");
    button.value = quiz.quiz_id;

    quizContainer.appendChild(clone);
}