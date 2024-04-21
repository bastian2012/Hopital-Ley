<?php
    include_once("connexion.php");
    $select_id_consultation = $bdd->prepare("SELECT Idconsultation FROM consultation");
    $select_id_consultation->execute();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <title>Prescriptions</title>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/prescriptions.css">
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
<body>
    <?php
        if (isset($_POST['enregistrer'])) {
            $idconsultation = $_POST['idconsultation'];
            $prescription = $_POST['prescription'];
    
            $insertion_prescription = $bdd->prepare("INSERT INTO prescription(Idconsultation,prescription) VALUES(?,?)");
            $insertion_prescription->execute(array($idconsultation,$prescription));

            if ($insertion_prescription) {
                ?>
                    <script>
                        M.toast({html: "L'enregistrement est réussi!"});
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
                <h5>Liste des préscriptions</h5>
                <a style="position: absolute; right: 30px;" class="waves-effect cyan btn modal-trigger" href="#modal1"><i class="las la-add"></i>ajouter une préscription</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="icon-close">
                        <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                    </div>
                    <div class="modal-content">
                    <img src="images/logo_eka_landscape.png" alt="">
                    <p>Ajouter une préscription</p>
                    <div class="row">
                        <form class="col s12" method="post">
                          <div class="row">
                          <div class="input-field col s12">
                                <select name="idconsultation" class="browser-default" required>
                                <option value="" disabled selected>Id consultation</option>
                                <?php
                                    while ($resultat_select_id_consultation = $select_id_consultation->fetch()) {
                                        ?>
                                            <option value="<?php echo $resultat_select_id_consultation['Idconsultation'];?>"><?php echo $resultat_select_id_consultation['Idconsultation'];?></option>
                                        <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="input-field col s12">
                                <textarea name="prescription" id="textarea1" class="materialize-textarea" required></textarea>
                                <label for="textarea1">Prescription</label>
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
                                    <i class="las la-user-nurse"></i>
                                    <a href="medecins.php">Enregistrer un médecin</a>
                                    <hr>
                                </div>
                                <div class="menu-en-corps-item">
                                    <i class="las la-notes-medical"></i>
                                    <a href="dossiers.php">Dossiers patients</a>
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
                    <table class="content-table">
                        <thead>
                            <th>Id prescription</th>
                            <th>Id consultation</th>
                            <th>Prescription</th>
                        </thead>
                        <tbody>
                            <?php
                                $select_prescription = $bdd->prepare("SELECT * FROM prescription");
                                $select_prescription->execute();

                                while ($resultat_select_prescription = $select_prescription->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $resultat_select_prescription['Idprescription'];?></td>
                                            <td><?php echo $resultat_select_prescription['Idconsultation'];?></td>
                                            <td><?php echo $resultat_select_prescription['prescription'];?></td>
                                            
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
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