<?php

/**
 * An interface for PleaseDressMe
 *
 * PHP version 5.1.0+
 *
 * Copyright (c) 2007, The PEAR Group
 * 
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *  - Neither the name of the The PEAR Group nor the names of its contributors 
 *    may be used to endorse or promote products derived from this software 
 *    without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Services
 * @package   Services_PleaseDressMe
 * @author    Joe Stump <joe@joestump.net> 
 * @copyright 2008 24736five, LLC
 * @license   http://tinyurl.com/42zef New BSD License
 * @version   SVN: @version@
 * @link      http://code.google.com/p/pleasedressme
 * @link      http://pleasedress.me
 */

require_once 'Services/PleaseDressMe/Exception.php';

/**
 * Base class for PleaseDressMe's API
 *
 * <code>
 * <?php
 * 
 * require_once 'Services/PleaseDressMe.php';
 *
 * $api    = new Services_PleaseDressMe();
 * $shirts = $api->shirts->search('seinfeld');
 * foreach ($shirts->shirt as $shirt) {
 *     echo $shirt['title'] . "\n";
 * }
 *
 * ?>
 * </code>
 *
 * @category  Services
 * @package   Services_PleaseDressMe
 * @author    Joe Stump <joe@joestump.net> 
 * @copyright 2008 24736five, LLC
 * @license   http://tinyurl.com/42zef New BSD License
 * @version   Release: @version@
 * @link      http://code.google.com/p/pleasedressme
 * @link      http://pleasedress.me
 */
class Services_PleaseDressMe
{
    /**
     * API URI 
     *
     * @var string $uri The URI for the API to use
     */
    static public $uri = 'https://pleasedress.me/api/1.0';

    /**
     * API username
     *
     * Using the vendor API requires a valid username and password. You must
     * be an approved vendor to use this portion of the API. The username
     * and password are the same as the vendor dashboard login.
     *
     * @var string $user The API username
     * @link http://pleasedress.me/vendors/join
     * @link http://pleasedress.me/vendors/login
     */
    protected $user = '';

    /**
     * API password
     *
     * @var string $pass The API password
     * @see Services_PleaseDressMe::$user
     */
    protected $pass = '';

    /**
     * List of valid API groups
     * 
     * @var array $groups API groups
     * @see PleaseDressMe::__get()
     */
    static protected $groups = array(
        'vendors' => 'Vendors',
        'shirts'  => 'Shirts',
        'tags'    => 'Tags'
    );

    /**
     * Constructor
     *
     * @param string $user The API username
     * @param string $pass The API password
     *
     * @return void
     */
    public function __construct($user = '', $pass = '')
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Load an API group driver
     *
     * @param string $group The API group driver to load
     * @param string $user  The API username
     * @param string $pass  The API password
     *
     * @return object Instance of an API group driver
     * @see Services_PleaseDressMe_Shirts
     * @see Services_PleaseDressMe_Vendors
     * @see Services_PleaseDressMe_Tags
     * @throws {@link Services_PleaseDressMe_Exception} on invalid group
     */
    static protected function factory($group, $user, $pass)
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

    /**
     * Get a group
     *
     * @param string $name The API group to load
     *
     * @return object Instance of API group driver
     * @see Services_PleaseDressMe::factory()
     * @throws {@link Services_PleaseDressMe_Exception} on invalid group
     */
    public function __get($name)
    {
        static $instances = array();

        if (!isset(self::$groups[$name])) {
            throw new Services_PleaseDressMe_Exception('Invalid API group');
        }

        if (isset($instances[$name])) {
            return $instances[$name];
        }

        $instances[$name] = self::factory(self::$groups[$name], 
                                          $this->user, 
                                          $this->pass);

        return $instances[$name];
    }
}

?>
