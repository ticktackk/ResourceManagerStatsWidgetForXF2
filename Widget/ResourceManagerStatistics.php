<?php

namespace TickTackk\ResourceManagerStatsWidget\Widget;

use TickTackk\ResourceManagerStatsWidget\Listener;
use TickTackk\ResourceManagerStatsWidget\XF\Repository\Counters as ExtendedCountersRepo;
use XF\Widget\AbstractWidget;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class ResourceManagerStatistics extends AbstractWidget
{
    /**
     * Renders the widget template.
     *
     * @return string Rendered the widget.
     */
    public function render() : string
    {
        $viewParams = [
            'resourceManagerStatistics' => $this->getResourceManagerStatistics()
        ];
        return $this->renderer('tckResourceManagerStatsWidget_widget_xfrm_statistics', $viewParams);
    }

    /**
     * Returns the options template that will be used in widget setup page to configure widgets.
     *
     * @return string|null Returns string if the widget has options available to be configured.
     */
    public function getOptionsTemplate() :? string
    {
        return null;
    }

    /**
     * This will retrieve the resource manager statistics via data registry.
     *
     * @see ExtendedCountersRepo::rebuildResourceManagerStatisticsForTck()
     *
     * @return array Returns the cached resource manager statistics.
     */
    protected function getResourceManagerStatistics() : array
    {
        return $this->app()->container(Listener::RESOURCE_MANAGER_STATS_REGISTRY_KEY);
    }
}