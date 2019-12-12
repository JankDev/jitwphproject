<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      lang="pl">
<head>
    <meta charset="UTF-8"/>
    <title>Blog dot org</title>
    <link rel="stylesheet" type="text/css" href="forms.css"/>
    <link rel="stylesheet" type="text/css" href="menu.css"/>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<?php include 'menu.php'; ?>
<h1>Dodaj wpis</h1>

<form method="post" action="wpis.php" enctype="multipart/form-data">
    <label for="username">Nazwa użytkownika: </label>
    <input id="username" name="username" type="text"/>

    <label for="password">Podaj hasło: </label>
    <input id="password" name="password" type="password"/>

    <label for="post">Wpis: </label>
    <textarea id="post" name="post"></textarea>

    <label for="date">Data: </label>
    <input id="date" type="text" name="date" value="<?php echo date("Y-m-d"); ?>"/>

    <label for="hour">Data: </label>
    <input id="hour" type="text" name="hour" value="<?php echo date("H:i"); ?>"/>


    <!--Załączniki-->
    <?php
    for ($i = 1; $i <= 3; $i++) {
        echo '<label for="file'.$i.'">Załącznik '.$i.': </label>
              <input id="file'.$i.'" type="file" name="file'.$i.'"/>';
    }
    ?>

    <button type="submit">Wyślij</button>
    <button type="reset">Wyczyść</button>
</form>
</body>
</html>