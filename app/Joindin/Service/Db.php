<?php
namespace Joindin\Service;

class Db
{
    private $_dbclass;

    /**
     * Set a mock MongoClient class
     *
     * @param MongoClient $client MongoClient class to mock
     *
     * @return MongoClient class
     */
    public function setMongoClient($client)
    {
        $this->_dbclass = $client;
        return $client;
    }

    /**
     * Get a single value from key $key
     *
     * @param string $collection Collection to search
     * @param string $key        Key to search
     * @param string $value      Value to match
     *
     * @return object
     */
    public function getOneByKey($collection, $key, $value)
    {
        return $this->_getMongoClient()
            ->selectCollection('joindin', $collection)
            ->findOne(array($key => $value));
    }

    /**
     * Save a value
     *
     * @param string $collection Collection to save into
     * @param array  $data       Data to save
     *
     * @return array Status of save
     */
    public function save($collection, $data)
    {
        return $this->_getMongoClient()
            ->selectCollection('joindin', $collection)
            ->save($data);
    }


    /**
     * Returns MongoClient object, or a mock
     *
     * @return MongoClient
     */
    private function _getMongoClient()
    {
        if (null == $this->_dbclass) {
            $db = new \MongoClient();
            $this->_dbclass = $db;
        }

        return $this->_dbclass;
    }
}