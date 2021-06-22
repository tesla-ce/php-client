<?php
namespace tesla_ce\client;

use tesla_ce\exceptions\NotImplemented;

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
