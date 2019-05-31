<?php 
use App\Helpers\Security;
use App\Controller\MailController;

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']) && empty($_POST['LastName'])){
    $name = Security::formatInput($_POST['name']);
    $email = Security::formatInput($_POST['email']);
    $subject = Security::formatInput($_POST['subject']);
    $message = Security::formatInput($_POST['message']);

    $contact = new MailController();
    $mail = $contact->send($name, $email, $subject, $message);
    if($mail){
        echo 'Votre message a bien été envoyé';
    }
    else{
        echo 'Votre message n\'a pas été envoyé';
    }
}
else{echo 'Donné manquante';}
$title = 'Nous contacter';
?>
<h1 class="uw-padding-small">Mon Blog</h1>

<section class="uw-container uw-row-padding uw-margin">
    <form action="<?= $router->url('email') ?>" method="post">
        <div class="uw-row uw-section">
          <div class="uw-col" style="width:50px"><i class="uw-xxlarge uw-text-green fa fa-user"></i></div>
            <div class="uw-rest">
              <input class="uw-input uw-border" name="name" type="text" placeholder="Nom">
            </div>
        </div>
        <div class="uw-row uw-section">
          <div class="uw-col" style="width:50px"><i class="uw-xxlarge uw-text-green far fa-envelope"></i></div>
            <div class="uw-rest">
              <input class="uw-input uw-border" name="email" type="email" placeholder="Mail">
            </div>
        </div>
        <div class="uw-row uw-section">
          <div class="uw-col" style="width:50px"><i class="uw-xxlarge uw-text-green far fa-file-alt"></i></div>
            <div class="uw-rest">
              <input class="uw-input uw-border" name="subject" type="text" placeholder="Sujet">
            </div>
        </div>
        <div class="uw-row uw-section">
          <div class="uw-col" style="width:50px"><i class="uw-xxlarge uw-text-green fas fa-pencil-alt"></i></div>
            <div class="uw-rest">
              <textarea class="uw-input uw-border" name="message" placeholder="Message" style="resize:none"></textarea>
            </div>
        </div>
        <input type="text" class="uw-input uw-border" name="LastName" id="LastName" placeholder="Ne pas remplir" style="visibility: hidden;">
        <div class="uw-right">
          <button id="btn-submit" type="submit" value="Submit" class="uw-button uw-green uw-block buttonColor">Envoyer</button>
        </div>
    </form>
</section>