<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateQuiz.css">
    <title>CREATE QUIZ</title>
</head>
<body>
<div class="container">
    <div class="login-container">
        <form action="addQuestion" method="POST">
            <p>Add qustions to Your Quiz!</p>
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $msg)
                        echo $msg;
                }
                ?>
            </div>
            <input name="question" type="text" placeholder="question">
            <input name="correct" type="text" placeholder="correct answer">
            <input name="incorrect" type="text" placeholder="incorrect answer">
            <input name="incorrect" type="text" placeholder="incorrect answer">
            <input name="incorrect" type="text" placeholder="incorrect answer">
            <div class="buttons">
                <button>Previous</button>
                <button>Next</button>
            </div>
            <div class="buttons2">
                <img src="public/img/logo.svg" id="logo">
                <button>Finish</button>
            </div>
        </form>
    </div>
</div>
</body>