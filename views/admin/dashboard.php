<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:700|Montserrat:400,700" rel="stylesheet"> 
    <link rel="stylesheet" href="<?= $css .'UWCSS.css'?>">
    <link rel="stylesheet" href="<?= $css .'admin.css'?>">
    <title><?= isset($title) ? htmlentities($title) : 'Mon site' ?></title>
</head>
<body>
    <?php require 'sidebar.php'; ?>
    <main class="uw-main">
        <?php require 'header.php'; 
         echo $content ?>
    </main>
    <footer class="uw-container uw-light-grey footer uw-padding uw-bottom"> 
        <div class="uw-container">
        <?php if(defined('DEBUG_TIME')): ?>
            Page générée en <?= round(1000 *(microtime(true) - DEBUG_TIME)); ?> ms
        <?php endif ?>
        </div>
    </footer>
    <script>
        let mySidebar = document.getElementById("mySidebar");
        let overlayBg = document.getElementById("myOverlay");
        function uw_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }
        function uw_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
</body>
</html>