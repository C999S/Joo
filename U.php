//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
//• لا تنسى ذكر حقوق المطور توم
//• المطور ↦ @iznzz ↤
//• قناة المطور ↦ @izeoq ↤
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
<?php
ob_start();
error_reporting(0);
define("API_KEY", '7177871656:AAFQiMs8aIwNwPvWtKwLuSMBWVvpOcnloj4');
function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/$method";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    }
    return json_decode($res);
}
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳

//• هنا تكدر تخلي لوحه ادمن الي تعجبك 

//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
$input = file_get_contents("php://input");
$update = json_decode($input, TRUE);
$chatId = $update['message']['chat']['id'];
$text = $update['message']['text'];

if ($text == '/start') {
bot('sendMessage', [
'chat_id' => $chatId,
'text' =>'*• Добро пожаловать в GPT-бот
• я бот Ходи
Я помогу тебе со всем, что ты хочешь

• Чтобы сделать изображение из текста /image 

/image cat
*• Писать на белом листе бумаги вот так /Write *

/Write cat',
'parse_mode' => "Markdown",
'disable_web_page_preview' => true,
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "• مطور البوت •", 'url' => "https://t.me/iznzz"],
['text' => "• قناة البوت •", 'url' => "https://t.me/izeoq"]]
]
])
]);
return;
}
if (strpos($text, '/image ') === 0) {
    $description = substr($text, 7);

    $waitingMessage = bot('sendMessage', [
        'chat_id' => $chatId,
        'text' => "*• جار انشاء صورة حسب وصفك ↤ $description*",
        'parse_mode' => 'Markdown',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "• مطور البوت •", 'url' => "https://t.me/iznzz"],['text' => "• قناة البوت •", 'url' => "https://t.me/izeoq"]]
            ]
        ])
    ]);

    $api = 'http://art.nowtechai.com/art?name=' . urlencode($description);
    $headers = [
        "User-Agent: okhttp/5.0.0-alpha.9",
        "Connection: Keep-Alive",
        "Accept: application/json"
    ];

    $context = stream_context_create([
        "http" => [
            "header" => implode("\r\n", $headers)
        ]
    ]);
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
//• لا تنسى ذكر حقوق المطور توم
//• المطور ↦ @iznzz ↤
//• قناة المطور ↦ @izeoq ↤
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
    $response = @file_get_contents($api, false, $context);

    if ($response !== FALSE) {
        $data = json_decode($response, true);

        if ($data && isset($data['code']) && $data['code'] == 200 && !empty($data['data']) && isset($data['data'][0]['img_url'])) {
            $imageData = $data['data'][0];

            sleep(1);

            bot('deleteMessage', [
                'chat_id' => $chatId,
                'message_id' => $waitingMessage['result']['message_id']
            ]);

            bot('sendPhoto', [
                'chat_id' => $chatId,
                'photo' => $imageData['img_url'],
                'caption' => "*• تم انشاء الصورة بنجاح ✅ .\n• وصف الصورة ↤ $description*",
                'parse_mode' => 'Markdown',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => "• مطور البوت •", 'url' => "https://t.me/iznzz"],['text' => "• قناة البوت •", 'url' => "https://t.me/izeoq"]]
                    ]
                ])
            ]);
            exit;
        } else {
            bot('sendMessage', [
                'chat_id' => $chatId,
                'text' => "*• لم يتم العثور على الصورة .*",
                'parse_mode' => 'Markdown'
            ]);
            exit;
        }
    } else {
        bot('sendMessage', [
            'chat_id' => $chatId,
            'text' => "*• حدث خطأ أثناء إنشاء الصورة ، الرجاء إدخال وصف واضح ومفهوم .*",
            'parse_mode' => 'Markdown'
        ]);
        exit;
    }
}

if (strpos($text, '/Write ') === 0) {
    $textToWrite = substr($text, 7);
    bot('sendPhoto', [
        'chat_id' => $chatId,
        'photo' => "https://apis.xditya.me/write?text=" . urlencode($textToWrite),
        'caption' => "`$textToWrite`",
        'parse_mode' => "Markdown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "• مطور البوت •", 'url' => "https://t.me/iznzz"],['text' => "• قناة البوت •", 'url' => "https://t.me/izeoq"]]
            ]
        ])
    ]);
    exit;
}
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
//• لا تنسى ذكر حقوق المطور توم
//• المطور ↦ @iznzz ↤
//• قناة المطور ↦ @izeoq ↤
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
sendApiResponse($chatId, $text);
function sendApiResponse($chatId, $message) {
    $apiUrl = "https://chatai.aritek.app/stream";
    $payload = json_encode([
        "machineId" => substr(uniqid(), 0, 16) . "." . substr((string)rand(), 0, 18),
        "msg" => [["content" => $message, "role" => "user"]],
        "token" => "eyJzdWIiOiIyMzQyZmczNHJ0MzR0MzQiLCJuYW1lIjoiSm9objM0NTM0NT",
        "type" => 0
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; G011A Build/PI)'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $apiResponse = curl_exec($ch);
    curl_close($ch);
    $response_parts = '';
    $result = explode("\n", $apiResponse);
    foreach ($result as $line) {
        if (strpos($line, "data:") === 0) {
            $data_line = trim(substr($line, 5));
            if (!empty($data_line)) {
                $response_json = json_decode($data_line, true);
                if (isset($response_json['choices'][0]['delta']['content'])) {
                    $response_parts .= $response_json['choices'][0]['delta']['content'];
                }
            }
        }
    }
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
//• لا تنسى ذكر حقوق المطور توم
//• المطور ↦ @iznzz ↤
//• قناة المطور ↦ @izeoq ↤
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
$waitingMessage = bot('sendMessage', [
'chat_id' => $chatId,
'text' => "*• انتظر من فضلك ⏱️*",
'parse_mode' => 'Markdown'
]);    
$message_id = $waitingMessage->result->message_id;
bot('editMessageText', [
'chat_id' => $chatId,
'message_id' => $message_id,
'text' => !empty($response_parts) ? $response_parts : 'لم أتمكن من الحصول على رد.',
'parse_mode' => "markdown"
]);
}
?>
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳
//• لا تنسى ذكر حقوق المطور توم
//• المطور ↦ @iznzz ↤
//• قناة المطور ↦ @izeoq ↤
//𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳𓏳