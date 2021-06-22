<?php
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
        $session_id = null
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
            'session_id'=>$session_id
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }

    public function close($vle_id, $assessment_id)
    {
        $url = 'api/v2/vle/'.$vle_id.'/assessment/close/'.$assessment_id;
        return $this->connector->makeAPIRequest('GET', $url, array());
    }
}
