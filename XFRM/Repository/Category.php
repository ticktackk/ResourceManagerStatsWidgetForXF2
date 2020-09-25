<?php

namespace TickTackk\ResourceManagerStatsWidget\XFRM\Repository;

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
class Category extends XFCP_Category
{
    /**
     * Returns the current category counters totals.
     *
     * @return array Category counters totals
     */
    public function getCategoryCountersTotalsForTck() : array
    {
        return $this->db()->fetchRow('
            SELECT COUNT(*) AS resources,
                   SUM(update_count) AS updates,
                   SUM(rating_count) AS ratings
            FROM xf_rm_resource
            WHERE resource_state = ?
        ', 'visible');
    }
}