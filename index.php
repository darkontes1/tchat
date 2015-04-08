<?php
session_start();
    $meow = 'Meow_kitty_cat';
    if(empty($_SESSION)){
        $_SESSION['connect'] = FALSE;
        $_SESSION['pseudo'] = $meow;
    }
    var_dump($_SESSION)
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>IRC</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src="tchat.js"></script>
    </head>
    <body>
        <div id="false">
            <form id="connex" method="POST" action="verifco.php">
                <label>Pseudo : </label><input type="text" id="valueCo" name="valueCo" required><br/>
                <label>Password : </label><input type="password" id="passCo" name="passCo" required><br/>
                <input type="submit" id="co" name="co" value="connection"/>
            </form>
        </div>
            <div id="true">
                <form id="aff" method="POST" action="tchat.php">
                
                <div class="div_t">pseudo
                    <input type="text" name="user" id="user" value="<?php echo $_SESSION['pseudo'] ?>" />
                    <button id="deco" name="deco">deconnection</button>
                </div>
                <div class="div_t"><textarea id="tchat" rows="20" cols="100"></textarea></div>
                <div class="div_t"><textarea id="message" name="message" rows="3" cols="100" ></textarea></div>
                <input type="submit" name="ok" id="ok" />
            </form>
        </div>
    </body>
</html>