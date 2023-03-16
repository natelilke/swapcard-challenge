<?php

class Application_Model_DbTable_Emails extends Zend_Db_Table_Abstract

{
    protected $_name = 'emails';
    protected $_primary = 'id';

    public function insertEmail($formData)
    {
        return $this->insert([
            'name' => $formData['name'],
            'email' => $formData['email'],
            'phone_number' => $formData['phone_number'],
            'subject' => $formData['subject'],
            'message' => $formData['message'],
        ]);
    }
}
