<?php


class Services_PleaseDressMe_Exception extends Exception
{
    protected $uri = '';

    public function __construct($message = null, $code = 0, $uri = null)
    {
        parent::__construct($message, $code);
        $this->uri = $uri;
    }

    public function getURI()
    {
        return $this->uri;
    }
}

?>
