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

class Activity
{
    private $connector = null;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function get($vle_id, $course_id, $id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/activity/'.$id;
        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function getByVleActivityIdAndType($vle_id, $course_id, $vle_activity_id, $vle_activity_type)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/activity?vle_activity_id='.$vle_activity_id.
            '&vle_activity_type='.$vle_activity_type;
        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function create(
        $vle_id,
        $course_id,
        $vle_activity_type,
        $vle_activity_id,
        $name,
        $description = null,
        $start_at = null,
        $end_at = null,
        $conf = null
    ) {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/activity/';
        $data = array(
            'vle_id'=>$vle_id,
            'name'=>$name,
            'description'=>$description,
            'vle_activity_type'=>$vle_activity_type,
            'vle_activity_id'=>$vle_activity_id,
            'start' => ($start_at ? $start_at->format('Y-m-d\TH:i:s\Z') : null),
            'end' => ($end_at ? $end_at->format('Y-m-d\TH:i:s\Z') : null),
            'conf'=>$conf
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function remove($vle_id, $course_id, $id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/activity/'.$id;
        return $this->connector->makeAPIRequest('DELETE', $url, array());
    }

    public function update(
        $vle_id,
        $course_id,
        $activity_id,
        $vle_activity_type,
        $vle_activity_id,
        $name = null,
        $description = null,
        $start_at = null,
        $end_at = null,
        $conf = null
    ) {
        $url = 'api/v2/vle/' . $vle_id . '/course/' . $course_id . '/activity/'.$activity_id.'/';

        $data = array(
            'vle_id' => $vle_id,
            'vle_activity_type' => $vle_activity_type,
            'vle_activity_id' => $vle_activity_id
        );

        if ($name != null) {
            $data['name'] = $name;
        }

        if ($description != null) {
            $data['description'] = $description;
        }

        if ($start_at != null) {
            $data['start'] = $start_at->format('Y-m-d\TH:i:s\Z');
        }

        if ($end_at != null) {
            $data['end'] = $end_at->format('Y-m-d\TH:i:s\Z');
        }

        if ($conf != null) {
            $data['conf'] = $conf;
        }

        return $this->connector->makeAPIRequest('PATCH', $url, $data);
    }

    public function getInstruments($vle_id, $course_id, $activity_id)
    {
        $url = "api/v2/vle/{$vle_id}/course/{$course_id}/activity/{$activity_id}/instrument/";

        return $this->connector->makeAPIRequest('GET', $url, array());
    }
}
