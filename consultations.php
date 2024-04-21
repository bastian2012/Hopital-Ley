<?php
    include_once("connexion.php");
    $consultation_existe = false;

    $select_id_medecin = $bdd->prepare("SELECT Idmedecin FROM medecin");
    $select_id_medecin->execute();

    $select_id_patient = $bdd->prepare("SELECT Idpatient FROM patient");
    $select_id_patient->execute();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <title>Medecins</title>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/consultations1.css">
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
<body>
    <?php
        if (isset($_POST['enregistrer'])) {
            $idmedecin = $_POST['idmedecin'];
            $idpatient = $_POST['idpatient'];
            $poids = $_POST['poids'];
            $hauteur = $_POST['hauteur'];
            $diagnostique = $_POST['diagnostique'];
            $date = $_POST['date'];

            $insertion_des_consultations = $bdd->prepare("INSERT INTO consultation(Idmedecin,Idpatient,poids,hauteur,diagnostique,date_consultation) VALUES(?,?,?,?,?,?)");
            $insertion_des_consultations->execute(array($idmedecin,$idpatient,$poids,$hauteur,$diagnostique,$date));
            if ($insertion_des_consultations) {
                ?>
                    <script>
                        M.toast({html: "L'enregistrement est réussi!"});
                    </script>
                <?php
            }
        }

        if (isset($_POST['rechercher'])) {
            $consultation_rechercher = $_POST['consultation-recherche'];
    
            $rechercher_consultation = $bdd->prepare("SELECT * FROM consultation WHERE Idmedecin = '$consultation_rechercher' OR Idpatient = '$consultation_rechercher'");
            $rechercher_consultation->execute();
    
            $nombre_rechercher_consultation = $rechercher_consultation->rowCount();
    
            if ($nombre_rechercher_consultation != 0) {
                $consultation_existe = true;
            }else {
                ?>
                    <script>
                        M.toast({html: "Aucun patient portant ce nom n'a été trouvé!"});
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
                <h5>Liste des consultations</h5>
                <a style="position: absolute; right: 30px;" class="waves-effect cyan btn modal-trigger" href="#modal1"><i class="las la-add"></i>ajouter une consultation</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="icon-close">
                        <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                    </div>
                    <div class="modal-content">
                    <img src="images/logo_eka_landscape.png" alt="">
                    <p>Ajouter une consultation</p>
                    <div class="row">
                        <form class="col s12" method="post">
                          <div class="row">
                            <div class="input-field col s6">
                                <select name="idmedecin" class="browser-default" required>
                                  <option value="" disabled selected>Id medecin</option>
                                  <?php
                                    while ($resultat_select_id_medecin = $select_id_medecin->fetch()) {
                                        ?>
                                            <option value="<?php echo $resultat_select_id_medecin['Idmedecin']; ?>"><?php echo $resultat_select_id_medecin['Idmedecin']; ?></option>
                                        <?php
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <select name="idpatient" class="browser-default" required>
                                  <option value="" disabled selected>Id patient</option>
                                  <?php
                                    while ($resultat_select_id_patient = $select_id_patient->fetch()) {
                                        ?>
                                            <option value="<?php echo $resultat_select_id_patient['Idpatient']; ?>"><?php echo $resultat_select_id_patient['Idpatient']; ?></option>
                                        <?php
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                              <input name="poids" id="icon_telephone" type="text" class="validate" required>
                              <label for="icon_telephone">Poids</label>
                            </div>
                            <div class="input-field col s6">
                              <input name="hauteur" id="icon_prefix" type="number" class="validate" required>
                              <label for="icon_prefix">Hauteur</label>
                            </div>
                            <div class="input-field col s6">
                                <textarea name="diagnostique" id="textarea1" class="materialize-textarea" required></textarea>
                                <label for="textarea1">Diagnostique</label>
                            </div>
                            <div class="input-field col s6">
                              <input name="date" id="icon_prefix" type="date" class="validate" required>
                              <label for="icon_prefix">Date</label>
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
                                    <i class="las la-user-plus"></i>
                                    <a href="medecins.php">Enregistrer un médecin</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-notes-medical"></i>
                                    <a href="dossiers.php">Dossiers patients</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-user-plus"></i>
                                    <a href="patients.php">Patients</a>
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
                        $selectionner_existance_des_consultations = $bdd->prepare("SELECT * FROM consultation");
                        $selectionner_existance_des_consultations->execute();
                        $nombre_des_consultations = $selectionner_existance_des_consultations->rowCount();

                        if ($nombre_des_consultations != 0) {
                            if ($consultation_existe == false) {
                                ?>
                                <table class="content-table">
                                    <thead>
                                        <th>Id Consultation</th>
                                        <th>Id Medecin</th>
                                        <th>Id Patient</th>
                                        <th>Poids</th>
                                        <th>Hauteur</th>
                                        <th>Diagnostique</th>
                                        <th>Date Consultation</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $selection_des_consultations = $bdd->prepare("SELECT * FROM consultation");
                                            $selection_des_consultations->execute();
                                            while ($resutat_selection_des_consultations = $selection_des_consultations->fetch()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $resutat_selection_des_consultations['Idconsultation'];?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['Idmedecin'];?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['Idpatient'];?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['poids']." Kg";?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['hauteur']." metre";?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['diagnostique'];?></td>
                                                        <td><?php echo $resutat_selection_des_consultations['date_consultation'];?></td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            }
                            else {
                                    ?>
                                        <table class="content-table">
                                            <thead>
                                                <th>Noms</th>
                                                <th>Prénoms</th>
                                                <th>Sexe</th>
                                                <th>Tel</th>
                                                <th>Adresses</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while ($resultat_rechercher_patient = $rechercher_patient->fetch()) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $resultat_rechercher_patient['nom'];?></td>
                                                                <td><?php echo $resultat_rechercher_patient['prenom'];?></td>
                                                                <td><?php echo $resultat_rechercher_patient['sexe'];?></td>
                                                                <td><?php echo $resultat_rechercher_patient['tel'];?></td>
                                                                <td><?php echo $resultat_rechercher_patient['adresse'];?></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                            <?php
                            }
                            
                        }else {
                            ?>
                                <div class="dossier-patient-vide">
                                    <h5>Il n'y a pas encore de consultations enregistrés</h5>
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