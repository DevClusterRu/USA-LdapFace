<?php

use CodeIgniter\HTTP\RequestInterface;


class Mmongo extends MongoLib
{

    public function tryAuth(RequestInterface $request)
    {
        $result = MongoLib::query(self::$db . '.users', array("email" => $request->getPost('username'), "password" => $request->getPost('password')));
        return $result;
    }

    public static function tryRegistration(RequestInterface $request)
    {
        $result = MongoLib::query(MongoLib::$db . '.users', array("email" => $request->getPost('username')));
        if (count($result)) return "isset";

        $now = new MongoDB\BSON\UTCDateTime(time() * 1000);

        MongoLib::addRow(MongoLib::$db . '.users', array(
            "email" => $request->getPost('username'),
            "role" => "admin",
            "name" => $request->getPost('username'),
            "status" => "pending",
            "password" => $request->getPost('password'),
            "avatar" => "avatar/img.png",
            "created_at" => $now,
            "updated_at" => $now,
        ));

        return self::tryAuth($request);
    }

    public static function getUsers()
    {
        $result = MongoLib::query(self::$db . '.users', array());
        return $result;
    }

    public static function getUser($uid)
    {
        $result = MongoLib::query(MongoLib::$db . '.users', ["_id" => new MongoDB\BSON\ObjectId($uid)]);
        return $result[0];
    }

    public static function getProjects()
    {
        $result = MongoLib::query(MongoLib::$db . '.projects', []);

        foreach ($result as $res) {
            if (!isset($res->tasks)) continue;
            foreach ($res->tasks as $key => $task) {
                if (!isset($task->performer)) {
                    $res->tasks[$key]->avatar = "avatar/img.png";
                    $res->tasks[$key]->performer = "";
                    $res->tasks[$key]->percent = -1;
                    $res->tasks[$key]->percent_state = "Простой, нет исполнителя";

                } else {
                    $performer = self::getUser($task->performer);
                    $res->tasks[$key]->avatar = $performer->avatar;
                    $res->tasks[$key]->performer = $performer->name;

                    $fulltime = date($res->tasks[$key]->deadline) - date($res->tasks[$key]->created_at);
                    $passtime = date($res->tasks[$key]->deadline) - time() * 1000;
                    $res->tasks[$key]->percent = round(100 - ($passtime / $fulltime * 100));
                    $res->tasks[$key]->percent_state = $res->tasks[$key]->percent;

                }

            }
        }


        return $result;
    }

    public static function createTask(RequestInterface $request)
    {
        $now = new MongoDB\BSON\UTCDateTime(time() * 1000);
        $deadline = new MongoDB\BSON\UTCDateTime(strtotime($request->getPost('deadlineDate') . " " . $request->getPost('deadlineTime')) * 1000);

        $result = MongoLib::push(self::$db . '.projects', ["_id" => new MongoDB\BSON\ObjectId($request->getPost('pid'))],
            [
                "tasks" =>
                    [
                        "id" => sha1($request->getPost('pid') . date("d.m.Y H:i:s") . rand(555, 9999999)),
                        "name" => $request->getPost('taskName'),
                        "description" => $request->getPost('taskDescription'),
                        "price" => $request->getPost('price'),
                        "created_at" => $now,
                        "updated_at" => $now,
                        "deadline" => $deadline,
                        "payment" => $request->getPost('optionsRadios'),
                    ]
            ]
        );

        return $result;
    }

    public static function pushAvatar($fname, $uid)
    {
        return MongoLib::update(self::$db . '.users', ["_id" => new MongoDB\BSON\ObjectId($uid)], ["avatar" => $fname]);
    }

    public static function changeUserName($username)
    {
        return MongoLib::update(self::$db . '.users', ["_id" => new MongoDB\BSON\ObjectId(session()->get("userId"))], ["name" => $username]);
    }

    public function createProject(RequestInterface $request)
    {
        $now = new MongoDB\BSON\UTCDateTime(time() * 1000);

        MongoLib::addRow(self::$db . '.projects', [
            "name" => $request->getPost('projectName'),
            "description" => $request->getPost('projectDescription'),
            "fullPrice" => $request->getPost('fullPrice'),
            "milestonePrice" => $request->getPost('milestonePrice'),
            "created_at" => $now,
            "updated_at" => $now,
        ]);
    }

    public static function removeTask($tid)
    {
        return MongoLib::removeFromArray(self::$db . '.projects', ["tasks" => ["id" => $tid]]);
    }

    public static function getTask(RequestInterface $request, $session)
    {
        $now = new MongoDB\BSON\UTCDateTime(time() * 1000);
        MongoLib::update(self::$db . '.projects',
            [
                "_id" => new MongoDB\BSON\ObjectId($request->getPost("pid")),
                "tasks.id" => $request->getPost("tid"),
            ],
            [
                "tasks.$.performer" => $session->get("userId")
            ]
        );
    }


}