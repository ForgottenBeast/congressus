<?php /*
	Copyright 2015 Cédric Levieux, Parti Pirate

	This file is part of Congressus.

    Congressus is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Congressus is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Congressus.  If age, see <http://www.gnu.org/licenses/>.
*/

if (!isset($api)) exit();

include_once("config/config.php");
include_once("config/memcache.php");
require_once("engine/utils/EventStackUtils.php");

require_once("engine/bo/MeetingBo.php");
require_once("engine/bo/NoticeBo.php");
require_once("engine/bo/TaskBo.php");

$meetingId = $arguments["meetingId"];

$data = array();
$data["ok"] = "ok";

$connection = openConnection();

$meetingBo = MeetingBo::newInstance($connection);
$noticeBo = NoticeBo::newInstance($connection);
$taskBo = TaskBo::newInstance($connection, $config);

$meeting = $meetingBo->getById($_REQUEST["meetingId"]);

if (!$meeting) {
	echo json_encode(array("ko" => "ko", "message" => "meeting_does_not_exist"));
}

$notices = $noticeBo->getByFilters(array("not_meeting_id" => $meeting[$meetingBo->ID_FIELD]));
$tasks = $taskBo->getByFilters(array("notices" => $notices, "only_open" => true));

$data["tasks"] = $tasks;

echo json_encode($data, JSON_NUMERIC_CHECK);
?>