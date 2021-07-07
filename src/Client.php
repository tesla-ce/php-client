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

class Client
{
    private $role_id;
    private $secret_id;
    private $base_url;
    private $verify_ssl;
    private $connector;
    private $instructor;
    private $learner;
    private $course;
    private $activity;
    private $assessment;
    private $verification;
    private $vle;

    public function __construct($role_id, $secret_id, $base_url, $verify_ssl = true, $cache = null)
    {
        $this->role_id = $role_id;
        $this->secret_id = $secret_id;
        $this->base_url = $base_url;
        $this->verify_ssl = $verify_ssl;

        $this->connector = new Connector($this->role_id, $this->secret_id, $this->base_url, $this->verify_ssl, $cache);
        $this->activity = new Activity($this->connector);
        $this->assessment = new Assessment($this->connector);
        $this->course = new Course($this->connector);
        $this->instructor = new Instructor($this->connector);
        $this->learner = new Learner($this->connector);
        $this->verification = new Verification($this->connector);
        $this->vle = new Vle($this->connector);
    }

    public function getModule()
    {
        if ($this->connector == null) {
            return null;
        }
        return $this->connector->getModule();
    }

    public function getModuleType()
    {
        if ($this->connector == null) {
            return null;
        }
        return $this->connector->getModuleType();
    }

    public function getConfiguration()
    {
        if ($this->connector == null) {
            return null;
        }
        return $this->connector->getConfiguration();
    }

    public function getVleId()
    {
        if ($this->connector == null) {
            return null;
        }
        $module = $this->connector->getModule();
        $module_type = $this->connector->getModuleType();
        return $module[$module_type]['id'];
    }

    public function getActivity()
    {
        return $this->activity;
    }

    public function getAssessment()
    {
        return $this->assessment;
    }

    public function getCourse()
    {
        return $this->course;
    }

    public function getInstructor()
    {
        return $this->instructor;
    }

    public function getLearner()
    {
        return $this->learner;
    }

    public function getVerification()
    {
        return $this->verification;
    }

    public function getVle()
    {
        return $this->vle;
    }
}
