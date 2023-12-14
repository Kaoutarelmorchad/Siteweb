<?php
// save_invoice.php

// Inclure la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');

// Vérifier si la session est démarrée
session_start();

// Vérifier si l'utilisateur est connecté
if (!empty($_SESSION["loggedin"])) {
    $cust_id = $_SESSION["id"];

    // Créer un objet TCPDF
    $pdf = new TCPDF();

    // Ajouter une page au PDF
    $pdf->AddPage();

    // Ajouter le contenu de la facture (personnalisez cela en fonction de vos besoins)
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Facture pour le client ' . $cust_id);
    // Ajoutez d'autres détails de la facture...

    // Sauvegarder le PDF dans un fichier
    $filename = 'invoice_' . $cust_id . '.pdf';
    $pdf->Output($filename, 'D');

    // Terminer le script pour éviter tout affichage supplémentaire
    exit();
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers une page de connexion
    header("Location: login.php");
    exit();
}
?>
