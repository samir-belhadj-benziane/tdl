<?php
date_default_timezone_set('Europe/Paris');

class User extends DataBase
{

    private $pdo;

    private int $id;
    public string $username;
    public string $lastname;
    public string $mail;
    public string $confirm_mail;
    public string $password;
    public string $confirm_password;
    public string $phone;
    public string $country;
    public string $birthday;


    public function register($username, $mail, $password)

    {

        if (isset($username) and isset($mail) and isset($password)) {

            $usernamelenght = strlen($username);

            $getmail = $this->connect()->prepare("SELECT * FROM users WHERE mail = ?");
            $getmail->execute(array($mail));
            $getmailcount = $getmail->rowCount();








            if ($usernamelenght >= 2 && $usernamelenght <= 18) {
                $message1 = "Le Nom D'utilisateur est valide ✅/2";
                $usernameaccess = 1;
            } else {
                $message1 = "Le Nom D'utilisateur doit contenir 2 a 18 caractères ! ❌/1";
                $usernameaccess = 0;
            }










            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                if ($getmailcount == 0) {
                    $mailaccess = 1;
                    $message2 = "L'E-mail est valide ✅/2";
                } else {
                    $mailaccess = 0;
                    $message2 = "Veuillez vous connecter ! ❌/1";
                }
            } else {
                $mailaccess = 0;
                $message2 = "L'E-mail n'est pas correct ! ❌/1";
            }

            if ($password != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
                $message4 = "Le Mot de Passe est valide ✅/2";
                $passwordaccess = 1;
            } else {
                $message4 = "Le Mot de Passe ne doit pas etre vide ! ❌/1";
                $passwordaccess = 0;
            }



            if ($usernameaccess == 1 && $mailaccess == 1 && $passwordaccess == 1) {
                $register = $this->connect()->prepare("INSERT INTO users (username, mail, password) VALUES (?, ?, ?)");
                $register->execute(array($username, $mail, $password));
                $message3 = "Votre Compte a ete creer ! ✅/2";
                return $message3 . ',' . $message1 . ',' . $message2 . ',' . $message4;
            } else {
                return ' ' . ',' . $message1 . ',' . $message2 . ',' . $message4;
            }
        } else {
            return "Veuillez remplir tout les champs ! ❌/0";
        }
    }




    public function connection($mail, $password)
    {

        if (!empty($mail) and !empty($password) and $password != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
            $getmail = $this->connect()->prepare("SELECT * FROM users WHERE mail = ?");
            $getmail->execute(array($mail));
            $mailcount = $getmail->rowCount();




            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                if ($mailcount == 1) {
                    $mailaccess = 1;
                } else {
                    $mailaccess = 0;
                    $message = "Veuillez creer un compte ! ❌/1";
                }
            } else {
                $mailaccess = 0;
                $message = "L'E-mail n'est pas correct ! ❌/1";
            }





            if ($mailaccess == 1) {
                $getusers = $this->connect()->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
                $getusers->execute(array($mail, $password));
                $usersexist = $getusers->rowCount();

                if ($usersexist == 1) {
                    $usersinfo = $getusers->fetch();
                    $_SESSION['id'] = $usersinfo['id'];
                    $success = "Vous etes connecte ! ✅/2";
                    return $success;
                } else {
                    $erreur = "Vos informations sont incorrect ! ❌/1";
                    return $erreur;
                }
            } else {
                return $message;
            }
        } else {
            return "Veuillez remplir tout les champs ! ❌/0";
        }
    }

    public function disconnect()
    {
        session_destroy();
        $url = $_SERVER['PHP_SELF'];
        header("Refresh:0;" . $url);
    }





    public function update($username, $lastname, $mail, $password, $phone, $avatarname, $avatartype, $avatartmp_name, $avatarerror, $avatarsize)
    {
        $getallinfos = $this->connect()->prepare("SELECT * FROM users WHERE id_utilisateur = ?");
        $getallinfos->execute(array($_SESSION['id']));
        $getallinfosinfo = $getallinfos->fetch();

        if (!empty($username) && $getallinfosinfo['username'] != $username) {
            $usernamelenght = strlen($_POST['username']);
            if ($usernamelenght >= 2 && $usernamelenght <= 18) {
                $updateusername = $this->connect()->prepare("UPDATE users SET username = ? WHERE id_utilisateur = ?");
                $updateusername->execute(array($username, $_SESSION['id']));
                $successfirst = "Votre prenom a bien été modifié !";
                // return $successfirst;
            } else {
                $erreurfirst = "Votre prenom est soit trop court ou soit trop long !";
                // return $erreurfirst;
            }
        } else {
            $erreurfirst = "Votre prenom n'a pas été modifié !";
            // return $erreurfirst;
        }

        if (!empty($lastname) && $getallinfosinfo['lastname'] != $lastname) {
            $lastnamelenght = strlen($_POST['lastname']);
            if ($lastnamelenght >= 2 && $lastnamelenght <= 18) {
                $updatelastname = $this->connect()->prepare("UPDATE users SET lastname = ? WHERE id_utilisateur = ?");
                $updatelastname->execute(array($lastname, $_SESSION['id']));
                $successname = "Votre nom a bien été modifié !";
            } else {
                $erreurname = "Votre nom est soit trop court ou soit trop long !";
            }
        } else {
            $erreurname = "Votre nom n'a pas été modifié !";
        }

        if (!empty($mail) && $getallinfosinfo['mail'] != $mail) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $getmail = $this->connect()->prepare("SELECT * FROM users WHERE mail = ?");
                $getmail->execute(array($mail));
                $mailcount = $getmail->rowCount();
                if ($mailcount == 0) {
                    $updatemail = $this->connect()->prepare("UPDATE users SET mail = ? WHERE id_utilisateur = ?");
                    $updatemail->execute(array($mail, $_SESSION['id']));
                    $successmail = "Votre E-mail a bien été modifié !";
                } else {
                    $erreurmail = "Nous n'avons pas pu changé votre E-mail !";
                }
            } else {
                $erreurmail = "Votre E-mail n'est pas correct";
            }
        } else {
            $erreurmail = "Votre E-mail n'a pas été modifié !";
        }

        if (!empty($password) && $getallinfosinfo['password'] != $password && $password != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
            $updatepassword = $this->connect()->prepare("UPDATE users SET password = ? WHERE id_utilisateur = ?");
            $updatepassword->execute(array($password, $_SESSION['id']));
            $successpass = "Votre mot de passe a bien été modifié !";
            // return $successpass;
        } else {
            $erreurpass = "Votre mot de passe n'a pas été modifié !";
            // return $erreurpass;
        }

        if (!empty($phone) && $getallinfosinfo['phone'] != $phone) {
            $updatephone = $this->connect()->prepare("UPDATE users SET phone = ? WHERE id_utilisateur = ?");
            $updatephone->execute(array($phone, $_SESSION['id']));
            $successphone = "Votre numero de téléphone a bien été modifié !";
            // return $successphone;
        } else {
            $erreurphone = "Votre numero de téléphone n'a pas été modifié !";
            // return $erreurphone;
        }

        if (isset($_FILES['file'])) {
            $tailleMax = 2097152;
            $extensionsValide = array('jpg', 'jpeg', 'gif', 'png');

            if ($avatarsize <= $tailleMax) {
                $extensionUpload = strtolower(substr(strrchr($avatarname, '.'), 1));
                if (in_array($extensionUpload, $extensionsValide)) {
                    $chemin = "../views/img/avatar/" . $_SESSION['id'] . "." . $extensionUpload;
                    $resultat = move_uploaded_file($avatartmp_name, $chemin);
                    if ($resultat) {
                        $nameofavatar = $_SESSION['id'] . "." . $extensionUpload;
                        $modavatar = $this->connect()->prepare("UPDATE users SET avatar = ? WHERE id_utilisateur = ?");
                        $modavatar->execute(array($nameofavatar, $_SESSION['id']));
                        $successfile = "Votre photo de profil a bien été modifié !";
                    } else {
                        $erreurfile = "Il y a eu une erreur pendant l'importation du fichier !";
                    }
                } else {
                    $erreurfile = "Votre photo de profil doit être au format jpg jpeg gif ou png !";
                }
            } else {
                $erreurfile = "Votre photo de profil ne doit pas dépasser 2 mo !";
            }
        } else {
            $erreurfile = "Votre photo de profil n'a pas été modifié !";
        }

        if (isset($successfirst)) {
            $messfirst = $successfirst;
        } elseif (isset($erreurfirst)) {
            $messfirst = $erreurfirst;
        }
        if (isset($successname)) {
            $messname = $successname;
        } elseif (isset($erreurname)) {
            $messname = $erreurname;
        }
        if (isset($successmail)) {
            $messmail = $successmail;
        } elseif (isset($erreurmail)) {
            $messmail = $erreurmail;
        }
        if (isset($successpass)) {
            $messpass = $successpass;
        } elseif (isset($erreurpass)) {
            $messpass = $erreurpass;
        }
        if (isset($successphone)) {
            $messphone = $successphone;
        } elseif (isset($erreurphone)) {
            $messphone = $erreurphone;
        }
        if (isset($successfile)) {
            $messfile = $successfile;
        } elseif (isset($erreurfile)) {
            $messfile = $erreurfile;
        }

        return  $messfirst . ',' . $messname . ',' . $messmail . ',' . $messpass . ',' . $messphone . ',' . $messfile;
    }

    public function addList($name)
    {
        if (!empty($name)) {
            $addList = $this->connect()->prepare("INSERT INTO tasklist (name, id_users) VALUES (?, ?)");
            $addList->execute(array($name, $_SESSION['id']));
        }
    }

    public function deleteList($iddelete)
    {
        $deletelist = $this->connect()->prepare('DELETE FROM tasklist WHERE id = ? and id_users = ?');
        $deletelist->execute(array($iddelete, $_SESSION['id']));
    }

    public function validList($idvalid)
    {

        $getListByIdUser = $this->connect()->prepare("SELECT * FROM tasklist WHERE id = ?");
        $getListByIdUser->execute(array($idvalid));
        $getListByIdUserInfo = $getListByIdUser->fetch();

        if ($getListByIdUserInfo['status'] == 1) {
            $validlist = $this->connect()->prepare("UPDATE tasklist SET status = ? , ending_at = ? WHERE id = ?");
            $validlist->execute(array(0, '', $idvalid));

            echo '☐/En cours';
        } else {
            $validlist = $this->connect()->prepare("UPDATE tasklist SET status = ? , ending_at = ? WHERE id = ?");
            $validlist->execute(array(1, date("Y-m-d H:i:s"), $idvalid));

            $getListByIdUser0 = $this->connect()->prepare("SELECT * FROM tasklist WHERE id = ?");
            $getListByIdUser0->execute(array($idvalid));
            $getListByIdUserInfo0 = $getListByIdUser0->fetch();

            echo '☒/' . $getListByIdUserInfo0['ending_at'];
        }



        // $validlist1 = $this->connect()->prepare("UPDATE tasklist SET ending_at = ? WHERE id = ?");
        // $validlist1->execute(array(date("Y-m-d H:i:s"), $idvalid));
    }

    public function getListByIdUserAndNotValid()
    {
        $getListByIdUser = $this->connect()->prepare("SELECT * FROM tasklist WHERE id_users = ? and status = ? ORDER BY id DESC");
        $getListByIdUser->execute(array($_SESSION['id'], 0));
        $getListByIdUserInfo = $getListByIdUser->fetchAll();
        return $getListByIdUserInfo;
    }

    public function getListByIdUserAndValid()
    {
        $getListByIdUser = $this->connect()->prepare("SELECT * FROM tasklist WHERE id_users = ? and status = ? ORDER BY id DESC");
        $getListByIdUser->execute(array($_SESSION['id'], 1));
        $getListByIdUserInfo = $getListByIdUser->fetchAll();
        return $getListByIdUserInfo;
    }

    public function getAllListByIdUser()
    {
        $getListByIdUser = $this->connect()->prepare("SELECT * FROM tasklist WHERE id_users = ? ORDER BY id DESC");
        $getListByIdUser->execute(array($_SESSION['id']));
        $getListByIdUserInfo = $getListByIdUser->fetchAll();
        return $getListByIdUserInfo;
    }

    public function getAllListByNameOnly($name)
    {
        $getListByIdUser = $this->connect()->prepare("SELECT * FROM tasklist WHERE name = ?");
        $getListByIdUser->execute(array($name));
        $getListByIdUserInfo = $getListByIdUser->fetch();
        return $getListByIdUserInfo;
    }


    public function getAllInfos($getid)
    {
        $getallinfos = $this->connect()->prepare("SELECT * FROM users WHERE id = ?");
        $getallinfos->execute(array($getid));
        $getallinfosinfo = $getallinfos->fetch();
        return $getallinfosinfo;
    }
}
