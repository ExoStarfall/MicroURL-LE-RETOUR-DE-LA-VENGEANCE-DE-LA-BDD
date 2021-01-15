<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Micro URL</title>
  <meta name="description" content="Voilou hein ">
</head>
<body><pre><?php

 // séparer ses identifiants et les protéger, une bonne habitude à prendre
 include "micro_url_dbconfig.php";

 try {

   // instancie un objet $connexion à partir de la classe PDO
   $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

   // Requête de sélection  globale
   $requete = "SELECT * FROM `url`";
   $prepare = $connexion->prepare($requete);
   $prepare->execute();
   $resultat = $prepare->fetchAll();
   print_r([$requete, $resultat]); // debug & vérification


   // Requête de séléction précise 
   $requete = "SELECT *
                FROM `mc`
                WHERE `mc_id` = :mc_id"; // on cible le mot clé dont l'id est ...
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(":mc_id" => 2)); // on cible le mot clé dont l'id est 2
    $resultat = $prepare->fetchAll();
    print_r([$requete, $resultat]); // debug & vérification


   // Afficher toutes les entrées avec le mot clé piratage 
   $requete = "SELECT * FROM `url`
                   INNER JOIN `assoc_mc_url` ON `url_id` = `assoc_url_id`
                   WHERE `assoc_mc_id` = :assoc_mc_id;"; 
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(":assoc_mc_id" => 8)); 
   $resultat = $prepare->fetchAll();
   print_r([$requete, $resultat]); // debug & vérification




   // Requête d'insertion globale 
   $requete = "INSERT INTO `url` (ùrl_id, `url_name`, `url_shortcut`, `url_datetime`,`url_desc`)
               VALUES (:url_id, :url_name, :url_shortcut, :url_datetime, :url_desc);";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(
     "url-id" => "id",
     ":url_name" => "url",
     ":_url_shortcut" => "shortcut",
     ":url_desc" => "description",
   ));
   $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
   $lastInsertedURLId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
   print_r([$requete, $resultat, $lastInsertedURLId]); // debug & vérification

  // Requête d'insertion précise
  $requete = "INSERT INTO `url` ( `url_id`,`url_name`, `url_shortcut`, `url_datetime`,`url_desc`)
               VALUES (:url_id, :url_name, :url_shortcut, :url_datetime, :url_desc);";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(
     "url_id" => 4,
     ":url_name" => " https://www.zataz.com/total-energie-direct-obligee-de-stopper-un-jeu-en-ligne-suite-a-une-fuite-de-donnees/",
     ":url_shortcut" => "ztz7",
     ":url_datetime" => date('Y-m-d H:i:s'),
     ":url_desc" => "L'entreprise Total Energie Direct avait lancé un jeu en ligne. Le concours a dû être stoppé. Il était possible d'accéder aux données des autres joueurs."
   ));
   $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
   $lastInsertedURLId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
   print_r([$requete, $resultat, $lastInsertedURLId]); // debug & vérification

   // Requête d'insertion de Piratage dans la table mc
   $requete = "INSERT INTO `mc` (`mc_id`,`mc_motcle`)
                VALUES (:mc_id, :mc_motcle);";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(
     ":mc_motcle" => "Piratage",
     ":mc_id" => 8
   ));
   $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
   $lastInsertedKeywordId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
   print_r([$requete, $resultat, $lastInsertedKeywordId]); // debug & vérification

   // Insertion table associative
   $requete = "INSERT INTO `assoc_mc_url` (`id`, `assoc_mc_id`, `assoc_url_id`)
                VALUES (:id, :mc_id, :url_id);";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(
       ":id" => 3,
     ":mc_id" => "8",
     ":url_id" => "4"
   ));
   $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
   $lastInsertedAssocId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
   print_r([$requete, $resultat, $lastInsertedAssocId]); // debug & vérification
 
   // Requête de modification
   $requete = "UPDATE `mc`
               SET `mc_id` = :mc_id
               WHERE `mc_motcle` = :mc_motcle;";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(
     ":mc_id"   => 8,
     ":mc_motcle" => "Piratage de zouz🤠"
   ));
   $resultat = $prepare->rowCount();
   print_r([$requete, $resultat]); // debug & vérification

   // Requête de suppression
   $requete = "DELETE FROM `mc`
               WHERE ((`mc_id` = :mc_id));";
   $prepare = $connexion->prepare($requete);
   $prepare->execute(array(":mc_id" => 666)); // on lui passe l'id tout juste créé
   $resultat = $prepare->rowCount();
   print_r([$requete, $resultat, $lastInsertedRecipeId]); // debug & vérification

 } catch (PDOException $e) {

   // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
   exit("❌🙀💀 OOPS :\n" . $e->getMessage());

 }

?></pre></body>
</html>