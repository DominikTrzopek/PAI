<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateQuiz.css">
    <title>CREATE QUIZ</title>
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
            <input name="content" type="text" placeholder="question" >
            <input name="correct" type="text" placeholder="correct answer" >
            <input name="incorrect1" type="text" placeholder="incorrect answer" >
            <input name="incorrect2" type="text" placeholder="incorrect answer" >
            <input name="incorrect3" type="text" placeholder="incorrect answer" >
            <div class="buttons">
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