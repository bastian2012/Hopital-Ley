<?php
    include_once("connexion.php");
    $dossier_existe = false;
    $voir = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <title>Dossiers</title>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/dossier2.css">
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
<body>
    <?php
        if (isset($_POST['enregistrer'])) {
            $idconsultation = $_POST['idconsultation'];
            $code = $_POST['code'];
            $date = $_POST['date'];

            $insertion_des_dossiers = $bdd->prepare("INSERT INTO dossier(code,Idconsultation,date_enregistrement) VALUES(?,?,?)");
            $insertion_des_dossiers->execute(array($code,$idconsultation,$date));
            if ($insertion_des_dossiers) {
                ?>
                    <script>
                        M.toast({html: "L'enregistrement est réussi!"});
                    </script>
                <?php
            }
        }

        if (isset($_POST['rechercher'])) {
            $dossier_rechercher = $_POST['dossier-recherche'];
    
            $rechercher_dossier = $bdd->prepare("SELECT * FROM dossier WHERE code = '$dossier_rechercher'");
            $rechercher_dossier->execute();
    
            $nombre_rechercher_dossier = $rechercher_dossier->rowCount();
    
            if ($nombre_rechercher_dossier != 0) {
                $dossier_existe = true;
            }else {
                ?>
                    <script>
                        M.toast({html: "Aucun dossier portant ce code n'a été trouvé!"});
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
                <h5>Liste des dossiers</h5>
                <form class="form-en-tete" action="" method="post">
                    <input name="dossier-recherche" style="background: white; height: 25px; margin-top: 10px; padding-left: 10px; border-radius: 5px; margin-right: 10px;" type="text" placeholder="Rechercher un dossier">
                    <button name="rechercher" class="btn-floating cyan" type="submit"><i style="color: white; font-size: 15px;" class="las la-search"></i></button>
                </form>
                <a style="position: absolute; right: 30px;" class="waves-effect cyan btn modal-trigger" href="#modal"><i class="las la-add"></i>ajouter un dossier</a>

                <!-- Modal Structure -->
                <div id="modal" class="modal">
                    <div class="icon-close">
                        <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                    </div>
                    <div class="modal-content">
                    <img src="images/logo_eka_landscape.png" alt="">
                    <p>Ajouter un dossier</p>
                    <div class="row">
                        <form class="col s12" method="post">
                          <div class="row">
                          <div class="input-field col s6">
                                <select name="idconsultation" class="browser-default" required>
                                  <option value="" disabled selected>Id consultation</option>
                                  <?php
                                    $rechercher_consultation = $bdd->prepare("SELECT Idconsultation FROM consultation");
                                    $rechercher_consultation->execute();
                                    while ($resultat_rechercher_consultation = $rechercher_consultation->fetch()) {
                                        ?>
                                            <option value="<?php echo $resultat_rechercher_consultation['Idconsultation']; ?>"><?php echo $resultat_rechercher_consultation['Idconsultation']; ?></option>
                                        <?php
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <?php
                                    $select_code_dossier = $bdd->prepare("SELECT max(code) AS mc FROM dossier");
                                    $select_code_dossier->execute();
                                    $codes = $select_code_dossier->fetch();
                                    $new_code = $codes['mc']+1000;
                                ?>
                              <input name="code" id="icon_telephone" type="number" class="validate" value="<?php echo $new_code;?>">
                              <label for="icon_telephone">Code</label>
                            </div>
                            <div class="input-field col s12">
                              <input name="date" id="icon_prefix" type="date" class="validate" required>
                              <label for="icon_prefix">Date</label>
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
                        <img src="images/20944142.jpg" alt="">
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
                                    <i class="las la-user-injured"></i>
                                    <a href="patients.php">Patients</a>
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
                        $selectionner_existance_des_dossiers = $bdd->prepare("SELECT * FROM dossier");
                        $selectionner_existance_des_dossiers->execute();
                        $nombre_des_dossiers = $selectionner_existance_des_dossiers->rowCount();

                        if ($nombre_des_dossiers != 0) {
                            if ($dossier_existe == false) {
                                ?>
                                <table class="content-table">
                                    <thead>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Codes</th>
                                        <th>Dates</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $selection_des_dossiers = $bdd->prepare("SELECT * FROM dossier");
                                            $selection_des_dossiers->execute();

                                            while ($resutat_selection_des_dossiers = $selection_des_dossiers->fetch()) {
                                                $id_consultation4 = $resutat_selection_des_dossiers['Idconsultation'];
                                                ?>
                                                    <tr>
                                                            <td><img style="width: 40px; object-fit: cover; margin: -12px;" src="images/6306484-removebg-preview.png" alt=""></td>
                                                            <td><?php echo $resutat_selection_des_dossiers['Iddossier'];?></td>
                                                            <td><?php echo $resutat_selection_des_dossiers['code'];?></td>
                                                            <td><?php echo $resutat_selection_des_dossiers['date_enregistrement'];?></td>

                                                            <td>
                                                                    <a href="#modal<?php echo $resutat_selection_des_dossiers['Iddossier'];?>" class="modal-trigger waves-effect waves-light btn">Voir son contenu</a>

                                                                    <!-- Modal Structure -->
                                                                    <div id="modal<?php echo $resutat_selection_des_dossiers['Iddossier'];?>" class="modal">
                                                                        <div class="icon-close">
                                                                            <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                                                                        </div>
                                                                        <div class="modal-content">
                                                                        <img src="images/logo_eka_landscape.png" alt="">
                                                                        <p><strong>Dossier Code <?php echo $resutat_selection_des_dossiers['code'];?></strong></p>
                                                                        <div class="">
                                                                            <div class="afficher-contenu-dossier">
                    
                                                                                <?php

                                                                                    $selection_des_consultations5 = $bdd->prepare("SELECT * FROM consultation WHERE Idconsultation = '$id_consultation4'");
                                                                                    $selection_des_consultations5->execute();
                                                                                    $select_patient_info = $selection_des_consultations5->fetch();
                                                                                    $i_patient5 = $select_patient_info['Idpatient'];

                                                                                    $select_patient_info2 = $bdd->prepare("SELECT * FROM patient WHERE Idpatient = '$i_patient5'");
                                                                                    $select_patient_info2->execute();
                                                                                    $res_patient_info = $select_patient_info2->fetch();

                                                                                    $id_patient = $res_patient_info['Idpatient'];
                                                                                    $selection_des_consultations4 = $bdd->prepare("SELECT * FROM consultation WHERE Idpatient = '$id_patient'");
                                                                                    $selection_des_consultations4->execute();

                                                                                    
                                                                                    ?>
                                                                                    <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Patient</strong></h5>
                                                                                        <h5><strong>Nom :</strong> <?php echo $res_patient_info['nom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Prenom :</strong> <?php echo $res_patient_info['prenom'];?></h5>
                                                                                        <hr>
                                                                                        <h5><strong>Sexe :</strong> <?php echo $res_patient_info['sexe'];?></h5>
                                                                                        <br>
                                                                                        <br>
                                                                                    <?php
                                                                                    while ($resultat_selection_des_consultations4 = $selection_des_consultations4->fetch()) {
                                                                                            $id_medecin = $resultat_selection_des_consultations4['Idmedecin'];
                                                                                            $select_medecin = $bdd->prepare("SELECT * FROM medecin WHERE Idmedecin = '$id_medecin'");
                                                                                            $select_medecin->execute();
                                                                                            $resultat_select_medecin = $select_medecin->fetch();
                                                                                        ?>
                                                                                            <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Consultation</strong></h5>
                                                                                                        <h5><strong>Nom medecin :</strong> <?php echo $resultat_select_medecin['nom'];?> <?php echo $resultat_select_medecin['prenom'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Poids :</strong> <?php echo $resultat_selection_des_consultations4['poids'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Hauteur :</strong> <?php echo $resultat_selection_des_consultations4['hauteur'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Diagnostique :</strong> <?php echo $resultat_selection_des_consultations4['diagnostique'];?></h5>
                                                                                                        <hr>
                                                                                                        <h5><strong>Date Consultation :</strong> <?php echo $resultat_selection_des_consultations4['date_consultation'];?></h5>
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
                                                                        </div>
                                                                        </div>
                                                                        <!-- <div class="modal-footer">
                                                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                                                                        </div> -->
                                                                    </div>
                                                            </td>
                                                            <!-- Modal Structure -->
                                                            
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
                                                <th></th>
                                                <th>Id</th>
                                                <th>Codes</th>
                                                <th>Dates</th>
                                                <th>Options</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    



                                                    while ($resultat_rechercher_dossier = $rechercher_dossier->fetch()) {
                                                        $id_consultation4 = $resultat_rechercher_dossier['Idconsultation'];
                                                        ?>
                                                            <tr>
                                                                    <td><img style="width: 40px; object-fit: cover; margin: -12px;" src="images/6306484-removebg-preview.png" alt=""></td>
                                                                    <td><?php echo $resultat_rechercher_dossier['Iddossier'];?></td>
                                                                    <td><?php echo $resultat_rechercher_dossier['code'];?></td>
                                                                    <td><?php echo $resultat_rechercher_dossier['date_enregistrement'];?></td>
        
                                                                    <td>
                                                                            <a href="#modal<?php echo $resultat_rechercher_dossier['Iddossier'];?>" class="modal-trigger waves-effect waves-light btn">Voir son contenu</a>
        
                                                                            <!-- Modal Structure -->
                                                                            <div id="modal<?php echo $resultat_rechercher_dossier['Iddossier'];?>" class="modal">
                                                                                <div class="icon-close">
                                                                                    <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                                                                                </div>
                                                                                <div class="modal-content">
                                                                                <img src="images/logo_eka_landscape.png" alt="">
                                                                                <p><strong>Dossier Code <?php echo $resultat_rechercher_dossier['code'];?></strong></p>
                                                                                <div class="">
                                                                                    <div class="afficher-contenu-dossier">
                            
                                                                                        <?php
                                                                                            $selection_des_consultations5 = $bdd->prepare("SELECT * FROM consultation WHERE Idconsultation = '$id_consultation4'");
                                                                                            $selection_des_consultations5->execute();
                                                                                            $select_patient_info = $selection_des_consultations5->fetch();
                                                                                            $i_patient5 = $select_patient_info['Idpatient'];
        
                                                                                            $select_patient_info2 = $bdd->prepare("SELECT * FROM patient WHERE Idpatient = '$i_patient5'");
                                                                                            $select_patient_info2->execute();
                                                                                            $res_patient_info = $select_patient_info2->fetch();

                                                                                            $id_patient_rechercher = $res_patient_info['Idpatient'];

                                                                                            $selection_des_consultations4 = $bdd->prepare("SELECT * FROM consultation WHERE Idpatient = '$id_patient_rechercher'");
                                                                                            $selection_des_consultations4->execute();
        
                                                                                            ?>
                                                                                            <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Patient</strong></h5>
                                                                                                <h5><strong>Nom :</strong> <?php echo $res_patient_info['nom'];?></h5>
                                                                                                <hr>
                                                                                                <h5><strong>Prenom :</strong> <?php echo $res_patient_info['prenom'];?></h5>
                                                                                                <hr>
                                                                                                <h5><strong>Sexe :</strong> <?php echo $res_patient_info['sexe'];?></h5>
                                                                                                <br>
                                                                                                <br>
                                                                                            <?php
                                                                                            while ($resultat_selection_des_consultations4 = $selection_des_consultations4->fetch()) {
                                                                                                $id_medecin = $resultat_selection_des_consultations4['Idmedecin'];
                                                                                                $select_medecin = $bdd->prepare("SELECT * FROM medecin WHERE Idmedecin = '$id_medecin'");
                                                                                                $select_medecin->execute();
                                                                                                $resultat_select_medecin = $select_medecin->fetch();
                                                                                                ?>
                                                                                                    <h5 style="width: 100%; display: flex; justify-content: center;"><strong>Consultation</strong></h5>
                                                                                                                <h5><strong>Nom medecin :</strong> <?php echo $resultat_select_medecin['nom'];?> <?php echo $resultat_select_medecin['prenom'];?></h5>
                                                                                                                <hr>
                                                                                                                <h5><strong>Poids :</strong> <?php echo $resultat_selection_des_consultations4['poids'];?></h5>
                                                                                                                <hr>
                                                                                                                <h5><strong>Hauteur :</strong> <?php echo $resultat_selection_des_consultations4['hauteur'];?></h5>
                                                                                                                <hr>
                                                                                                                <h5><strong>Diagnostique :</strong> <?php echo $resultat_selection_des_consultations4['diagnostique'];?></h5>
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
                                                                                </div>
                                                                                </div>
                                                                                <!-- <div class="modal-footer">
                                                                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                                                                                </div> -->
                                                                            </div>
                                                                    </td>
                                                                    <!-- Modal Structure -->
                                                                    
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
                                    <h5>Il n'y a pas encore de dossiers enregistrés</h5>
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