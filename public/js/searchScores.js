const  search = document.querySelector(".searchJS");
const scoresContainer = document.querySelector(".grades");

search.addEventListener("keyup", function (event){
    if(event.key === "Enter"){
        event.preventDefault();


        const data = {search: this.value};
        fetch("/searchScores",{
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (scores){
            scoresContainer.innerHTML = "";
            loadScore(scores)

        });
    }

});

function loadScore(scores){
    scores.forEach(score => {
        console.log(score);
        createScore(score);
    })
}

function createScore(score){
    const template = document.querySelector("#scoreTemplate");
    const clone = template.content.cloneNode(true);

    const scoreVal = clone.querySelector('p[id="score"]');
    scoreVal.innerHTML = "Score: " + '<br>' + score.score + "/" + score.max;

    const scoreDate = clone.querySelector('p[id="date"]');
    scoreDate.innerHTML = "Date: " + '<br>' + score.date;

    const scoreQuiz = clone.querySelector('p[id="quiz"]');
    scoreQuiz.innerHTML = "Quiz: " + '<br>' + score.name;

    scoresContainer.appendChild(clone);
}