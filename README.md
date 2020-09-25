Resource Manager Stats Widget for XenForo 2.1.10.2+
===================================================

Description
-----------

This add-on allows showing resource manager statistics in a widget.

Requirements
------------

- PHP 7.3+
- XenForo Resource Manager 2.1.0+

Widget Definitions
------------------

| Definition                                     | Description                                                                                                                                                          |
| ---------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Resource manager statistics (`tck_xfrm_stats`) | Displays a block which that shows the forum's current resource manager statistics on things like total resources, updates, ratings, files, disk usage and downloads. |

Cron Entries
------------

| Name                                | Run on...            | Run at hours | Run at minutes |
| ----------------------------------- | -------------------- | ------------ | -------------- |
| Rebuild resource manager statistics | Any day of the month | Any          | 4              |

License
-------

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/ticktackk/ResourceManagerStatsWidgetForXF2/blob/master/LICENSE.md) file for details.