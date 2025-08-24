<?php
/*
 * sendPushMessage
 * */
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use Minishlink\WebPush\MessageSentReport;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;


function sendPushMessage($endPoint,$auth,$payload): void
{
    $defaultOptions = [
        'TTL' => 300, // defaults to 4 weeks
        'urgency' => 'normal', // protocol defaults to "normal". (very-low, low, normal, or high)
        'topic' => 'newEvent', // not defined by default. Max. 32 characters from the URL or filename-safe Base64 characters sets
        'batchSize' => 200, // defaults to 1000
    ];

    try {
        $webPush = new WebPush($auth);
        $webPush->setDefaultOptions($defaultOptions);
        /**
         * send one notification and flush directly
         *
         */
        $report = $webPush->sendOneNotification(
            Subscription::create(json_decode($endPoint,true)),
            $payload,
            ['TTL' => 5000]);

        /**
         * Check sent results
         *
         */
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
            require SHARED . '/response-header-api.php';
            echo json_encode(["token" => "0", "title"=> "Новое сообщение от Марка"]);
        } else {
            require SHARED . '/response-header-api.php';
            echo json_encode(["report" => $report->getReason()]);
        }


    } catch (ErrorException $e) {
        echo $e->getMessage();
    }
}

//$auth2temp = [
//    'VAPID' => [
//        'subject' => 'mailto:alex2505@bk.ru', // can be a mailto: or your website address
//        'publicKey' => 'BAfNaGRIukwj_jcTkw8ymqJiWg9QOZ5wKt3famaKgNz_K5g583NVDD6y1FVKUv00iaaCiNkr4VZ4OE3ecmDz9ro', // (recommended) uncompressed public key P-256 encoded in Base64-URL
//        'privateKey' => '~44 chars', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
//        'pemFile' => 'path/to/pem', // if you have a PEM file and can link to it on your filesystem
//        'pem' => 'pemFileContent', // if you have a PEM file and want to hardcode its content
//    ],
//];

//    $webPush->queueNotification(
//        $subscription,
//        '{"message":"Hello Natusya!"}', // optional (defaults null)
//    );

//try {
//    $webPush = new WebPush($auth);
//    $endPoint = '{"endpoint":"https://fcm.googleapis.com/fcm/send/fqwFnwiv72g:APA91bHgkz-Np3LvfLuzV2V9sla5BflUKe819GTOy00nB7uwH0I3Y5T3z2J0lQIQTuKYGv_FR9vNRef2Yr_2X2TCFLTlDn_c-mSCczIwaAWPpCFNzn7cfFgD31V5xpCMobj6pfkwq0wN","expirationTime":null,"keys":{"p256dh":"BMxnecQgY1oioELYfsCIiAuGpRUex-igWWe0S9Db3q7-YSGRmJKOxWWAge-2jJgg8e5C1b5SQndJKgc1z1TwirM","auth":"3FvyhSQc_8LJfXakyTJyew"}}';
//    $report = $webPush->sendOneNotification(
//        Subscription::create(json_decode($endPoint,true)),
//        '{"title":"Hi from php" , "body":"php is amazing!" , "url":"./?message=123"}',
//        ['TTL' => 5000]);
//
//    print_r($report);
//} catch (ErrorException $e) {
//
//}


//try {
//    $json_data = json_decode($json_data, true);
//    if ($json_data === null) {
//        echo 'bad request';
//        die();
//    }
//    sendPushMessage($json_data, '{"message":"Hello Natusya!"}');
//    $subscription = Subscription::create($json_data);
//    $auth3 = [
//        'VAPID' => [
//            'subject' => 'mailto:alex2505@bk.ru', // can be a mailto: or your website address
//            'publicKey' => 'BAfNaGRIukwj_jcTkw8ymqJiWg9QOZ5wKt3famaKgNz_K5g583NVDD6y1FVKUv00iaaCiNkr4VZ4OE3ecmDz9ro', // (recommended) uncompressed public key P-256 encoded in Base64-URL
//            'privateKey' => '~44 chars', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
//            'pemFile' => 'path/to/pem', // if you have a PEM file and can link to it on your filesystem
//            'pem' => 'pemFileContent', // if you have a PEM file and want to hardcode its content
//        ],
//    ];
//    $webPush = new WebPush($auth);
//    sleep(10);
//    $webPush->queueNotification(
//        $subscription,
//        '{"message":"Hello Natusya!"}', // optional (defaults null)
//    );
//    echo json_encode(["token" => "0"]);
//    echo json_encode($json_data);
//    echo $json_data;
//} catch (ErrorException $e) {
//    echo $json_data;
//    echo $e->getMessage();
//}

//{\"endpoint\":\"https:\/\/fcm.googleapis.com\/fcm\/send\/dwMY9Ogmtq8:APA91bEGLhd7HAX1oFA0U1OXe6NOIntm5IWyOJ0X9QyWR92ZGczE_IbxZhn5w2lmLV5ybOYYEy9OIJtlgkHjKyGeTzXIDE7XWMcBIU25BdpIBaGNJulu7NCzLJbqxnzUvKdxL9sxcRnW\",\"expirationTime\":null,\"keys\":{\"p256dh\":\"BE44LsbbzV-jUsex3zOrpGBNPo94QDBR66thbYkM4gC-SOvv3fpDhm3bYLoj9AgohZ4ik2mDUgapfUPMu_7mE3M\",\"auth\":\"AyD59VbkZ2OzjUnUf1M96g\"}}"

//{
//    "endpoint": "https://fcm.googleapis.com/fcm/send/dwMY9Ogmtq8:APA91bEGLhd7HAX1oFA0U1OXe6NOIntm5IWyOJ0X9QyWR92ZGczE_IbxZhn5w2lmLV5ybOYYEy9OIJtlgkHjKyGeTzXIDE7XWMcBIU25BdpIBaGNJulu7NCzLJbqxnzUvKdxL9sxcRnW",
//    "expirationTime": null,
//    "keys": {
//      "p256dh": "BE44LsbbzV-jUsex3zOrpGBNPo94QDBR66thbYkM4gC-SOvv3fpDhm3bYLoj9AgohZ4ik2mDUgapfUPMu_7mE3M",
//      "auth": "AyD59VbkZ2OzjUnUf1M96g"
//    }
//}