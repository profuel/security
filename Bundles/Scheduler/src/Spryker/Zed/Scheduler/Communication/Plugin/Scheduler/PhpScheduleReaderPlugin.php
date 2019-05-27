<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Scheduler\Communication\Plugin\Scheduler;

use Generated\Shared\Transfer\SchedulerFilterTransfer;
use Generated\Shared\Transfer\SchedulerRequestTransfer;
use Generated\Shared\Transfer\SchedulerScheduleTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SchedulerExtension\Dependency\Plugin\ScheduleReaderPluginInterface;

/**
 * @method \Spryker\Zed\Scheduler\Business\SchedulerFacadeInterface getFacade()
 * @method \Spryker\Zed\Scheduler\SchedulerConfig getConfig()
 */
class PhpScheduleReaderPlugin extends AbstractPlugin implements ScheduleReaderPluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SchedulerFilterTransfer $schedulerFilterTransfer
     * @param \Generated\Shared\Transfer\SchedulerScheduleTransfer $scheduleTransfer
     *
     * @return \Generated\Shared\Transfer\SchedulerScheduleTransfer
     */
    public function readSchedule(SchedulerFilterTransfer $schedulerFilterTransfer, SchedulerScheduleTransfer $scheduleTransfer): SchedulerScheduleTransfer
    {
        return $this->getFacade()->readScheduleFromPhpSource($schedulerFilterTransfer, $scheduleTransfer);
    }
}
