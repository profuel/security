<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Git\Communication\Console;

use SprykerFeature\Zed\Console\Business\Model\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GitFlowUpdateConsole extends Console
{

    const COMMAND_NAME = 'gitflow:update';
    const DESCRIPTION = 'Rebase latest develop';

    const OPTION_LEVEL = 'level';
    const OPTION_LEVEL_SHORT = 'l';
    const OPTION_LEVEL_DESCRIPTION = 'Define on which level this command should run (default: project)';
    const OPTION_LEVEL_PROJECT = 'project';
    const OPTION_LEVEL_CORE = 'core';

    const OPTION_FROM = 'from';
    const OPTION_FROM_SHORT = 'f';
    const OPTION_FROM_DESCRIPTION = 'Define from where you want to rebase (default: develop)';
    const OPTION_FROM_DEVELOP = 'develop';

    const OPTION_BRANCH = 'branch';
    const OPTION_BRANCH_SHORT = 'b';
    const OPTION_BRANCH_DESCRIPTION = 'Define which branch you want to rebase (default: current)';

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);

        $this->addOption(self::OPTION_LEVEL, self::OPTION_LEVEL_SHORT, InputOption::VALUE_OPTIONAL, self::OPTION_LEVEL_DESCRIPTION, self::OPTION_LEVEL_PROJECT);
        $this->addOption(self::OPTION_FROM, self::OPTION_FROM_SHORT, InputOption::VALUE_OPTIONAL, self::OPTION_FROM_DESCRIPTION, self::OPTION_FROM_DEVELOP);
        $this->addOption(self::OPTION_BRANCH, self::OPTION_BRANCH_SHORT, InputOption::VALUE_OPTIONAL, self::OPTION_BRANCH_DESCRIPTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $workingDirectory = $this->getWorkingDirectory();
        $from = $this->getFrom();

        $this->info('console git:update --level=core --from=develop --branch=feature/XX-123-Your-description-here');

//console gitflow:update --level=core --from=develop --branch=feature/XX-123-Your-description-here
//
//Run "git checkout develop"? y
//... output ...
//
//Run "git pull --rebase"? y
//... output ...
//
//Run "git checkout feature/XX-123-Your-description-here"? y
//... output ...
//
//Run "git rebase develop"? y
//... output ...
//
//Run "git push -f origin feature/XX-123-Your-description-here"? y
//... output ...
    }

    /**
     * @return string
     */
    private function getWorkingDirectory()
    {
        $level = $this->input->getOption(self::OPTION_LEVEL);
        if ($level === self::OPTION_LEVEL_PROJECT) {
            return APPLICATION_ROOT_DIR;
        }

        if ($level === self::OPTION_LEVEL_CORE) {
            return APPLICATION_VENDOR_DIR . implode(DIRECTORY_SEPARATOR, ['spryker', 'spryker']);
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid level, allowed levels are "%s" and "%s"', $level, self::OPTION_LEVEL_CORE, self::OPTION_LEVEL_PROJECT));
    }

    /**
     * @return string
     */
    private function getFrom()
    {
        $level = $this->input->getOption(self::OPTION_LEVEL);
        if ($level === self::OPTION_LEVEL_PROJECT) {
            return APPLICATION_ROOT_DIR;
        }

        if ($level === self::OPTION_LEVEL_CORE) {
            return APPLICATION_VENDOR_DIR . implode(DIRECTORY_SEPARATOR, ['spryker', 'spryker']);
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid level, allowed levels are core and project', $level));
    }

}
