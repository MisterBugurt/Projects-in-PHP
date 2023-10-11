<?php

namespace MyProject\cli;

use MyProject\Exception\CliException;

class Summator extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists('a');
        $this->ensureParamExists('b');
    }

    public function execute()
    {
        echo $this->getParam('a') + $this->getParam('b');
    }

}