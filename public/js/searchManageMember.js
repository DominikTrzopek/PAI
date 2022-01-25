function searchMember(data){

        fetch("/searchManageMember",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (quizzes){
            loadQuizzesMember(quizzes);
        });

}

function loadQuizzesMember(quizzes){
    quizzes.forEach(quiz => {
        console.log(quiz);
        createQuizMember(quiz);
    })
}

function createQuizMember(quiz){
    const template = document.querySelector("#quizMember");
    const clone = template.content.cloneNode(true);

    const name = clone.querySelector('p');
    name.innerHTML = "Quiz (member): " + '<br>' + quiz.name;

    const button = clone.querySelector('button');
    button.value = quiz.quiz_id;

    quizContainer.appendChild(clone);
}