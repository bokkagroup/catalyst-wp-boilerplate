<?php

namespace CatalystWP\AtomChild\controllers;

class EventSingleController extends \CatalystWP\Nucleus\Controller
{
    public function initialize()
    {
        $this->view->display($this->model->data);
    }
}