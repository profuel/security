<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SchedulerJenkins;

use Spryker\Shared\SchedulerJenkins\SchedulerJenkinsConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SchedulerJenkinsConfig extends AbstractBundleConfig
{
    protected const DEFAULT_AMOUNT_OF_DAYS_FOR_LOGFILE_ROTATION = 7;

    protected const DEFAULT_JENKINS_TEMPLATE_PATH = 'SchedulerJenkins/SchedulerJenkins/jenkins-job.xml.twig';

    /**
     * @return array
     */
    public function getJenkinsConfiguration(): array
    {
        return $this->get(SchedulerJenkinsConstants::JENKINS_CONFIGURATION);
    }

    /**
     * @param string $schedulerId
     *
     * @return string
     */
    public function getJenkinsBaseUrlBySchedulerId(string $schedulerId): string
    {
        return $this->getJenkinsConfiguration()[$schedulerId];
    }

    /**
     * @return bool
     */
    public function isJenkinsCsrfProtectionEnabled(): bool
    {
        return $this->get(SchedulerJenkinsConstants::JENKINS_CSRF_PROTECTION_ENABLED, false);
    }

    /**
     * @return int
     */
    public function getAmountOfDaysForLogFileRotation(): int
    {
        return $this->get(SchedulerJenkinsConstants::JENKINS_DEFAULT_AMOUNT_OF_DAYS_FOR_LOGFILE_ROTATION, static::DEFAULT_AMOUNT_OF_DAYS_FOR_LOGFILE_ROTATION);
    }

    /**
     * @return string
     */
    public function getJenkinsTemplatePath(): string
    {
        return $this->get(SchedulerJenkinsConstants::JENKINS_TEMPLATE_PATH, static::DEFAULT_JENKINS_TEMPLATE_PATH);
    }
}
