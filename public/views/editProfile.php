<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleMainPage.css">
    <link rel="stylesheet" type="text/css" href="public/css/styleProfile.css">
    <script src="https://kit.fontawesome.com/a80193e2f6.js" crossorigin="anonymous"></script>
    <title>PROFILE</title>
</head>


<?
include("mainPageTemplatePart1.php");
?>

    <section class = profile>

            <div class="profileInfo">
                <div class="content">
                    <form class="edit" action="editProfile" method="POST">
                        <h2>Email</h2>
                        <input name="email" type="text" placeholder=<?= $user->getEmail() ?>>
                        <h2>Name</h2>
                        <input name="name" type="text" placeholder=<?= $user->getName() ?>>
                        <h2>Surname</h2>
                        <input name="surname" type="text" placeholder=<?= $user->getSurname() ?>>
                        <button name="editButton" class="editProfileSubmit" type="submit">Submit</button>
                        <button class="editProfileCancel" type="button" onclick="location.href='/viewProfile';">Cancel</button>
                    </form>
                </div>
            </div>

    </section>

<?
include("mainPageTemplatePart2.php");
?>