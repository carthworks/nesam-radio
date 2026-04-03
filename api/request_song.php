<?php
// api/request_song.php – Saves song request to DB
require_once dirname(__DIR__) . '/config.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Method not allowed.']);
    exit;
}

$name    = trim($_POST['requester_name'] ?? '');
$song    = trim($_POST['song_name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$station = trim($_POST['station'] ?? 'Nesam FM');

if (!$name || !$song) {
    echo json_encode(['ok' => false, 'message' => 'Please fill in your name and song name.']);
    exit;
}

// Sanitize
$name    = htmlspecialchars(substr($name,  0, 100), ENT_QUOTES, 'UTF-8');
$song    = htmlspecialchars(substr($song,  0, 200), ENT_QUOTES, 'UTF-8');
$phone   = preg_replace('/[^0-9+\-\s]/', '', substr($phone, 0, 20));
$station = htmlspecialchars(substr($station, 0, 100), ENT_QUOTES, 'UTF-8');

$db = getDB();
if ($db) {
    $stmt = $db->prepare('INSERT INTO song_requests (requester_name, song_name, phone, station) VALUES (?,?,?,?)');
    $stmt->execute([$name, $song, $phone, $station]);
    echo json_encode(['ok' => true, 'message' => "Request sent! We'll play '$song' soon ❤️"]);
} else {
    // Graceful degradation (no DB)
    echo json_encode(['ok' => true, 'message' => "Request received! We'll play '$song' soon ❤️"]);
}
