<?php

namespace TickTackk\ResourceManagerStatsWidget\Cron;

use XF\App as BaseApp;
use XF\Mvc\Entity\Repository;
use XF\Repository\Counters as CountersRepo;
use TickTackk\ResourceManagerStatsWidget\XF\Repository\Counters as ExtendedCountersRepo;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class Counters
{
    /**
     * Rebuilds the board resource manager totals counter.
     */
    public static function rebuildResourceManagerStatistics() : void
    {
        static::getCountersRepo()->rebuildResourceManagerStatisticsForTck();
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
     * @param string $identifier Identifier of the repository.
     *
     * @return Repository Initiated repository.
     */
    protected static function repository(string $identifier) : Repository
    {
        return static::app()->repository($identifier);
    }

    /**
     * Returns an extended instance of \XF\Repository\Counters repository.
     *
     * @return Repository|CountersRepo|ExtendedCountersRepo Extended instance of \XF\Repository\Counters.
     */
    protected static function getCountersRepo() : CountersRepo
    {
        return static::repository('XF:Counters');
    }
}