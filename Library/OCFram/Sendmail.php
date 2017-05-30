<?php
namespace OCFram;

//use PHPMailer;

class Sendmail {

    public function sendmail($to,$subject,$message,$name)
    {
        //require_once("PHPmailer.php");
        /*$mail = new PHPMailer();
        $body = $message;
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.gmail.com";
        $mail->Port       = 465;
        $mail->Username   = "jplainchamp782@gmail.com";
        $mail->Password   = "drogba78";
        $mail->SMTPSecure = 'ssl';
        $mail->setFrom("jplainchamp782@gmail.com","Jeremy Plainchamp");
        $mail->AddReplyTo("jplainchamp782@gmail.com","Jeremy Plainchamp");
        $mail->Subject    = $subject;
        $mail->AltBody    = "Aucun message.";
        $mail->MsgHTML($body);
        $address = $to;
        $mail->AddAddress($address, $name);
        if(!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }*/
        return mail($to,$subject,$message,$name);
    }

}
    