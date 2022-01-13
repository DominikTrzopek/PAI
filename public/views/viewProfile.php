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
                    <h2>Id: <?= $user->getId() ?></h2>
                    <h2>Email: <?= $user->getEmail() ?></h2>
                    <h2>Name: <?= $user->getName() ?></h2>
                    <h2>Surname: <?= $user->getSurname() ?></h2>
                    <button class="editProfile" type="button" onclick="location.href='/editProfile';">Edit</button>
                </div>
            </div>

    </section>

<?
include("mainPageTemplatePart2.php");
?>