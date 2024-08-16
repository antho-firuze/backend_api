<?php

namespace process;

use Workerman\Crontab\Crontab;
use support\Db;

class Task
{
    public function onWorkerStart()
    {
        // // Run every second
        // new Crontab('*/1 * * * * *', function () {
        //     echo date('Y-m-d H:i:s') . "\n";
        // });

        // Run every 15 seconds
        new Crontab('*/15 * * * * *', function () {
            $this->update_broadcast_state();
        });

        // // Run every minute
        // new Crontab('0 */1 * * * *', function () {
        //     echo date('Y-m-d H:i:s') . "\n";
        // });

        // Run every 5 minutes
        new Crontab('0 */5 * * * *', function () {
            $this->clean_broadcast_garbage();
        });

        // // Run on the first second of every minute
        // new Crontab('1 * * * * *', function () {
        //     echo date('Y-m-d H:i:s') . "\n";
        // });

        // Run at 23:00pm every day. Note that the second field is omitted here
        new Crontab('0 23 * * *', function () {
            $this->clean_location_garbage();
        });
    }

    private function update_broadcast_state()
    {
        // echo date('Y-m-d H:i:s') . " => Cleaning Broadcast every 15 second\n";
        $obsolete = date('Y-m-d H:i:s', strtotime('-15 second'));
        Db::table('presenter')->where('heartbeat', '<', $obsolete)->update(['state' => 'inactive']);
        Db::table('audience')->where('heartbeat', '<', $obsolete)->update(['state' => 'inactive']);
    }

    private function clean_broadcast_garbage()
    {
        // echo date('Y-m-d H:i:s') . " => Cleaning Broadcast every 5 minutes\n";
        $obsolete = date('Y-m-d H:i:s', strtotime('-5 minute'));
        Db::table('presenter')->where('heartbeat', '<', $obsolete)->delete();
        Db::table('audience')->where('heartbeat', '<', $obsolete)->delete();
    }

    private function clean_location_garbage()
    {
        // echo date('Y-m-d H:i:s') . " => Cleaning Location every 1 day at 23:00pm\n";
        $obsolete = date('Y-m-d H:i:s', strtotime('-1 day'));
        Db::table('log_location')->where('time', '<', $obsolete)->delete();
        Db::table('live_location')->where('heartbeat', '<', $obsolete)->delete();
    }
}
