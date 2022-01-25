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
                <i id="numberOfQuestions" class="fas fa-comment-alt"></i>
                <i id="time" class="fas fa-clock"></i>
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

<template id = "questionTemplate">

    <div class="parentContainer">
        <div class="textContainer">
            <p>Question</p>
        </div>
        <form class="quizForm" action="deleteQuestion" method="POST">
            <div class="buttons">
                <button class="manageButton" name="delete" type="submit" value="">Delete</button>
            </div>
        </form>
    </div>

</template>

<template id ="quizOwner">

    <div class="parentContainer">
        <div class="textContainer">
            <p>Quiz (owner)</p>
        </div>
        <form class="quizForm" action="changeQuiz" method="POST">
            <div class="buttons">
                <button id="addQuestion" class="manageButton" name="addQuestion" type="submit" value="">Add Question</button>
                <button id="deleteQuestion" class="manageButton" name="deleteQuestion" type="submit" value="">Delete question</button>
                <button id="deleteQuiz" class="manageButton" name="deleteQuiz" type="submit" value="">Delete quiz</button>
            </div>
        </form>
    </div>

</template>

<template id ="quizMember">

    <div class="parentContainer">
        <div class="textContainer">
            <p>Quiz (member)</p>
        </div>
        <form class="quizForm" action="changeQuiz" method="POST">
            <div class="buttons">
                <button class="manageButton" name="quit" type="submit" value="">Quit quiz</button>
            </div>
        </form>
    </div>

</template>