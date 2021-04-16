<?php if (isset($_GET['msg'])) { ?>
    
        <?php
            switch ($_GET['msg']) {
                case '1': ?>
                <div class="alert alert-danger">
                    Identifiant ou mot de passe incorrect !
                </div>
            <?php    break;
                case '2': ?>
                <div class="alert alert-success">
                    Deconnexion réussie avec succès !
                </div>
            <?php    break;
            } ?>
<?php } ?>