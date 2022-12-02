<?php
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: image/svg+xml');
header('Cache-Control: max-age=0, no-cache, no-store, must-revalidate');

use Ghvc\Badge\Render;

$render = new Render();

echo $render->getBadge();
exit;
