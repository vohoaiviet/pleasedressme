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

/**
 * Exception
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
class Services_PleaseDressMe_Exception extends Exception
{
    /**
     * URI used during failed call
     *
     * @var string $uri URI of API call
     */
    protected $uri = '';

    /**
     * Constructor
     *
     * @param string  $message Exception message
     * @param integer $code    Error code
     * @param string  $uri     URI of failed API call
     *
     * @return void
     * @see Services_PleaseDressMe_Exception::$uri
     */
    public function __construct($message = null, $code = 0, $uri = null)
    {
        parent::__construct($message, $code);
        $this->uri = $uri;
    }

    /**
     * Get URI of failed API call
     *
     * @return string
     */
    public function getURI()
    {
        return $this->uri;
    }
}

?>
