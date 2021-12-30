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
            <section class = quizess>
                <div id="quiz 1">         
                     <div>
                        <h2><?= $quiz->getName() ?></h2>
                            <img src="public/uploads/<?= $quiz->getImage() ?>">
                        <div class="social">
                            <i class="fas fa-users"><?= $quiz->getCreator() ?></i>
                        </div>
                        <p><?= $quiz->getDescription() ?></p>
                    </div>
                        <button class="quizButton">START</button>
                </div>
                <div id="quiz 2">         
                    <div>
                       <h2>Title</h2>
                            <img src="public/img/upload/Temple-of-Saturn-Arch-Septimius-Severus-Forum.jpg">
                       <div class="social">
                           <i class="fas fa-users">56</i>
                       </div>
                       <p>Lorem ipsum dolor sit amet, conveniam, quis nostrud exercitation</p>
                   </div>
                   <button class="quizButton">START</button>
               </div>
               <div id="quiz 3">         
                <div>
                   <h2>Title</h2>
                        <img src="public/img/upload/Temple-of-Saturn-Arch-Septimius-Severus-Forum.jpg">
                   <div class="social">
                       <i class="fas fa-users">56</i>
                   </div>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
               </div>
               <button class="quizButton" >START</button>
            </div>
            </section>
        </main>

    </div>
</body>
