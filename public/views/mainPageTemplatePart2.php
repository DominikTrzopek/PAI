</main>

<div class="nav-mobile">
    <a href="/mainPage" class="buttonMenu"><i class="fas fa-home"></i> </a>
    <a href="/viewProfile" class="buttonMenu"><i class="fas fa-user"></i></a>
    <a href="/manageQuizzes" class="buttonMenu"><i class="fa fa-gears"></i> </a>
    <a href="/joinQuiz" class="buttonMenu"><i class="fas fa-users"></i></a>
    <a href="/scores" class="buttonMenu"><i class="fas fa-graduation-cap"></i></a>
</div>


</div>
</body>


<template id = "quizTemplate">

    <div id="quiz">
        <img src="">
        <div>
            <h2>title</h2>
            <div class="social">
                <i class="fas fa-users">Id</i>
            </div>
            <p>description</p>
        </div>
        <form action="startQuiz" method="GET">
            <button name="next" class="quizButton" value="">START</button>
        </form>
    </div>

</template>

<template id = "scoreTemplate">

    <div class="scoreContainer">
        <div class="textContainer">
            <p id="score">Score: <br> </p>
        </div>
        <div class="textContainer">
            <p id="date">Date: <br></p>
        </div>
        <div class="textContainerLast">
            <p id="quiz">Quiz: <br> </p>
        </div>
    </div>

</template>