<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/** send email function using php mailer library**/
if (!function_exists('sendEmail')){
    function sendEmail($emailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        $email = new PHPMailer(true);
        $email->SMTPDebug = 0;
        $email->isSMTP();
        $email->Host = env('EMAIL_HOST');
        $email->SMTPAuth = true;
        $email->Username = env('EMAIL_USERNAME');
        $email->Password = env('EMAIL_PASSWORD');
        $email->SMTPSecure = env('EMAIL_ENCRYPTION');
        $email->Port = env('EMAIL_PORT');
        $email->setFrom($emailConfig['mail_from_email'],$emailConfig['mail_from_name']);
        $email->addAddress($emailConfig['mail_recipient_email'],$emailConfig['mail_recipient_name']) ;
        $email->isHTML(true);
        $email->Subject = $emailConfig['mail_subject'];
        $email->Body = $emailConfig['mail_body'];
        if ($email->send()){
            return true;
        }else{
            return  false;
        }
    }
}

//get general setting
if (!function_exists('get_settings')){
    function get_settings(){
        $results = null;
        $settings = new \App\Models\GeneralSetting();
        $settings_data = $settings->first();
        if ($settings_data){
            $results =  $settings_data;
        }else{
            $settings->insert([
                'site_name' => 'laravel',
                'site_email' => 'laravel@info.com',
            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }
        return $results;
    }
}
// social network
if (!function_exists('get_social_network')){
    function get_social_network(){
        $results = null;
        $social_network = new \App\Models\SocailNetwork();
        $social_network_data = $social_network->first();
        if ($social_network_data){
            $results = $social_network_data;
        }else{
            $social_network->insert([
            'facebook_url' => null,
            'twitter_url' => null,
                'instagram_url' => null,
                'youtube_url' => null,
                'github_url' => null,
                'linkedin_url' => null
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}
