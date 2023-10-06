<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GenaralSetting;
use App\Models\SocialNetworks;

/** SEND EMAIL FUNCTION USING PHPMAILER LIBRARY*/
if (!function_exists('sendEmail')) {
     function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail -> SMTPDebug = 0;
        $mail -> isSMTP();
        $mail -> Host = env('EMAILHOST');
        $mail -> SMTPAuth = true;
        $mail -> Username = env('EMAIL_USERNAME');
        $mail -> Password = env('EMAIL_PASSWORD');
        $mail -> SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail -> Port = env('EMAIL_PORT');
        $mail -> setFrom($mailConfig['mail_from_email'],$mailConfig['mail_from_email']);
        $mail -> addAddress($mailConfig['mail_recipient_email'],$mailConfig['mail_recipient_email']);
        $mail -> isHTML(true);
        $mail -> Subject = ['mail_subject'];
        $mail -> Body = ['mail_body'];
        if ($mail->send()) {
            return true;
        }
        else{
            return false;
        }
     }


}

/**get general settings  */
if (!function_exists('get-settings')) {
    function get_settings(){
        $results = null;
        $settings = new GenaralSetting();
        $settings_data = $settings->first();

        if ($settings_data) {
            $results = $settings_data;
        }else {
            $settings->insert([
                'site_name'=>'Cyberclashpunk',
                'site_email'=>'laravel.Info@Cyberclashpunk.com'
            ]);
            $new_settings_data = $settings->first();
            $results = $settings_data;
        }
        return $results;
    }
}

/** get social media nettworks */
if (!function_exists('get_social_network')) {
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetworks();
        $social_network_data = $social_network->first(); 

        if ($social_network_data) {
            $results = $social_network_data;
        }else {
            $social_network->insert([
                'facebook_url'=>null,
                'twitter_url'=>null,
                'instagram_url'=>null,
                'youtube_url'=>null,
                'github_url'=>null,
                'github_url'=>null
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}

