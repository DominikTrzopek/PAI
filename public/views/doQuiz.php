<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleAnswer.css">
    <script type="text/javascript" src="./public/js/timer.js" defer></script>
    <script type="text/javascript" src="./public/js/quiz.js" defer></script>
    <title>QUIZ</title>
</head>
<body>
<div class="container">
    <div class="circle">
        <img src="public/img/circle.png" class="circle-left">
        <h3 class="h3-left"> <?php $num=$_SESSION['questionNumber']+1; echo $num."/".$all; ?></h3>
    </div>
    <div class="qa-container">
        <form action="startQuiz" method="GET">
            <p><?php echo $question->getContent(); ?></p>
            <button id="A" name="next" value="<?php $val=$quizId." ".$answers[0]->getAnswerId(); echo $val; ?>"><?php echo $answers[0]->getText(); ?></button>
            <button id="B" name="next" value="<?php $val=$quizId." ".$answers[1]->getAnswerId(); echo $val; ?>"><?php echo $answers[1]->getText(); ?></button>
            <button id="C" name="next" value="<?php $val=$quizId." ".$answers[2]->getAnswerId(); echo $val; ?>"><?php echo $answers[2]->getText(); ?></button>
            <button id="D" name="next" value="<?php $val=$quizId." ".$answers[3]->getAnswerId(); echo $val; ?>"><?php echo $answers[3]->getText(); ?></button>
        </form>
    </div>
    <div class="circle">
        <img src="public/img/circle.png" class="circle-right">
        <h3 class="h3-right" id="time"> <?php echo " "; ?></h3>
    </div>
</div>
</body>