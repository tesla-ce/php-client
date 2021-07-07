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

class Instructor
{
    private $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function get($instructor_id)
    {
        // https://demo.tesla-project.eu/api/v2/vle/1/course/1/instructor/:id
        throw new NotImplemented();
    }

    public function create($course_id, $email, $name, $uuid)
    {
        // POST https://demo.tesla-project.eu/api/v2/vle/1/course/1/instructor/:id
        throw new NotImplemented();
    }

    public function remove($instructor_id)
    {
        // DELETE https://demo.tesla-project.eu/api/v2/vle/1/course/1/instructor/:id
        throw new NotImplemented();
    }
}
