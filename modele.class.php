<?php 

class Modele {

	private $pdo;
	private $uneTable;

	public function __construct($server, $bdd, $user, $mdp) {
		$this->pdo = null;
		try {
			$this->pdo = new PDO("mysql:host=".$server.";dbname=".$bdd.";charset=utf8", $user, $mdp);
		} catch (PDOException $e) {
			die("Erreur de connexion à la base de données : " . $e->getMessage());
		}
	}

	public function setTable($uneTable) {
		$this->uneTable = $uneTable;
	}

	public function selectAll($chaine) {
		if ($this->pdo != null) {
			$requete = "SELECT ".$chaine." FROM " . $this->uneTable;
			$select = $this->pdo->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		} else {
			return null;
		}
	}

	public function selectWhere($chaine, $where) {
		if ($this->pdo != null) {
            $champs = array();
			$donnees = array();
			foreach ($where as $key=>$value) {
				$champs[] = $key." = :".$key;
				$donnees[":".$key] = $value;
			}
			$chaineWhere = implode(" AND ", $champs);
			$requete = "SELECT ".$chaine." FROM ".$this->uneTable." WHERE ".$chaineWhere;
            $select = $this->pdo->prepare($requete);
            $select->execute($donnees);
            return $select->fetch();
		} else {
			return null;
		}
	}

	public function insert($tab) {
		if ($this->pdo != null) {
			$champs = array();
			$donnees = array();
			foreach ($tab as $key=>$value) {
				$champs[] = ":".$key;
				$donnees[":".$key] = $value;
			}
			$chaine = implode(",", $champs);
			$requete = "INSERT INTO ".$this->uneTable." VALUES (null, ".$chaine.")";
			$insert = $this->pdo->prepare($requete);
			$insert->execute($donnees);
		} else {
			return null;
		}
	}

	public function delete($where) {
		if ($this->pdo != null) {
            $champs = array();
			$donnees = array();
			foreach ($where as $key=>$value) {
				$champs[] = $key." = :".$key;
				$donnees[":".$key] = $value;
			}
			$chaine = implode(" AND ", $champs);
			$requete = "DELETE FROM ".$this->uneTable." WHERE ".$chaine;
			$delete = $this->pdo->prepare($requete);
			$delete->execute($donnees);
		} else {
			return null;
		}
	}

    public function update($tab, $where) {
        if ($this->pdo != null) {
            $champs = array();
			$donnees = array();
			foreach ($tab as $key=>$value) {
				$champs[] = $key . " = :".$key;
				$donnees[":".$key] = $value;
			}
			$chaine = implode(",", $champs);
            $champsWhere = array();
            foreach ($where as $key=>$value) {
				$champsWhere[] = $key." = :".$key;
				$donnees[":".$key] = $value;
			}
			$chaineWhere = implode(" AND ", $champsWhere);
            $requete ="UPDATE ".$this->uneTable." SET ".$chaine." WHERE ".$chaineWhere;
            $update = $this->pdo->prepare($requete);
            $update->execute($donnees);
        } else {
            return null;
        }
    }

    public function selectSearch($tab, $mot) {
    	if ($this->pdo != null) {
			$donnees = array();
			$champs = array();
			foreach ($tab as $key) {
				$champs[] = $key." like :mot";
				$donnees[":mot"] = "%".$mot."%";
			}
			$chaineWhere = implode(" or ", $champs);
			$requete = "SELECT * FROM ".$this->uneTable." WHERE ".$chaineWhere;
			$select = $this->pdo->prepare($requete);
			$select->execute($donnees);
			return $select->fetchAll();
    	} else {
    		return null;
    	}
    }

    public function showCountTables() {
    	if ($this->pdo != null) {
    		$requete = "SELECT count(*) as nb FROM ".$this->uneTable;
			$select = $this->pdo->prepare($requete);
			$select->execute();
			return $select->fetch()["nb"];
    	} else {
    		return null;
    	}
    }

    // Ajout de l'appel d'une procédure
    public function appelProc($nom, $tab) {
    	if ($this->pdo != null) {
    		$champs = array();
			$donnees = array();
			foreach ($tab as $key=>$value) {
				$champs[] = ":".$key;
				$donnees[":".$key] = $value;
			}
			$chaineArguments = implode(",", $champs);
    		$requete = "call ".$nom." (".$chaineArguments.");";
    		$appel = $this->pdo->prepare($requete);
			$appel->execute($donnees);
    	} else {
    		return null;
    	}
    }
	
}

?>