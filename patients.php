<<?php
    include_once("connexion.php");
    $patient_existe = false;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <title>patients</title>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/patients2.css">
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

            $insertion_des_patients = $bdd->prepare("INSERT INTO patient(nom,prenom,sexe,tel,adresse) VALUES(?,?,?,?,?)");
            $insertion_des_patients->execute(array($nom,$prenom,$sexe,$telephone,$adresse));
            if ($insertion_des_patients) {
                ?>
                    <script>
                        M.toast({html: "L'enregistrement est réussi!"});
                    </script>
                <?php
            }
        }

        if (isset($_POST['rechercher'])) {
            $patient_rechercher = $_POST['patient-recherche'];
    
            $rechercher_patient = $bdd->prepare("SELECT * FROM patient WHERE nom = '$patient_rechercher' OR prenom = '$patient_rechercher'");
            $rechercher_patient->execute();
    
            $nombre_rechercher_patient = $rechercher_patient->rowCount();
    
            if ($nombre_rechercher_patient != 0) {
                $patient_existe = true;
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
                <h5>Liste des patients</h5>
                <form class="form-en-tete" action="" method="post">
                    <input name="patient-recherche" style="background: white; height: 25px; margin-top: 10px; padding-left: 10px; border-radius: 5px; margin-right: 10px;" type="text" placeholder="Rechercher un patient">
                    <button name="rechercher" class="btn-floating cyan" type="submit"><i style="color: white; font-size: 15px;" class="las la-search"></i></button>
                </form>
                <a style="position: absolute; right: 30px;" class="waves-effect cyan btn modal-trigger" href="#modal"><i class="las la-add"></i>ajouter un patient</a>

                <!-- Modal Structure -->
                <div id="modal" class="modal">
                    <div class="icon-close">
                        <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                    </div>
                    <div class="modal-content">
                    <img src="images/logo_eka_landscape.png" alt="">
                    <p>Ajouter un patient</p>
                    <div class="row">
                        <form class="col s12" method="post">
                          <div class"row">
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
                                      <input name="sexe" value="Feminin" type="radio" required/>
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
                          </div>
                          <button name="enregistrer" class="waves-effect waves-light btn" type="submit">Enregistrer</button>
                        </form>
                      </div>
                    </div>
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
                                    <i class="las la-user-nurse"></i>
                                    <a href="medecins.php">Médecins</a>
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
                        $selectionner_existance_des_patients = $bdd->prepare("SELECT * FROM patient");
                        $selectionner_existance_des_patients->execute();
                        $nombre_des_patients = $selectionner_existance_des_patients->rowCount();

                        if ($nombre_des_patients != 0) {
                            if ($patient_existe == false) {
                                ?>
                                <table class="content-table">
                                    <thead>
                                        <th>Id</th>
                                        <th>Noms</th>
                                        <th>Prénoms</th>
                                        <th>Sexe</th>
                                        <th>Tel</th>
                                        <th>Adresses</th>
                                        <th>Dossiers</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $selection_des_patients = $bdd->prepare("SELECT * FROM patient");
                                            $selection_des_patients->execute();
                                            while ($resutat_selection_des_patients = $selection_des_patients->fetch()) {
                                                ?>
                                                    <tr>
                                                            <td><?php echo $resutat_selection_des_patients['Idpatient'];?></td>
                                                            <td><?php echo $resutat_selection_des_patients['nom'];?></td>
                                                            <td><?php echo $resutat_selection_des_patients['prenom'];?></td>
                                                            <td><?php echo $resutat_selection_des_patients['sexe'];?></td>
                                                            <td><?php echo $resutat_selection_des_patients['tel'];?></td>
                                                            <td><?php echo $resutat_selection_des_patients['adresse'];?></td> 

                                                            <td><a class="modal-trigger waves-effect waves-light btn" href="#modal<?php echo $resutat_selection_des_patients['Idpatient'];?>">Voir son dossier</a></td>
                                                            <!-- Modal Structure -->
                                                            <div id="modal<?php echo $resutat_selection_des_patients['Idpatient'];?>" class="modal">
                                                                <div class="icon-close">
                                                                    <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                                                                </div>
                                                                <div class="modal-content">
                                                                <img src="images/logo_eka_landscape.png" alt="">
                                                                <div>
                                                                    <?php
                                                                        $id_patient = $resutat_selection_des_patients['Idpatient'];
                                                                        $rechercher_consultation = $bdd->prepare("SELECT * FROM consultation WHERE Idpatient = '$id_patient'");
                                                                        $rechercher_consultation->execute();

                                                                        $nombre_de_consultations = $rechercher_consultation->rowCount();
                                                                        if ($nombre_de_consultations != 0) {
                                                                            ?>
                                                                                <div class="affiche">
                                                                                        <p style=" width: 100%; text-align: center;">Dossier de</p>
                                                                                        <h5><strong>Nom :</strong> <?php echo $resutat_selection_des_patients['nom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Prenom :</strong> <?php echo" ". $resutat_selection_des_patients['prenom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Sexe :</strong> <?php echo $resutat_selection_des_patients['sexe'];?></h5>
                                                                                        <hr>
                                                                                        <br> <br>
                                                                                        <?php
                                                                                            while ($resultat_rechercher_consultation = $rechercher_consultation->fetch()) {
                                                                                                    $id_consultation2 = $resultat_rechercher_consultation['Idconsultation'];
                                                                                                    $selection_des_prescription = $bdd->prepare("SELECT * FROM prescription WHERE Idconsultation = '$id_consultation2'");
                                                                                                    $selection_des_prescription->execute();
                                                                                                    $resultat_selection_des_prescription = $selection_des_prescription->fetch();
                                                                                                ?>
                                                                                                    
                                                                                                    <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Consultation</strong></h5>
                                                                                                        <h5><strong>Id Medecin :</strong> <?php echo $resultat_rechercher_consultation['Idmedecin'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Poids :</strong> <?php echo $resultat_rechercher_consultation['poids'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Hauteur :</strong> <?php echo $resultat_rechercher_consultation['hauteur'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Diagnostique :</strong> <?php echo $resultat_rechercher_consultation['diagnostique'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Date consultation :</strong> <?php echo $resultat_rechercher_consultation['date_consultation'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Prescription :</strong> <?php echo $resultat_selection_des_prescription['prescription'];?></h5>
                                                                                                        <hr>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
                                                                                        <div style="width: 100%; display: flex; justify-content: right;" class="signature">
                                                                                            <img style="width: 80px;" src="images/signature2.png" alt="">
                                                                                        </div>
                                                                                </div>
                                                                            <?php
                                                                        }else {
                                                                            $sexe_patient = $resutat_selection_des_patients['sexe'];
                                                                            if ($sexe_patient == "Feminin") {
                                                                                $sexe_patient = "elle";
                                                                            }else {
                                                                                $sexe_patient = "il";
                                                                            }
                                                                            ?>
                                                                                <p>Ce patient n'a pas encore fait de consultation donc <?php echo $sexe_patient;?> n'a pas de dossier!</p>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                                </div>
                                                            </div>
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
                                                <th>Dossiers</th>
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
                                                                <td><a class="modal-trigger waves-effect waves-light btn" href="#modal<?php echo $resultat_rechercher_patient['Idpatient'];?>">Voir son dossier</a></td>

                                                                <!-- Modal Structure -->
                                                            <div id="modal<?php echo $resultat_rechercher_patient['Idpatient'];?>" class="modal">
                                                                <div class="icon-close">
                                                                    <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                                                                </div>
                                                                <div class="modal-content">
                                                                <img src="images/logo_eka_landscape.png" alt="">
                                                                <div>
                                                                    <?php
                                                                        $id_patient = $resultat_rechercher_patient['Idpatient'];
                                                                        $rechercher_consultation = $bdd->prepare("SELECT * FROM consultation WHERE Idpatient = '$id_patient'");
                                                                        $rechercher_consultation->execute();

                                                                        $nombre_de_consultations = $rechercher_consultation->rowCount();
                                                                        if ($nombre_de_consultations != 0) {
                                                                            ?>
                                                                                <div class="affiche">
                                                                                        <p style=" width: 100%; text-align: center;">Dossier de</p>
                                                                                        <h5><strong>Nom :</strong> <?php echo $resultat_rechercher_patient['nom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Prenom :</strong> <?php echo" ". $resultat_rechercher_patient['prenom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Sexe :</strong> <?php echo $resultat_rechercher_patient['sexe'];?></h5>
                                                                                        <hr>
                                                                                        <br> <br>
                                                                                        <?php
                                                                                            while ($resultat_rechercher_consultation = $rechercher_consultation->fetch()) {
                                                                                                    $id_consultation2 = $resultat_rechercher_consultation['Idconsultation'];
                                                                                                    $selection_des_prescription = $bdd->prepare("SELECT * FROM prescription WHERE Idconsultation = '$id_consultation2'");
                                                                                                    $selection_des_prescription->execute();
                                                                                                    $resultat_selection_des_prescription = $selection_des_prescription->fetch();
                                                                                                ?>
                                                                                                    
                                                                                                    <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Consultation</strong></h5>
                                                                                                        <h5><strong>Id Medecin :</strong> <?php echo $resultat_rechercher_consultation['Idmedecin'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Poids :</strong> <?php echo $resultat_rechercher_consultation['poids'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Hauteur :</strong> <?php echo $resultat_rechercher_consultation['hauteur'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Diagnostique :</strong> <?php echo $resultat_rechercher_consultation['diagnostique'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Date consultation :</strong> <?php echo $resultat_rechercher_consultation['date_consultation'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Prescription :</strong> <?php echo $resultat_selection_des_prescription['prescription'];?></h5>
                                                                                                        <hr>
                                                                                                        <br>
                                                                                                        <br>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
                                                                                        <div style="width: 100%; display: flex; justify-content: right;" class="signature">
                                                                                            <img style="width: 80px;" src="images/signature2.png" alt="">
                                                                                        </div>
                                                                                </div>
                                                                            <?php
                                                                        }else {
                                                                            $sexe_patient = $resutat_selection_des_patients['sexe'];
                                                                            if ($sexe_patient == "Feminin") {
                                                                                $sexe_patient = "elle";
                                                                            }else {
                                                                                $sexe_patient = "il";
                                                                            }
                                                                            ?>
                                                                                <p>Ce patient n'a pas encore fait de consultation donc <?php echo $sexe_patient;?> n'a pas de dossier!</p>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                                </div>
                                                            </div>
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
                                    <h5>Il n'y a pas encore de patients enregistrés</h5>
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