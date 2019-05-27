<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Scheduler\Business\PhpScheduleReader;

use Generated\Shared\Transfer\SchedulerFilterTransfer;
use Generated\Shared\Transfer\SchedulerRequestTransfer;
use Generated\Shared\Transfer\SchedulerScheduleTransfer;
use Spryker\Zed\Scheduler\Business\Exception\FileIsNotAccessibleException;
use Spryker\Zed\Scheduler\Business\PhpScheduleReader\Mapper\PhpScheduleMapperInterface;
use Spryker\Zed\Scheduler\SchedulerConfig;

class PhpScheduleReader implements PhpScheduleReaderInterface
{
    /**
     * @var \Spryker\Zed\Scheduler\Business\PhpScheduleReader\Mapper\PhpScheduleMapperInterface
     */
    protected $mapper;

    /**
     * @var \Spryker\Zed\Scheduler\SchedulerConfig
     */
    protected $schedulerConfig;

    /**
     * @param \Spryker\Zed\Scheduler\Business\PhpScheduleReader\Mapper\PhpScheduleMapperInterface $mapper
     * @param \Spryker\Zed\Scheduler\SchedulerConfig $schedulerConfig
     */
    public function __construct(
        PhpScheduleMapperInterface $mapper,
        SchedulerConfig $schedulerConfig
    ) {
        $this->mapper = $mapper;
        $this->schedulerConfig = $schedulerConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\SchedulerFilterTransfer $schedulerFilterTransfer
     * @param \Generated\Shared\Transfer\SchedulerScheduleTransfer $scheduleTransfer
     *
     * @return \Generated\Shared\Transfer\SchedulerScheduleTransfer
     */
    public function readSchedule(SchedulerFilterTransfer $schedulerFilterTransfer, SchedulerScheduleTransfer $scheduleTransfer): SchedulerScheduleTransfer
    {
        $sourceFileName = $this->schedulerConfig->getPhpSchedulerReaderPath($scheduleTransfer->getIdScheduler());

        $this->assertSourceFileName($sourceFileName);

        $jobs = [];

        include_once $sourceFileName;

        return $this->mapper->mapScheduleFromArray($schedulerFilterTransfer, $scheduleTransfer, $jobs);
    }

    /**
     * @param string $sourceFileName
     *
     * @throws \Spryker\Zed\Scheduler\Business\Exception\FileIsNotAccessibleException
     *
     * @return void
     */
    protected function assertSourceFileName(string $sourceFileName): void
    {
        if (!file_exists($sourceFileName) || !is_readable($sourceFileName)) {
            throw new FileIsNotAccessibleException();
        }
    }
}
