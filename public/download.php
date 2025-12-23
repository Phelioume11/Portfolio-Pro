<?php
$file = __DIR__ . '/files/CV - Nolhann GUILLAUME.pdf';

if (!file_exists($file)) {
    http_response_code(404);
    exit('Fichier introuvable');
}

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="CV - Nolhann GUILLAUME.pdf"');
header('Content-Length: ' . filesize($file));

readfile($file);
exit;
