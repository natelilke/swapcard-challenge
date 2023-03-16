<?php

class Application_Validator_Form_SendEmail extends Zend_Validate_Abstract
{
    protected $_fields = [
        'name',
        'email',
        'phone_number',
        'subject',
        'message'
    ];

    protected $_messageTemplates = [
        'name_required' => 'The field <strong>Name</strong> is required.',
        'email_required' => 'The field <strong>E-mail</strong> is required.',
        'phone_number_required' => 'The field <strong>Phone Number</strong> is required.',
        'phone_number_regex' => 'The field <strong>Phone Number</strong> is invalid. Valid Ex: (202) 555-0107',
        'subject_required' => 'The field <strong>Subject</strong> is required.',
        'message_required' => 'The field <strong>Message</strong> is required.',
    ];

    public function isValid($fields)
    {
        $isValid = true;

        //All fields required
        foreach ($this->_fields as $field) {
            if (empty($fields[$field])) {
                $this->_error("{$field}_required");
                $isValid = false;
            }
        }

        //Check phone_number format
        if (!preg_match("/\([0-9]{3}\) [0-9]{3}\-[0-9]{4}/", $fields['phone_number'])) {
            $this->_error('phone_number_regex');
            $isValid = false;
        }

        return $isValid;
    }
}
