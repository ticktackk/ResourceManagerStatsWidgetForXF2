<?php

namespace TickTackk\ResourceManagerStatsWidget\XF\Repository;

use TickTackk\ResourceManagerStatsWidget\Listener;
use TickTackk\ResourceManagerStatsWidget\XFRM\Repository\Category as ExtendedCategoryRepo;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class Counters extends XFCP_Counters
{
    /**
     * Returns the resource manager statistics.
     *
     * @return array This is the resource statistics which will be used to save in cache.
     */
    public function getResourceManagerStatisticsForTck() : array
    {
        /** @var ExtendedCategoryRepo $categoryRepo */
        $categoryRepo = $this->repository('XFRM:Category');

        $cache = $categoryRepo->getCategoryCountersTotalsForTck();

        $attachmentStats = $this->db()->fetchRow("
            SELECT COUNT(*) AS files,
                   SUM(attachment.view_count) AS downloads,
                   SUM(attachment_data.file_size) AS disk_usage
            FROM xf_attachment AS attachment
            INNER JOIN xf_rm_resource_version AS resource_version
               ON (attachment.content_id = resource_version.resource_version_id AND attachment.content_type = ?)
            INNER JOIN xf_rm_resource AS resource
               ON (resource_version.resource_id = resource.resource_id)
            INNER JOIN xf_attachment_data AS attachment_data
              ON (attachment.data_id = attachment_data.data_id)
            WHERE attachment.content_type = ?
              AND resource_version.version_state = ?
        ", ['resource_version', 'resource_version', 'visible']);

        $cache['files'] = $attachmentStats['files'];
        $cache['disk_usage'] = $attachmentStats['disk_usage'] ?? 0;
        $cache['downloads'] = $attachmentStats['downloads'] ?? 0;

        return $cache;
    }

    /**
     * Rebuilds resource manager statistics to be shown in a widget.
     *
     * @return array The statistics which has been cached.
     */
    public function rebuildResourceManagerStatisticsForTck() : array
    {
        $cache = $this->getResourceManagerStatisticsForTck();

        $this->app()->registry()->set(Listener::RESOURCE_MANAGER_STATS_REGISTRY_KEY, $cache);

        return $cache;
    }
}