<?php
namespace App\Controller;

class MailController
{
    
    private $UWmail;
    private $EOL;
    private $FinalMessage;
    private $header;
    
    public function __construct()
    {
      $this->EOL = "\r\n";
      $this->UWmail = "info@underdogweb.com";
    }
    
    public function send($name, $email, $subject, $message): bool
    {
        $hed =  $this->createHeader($name, $email);
        $mess = $this->createMessage($message);
        return mail($this->UWmail, $subject, $mess, $hed);   
    }

    public function createHeader($name, $email): string
    {
        return "From: ". $name . $this->EOL . "adresse mail: ". $email;
    }

    public function createMessage($message): string
    {
        return $this->EOL . $message . $this->EOL;
    }
}