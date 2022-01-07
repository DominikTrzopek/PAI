<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/quiz.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <title>MAIN PAGE</title>
</head>
<body>
    <div class="base-container">
        <nav>
            <img src="public/img/logo.svg">
            <ul>
                <li>
                    <i class="fas fa-user"></i>
                    <a href="#" class="buttonMenu">profile</a>
                </li>
                <li>
                    <i class="fa fa-gears"></i>
                    <a href="#" class="buttonMenu">manage quizzes</a>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <a href="#" class="buttonMenu">join group</a>
                </li>
                <li>
                    <i class="fas fa-bell"></i>
                    <a href="#" class="buttonMenu">notifications</a>
                </li>
            </ul>   
        </nav>
        <main>
            <header>
                <div class="search-bar">                  
                    <form>
                        <i class="fab fa-searchengin"></i>
                        <input placeholder="search quizess">
                    </form>
                </div>
                <div class="space"></div>
                <div class="headerButton">
                <a href="/createQuiz" class="add-quiz">
                    <i class="fas fa-plus"></i>
                    create quiz
                </a>
                </div>
            
                <div class="headerButton">
                    <form class="logout" action="logout" method="POST">
                        <button type="submit">
                            <i class="fas fa-arrow-left"></i> logout
                        </button>
                    </form>
                </div>

            </header>
            <section class = quizzes>
                <?php foreach ($quizzes as $quiz):?>
                <div id="quiz">
                    <img src="public/uploads/<?= $quiz->getImage() ?>">
                     <div>
                        <h2><?= $quiz->getName() ?></h2>
                        <div class="social">
                            <i class="fas fa-users"><?= $quiz->getCreator() ?></i>
                        </div>
                        <p><?= $quiz->getDescription() ?></p>
                    </div>
                    <form action="startQuiz" method="GET">
                        <button name="next" class="quizButton" value="<?php echo $quiz->getId(); ?>">START</button>
                    </form>
                </div>
                <?php endforeach;?>
            </section>
        </main>

    </div>
</body>
