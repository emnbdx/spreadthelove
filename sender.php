<?php
    require 'loader.php';

    echo 'Ready to send emails<br/>';

    $receivers = $repo->getReceivers();

    foreach ($receivers as $receiver) {

        echo 'Send email to ' . $receiver['name'] . '(' . $receiver['email'] . ')<br/>';

        $loves = $repo->getLoves($receiver['id']);

        if(!$loves) {
            echo 'Nothing to send :(<br/>';
            continue;
        }

        $content = '';
        foreach ($loves as $love) {
            $content .= '<h1>' . $love['sender'] . '</h1><p>' . nl2br($love['content']) . '</p><br/><br/>';       
        }
        
        $mailjetClient = new \Mailjet\Client($_ENV['MailjetPublicKey'], $_ENV['MailjetPrivateKey'], true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $_ENV['MailFromEmail'],
                        'Name' => $_ENV['MailFromName']
                    ],
                    'To' => [
                        [
                            'Email' => $receiver['email'],
                        ],
                    ],
                    'Subject' => $_ENV['MailSubject'],
                    'Variables' => [
                        'content' => $content
                    ],
                    'TemplateID' => (int)$_ENV['MailTemplateId'],
                    'TemplateLanguage' => true,
                ]
            ]
        ];
        $response = $mailjetClient->post(\Mailjet\Resources::$Email, ['body' => $body]);
        if (!$response->success()) {
            echo 'error<br/>';
            print_r($response->getData());
            echo '<br/>';
        } else {
            echo 'ok<br/>';
        }
    }
?>