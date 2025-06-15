<?php
require_once 'functions.php';

$unsubscribeFile = __DIR__ . '/unsub_verifications.json';
if (!file_exists($unsubscribeFile)) file_put_contents($unsubscribeFile, '{}');
$unsubs = json_decode(file_get_contents($unsubscribeFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['unsubscribe_email'])) {
        $email = $_POST['unsubscribe_email'];
        $code = generateVerificationCode();
        $unsubs[$email] = $code;
        file_put_contents($unsubscribeFile, json_encode($unsubs));
        sendUnsubscribeCode($email, $code);
        echo "Unsubscribe code sent to $email";
    } elseif (isset($_POST['unsubscribe_verification_code']) && isset($_POST['unsubscribe_email'])) {
        $email = $_POST['unsubscribe_email'];
        $code = $_POST['unsubscribe_verification_code'];
        if (isset($unsubs[$email]) && $unsubs[$email] === $code) {
            unsubscribeEmail($email);
            unset($unsubs[$email]);
            file_put_contents($unsubscribeFile, json_encode($unsubs));
            echo "Email unsubscribed successfully.";
        } else {
            echo "Invalid unsubscription code.";
        }
    }
}
?>
<form method="POST">
    <input type="email" name="unsubscribe_email" required>
    <button id="submit-unsubscribe">Unsubscribe</button>
</form>
<form method="POST">
    <input type="email" name="unsubscribe_email" required>
    <input type="text" name="unsubscribe_verification_code">
    <button id="verify-unsubscribe">Verify</button>
</form>