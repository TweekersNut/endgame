<?php

namespace APP\Core;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use APP\Models\Settings as Settings;

class Mailer{

    private $mail;
    private $mailSent = false;
    private $settings;

    function __construct(){
        $this->mail = new PHPMailer(true);
        $this->settings = new Settings;
    }

    public function sendMail($to,$subject = 'MVC 1.0',$body = '',$altBody = ''){
        try {
            //Server settings
            //$this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
            //$this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = ($this->settings->getValue('email.host')->_val);
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = ($this->settings->getValue('email.username')->_val);
            $this->mail->Password   = ($this->settings->getValue('email.password')->_val);
            $this->mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = ($this->settings->getValue('email.port')->_val);
        
            //Recipients
            $this->mail->setFrom('noreply@tweekersnut-tutorial.ml', 'MVC 1.0 Mailer');
            $this->mail->addAddress($to);     // Add a recipient
            $this->mail->addReplyTo('admin@tweekersnut.com', 'TweekersNut Network Admin');
            
            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = $altBody;
        
            $this->mail->send();
            $this->mailSent = true;
        } catch (Exception $e) {
            $this->mailSent = false;
        }
    }

    public function sendMailBulk($to = [],$subject,$body,$altBody){
        try {
            //Server settings
            //$this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
            //$this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = $this->settings->getValue('email.host')->_val;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = $this->settings->getValue('email.username')->_val;                     // SMTP username
            $this->mail->Password   = $this->settings->getValue('email.password')->_val;                            // SMTP password
            $this->mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = $this->settings->getValue('email.port')->_val;                                   // TCP port to connect to
        
            //Recipients
            $this->mail->setFrom('noreply@tweekersnut-tutorial.ml', 'MVC 1.0 Mailer');
            foreach($to as $val){
                $this->mail->addAddress($val);     // Add a recipient
            }
            
            $this->mail->addReplyTo('admin@tweekersnut.com', 'TweekersNut Network Admin');
            
            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = $altBody;
        
            $this->mail->send();
            $this->mailSent = true;
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->mailSent = false;
        }
    }

    public function sendMailAttachments($to = [],$subject,$body,$altBody,$attachments = []){
        try {
            //Server settings
            //$this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
            //$this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = $this->settings->getValue('email.host')->_val;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = $this->settings->getValue('email.username')->_val;                     // SMTP username
            $this->mail->Password   = $this->settings->getValue('email.password')->_val;                            // SMTP password
            $this->mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = $this->settings->getValue('email.port')->_val;                                   // TCP port to connect to
        
            //Recipients
            $this->mail->setFrom('noreply@tweekersnut-tutorial.ml', 'MVC 1.0 Mailer');
            foreach($to as $val){
                $this->mail->addAddress($val);     // Add a recipient
            }
            
            $this->mail->addReplyTo('admin@tweekersnut.com', 'TweekersNut Network Admin');
            
            // Attachments
            foreach($attachments as $attVal){
                $mail->addAttachment($attVal);         // Add attachments
            }

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = $altBody;
        
            $this->mail->send();
            $this->mailSent = true;
        } catch (Exception $e) {
            $this->mailSent = false;
        }
    }

    public function getStatus(){
        return $this->mailSent ? true : false;
    }
}