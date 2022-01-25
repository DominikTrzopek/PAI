<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleManageQuizzes.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchQuestions.js" defer></script>
    <title>MANAGE</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>

<section class = questions>
    <?php foreach ($questions as $question):?>
        <div class="parentContainer">
            <div class="textContainer">
                <p>Question: <br> <?= $question->getContent(); ?></p>
            </div>
            <form class="quizForm" action="deleteQuestion" method="POST">
                <div class="buttons">
                    <button class="manageButton" name="delete" type="submit" value="<?php echo $question->getQuestionId()." ".$quizId; ?>">Delete</button>
                </div>
            </form>
        </div>
    <?php endforeach;?>
</section>

<?
include("mainPageTemplatePart2.php");
?>