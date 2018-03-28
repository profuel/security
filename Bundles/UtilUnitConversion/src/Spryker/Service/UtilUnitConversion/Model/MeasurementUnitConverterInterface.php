<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\UtilUnitConversion\Model;

interface MeasurementUnitConverterInterface
{
    /**
     * @param string $fromCode
     * @param string $toCode
     *
     * @throws \Spryker\Service\UtilUnitConversion\Exception\InvalidMeasurementUnitExchangeException
     *
     * @return float
     */
    public function getExchangeRatio(string $fromCode, string $toCode): float;
}
