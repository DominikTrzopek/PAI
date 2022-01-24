<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleAnswer.css">
    <script type="text/javascript" src="./public/js/timer.js" defer></script>
    <script type="text/javascript" src="./public/js/quiz.js" defer></script>
    <title>QUIZ</title>
</head>
<body>
<div id="container" class="container">
    <div class="circle">
        <img src="public/img/circle.png" class="circle-left">
        <h3 id="stats" class="h3-left"> <?php $num=$_SESSION['questionNumber']+1; echo $num."/".$all; ?></h3>
    </div>
    <div class="qa-container">
        <div class="answers">
            <p id="qu"><?php echo $question->getContent(); ?></p>
            <button id="A" name="next" value="<?php echo $answers[0]->getAnswerId(); ?>"><?php echo $answers[0]->getText(); ?></button>
            <button id="B" name="next" value="<?php echo $answers[1]->getAnswerId(); ?>"><?php echo $answers[1]->getText(); ?></button>
            <button id="C" name="next" value="<?php echo $answers[2]->getAnswerId(); ?>"><?php echo $answers[2]->getText(); ?></button>
            <button id="D" name="next" value="<?php echo $answers[3]->getAnswerId(); ?>"><?php echo $answers[3]->getText(); ?></button>
        </div>
    </div>
    <div class="circle">
        <img src="public/img/circle2.png" class="circle-right">
        <h3 class="h3-right" id="time"> <?php echo " "; ?></h3>
    </div>
</div>
</body>

<template id ="endTemplate">

    <div class="container">
        <div class="qa-container">
                    <form class="end" action="endQuiz" method="POST">
                        <p>Your final score: </p>
                        <button name="end" value="">Save & end Quiz</button>
                    </form>
        </div>
    </div>


</template>