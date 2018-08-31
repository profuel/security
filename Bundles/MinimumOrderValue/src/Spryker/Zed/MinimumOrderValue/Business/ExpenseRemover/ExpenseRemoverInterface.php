<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MinimumOrderValue\Business\ExpenseRemover;

use Generated\Shared\Transfer\CalculableObjectTransfer;

interface ExpenseRemoverInterface
{
    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return void
     */
    public function removeMinimumOrderValueExpenses(CalculableObjectTransfer $calculableObjectTransfer): void;
}
