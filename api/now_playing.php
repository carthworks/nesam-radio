<?php
// api/now_playing.php – Returns current now-playing info as JSON
require_once dirname(__DIR__) . '/config.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache');

$station = $_GET['station'] ?? 'nesam-fm';
$streams = json_decode(STREAMS, true);

// In production: query Icecast/Shoutcast JSON endpoint or your metadata service
// For demo: return station name + sample song
$demos = [
    'nesam-fm'         => ['Vellai Pookal – AR Rahman', 'Nesam FM'],
    'nesam-devotional' => ['Govinda Govinda – Devotional', 'Nesam Devotional'],
    'nesam-news'       => ['Live Tamil News Update', 'Nesam News'],
    'nesam-hits'       => ['Vaathi Coming – Thalapathy 65', 'Nesam Hits'],
    'nesam-retro'      => ['Roja Kaadhali – AR Rahman', 'Nesam Retro'],
    'nesam-kids'       => ['Aathichudi Song for Kids', 'Nesam Kids'],
];

[$song, $name] = $demos[$station] ?? ['Live Stream', $streams[$station]['name'] ?? 'Nesam FM'];

echo json_encode(['ok' => true, 'song' => $song, 'station' => $name]);
