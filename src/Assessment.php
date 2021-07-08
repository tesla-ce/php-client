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

class Assessment
{
    private $connector = null;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function create(
        $vle_id,
        $vle_course_id,
        $vle_activity_id,
        $vle_activity_type,
        $vle_learner_uid,
        $max_ttl,
        $redirect_reject_url,
        $reject_message = null,
        $locale = null,
        $session_id = null,
        $floating_menu_initial_pos = 'top-right'
    ) {
        $url = 'api/v2/vle/'.$vle_id.'/assessment/';

        // todo: review all these fields. Are all fields needed?
        $data = array(
            'vle_course_id'=>$vle_course_id,
            'vle_activity_id'=>$vle_activity_id,
            'vle_activity_type'=>$vle_activity_type,
            'vle_learner_uid'=>$vle_learner_uid,
            'max_ttl'=>$max_ttl,
            'redirect_reject_url'=> $redirect_reject_url,
            'reject_message'=> $reject_message,
            'locale'=>$locale,
            'session_id'=>$session_id,
            'options'=>array(
                'floating_menu_initial_pos'=>$floating_menu_initial_pos
            )
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function close($vle_id, $assessment_id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/assessment/close/'.$assessment_id;
        return $this->connector->makeAPIRequest('GET', $url, array());
    }
}
