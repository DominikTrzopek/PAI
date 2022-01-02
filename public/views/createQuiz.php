<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateQuiz.css">
    <title>CREATE QUIZ</title>
</head>
<body>
<div class="container">
    <div class="login-container">
        <form action="createQuiz" method="POST" enctype="multipart/form-data">
            <p>Create Your own History quiz!</p>
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $msg)
                        echo $msg;
                }
                ?>
            </div>
            <input name="topic" type="text" placeholder="main topic">
            <input name="name" type="text" placeholder="name">
            <input name="password" type="password" placeholder="password">
            <input name="time" type="text" placeholder="time restriction (minutes)">
            <textarea name="description" type="text" placeholder="descryption"></textarea>
            <label class="customFileUpload">
                <p class="p2">Upload file</p>
                <input type="file" name="file" class="file">
            </label>
            <img src="public/img/logo.svg" id="logo">
            <div class="buttons">
                <button type="submit">Create</button>
                <button type="button" onclick="location.href='/mainPage';">Cancel</button
            </div>

        </form>
    </div>
</div>
</body>