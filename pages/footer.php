        </div>
<<<<<<< HEAD
        <div style="background-color: lightgray; height : 150px; text-align:center;">
            <a href="mentionsLegale.php">Mentions Légale</a>
        </div>
=======
        <footer>
                <?php 
                if(!isset($_COOKIE["accept-cookie"]) && !isset($_GET["cookie-accept"]))
                {
                    ?>
                        <div class="cookie-block">
                            <div class="cookie-info"><p>Ce site web utilise les cookies pour faciliter votre navigation...</p></div>
                            <div class="cookie-button">
                                <a href="?cookie-accept=1" class="btn btn-info">Accepter les cookies</a>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </footer>
>>>>>>> 2a46ed31e9603dfcef3d653578336b7795e675ea
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../fichier/main.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</html>