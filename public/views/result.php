<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleAnswer.css">
    <title>QUIZ</title>
</head>
<body>
<div class="container">
    <div class="qa-container">
        <form action="endQuiz" method="POST">
            <p>Your final score: <?= $score."/".$all ?> </p>
            <button name="end" value="<?= $score." ".$quizId ?>">Save & end Quiz</button>
        </form>
    </div>
</div>
</body>