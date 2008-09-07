<?php

require_once 'Services/PleaseDressMe/Exception.php';

class Services_PleaseDressMe
{
    static public $uri = 'http://www.dev.pleasedress.me/api/1.0';

    protected $user = '';
    protected $pass = '';

    static protected $groups = array(
        'vendors' => 'Vendors',
        'shirts'  => 'Shirts'
    );

    public function __construct($user = '', $pass = '')
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    static private function factory($group, $user, $pass)
    {
        $file = 'Services/PleaseDressMe/' . $group . '.php';
        include_once $file;

        $class = 'Services_PleaseDressMe_' . $group;
        if (!class_exists($class)) {
            throw new Services_PleaseDressMe_Exception('Invalid class name');
        }

        $instance = new $class($user, $pass);
        return $instance;
    }

    public function __get($name)
    {
        static $instances = array();

        if (!isset(self::$groups[$name])) {
            throw new Services_PleaseDressMe_Exception('Invalid API group');
        }

        if (isset($instances[$name])) {
            return $instances[$name];
        }

        $instances[$name] = self::factory(
            self::$groups[$name], $this->user, $this->pass
        );

        return $instances[$name];
    }
}

?>
