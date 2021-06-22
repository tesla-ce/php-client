<?php
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
}
