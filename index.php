<?php
session_start();
session_destroy();
session_start();
    $meow = 'Meow_kitty_cat';
    if(empty($_SESSION)){
        $_SESSION['connect'] = FALSE;
        $_SESSION['pseudo'] = $meow;
    }
    //var_dump($_SESSION)
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
        <div id="error"></div>
        <div id="false">
            <form id="connex" method="POST" action="verifco.php">
                <h3>CONNEXION</h3>
                <label>Pseudo : </label><input class="in_" type="text" id="valueCo" name="valueCo" required><br/>
                <label>Password : </label><input class="in_" type="password" id="passCo" name="passCo" required><br/>
                <input class="bout" type="submit" id="co" name="co" value="connection"/>
            </form>
            <form id="inscription" method="POST" action="inscription.php">
                <h3>INSCRIPTION</h3>
                <label>Pseudo : </label><input class="in_" type="text" id="valueIns" name="valueIns" required><br/>
                <label>Password : </label><input class="in_" type="password" id="passIns" name="passIns" required><br/>
                <label>Verif Password : </label><input class="in_" type="password" id="passVeri" name="passVeri" required><br/>
                <input class="bout" type="submit" id="insc" name="insc" value="inscription"/>
            </form>
        </div>
        <!--<button id="b_insc">inscription</button>-->

        <div id="true">
            <form id="aff" method="POST" action="tchat.php">
                <div class="div_t toto">pseudo :
                    <input class="in_" type="text" name="user" id="user" value="<?php echo $_SESSION['pseudo'] ?>" />
                    <button class="bout2 bout" id="deco" name="deco">deconnection</button>
                </div>
                <div id="titi">
                    <div class="div_t"><textarea id="tchat" rows="20" cols="133"></textarea></div>
                    <div class="div_t"><textarea id="message" name="message" rows="3" cols="133" ></textarea></div>
                    <div class="smiley">
                        <ul>
                            <li alt=":)"><img src="img/smile.gif" alt=":)" /></li>
                            <li alt=":D"><img src="img/very-content.gif" alt=":D" /></li>
                            <li alt=":boulet:"><img src="img/boulet.gif" alt=":boulet:" /></li>
                            <li alt=":content:"><img src="img/content.gif" alt=":content:" /></li>
                            <li alt=":merci:"><img src="img/message-merci.gif" alt=":merci:" /></li>
                            <li alt=":zz:"><img src="img/message-zz.gif" alt=":zz:" /></li>
                            <li alt=":+1:"><img src="img/plus-un.gif" alt=":+1:" /></li>
                        </ul>   
                    </div>
                    <div class="useless"></div>
                    <input class="bout2 bout" type="submit" name="ok" id="ok" />
                </div>
            </form>
        </div>
    </body>
</html>