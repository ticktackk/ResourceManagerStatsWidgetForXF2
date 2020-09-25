<?php

namespace TickTackk\ResourceManagerStatsWidget;

use XF\App as BaseApp;
use XF\Container;
use XF\Mvc\Entity\Manager as EntityManager;
use XF\Mvc\Entity\Repository;
use XF\Repository\Counters as CountersRepo;
use TickTackk\ResourceManagerStatsWidget\XF\Repository\Counters as ExtendedCountersRepo;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class Listener
{
    public const RESOURCE_MANAGER_STATS_REGISTRY_KEY = 'tckResourceManagerStats';

    /**
     * Called after the global \XF\App object has been setup. This will fire regardless of the application type.
     *
     * @param \XF\App $app Global App object.
     *
     * @throws \XF\Db\Exception
     */
    public static function appSetup(BaseApp $app) : void
    {
        $container = $app->container();

        $dataRegistryKey = static::RESOURCE_MANAGER_STATS_REGISTRY_KEY;
        $container[$dataRegistryKey] = $app->fromRegistry($dataRegistryKey, function(Container $c)
        {
            return static::getCountersRepo($c['em'])->rebuildResourceManagerStatisticsForTck();
        });
    }

    /**
     * Returns the current running XenForo app.
     *
     * This can be either \XF\Pub\App or \XF\Admin\App in this case.
     *
     * @return BaseApp The instance of XF app.
     */
    protected static function app() : BaseApp
    {
        return \XF::app();
    }

    /**
     * @param string $identifier Identifier of the repository we want to initiate.
     * @param EntityManager|null $em Entity manager which will be used to create the repository.
     *
     * @return Repository The initiated repository.
     */
    protected static function repository(string $identifier, ?EntityManager $em = null) : Repository
    {
        $em = $em ?: static::app()->em();

        return $em->getRepository($identifier);
    }

    /**
     * Returns instance of \XF\Repository\Counters which has been extended.
     *
     * @return Repository|CountersRepo|ExtendedCountersRepo Extended instance of \XF\Repository\Counters repository.
     */
    protected static function getCountersRepo(?EntityManager $em = null) : CountersRepo
    {
        return static::repository('XF:Counters', $em);
    }
}