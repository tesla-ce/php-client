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

class Learner
{
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function get($id)
    {
        throw new NotImplemented();
    }

    public function create($vle_id, $course_id, $first_name, $last_name, $email, $uid)
    {
        // todo: Remove institution!
        $data = array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'uid'=>$uid,
            'institution'=>1
        );

        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/learner/';

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function getByUid($vle_id, $course_id, $uid)
    {
        $url = 'api/v2/vle/'.$vle_id.'/course/'.$course_id.'/learner/?uid='.urlencode($uid);

        return $this->connector->makeAPIRequest('GET', $url, array());
    }

    public function remove($leaner_id)
    {
        throw new NotImplemented();
    }

    public function addActivity($activity_id, $learner_id)
    {
        throw new NotImplemented();
    }
    public function removeActivity($activity_id, $learner_id)
    {
        throw new NotImplemented();
    }

    public function hasValidInformedConsent($activity_id)
    {
        throw new NotImplemented();
    }

    public function hasValidEnrolment($activity_id)
    {
        throw new NotImplemented();
    }

    public function getExternalToolURL($activity_id, $learner_id)
    {
        throw new NotImplemented();
    }

    public function sendRequest($activity_id, $learner_id, $b64_data)
    {
        throw new NotImplemented();
    }
}
