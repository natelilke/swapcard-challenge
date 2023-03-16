<?php

class Application_Service_SendEmail
{
    private $_mail;
    public function __construct()
    {
        $tr = new Zend_Mail_Transport_Smtp('mail.smtpbucket.com', ['port' => '8025']);
        Zend_Mail::setDefaultTransport($tr);

        $this->_mail = new Zend_Mail();
    }

    public function send($formData)
    {
        $this->_mail->setBodyText($formData['message']);
        $this->_mail->setFrom('contact@swapcard.com', 'Swapcard');
        $this->_mail->addTo($formData['email'], $formData['name']);
        $this->_mail->setSubject($formData['subject']);

        return $this->_mail->send();
    }
}
