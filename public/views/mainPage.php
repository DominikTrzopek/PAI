<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleQuiz.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/searchQuiz.js" defer></script>
    <title>MAIN PAGE</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>
            <section class = quizzes>
                <?php foreach ($quizzes as $quiz):?>
                <div id="quiz">
                    <img src="public/uploads/<?= $quiz->getImage() ?>">
                     <div>
                        <h2><?= $quiz->getName() ?></h2>
                        <div class="social">
                            <i class="fas fa-users">Id:<?= $quiz->getId() ?></i>
                        </div>
                        <p><?= $quiz->getDescription() ?></p>
                    </div>
                    <form action="startQuiz" method="GET">
                        <button name="next" class="quizButton" value="<?php echo $quiz->getId(); ?>">START</button>
                    </form>
                </div>
                <?php endforeach;?>
            </section>

<?
include("mainPageTemplatePart2.php");
?>