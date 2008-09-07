<?php

require_once 'Services/PleaseDressMe/Common.php';

class Services_PleaseDressMe_Shirts extends Services_PleaseDressMe_Common
{
    public function search($query)
    {
        return $this->sendRequest('/shirts/search', array('q' =>$query));
    }
}

?>
