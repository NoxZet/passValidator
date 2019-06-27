<?php

declare(strict_types = 1);

namespace App\Validate;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends Command {
    protected static $defaultName = 'passValidator:validate';
    
	protected function configure(): void {
		$this->setName('validate');
        $this->passRequirements = Validator::getRequirements();
        $this->setDescription("Validates that password meets requirements:\n" . $this->passRequirements);
        $this->addArgument('pass', InputArgument::REQUIRED, 'Password to validate');
	}

	protected function execute(InputInterface $input, OutputInterface $output): void {
		if (Validator::validate($input->getArgument('pass')))
            $output->writeln(sprintf('Password valid'));
        else
            $output->writeln(sprintf("Password invalid, must meet these requirements:\n %s", $this->passRequirements));
	}
}