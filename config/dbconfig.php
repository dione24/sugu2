<?php
ob_start();
try {
	$baseDeDonnee = new PDO('mysql:host=localhost;dbname=cp1146011p43_sugu', 'cp1146011p43_sugu', 'Diblo@cisco2019');
	$baseDeDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$baseDeDonnee->exec('SET NAMES utf8');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}