<?php

class Application_Model_DbTable_Emails extends Zend_Db_Table_Abstract

{
    protected $_name = 'emails';
    protected $_primary = 'id';

    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setId($row->id)
                ->setEmail($row->email)
                ->setComment($row->comment)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function insert($formData)
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
