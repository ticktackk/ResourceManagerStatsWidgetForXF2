<?php

namespace TickTackk\ResourceManagerStatsWidget;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\DataRegistry;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     * On uninstall, delete the cached resource manager stats
     */
    public function uninstallStep1() : void
    {
        $this->registry()->delete(Listener::RESOURCE_MANAGER_STATS_REGISTRY_KEY);
    }

    /**
     * Returns the data registry which is used for storing( and caching) all sorts data
     *
     * @return DataRegistry Instance of data registry
     */
    protected function registry() : DataRegistry
    {
        return $this->app()->registry();
    }
}