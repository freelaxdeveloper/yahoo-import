<?php
session_start();

require_once('importer.class.php');

echo '<a href="./?yahoo">Yahoo</a>';

$contacts = ContactsImporter::fetchYahooContacts();
echo '<pre>';
print_r($contacts);