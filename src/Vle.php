<?php
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
