<?php

require_once 'Services/PleaseDressMe/Common.php';

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
     * @param mixed $id The PleaseDressMe shirtid or unique URL of shirt
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
