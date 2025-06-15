<?php
require_once 'functions.php';

$verificationFile = __DIR__ . '/verifications.json';
if (!file_exists($verificationFile)) file_put_contents($verificationFile, '{}');
$verifications = json_decode(file_get_contents($verificationFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $code = generateVerificationCode();
        $verifications[$email] = $code;
        file_put_contents($verificationFile, json_encode($verifications));
        sendVerificationEmail($email, $code);
        echo "Verification code sent to $email";
    } elseif (isset($_POST['verification_code']) && isset($_POST['email'])) {
        $email = $_POST['email'];
        $code = $_POST['verification_code'];
        if (isset($verifications[$email]) && $verifications[$email] === $code) {
            registerEmail($email);
            unset($verifications[$email]);
            file_put_contents($verificationFile, json_encode($verifications));
            echo "Email verified and registered.";
        } else {
            echo "Invalid verification code.";
        }
    }
}
?>
<form method="POST">
    <input type="email" name="email" required>
    <button id="submit-email">Submit</button>
</form>
<form method="POST">
    <input type="email" name="email" required>
    <input type="text" name="verification_code" maxlength="6" required>
    <button id="submit-verification">Verify</button>
</form>