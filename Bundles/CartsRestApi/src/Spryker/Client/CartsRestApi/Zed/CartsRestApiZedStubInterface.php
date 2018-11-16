<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\CartsRestApi\Zed;

use Generated\Shared\Transfer\QuoteByIdCriteriaFilterTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;

interface CartsRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteByIdCriteriaFilterTransfer $quoteByIdCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByUuid(QuoteByIdCriteriaFilterTransfer $quoteByIdCriteriaFilterTransfer): QuoteResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteCriteriaFilterTransfer $quoteCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function getQuoteCollectionByCriteria(QuoteCriteriaFilterTransfer $quoteCriteriaFilterTransfer): QuoteCollectionTransfer;
}
