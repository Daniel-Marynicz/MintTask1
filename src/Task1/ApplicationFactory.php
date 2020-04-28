<?php

declare(strict_types=1);

namespace Task1;

use Symfony\Component\Console\Application;
use Task1\Command\Task1Command;
use function assert;
use function is_string;

class ApplicationFactory
{
    public function createApplication() : Application
    {
        $command     = new Task1Command();
        $application = new Application('Task1', '0.1.0');

        $application
            ->add($command);
        assert(is_string($command->getName()));
        $application->setDefaultCommand($command->getName(), true);

        return $application;
    }
}
