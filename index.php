<?php

/*
 * 1 - Uniquement pour la pratique, reproduisez via mysql workbench le schémas proposé.
 * 2 - Exportez le résultat de manière à créer les tables en base de données.
 * 3 - Ajoutez des utilisateurs, des rôles et ajoutez des données dans la table user_role ( attention, au moins un utilisateur doit avoir deux rôles au moins ).
 * 4 - A l'aide d'un simple print_r, afficher les rôles de chaque utilisateur.
 * 5 - FIN !
 */

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'exo_204';

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $request = $bdd->prepare("
        SELECT user_role.id, role.role, user.username
        FROM user_role
            INNER JOIN role ON user_role.role_fk = role.id
            INNER JOIN user ON user_role.user_fk = user.id
");

    $request->execute();
    echo '<pre>';
    print_r($request->fetchAll());
    echo "</pre>";

} catch (PDOException $exception) {
    echo $exception->getMessage();
}