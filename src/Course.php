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

use tesla_ce\client\exceptions\NotImplemented;

class Course
{
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function create(
        $vle_id,
        $code,
        $vle_course_id,
        $description,
        $start_at = null,
        $end_at = null,
        $parent_id = null
    ) {
        $url = 'api/v2/vle/'.$vle_id.'/course/';

        $data = array(
            'code' => $code,
            'vle'=>$vle_id,
            'vle_course_id' => $vle_course_id,
            'description' => $description,
            'start' => ($start_at ? $start_at->format('Y-m-d\TH:i:s\Z') : null),
            'end' => ($end_at ? $end_at->format('Y-m-d\TH:i:s\Z') : null),
            'parent' => $parent_id
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function update(
        $vle_id,
        $course_id,
        $code,
        $vle_course_id,
        $description,
        $start_at = null,
        $end_at = null,
        $parent_id = null
    ) {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/';

        $data = array(
            'code' => $code,
            'vle'=>$vle_id,
            'vle_course_id' => $vle_course_id,
            'description' => $description,
            'start' => ($start_at ? $start_at->format('Y-m-d\TH:i:s\Z') : null),
            'end' => ($end_at ? $end_at->format('Y-m-d\TH:i:s\Z') : null),
            'parent' => $parent_id
        );

        return $this->connector->makeAPIRequest('PUT', $url, $data);
    }

    public function get($vle_id, $id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$id;
        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function getByVleCourseId($vle_id, $vle_course_id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/?vle_course_id='.$vle_course_id;

        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function addActivity($course_id, $activity_id)
    {
        throw new NotImplemented();
    }

    public function removeActivity($course_id, $activity_id)
    {
        throw new NotImplemented();
    }

    public function addInstructor($vle_id, $course_id, $instructor_uuid)
    {
        $url = "api/v2/vle/{$vle_id}/course/{$course_id}/instructor/";

        $data = array(
            'uid' => $instructor_uuid,
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function removeInstructor($vle_id, $course_id, $instructor_uuid)
    {
        throw new NotImplemented();
    }

    public function addLearner($vle_id, $course_id, $learner_uuid)
    {
        $url = "api/v2/vle/{$vle_id}/course/{$course_id}/learner/";

        $data = array(
            'uid' => $learner_uuid,
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function removeLearner($vle_id, $course_id, $instructor_uuid)
    {
        throw new NotImplemented();
    }
}
