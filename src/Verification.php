<?php
/*
 * Copyright (c) 2020 Roger Muñoz Bernaus
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace tesla_ce\client;

class Verification
{
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function send(
        $institution_id,
        $learner_id,
        $data,
        $instruments,
        $course_id = null,
        $activity_id = null,
        $session_id = null,
        $metadata = null
    ) {
        $url = "lapi/v1/verification/{$institution_id}/{$learner_id}/";

        $data = array(
            'learner_id'=>$learner_id,
            'course_id'=>$course_id,
            'activity_id'=>$activity_id,
            'data'=>$data,
            'session_id'=>$session_id,
            'instruments'=>$instruments,
            'metadata'=>$metadata
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function canSend($vle_id, $course_id, $activity_id, $learner_id)
    {
        $url = "api/v2/vle/{$vle_id}/course/{$course_id}/activity/{$activity_id}/attachment/{$learner_id}/";

        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function sendActivityDocument(
        $vle_id,
        $learner_id,
        $data,
        $instruments,
        $course_id = null,
        $activity_id = null,
        $session_id = null,
        $metadata = null
    ) {
        $url = "api/v2/vle/{$vle_id}/course/{$course_id}/activity/{$activity_id}/attachment/{$learner_id}/";

        $data = array(
            'data'=>$data,
            'session_id'=>$session_id,
            'instruments'=>$instruments,
            'metadata'=>$metadata
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }
}
