<?php

class IndexController extends Zend_Controller_Action
{
    private $_dbTableEmails;
    private $_sendFormValidator;
    private $_sendEmailFormSession;
    private $_sendEmailService;

    public function init()
    {
        $this->_dbTableEmails = new Application_Model_DbTable_Emails;
        $this->_sendFormValidator = new Application_Validator_Form_SendEmail;
        $this->_sendEmailFormSession = new Zend_Session_Namespace('sendEmailForm');
        $this->_sendEmailService = new Application_Service_SendEmail;
    }

    public function indexAction()
    {
        $this->view->pageTitle = 'Index';

        $this->view->emails = $this->_dbTableEmails->fetchAll(null, 'id DESC');

        $this->view->formErrors = $this->_sendEmailFormSession->errors;
        $this->view->successMessage = $this->_sendEmailFormSession->successMessage;
        $this->view->sendEmailFormData = $this->_sendEmailFormSession->sendEmailFormData;

        //Deciding if form will appers opened
        $this->view->formIsVisible = !count($this->view->emails) || $this->view->formErrors;

        //Turn session empty
        \Zend_Session::destroy(true);
    }

    public function sendEmailAction()
    {
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            $isFormValid = $this->_sendFormValidator->isValid($formData);
            if ($isFormValid) {

                $formData['message'] = nl2br($formData['message']);

                $isEmailSent = $this->_sendEmailService->send($formData);
                if ($isEmailSent) {

                    $isInserted = $this->_dbTableEmails->insertEmail($formData);
                    if ($isInserted) {
                        $this->_sendEmailFormSession->successMessage = 'Email successfully sent';
                    } else {
                        $this->_sendEmailFormSession->errors = ['An unexpected error occurred when trying to save to the database.'];
                    }
                } else {
                    $this->_sendEmailFormSession->errors = ['An unexpected error occurred while sending the email.'];
                }
            } else {
                $this->_sendEmailFormSession->errors = $this->_sendFormValidator->getMessages();
            }
        }

        //Save formData if with errors
        if ($this->_sendEmailFormSession->errors) {
            $this->_sendEmailFormSession->sendEmailFormData = $formData;
        }

        return $this->_helper->redirector('index');
    }

    public function showDetailsAction()
    {
        $this->_helper->layout()->disableLayout();

        $id = (int)$this->getRequest()->getParam('id');

        $email = $this->_dbTableEmails->fetchRow("id = {$id}");

        if ($email) {
            $this->view->log = $email;
        } else {
            throw new Exception('Not found Page', 404);
        }
    }
}
