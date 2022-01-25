<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleScore.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchScores.js" defer></script>
    <title>GRADES</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>

    <section class = grades>
        <?php foreach ($scores as $score):?>
            <div class="scoreContainer">
                <div class="textContainer">
                    <p>Score: <br> <?= $score->getScore() ?>/<?= $score->getNumberOfQuestions() ?></p>
                </div>
                <div class="textContainer">
                    <p>Date: <br> <?= $score->getDate() ?></p>
                </div>
                <div class="textContainerLast">
                    <p>Quiz: <br> <?= $score->getQuizName() ?></p>
                </div>
            </div>
        <?php endforeach;?>
    </section>

<?
include("mainPageTemplatePart2.php");
?>