<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Application\Plugin\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Application\Plugin\Exception\InvalidUrlConfigurationException;
use Spryker\Yves\Kernel\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Yves\Application\ApplicationConfig getConfig()
 */
class AssertUrlConfigurationServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app)
    {
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app)
    {
        $app->before(function (Request $request) {
            $this->assertMatchingHostName($request);
        }, Application::EARLY_EVENT);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \Spryker\Yves\Application\Plugin\Exception\InvalidUrlConfigurationException
     *
     * @return void
     */
    protected function assertMatchingHostName(Request $request)
    {
        $hostName = $request->getHttpHost();
        if (!$hostName) {
            return;
        }

        $configuredHostName = $this->getConfig()->getHostName();
        if ($configuredHostName === $hostName) {
            return;
        }

        throw new InvalidUrlConfigurationException(sprintf(
            'Incorrect HOST_YVES config, expected `%s`, got `%s`. Set the URLs in your Shared/config_default_%s.php or env specific config files.',
            $hostName,
            $configuredHostName,
            Store::getInstance()->getStoreName()
        ));
    }
}