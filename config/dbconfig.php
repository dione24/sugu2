<?php
ob_start();


// Define database connection constants
try {
	$baseDeDonnee = new PDO('mysql:host=localhost;dbname=newsugu', 'root', '');
	$baseDeDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$baseDeDonnee->exec('SET NAMES utf8');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}