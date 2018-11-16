<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CheckoutRestApi\Business;

use Spryker\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataReader;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataReaderInterface;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\Customer\QuoteCustomerExpander;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\Customer\QuoteCustomerExpanderInterface;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\RestCheckoutRequestMapper;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\RestCheckoutRequestMapperInterface;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\PlaceOrderProcessor;
use Spryker\Zed\CheckoutRestApi\Business\Checkout\PlaceOrderProcessorInterface;
use Spryker\Zed\CheckoutRestApi\CheckoutRestApiDependencyProvider;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCartFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCartsRestApiFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCheckoutFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCustomerFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToPaymentFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToQuoteFacadeInterface;
use Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToShipmentFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CheckoutRestApi\CheckoutRestApiConfig getConfig()
 */
class CheckoutRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataReaderInterface
     */
    public function createCheckoutDataReader(): CheckoutDataReaderInterface
    {
        return new CheckoutDataReader(
            $this->getCartsRestApiFacade(),
            $this->getShipmentFacade(),
            $this->getPaymentFacade(),
            $this->getCustomerFacade(),
            $this->getQuoteMappingPlugins()
        );
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Business\Checkout\PlaceOrderProcessorInterface
     */
    public function createPlaceOrderProcessor(): PlaceOrderProcessorInterface
    {
        return new PlaceOrderProcessor(
            $this->getCartFacade(),
            $this->getCartsRestApiFacade(),
            $this->getCheckoutFacade(),
            $this->getQuoteFacade(),
            $this->getQuoteMappingPlugins()
        );
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\Customer\QuoteCustomerExpanderInterface
     */
    public function createQuoteCustomerExpander(): QuoteCustomerExpanderInterface
    {
        return new QuoteCustomerExpander($this->getCustomerFacade());
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Business\Checkout\Mapper\RestCheckoutRequestMapperInterface
     */
    public function createRestCheckoutRequestMapper(): RestCheckoutRequestMapperInterface
    {
        return new RestCheckoutRequestMapper();
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCartFacadeInterface
     */
    public function getCartFacade(): CheckoutRestApiToCartFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_CART);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCartsRestApiFacadeInterface
     */
    public function getCartsRestApiFacade(): CheckoutRestApiToCartsRestApiFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_CARTS_REST_API);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCheckoutFacadeInterface
     */
    public function getCheckoutFacade(): CheckoutRestApiToCheckoutFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_CHECKOUT);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToCustomerFacadeBridge
     */
    public function getCustomerFacade(): CheckoutRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToPaymentFacadeInterface
     */
    public function getPaymentFacade(): CheckoutRestApiToPaymentFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_PAYMENT);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToQuoteFacadeInterface
     */
    public function getQuoteFacade(): CheckoutRestApiToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApi\Dependency\Facade\CheckoutRestApiToShipmentFacadeInterface
     */
    public function getShipmentFacade(): CheckoutRestApiToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_SHIPMENT);
    }

    /**
     * @return \Spryker\Zed\CheckoutRestApiExtension\Dependency\Plugin\QuoteMappingPluginInterface[]
     */
    public function getQuoteMappingPlugins(): array
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::PLUGINS_QUOTE_MAPPING);
    }
}
