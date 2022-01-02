<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateQuiz.css">
    <title>SHOW QUESTION</title>
</head>
<body>
<div class="container">
    <div class="login-container">
        <form action="editQuiz" method="POST">
            <p>Add questions to Your Quiz!</p>
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $msg)
                        echo $msg;
                }
                ?>
            </div>
            <p> <?= $question->getContent() ?></p>
            <p> <?= $question->getCorrect() ?></p>
            <p> <?= $question->getIncorrect1() ?></p>
            <p> <?= $question->getIncorrect2() ?></p>
            <p> <?= $question->getIncorrect3() ?></p>
            <div class="buttons">
                <button><?= $question->getContent() ?></button>
                <button name="add" type="submit" value="<?php echo $quiz; ?>">Add</button>
            </div>
            <div class="buttons2">
                <img src="public/img/logo.svg" id="logo">
                <button name="finish" type="submit" value="<?php echo $quiz; ?>">Finish</button>
            </div>
        </form>
    </div>
</div>
</body>