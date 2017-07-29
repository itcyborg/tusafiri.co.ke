<?php

/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 7/8/2017
 * Time: 9:22 PM
 */
class paginator
{
    private $_data;
    private $_limit;
    private $_page;
    private $_total;
    private $_query;

    /**
     * paginator constructor.
     * @param $_data
     * @param $_limit
     * @param $_page
     * @param $_total
     */
    public function __construct($_data, $_limit, $_page, $_total)
    {
        $this->_data = $_data;
        $this->_limit = $_limit;
        $this->_page = $_page;
        $this->_total = $_total;
    }

    /**
     * @return mixed
     */
    public function getData($limit=10,$page=1)
    {
        $this->_limit=$limit;
        $this->_page=$page;

        if($this->_limit="all"){
            return $this->_query;
        }else{
            return $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
        return $this->_data;
    }
}