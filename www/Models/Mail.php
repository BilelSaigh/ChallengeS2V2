<?php
namespace App\Models;
require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
class Mail
{
    protected String $message;
    protected String $address;
    protected String $subject;
    protected String $name;


    public function setMessage($message): void
    {
        $this->message = $message;
    }
    /**
     *
     * @return $message
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
    public function setAddress($address): void
    {
        $this->address = $address;
    }
    /**
     * @return $address
     *
     * @return void
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    public function setSubject($subject): void
    {
        $this->subject =$subject;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }


    public function initMail(): PHPMailer
    {
        $mail = new PHPMailer();
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nkumba.estelle@gmail.com';                     //SMTP username
        $mail->Password   = 'xtydkvmubntmuwyf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;
        return $mail;
    }

    public function mail($mail)
    {
        try{
            //Recipients
            $mail->setFrom('from@example.com', 'Adebc');
            $mail->addAddress($this->address , $this->name);     //Add a recipient
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();

        }catch(Exception $e) {
            return '<div class="alert-error" style="text-align: center; padding: 1em ;">
                        <span>'.$e->getMessage().'</span>
                    </div>';
        }

    }

}