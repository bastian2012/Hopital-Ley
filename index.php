<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Centre hospitalier </title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/index1.css">
    <script type="text/javascript" src="js/materialize.min.js"></script>
    
</head>
<body>
    <?php
        // Email et mot de passe de connexion
        $email_connect = "admin@esih.edu";
        $password_connect = "admin123";

        
        if (isset($_POST['connect'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($email == $email_connect && $password == $password_connect) {
            
                ?>
                    <!-- <script>window.location.pathname = "patients.php"</script> -->
                    
                <?php
                header("Location: patients.php");
            }
            else {
                ?>
                    <script>
                        M.toast({html: "L'email ou le mot de passe est incorrect!"});
                    </script>
                <?php
            }
        }
    ?>
    <div class="corps">
        <div class="points1">
            <img style="width: 80px; margin-top: -24px;" src="images/pensement-removebg-preview.png" alt="">
        </div>
        <div class="card teal darken-1 z-depth-2">
            <div class="en-tete-card">
                <!-- <img src="" alt="" width="20px" > -->
                
            </div>
            <div class="card-corps">
                <div class="card-corps-left">
                    <div class="card-corps-left-item1">
                        <i class="las la-ambulance"></i>
                    </div>
                    <div class="card-corps-left-item1">
                        <i class="las la-procedures"></i>
                    </div>
                    <div class="card-corps-left-item1">
                        <i class="las la-user-nurse"></i>
                    </div>
                    
                    <div class="card-corps-left-item1">
                        <i class="las la-prescription-bottle-alt"></i>
                    </div>
                    
                </div>
                <div class="card-corps-center">
                    <div class="desc">
                        <h4>Pour une meilleure consultation</h4>
                    </div>
                    <div class="connect">
                        <a class="waves-effect green btn modal-trigger" href="#modal1"><i class="las la-key"></i>Login</a>

                        <!-- Modal Structure -->
                        <div id="modal1" class="modal">
                            <div class="icon-close">
                                <a href="" class="close-modal"><i style="color:  red; position: absolute; right: 10px; top: 10px;" class="lar la-times-circle"></i></a>
                            </div>
                            <div class="modal-content">
                            <img src="images/logo_eka_landscape.png" alt="">
                            <p>Log in form</p>
                            <div class="row">
                                <form class="col s12" method="post">
                                  <div class="row">
                                    <div class="input-field col s6">
                                        <i class="las la-user-tie prefix"></i>
                                      <input name="email" id="icon_prefix" type="email" class="validate">
                                      <label for="icon_prefix">Email</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="las la-lock prefix"></i>
                                      <input name="password" id="icon_telephone" type="password" class="validate">
                                      <label for="icon_telephone">Password</label>
                                    </div>
                                  </div>
                                  <button name="connect" class="waves-effect waves-light btn" type="submit">Connect</button>
                                </form>
                              </div>
                            </div>
                        </div>

                    </div>
                    <div class="powered">
                        <p>Powered by :</p>
                        <p>Cherenfant Rubenson

                        &copy alright reserved
                        </p>
                    </div>
                </div>
                <div class="card-corps-right">
                    <img src="images/bg.jpg" alt="">
                </div>
            </div>
          </div>
          <div class="points2">
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
            <div class="point-item"></div>
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