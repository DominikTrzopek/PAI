<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleJoin.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <title>JOIN</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>

<section class = profile>

    <div class="joinQuiz">
        <div class="content">
            <p>Fill in form to join Edival quiz</p>
            <form class="join" action="joinQuiz" method="POST">
                <input name="name" type="text" placeholder="quiz name" required>
                <input name="password" type="password" placeholder="password" required>

                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $msg)
                            echo $msg;
                    }
                    ?>
                </div>

                <button name="joinButton" class="joinQuizButton" type="submit">Join</button>
            </form>
        </div>
    </div>

</section>

<?
include("mainPageTemplatePart2.php");
?>