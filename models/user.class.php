<?php


class User extends DataBase
{

    private $pdo;

    private int $id;
    public string $username;
    public string $mail;
    public string $password;
    public string $confirm_password;
    public string $created_at;
    public string $last_modified;
    public string $phone;
    public string $birthday;


    public function register($username, $mail, $password, $date)
    {
        if (isset($username) and isset($mail) and isset($password)) {

            $usernamelenght = strlen($username);
            $passwordlenght = strlen($password);


            $getusername = $this->connect()->prepare("SELECT * FROM users WHERE username = ?");
            $getusername->execute(array($username));
            $getusernamecount = $getusername->rowCount();

            if ($usernamelenght >= 6 && $usernamelenght <= 18) {
                if ($getusernamecount == 0) {
                    $message1 = "Le Nom D'utilisateur est valide ✅";
                    $usernameaccess = 1;
                } else {
                    $usernameaccess = 0;
                    $message1 = "Le Nom D'utilisateur existe deja ! ❌";
                }
            } else {
                $message1 = "Le Nom D'utilisateur doit contenir 6 a 18 caractères ! ❌";
                $usernameaccess = 0;
            }

            $getmail = $this->connect()->prepare("SELECT * FROM users WHERE mail = ?");
            $getmail->execute(array($mail));
            $getmailcount = $getmail->rowCount();

            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                if ($getmailcount == 0) {
                    $mailaccess = 1;
                    $message2 = "L'E-mail est valide ✅";
                } else {
                    $mailaccess = 0;
                    $message2 = "L'E-mail existe deja  ! ❌";
                }
            } else {
                $mailaccess = 0;
                $message2 = "L'E-mail n'est pas correct ! ❌";
            }

            if ($passwordlenght > 4 && $passwordlenght < 18) {
                $message4 = "Le Mot de Passe est valide ✅";
                $passwordaccess = 1;
            } else {
                $message4 = "Le Mot de Passe doit contenir 4 a 18 caractères ! ❌";
                $passwordaccess = 0;
            }

            if ($usernameaccess == 1 && $mailaccess == 1 && $passwordaccess == 1) {
                $passwordright = sha1($password);
                $register = $this->connect()->prepare("INSERT INTO users (username, mail, password) VALUES (?, ?, ?)");
                $register->execute(array($username, $mail, $passwordright));
                $message3 = "Votre Compte a ete creer ! ✅";
                return $message3 . ',' . $message1 . ',' . $message2 . ',' . $message4;
            } else {
                $message3 = "❌";
                return $message3 . ',' . $message1 . ',' . $message2 . ',' . $message4;
            }
        } else {
            $message3 = "Veuillez remplir tout les champs ! ❌";
        }
    }




    public function connection($usermail, $password)
    {

        if (!empty($usermail) and !empty($password) and $password != 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
            $getmail = $this->connect()->prepare("SELECT * FROM users WHERE username = ?");
            $getmail->execute(array($usermail));
            $mailcount = $getmail->rowCount();


            if ($mailcount == 1) {
                $mailaccess = 1;
            } else {
                $mailaccess = 0;
            }


            if ($mailaccess == 1) {
                $getusers = $this->connect()->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                $getusers->execute(array($usermail, $password));
                $usersexist = $getusers->rowCount();

                if ($usersexist == 1) {
                    $usersinfo = $getusers->fetch();
                    $_SESSION['taskies_id_user'] = $usersinfo['id'];
                    $message = "Vous êtes connecté ! ✅";
                    return $message;
                } else {
                    $erreur = "Vos informations sont incorrect ! ❌";
                    return $erreur;
                }
            } else {
                $message = "Veuillez creer un compte ! ❌";
                return $message;
            }
        } else {
            return "Veuillez remplir tout les champs ! ❌";
        }
    }



    public function disconnect()
    {
        session_destroy();
        $url = $_SERVER['PHP_SELF'];
        header("Refresh:0;" . $url);
    }




    public function delete()
    {
        $delete = $this->connect()->prepare('DELETE FROM users WHERE id = ?');
        $delete->execute(array($_SESSION['taskies_id_user']));
        header('Location: ./index.php');
    }


    public function update($mail, $username, $password, $phone)
    {


        if ($mail != '') {
            $maillenght = strlen($mail);
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $updatemail = $this->connect()->prepare("UPDATE users SET mail = ? WHERE id = ?");
                $updatemail->execute(array($mail, $_SESSION['taskies_id_user']));
                $messagemail = "L'E-Mail a ete modifie ! ✅";
            } else {
                $messagemail = "L'E-Mail est incorrect ! ❌";
            }
        } else {
            $messagemail = "L'E-Mail n'a pas ete modifie ! ❌";
        }

        if ($username != '') {
            $usernamelenght = strlen($username);
            if ($usernamelenght >= 3 && $usernamelenght <= 18) {
                $updateusername = $this->connect()->prepare("UPDATE users SET username = ? WHERE id = ?");
                $updateusername->execute(array($username, $_SESSION['taskies_id_user']));
                $messageusername = "Le nom d'utilisateur a ete modifie ! ✅";
            } else {
                $messageusername = "Le nom d'utilisateur doit contenir 3 a 18 caractères ! ❌";
            }
        } else {
            $messageusername = "Le nom d'utilisateur n'a pas ete modifie ! ❌";
        }

        if ($password != '') {
            $password = sha1($password);
            $updatepassword = $this->connect()->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updatepassword->execute(array($password, $_SESSION['taskies_id_user']));
            $messagepassword = "Le mot de passe a ete modifie ! ✅";
        } else {
            $messagepassword = "Le mot de passe n'a pas ete modifie ! ❌";
        }

        if ($phone != '') {
            if (preg_match("/^[0-9]{10}$/", $phone)) {
                $updatephone = $this->connect()->prepare("UPDATE users SET phone = ? WHERE id = ?");
                $updatephone->execute(array($phone, $_SESSION['taskies_id_user']));
                $messagephone = "Le numero de telephone a ete modifie ! ✅";
            } else {
                $messagephone = "Le numero de telephone est incorrect ! ❌";
            }
        } else {
            $messagephone = "Le numero de telephone n'a pas ete modifie ! ❌";
        }

        return $messagemail . ',' . $messageusername . ',' . $messagepassword . ',' . $messagephone;
    }

    public function getAllInfos($getid)
    {
        $getallinfos = $this->connect()->prepare("SELECT * FROM users WHERE id = ?");
        $getallinfos->execute(array($getid));
        $getallinfosinfo = $getallinfos->fetch();
        return $getallinfosinfo;
    }

    public function sendAvatar($urlavartar)
    {
        $sendavatar = $this->connect()->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $sendavatar->execute(array($urlavartar, $_SESSION['taskies_id_user']));
    }
}

$user = new User();
