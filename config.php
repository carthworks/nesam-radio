<?php
// config.php – Database & site configuration

// AUTO-DETECT subfolder (works at /nesammedia/ in Laragon AND at root in production)
// e.g. /nesammedia  or  '' (empty at domain root)
define('BASE_PATH', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // ← Change to your DB username
define('DB_PASS', '');            // ← Change to your DB password
define('DB_NAME', 'nesam_radio');
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'Nesam Radio');
define('SITE_TAGLINE', 'Radio with Love ❤️');
define('SITE_URL', 'https://nesammedia.com');
define('SITE_EMAIL', 'nesammedia@gmail.com');
define('SITE_PHONE', '+91 86681 03301');
define('SITE_ADDRESS', '11, Govt. Hospital Street, Nedungadu, Karaikal, Puducherry – 609602');
define('WHATSAPP_NUMBER', '918668103301'); // No + or spaces

// Stream URLs – Replace with real Icecast/Shoutcast URLs
define('STREAMS', json_encode([
    'nesam-fm'        => ['name' => 'Nesam FM',         'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => 'Tamil Film Hits'],
    'nesam-devotional'=> ['name' => 'Nesam Devotional', 'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => 'Devotional & Bhajans'],
    'nesam-news'      => ['name' => 'Nesam News',        'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => 'News & Current Affairs'],
    'nesam-hits'      => ['name' => 'Nesam Hits',        'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => 'Latest Kollywood'],
    'nesam-retro'     => ['name' => 'Nesam Retro',       'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => '80s–2000s Classics'],
    'nesam-kids'      => ['name' => 'Nesam Kids',        'url' => 'https://stream.zeno.fm/y0q2tyy2g4zuv',  'genre' => 'Children Songs & Stories'],
]));

// DB connection (singleton) – returns null gracefully if DB not configured
function getDB(): ?PDO {
    static $pdo = null;
    static $failed = false;
    if ($failed) return null;          // Don't retry on every request
    if ($pdo === null) {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            $failed = true;
            return null;   // Pages degrade to static fallback data
        }
    }
    return $pdo;
}

function h(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
