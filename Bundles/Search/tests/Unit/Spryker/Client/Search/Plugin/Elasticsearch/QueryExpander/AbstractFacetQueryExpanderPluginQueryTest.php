<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander;

use Elastica\Query\BoolQuery;
use Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\FacetQueryExpanderPlugin;

abstract class AbstractFacetQueryExpanderPluginQueryTest extends AbstractQueryExpanderPluginTest
{

    /**
     * @dataProvider facetQueryExpanderDataProvider
     *
     * @param \Spryker\Client\Search\Dependency\Plugin\SearchConfigInterface $searchConfig
     * @param \Elastica\Query\BoolQuery $expectedQuery
     * @param array $params
     *
     * @return void
     */
    public function testFacetQueryExpanderShouldCreateSearchQueryBasedOnSearchConfig(SearchConfigInterface $searchConfig, BoolQuery $expectedQuery, array $params = [])
    {
        $queryExpander = new FacetQueryExpanderPlugin();
        $query = $queryExpander->expandQuery($this->createBaseQueryPlugin(), $searchConfig, $params);

        $query = $query->getSearchQuery()->getQuery();

        $this->assertEquals($expectedQuery, $query);
    }

    /**
     * @return array
     */
    abstract public function facetQueryExpanderDataProvider();

}
