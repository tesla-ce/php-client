<?php
namespace tesla_ce\client;

class Launcher
{
    private $connector = null;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function create($vle_id, $vle_user_uid)
    {
        $url = 'api/v2/vle/'.$vle_id.'/launcher/';

        $data = array(
            'vle_user_uid'=>$vle_user_uid
        );

        return $this->connector->makeAPIRequest('POST', $url, $data);
    }
}
