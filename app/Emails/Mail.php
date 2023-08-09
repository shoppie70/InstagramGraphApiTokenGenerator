<?php

namespace App\Emails;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    public function send($subject, $body): void
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Host       = config('MAIL_HOST');
        $phpmailer->Username   = config('MAIL_ADDRESS');
        $phpmailer->Password   = config('MAIL_PASSWORD');
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $phpmailer->Port       = 465;
        $phpmailer->CharSet    = 'utf-8';
        $phpmailer->addAddress(config('ADMIN_EMAIL_ADDRESS'));
        $phpmailer->From     = config('SYSTEM_EMAIL_ADDRESS');
        $phpmailer->FromName = config('SYSTEM_NAME');
        $phpmailer->Subject  = $subject;
        $phpmailer->isHTML(true);
        $phpmailer->Body = $body; //本文

        try {
            $phpmailer->send();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
