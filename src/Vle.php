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

class Vle
{
    private $connector = null;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function getLauncher(
        $vle_id,
        $vle_user_uid,
        $target = "DASHBOARD",
        $ttl = 120,
        $target_url = null,
        $session_id = null
    ) {
        $url = "api/v2/vle/{$vle_id}/launcher/";

        $data = array(
            'vle_user_uid'=>$vle_user_uid,
            'target'=>$target,
            'ttl'=>$ttl,
            'session_id'=>$session_id,
            'target_url'=>$target_url
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }
}
