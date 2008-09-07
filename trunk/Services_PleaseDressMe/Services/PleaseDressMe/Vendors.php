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
 * Vendors interface for PleaseDressMe
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
class Services_PleaseDressMe_Vendors extends Services_PleaseDressMe_Common
{
    /**
     * Add a shirt to the index
     *
     * All shirts, by default, are inserted into the index with a pending
     * status. They will NOT show up in results until they have been approved
     * and tagged by our team.
     *
     * Required values are title, url, image and price. The url and image
     * values should be the full permalink URL of the shirt and the full URL
     * to the image you wish to be used. For best results use a square image!
     * The price must be greater than 0.00.
     * 
     * The response will contain a shirt with an id and url attribute. The id
     * is the unique PleaseDressMe shirtid and the url is the permalink on
     * our site where your shirt will be indexed. 
     *
     * <code>
     * <?php
     * require_once 'Services/PleaseDressMe.php';
     *
     * $api = new Services_PleaseDressMe('foo@example.com', 'secret');
     * $res = $api->vendors->addShirt(array(
     *     'title' => $data[2],
     *     'url' => $data[1],
     *     'image' => $data[3],
     *     'price' => (isset($data[4]) && $data[4] > 0) ? $data[4] : 19.99
     * ));
     *
     * print_r($res); // This is the shirt's id, URL, etc.
     *
     * ?>
     * </code>
     * 
     * @param array $shirt The shirt to add to the index
     *
     * @throw {Services_PleaseDressMe_Exception} on error
     * @return object Instance of SimpleXMLElement with response
     */
    public function addShirt(array $shirt)
    {
        return $this->sendRequest('/vendors/shirts/add', $shirt, 'POST');
    }

    /**
     * Remove a shirt from the site
     *
     * This will remove a shirt from the site entirely. You can always readd
     * the shirt later.
     * 
     * @param mixed $url_or_id The PleaseDressMe shirtid or unique URL of shirt
     *
     * @throw {Services_PleaseDressMe_Exception} on error
     * @return object Instance of SimpleXMLElement with response
     */
    public function removeShirt($url_or_id)
    {
        return $this->sendRequest('/vendors/shirts/remove', array(
            'id' => $url_or_id
        ), 'POST');
    }

    /**
     * Expire a shirt's cache and image 
     *
     * By default all shirt data is in cache and we cache a copy of the image
     * on our servers. Use this URL to expire those caches after updated a
     * shirt.
     * 
     * @param mixed $url_or_id The PleaseDressMe shirtid or unique URL of shirt
     *
     * @throw {Services_PleaseDressMe_Exception} on error
     * @return object Instance of SimpleXMLElement with response
     */
    public function expireShirt($url_or_id)
    {
        return $this->sendRequest('/vendors/shirts/expire', array(
            'id' => $url_or_id
        ), 'POST');
    }
}

?>
