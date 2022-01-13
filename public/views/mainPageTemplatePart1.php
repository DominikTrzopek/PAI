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

