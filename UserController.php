<?php
	session_start();
    Class UserController extends Controller {
        // Fonction d'inscription d'un utilisateur dans la BDD
        public function createUser($login, $pseudo, $pass) {
            $req_ins = "INSERT INTO utilisateur VALUES (0, :pseudo, sha2(:mdp, 512), :login, 0, 0)";
			$res_ins = $this->connex->prepare($req_ins);
			$res_ins->execute(array(":pseudo"=>$pseudo,
									":login"=>$login,
									":mdp"=>$pass
									));
        }
        // Vérifie l'existance d'un utilisateur dans la base de donnée en fonction d'un email et d'un mot de passe
		public function testUser($login, $password) {
			$req_con = "select count(id_utilisateur) from utilisateur where login_utilisateur=:login and mdp_utilisateur=sha2(:mdp, 512)";
			$res_con = $this->connex->prepare($req_con);
			$res_con->execute(array(":login"=>$login, ":mdp"=>$password));
			$sel = $res_con->fetch();
			if ($sel[0]==1):
				return true;
				else:
					return false;
			endif;
		}
        // Fonction de création de session pour l'utilisateur lors de la connexion
		public function identification($login) {
			$req_ses = "select id_utilisateur, pseudonyme_utilisateur, id_departement from utilisateur where login_utilisateur=:login";
			$res_ses = $this->connex->prepare($req_ses);
			$res_ses->execute(array(":login"=>$login));
			$sel=$res_ses->fetch();

			$_SESSION["id"] = session_id();
			$_SESSION["id_user"] = $sel[0];
			$_SESSION["pseudo"] = $sel[1];
			$_SESSION["login"] = $login;
        }
        // Vérifie si l'email est disponible à l'utilisation
		public function loginVerif($login) {
			$req_ver = "select count(id_utilisateur) from utilisateur where login_utilisateur=:login";
			$res_ver = $this->connex->prepare($req_ver);
			$res_ver->execute(array(":login"=>$login));
			$sel=$res_ver->fetch();
			if ($sel[0] == 0):
				return true;
				else:
					return false;
			endif;
		}
		// Vérifie si le pseudonyme est disponible à l'utilisation 
		public function pseudoVerif($pseudo) {
			$req_ver = "select count(id_utilisateur) from utilisateur where pseudonyme_utilisateur=:pseudo";
			$res_ver = $this->connex->prepare($req_ver);
			$res_ver->execute(array(":pseudo"=>$pseudo));
			$sel=$res_ver->fetch();
			if ($sel[0] == 0):
				return true;
				else:
					return false;
			endif;
		}
		// Vérifie si le pseudonyme est disponible à l'utilisation 
		public function mdpVerif($mdp, $mdpC) {
			if($mdp != $mdpC): // Condition vérifiant si les deux mots de passe fournis sont identiques
				echo "Les mots de passe ne correspondent pas";
				//return false;
				elseif(strlen($mdp) < 6):	// Condition vérifiant la longueur du mot de passe (6 caractères minimum)
					echo "Votre mot de passe doit contenir au moins 6 caractères";
					return false;
					elseif($mdp == strtoupper($mdp) || $mdp == strtolower($mdp)): // Condition vérifiant la présence d'au moins une minuscule et d'une majuscule dans le mot de passe
						echo "Votre mot de passe doit contenir au moins une minuscule et une majuscule";
						return false;
						elseif(!preg_match("~[0-9]~", $mdp)): // Condition vérifiant la présence d'au moins un chiffre dans le mot de passe
							echo "Votre mot de passe doit contenir un chiffre";
							return false;
							else:
								return true;
			endif;
		}
        // Permet de mettre à jour le mot de passe d'un utilisateur en fonction de son id
        public function updatePassUser($pass, $id) {
            $req_upd = "UPDATE utilisateur SET mdp_utilisateur = :pass WHERE id_utilisateur = :id";
            $res_upd = $this->connex->prepare($req_upd);
            $res_upd->execute(array(":pass"=>$pass,
                                    ":id"=>$id));
        }
    }
?>