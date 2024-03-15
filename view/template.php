<!DOCTYPE html>
<html lang="en">

<head>
    <!-- encodage EU : UTF-8 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public\script.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <figure class="logo" >
             <a  href="index.php">
            <img class="logo" src= "https://img.freepik.com/vecteurs-premium/logo-pour-cinema-grande-lettre-fond-noir_10375-517.jpg" alt= "logo cinema">
            </a>
        </figure> 
        <nav>
            <ul class="navigation">
                <li>
                    <a class=Decoration href="index.php">Home</a>
                </li>
                <li>
                    <a class=Decoration href="index.php?action=listFilms">Movie</a>
                </li>
                <li>
                    <a class=Decoration href="index.php?action=genreFilms">Genre</a>
                </li>
                <li>
                    <a class=Decoration href="index.php?action=updateMenu">Modify Movie</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="background">
    </div>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <small>2023 &copy; Cinema - City</small>
    </footer>
    
    <!-- <script src="app/script.js"></script> -->
</body>

</html>