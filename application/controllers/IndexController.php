<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {

        $this->view->pageTitle = 'Index';
    }

    public function sendEmailAction()
    {
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            $dbTableEmails = new Application_Model_DbTable_Emails();
            $inserted = $dbTableEmails->insert($formData);

            var_dump($inserted);
            exit;
        }
    }
}
