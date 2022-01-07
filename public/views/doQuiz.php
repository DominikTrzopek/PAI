<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleAnswer.css">
    <title>QUIZ</title>
</head>
<body>
<div class="container">
    <div class="left">
    <h3><?php echo "question ".$_SESSION['questionNumber']; ?></h3>
    </div>
    <div class="qa-container">
        <form action="startQuiz" method="GET">
            <p><?php echo $question->getContent(); ?></p>
            <button name="next" value="<?php echo $quizId; ?>"><?php echo $answers[0]->getText(); ?></button>
            <button name="next" value="<?php echo $quizId; ?>"><?php echo $question->getContent(); ?></button>
            <button name="next" value="<?php echo $quizId; ?>"><?php echo $question->getContent(); ?></button>
            <button name="next" value="<?php echo $quizId; ?>"><?php echo $question->getContent(); ?></button>
        </form>
    </div>
    <div class="right"></div>
</div>
</body>