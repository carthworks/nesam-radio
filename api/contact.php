<?php
// api/contact.php – Saves contact form message to DB
require_once dirname(__DIR__) . '/config.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'message' => 'Method not allowed.']);
    exit;
}

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    echo json_encode(['ok' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$name    = htmlspecialchars(substr($name,    0, 100), ENT_QUOTES, 'UTF-8');
$email   = htmlspecialchars(substr($email,   0, 150), ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars(substr($subject, 0, 200), ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars(substr($message, 0, 2000), ENT_QUOTES, 'UTF-8');

$db = getDB();
if ($db) {
    $stmt = $db->prepare('INSERT INTO contact_messages (name, email, subject, message) VALUES (?,?,?,?)');
    $stmt->execute([$name, $email, $subject, $message]);
}

// Optional: send email notification
// mail(SITE_EMAIL, "New Contact: $subject", $message, "From: $name <$email>");

echo json_encode(['ok' => true, 'message' => 'Thank you! We will get back to you within 24 hours ❤️']);
