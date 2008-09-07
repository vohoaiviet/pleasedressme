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

require_once 'Services/PleaseDressMe/Common.php';

/**
 * Shirts API Group
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
class Services_PleaseDressMe_Shirts extends Services_PleaseDressMe_Common
{
    /**
     * Search shirts by keyword
     *
     * @param string $query The query string to search for
     *
     * @return object Instance of SimpleXMLElement with API response
     * @throws {@link Services_PleaseDressMe_Exception} on API error
     */
    public function search($query)
    {
        return $this->sendRequest('/shirts/search', array('q' =>$query));
    }

    /**
     * Get shirts by tag
     *
     * @param string $tag The tag to fetch shirts for (e.g. 'beer')
     *
     * @return object Instance of SimpleXMLElement with API response
     * @throws {@link Services_PleaseDressMe_Exception} on API error
     */
    public function tag($tag)
    {
        return $this->sendRequest('/shirts/tag', array('tag' =>$query));
    }
}

?>
