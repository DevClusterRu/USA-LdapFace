<?php


class MongoLib
{

    protected static $db = "kanban";

    function __construct()
    {
        parent::__construct();
    }


    private static function manager()
    {
        return new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public static function query($collection, $q)
    {
        $query = new MongoDB\Driver\Query($q);
        $cursor = self::manager()->executeQuery($collection, $query);
        return $cursor->toArray();
    }

    public static function addRow($collection, $row)
    {
        $bulk = new MongoDB\Driver\BulkWrite();
        $bulk->insert($row);
        self::manager()->executeBulkWrite($collection, $bulk);
    }


    function agg($collection, $row)
    {
        $command = new MongoDB\Driver\Command([
            'aggregate' => $collection,
            'pipeline' => $row,
            'cursor' => new stdClass,
        ]);
        $cursor = $this->manager()->executeCommand(self::$db, $command);
        return $cursor->toArray();

    }

    public static function update($collection, $filter, $row, $multi = null)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        if ($multi != null) {
            $bulk->update($filter, ['$set' => $row], $multi);
        }
        $bulk->update($filter, ['$set' => $row]);
        self::manager()->executeBulkWrite($collection, $bulk);
        return true;
    }

    public static function removeFromArray($collection, $filter, $multi = null)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        if ($multi != null) {
            $bulk->update([], ['$pull' => $filter], $multi);
        }
        $bulk->update([], ['$pull' => $filter]);
        self::manager()->executeBulkWrite($collection, $bulk);
        return true;
    }


    public static function push($collection, $filter, $row, $multi = null)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        if ($multi != null) {
            $bulk->update($filter, ['$set' => $row], $multi);
        }
        $bulk->update($filter, ['$push' => $row]);
        self::manager()->executeBulkWrite($collection, $bulk);
        return true;
    }


    public static function remove($collection, $filter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete($filter);
        self::manager()->executeBulkWrite($collection, $bulk);
    }



}