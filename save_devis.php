<?php
// save_devis.php

// Include the necessary files and establish a database connection
include_once('include/database.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $date = $_POST['date'];
    $Ndevis = $_POST['numero_devis'];
    $client = $_POST['client'];
    $codeArticles = $_POST['code_article'];
    $designations = $_POST['designation'];
    $qtes = $_POST['qte'];
    $prixHTs = $_POST['prix_ht'];
    $totalHTs = $_POST['total_ht'];

    // Prepare the SQL statement
    $sql = "INSERT INTO devis (date, numero_devis, client, code_article, designation, qte, prix_ht, total_ht) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Loop through the array data and execute the SQL statement for each row
    for ($i = 0; $i < count($codeArticles); $i++) {
        $codeArticle = $codeArticles[$i];
        $designation = $designations[$i];
        $qte = $qtes[$i];
        $prixHT = $prixHTs[$i];
        $totalHT = $totalHTs[$i];

        $stmt->execute([$date, $Ndevis, $client, $codeArticle, $designation, $qte, $prixHT, $totalHT]);
    }

    echo "Data submitted";
}
?>
