<?php
include_once("connexion.php");

$medecin_existe = false;

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Medecins</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="css/medecin1.css">
    <script type="text/javascript" src="js/materialize.min.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['enregistrer'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $email = $_POST['email'];
        $specialite = $_POST['specialite'];
        $insertion_des_medecins = $bdd->prepare("INSERT INTO medecin(nom,prenom,sexe,tel,adresse,email,specialite) VALUES(?,?,?,?,?,?,?)");
        $insertion_des_medecins->execute(array($nom, $prenom, $sexe, $telephone, $adresse, $email, $specialite));
        if ($insertion_des_medecins) {
    ?>
            <script>
                M.toast({
                    html: "L'enregistrement est réussi!"
                });
            </script>
        <?php
        }
    }
    if (isset($_POST['rechercher'])) {
        $medecin_rechercher = $_POST['patient-recherche'];

        $rechercher_medecin = $bdd->prepare("SELECT * FROM medecin WHERE nom = '$medecin_rechercher' OR prenom = '$medecin_rechercher' OR specialite = '$medecin_rechercher'");
        $rechercher_medecin->execute();

        $nombre_rechercher_medecin = $rechercher_medecin->rowCount();

        if ($nombre_rechercher_medecin != 0) {
            $medecin_existe = true;
        } else {
        ?>
            <script>
                M.toast({
                    html: "Aucun médecin portant ce nom n'a été trouvé!"
                });
            </script>
    <?php
        }
    }
    ?>
    <div class="corps">
        <div class="card white darken-1 z-depth-2">
            <div class="en-tete-card">
                <div class="logo" style="background: white; height: 55px; display: flex; align-items: center; position: absolute; left: 1px;">
                </div>
                <h5>Liste des médecins</h5>
                <form class="form-en-tete" action="" method="post">
                    <input name="patient-recherche" style="background: white; height: 25px; margin-top: 10px; padding-left: 10px; border-radius: 5px; margin-right: 10px;" type="text" placeholder="Rechercher un médecin">
                    <button name="rechercher" class="btn-floating cyan" type="submit"><i style="color: white; font-size: 15px;" class="las la-search"></i></button>
                </form>
                <a style="position: absolute; right: 30px;" class="waves-effect cyan btn modal-trigger" href="#modal1"><i class="las la-add"></i>ajouter un médecin</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="icon-close">
                        <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                    </div>
                    <div class="modal-content">
                        <img src="images/logo_eka_landscape.png" alt="">
                        <p>Ajouter un médecin</p>
                        <div class="row">
                            <form class="col s12" method="post">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="nom" id="icon_prefix" type="text" class="validate" required>
                                        <label for="icon_prefix">Nom</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="prenom" id="icon_telephone" type="text" class="validate" required>
                                        <label for="icon_telephone">Prénom</label>
                                    </div>
                                    <div style="display: flex;" class="input-field col s6">
                                        <p style="margin-right: 20px;">
                                            <label>
                                                <input name="sexe" value="Masculin" type="radio" required />
                                                <span>Masculin</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input name="sexe" value="Feminin" type="radio" required />
                                                <span>Féminin</span>
                                            </label>
                                        </p>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="telephone" id="icon_telephone" type="tel" class="validate" required>
                                        <label for="icon_telephone">Téléphone</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="adresse" id="icon_prefix" type="text" class="validate" required>
                                        <label for="icon_prefix">Adresse</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="email" id="icon_prefix" type="email" class="validate" required>
                                        <label for="icon_prefix">Email</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="specialite" class="browser-default" required>
                                            <option value="" disabled selected>Spécialités</option>
                                            <option value="Urologue">Urologue</option>
                                            <option value="Gynécologue">Gynécologue</option>
                                            <option value="Dermatologue">Dermatologue</option>
                                            <option value="Chirurgien">Chirurgien</option>
                                            <option value="Anesthésiologue">Anesthésiologue</option>
                                            <option value="Cardiologue">Cardiologue</option>
                                            <option value="Hématologue">Hématologue</option>
                                            <option value="Hépatologue">Hépatologue</option>
                                            <option value="Infectiologue">Infectiologue</option>
                                            <option value="Néonatologue">Néonatologue</option>
                                            <option value="Néphrologue">Néphrologue</option>
                                            <option value="Neurologue">Neurologue</option>
                                            <option value="Odontologue">Odontologue</option>
                                            <option value="Oncologue">Oncologue</option>
                                            <option value="Obstétricien">Obstétricien</option>
                                            <option value="Ophtalmologue">Ophtalmologue</option>
                                            <option value="Pédiatre">Pédiatre</option>
                                            <option value="Pneumologue">Pneumologue</option>
                                            <option value="Psychiatre">Psychiatre</option>
                                            <option value="Radiologue">Radiologue</option>
                                            <option value="Rhumatologue">Rhumatologue</option>
                                        </select>
                                    </div>
                                </div>
                                <button name="enregistrer" class="waves-effect waves-light btn" type="submit">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                    </div> -->
                </div>
            </div>
            <div class="card-corps">
                <div class="card-corps-img">
                    <div class="card-corps-image">
                        <img src="images/insurance_set_1.jpg" alt="">
                    </div>
                    <div class="menu">
                        <div class="menu-liste">
                            <div class="menu-en-tete">
                                <div class="rond"></div>
                                <div class="carre"></div>
                            </div>
                            <div class="menu-en-corps">
                                <div class="menu-en-corps-item">
                                    <i class="las la-user-injured"></i>
                                    <a href="patients.php">Patients</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-notes-medical"></i>
                                    <a href="dossiers.php">Dossiers patients</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-stethoscope"></i>
                                    <a href="consultations.php">Consultations</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-prescription-bottle-alt"></i>
                                    <a href="prescriptions.php">Préscriptions</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <br>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <br>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <br>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="liste-doctor">
                    <?php
                    $selectionner_existance_des_medecins = $bdd->prepare("SELECT * FROM medecin");
                    $selectionner_existance_des_medecins->execute();
                    $nombre_des_medecins = $selectionner_existance_des_medecins->rowCount();

                    if ($nombre_des_medecins != 0) {
                        if ($medecin_existe == false) {
                    ?>
                            <table class="content-table datatable">
                                <thead>
                                    <th>Id</th>
                                    <th>Noms</th>
                                    <th>Prénoms</th>
                                    <th>Sexe</th>
                                    <th>Tel</th>
                                    <th>Adresses</th>
                                    <th>Emails</th>
                                    <th>Spécialités</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $selection_des_medecins = $bdd->prepare("SELECT * FROM medecin");
                                    $selection_des_medecins->execute();
                                    while ($resutat_selection_des_medecins = $selection_des_medecins->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $resutat_selection_des_medecins['Idmedecin']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['nom']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['prenom']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['sexe']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['tel']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['adresse']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['email']; ?></td>
                                            <td><?php echo $resutat_selection_des_medecins['specialite']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                        ?>
                            <table class="content-table datatable">
                                <thead>
                                    <th>Noms</th>
                                    <th>Prénoms</th>
                                    <th>Sexe</th>
                                    <th>Tel</th>
                                    <th>Adresses</th>
                                    <th>Emails</th>
                                    <th>Spécialités</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($resutat_rechercher_medecin = $rechercher_medecin->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $resutat_rechercher_medecin['nom']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['prenom']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['sexe']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['tel']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['adresse']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['email']; ?></td>
                                            <td><?php echo $resutat_rechercher_medecin['specialite']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="dossier-medecin-vide">
                            <h5>Il n'y a pas encore de médecins enregistrés</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
    <script>
        //Modal 1
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {});
        });
    </script>
</body>

</html>