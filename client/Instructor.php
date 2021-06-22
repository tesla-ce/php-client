<?php
namespace tesla_ce\client;

use tesla_ce\exceptions\NotImplemented;

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
