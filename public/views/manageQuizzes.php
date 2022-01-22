<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleManageQuizzes.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>

    <title>MANAGE</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>

<section class = grades>
    <?php foreach ($myQuizzes as $quiz):?>
        <div class="parentContainer">
            <div class="textContainer">
                <p>Quiz: <br> <?= $quiz->getName(); ?></p>
            </div>
            <form class="quizForm" action="changeQuiz" method="POST">
                <div class="buttons">
                    <button class="manageButton" name="addQuestion" type="submit" value="<?php echo $quiz->getId(); ?>">Add Question</button>
                    <button class="manageButton" name="deleteQuestion" type="submit" value="<?php echo $quiz->getId(); ?>">Delete question</button>
                    <button class="manageButton" name="deleteQuiz" type="submit" value="<?php echo $quiz->getId(); ?>">Delete quiz</button>
                </div>
            </form>
        </div>
    <?php endforeach;?>
    <?php foreach ($joinedQuizzes as $quiz):?>
        <div class="parentContainer">
            <div class="textContainer">
                <p>Quiz: <br> <?= $quiz->getName(); ?></p>
            </div>
            <form class="quizForm" action="changeQuiz" method="POST">
                <div class="buttons">
                    <button class="manageButton" name="quit" type="submit" value="<?php echo $quiz->getId(); ?>">Quit quiz</button>
                </div>
            </form>
        </div>
    <?php endforeach;?>

</section>

<?
include("mainPageTemplatePart2.php");
?>