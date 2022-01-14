<body>
<div class="base-container">
    <nav>
        <a href="/mainPage" class="goBack"><img class="logo" src="public/img/logo.svg"></a>
        <ul>
            <li>
                <i class="fas fa-user"></i>
                <a href="/viewProfile" class="buttonMenu">profile</a>
            </li>
            <li>
                <i class="fa fa-gears"></i>
                <a href="#" class="buttonMenu">manage quizzes</a>
            </li>
            <li>
                <i class="fas fa-users"></i>
                <a href="/joinQuiz" class="buttonMenu">join group</a>
            </li>
            <li>
                <i class="fas fa-graduation-cap"></i>
                <a href="/scores" class="buttonMenu">grades</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="search-bar">
                    <i class="fab fa-searchengin"></i>
                    <input class="searchJS" placeholder="search quizzes">
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

