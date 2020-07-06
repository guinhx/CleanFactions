<?php

namespace Clean\async;

use Clean\Factions;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class ConvertFromFactionsPro extends AsyncTask {
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function onRun()
    {
        @mkdir($this->path);
        $scan = @scandir($this->path);
        unset($scan[0], $scan[1]);
        $scan = array_values($scan);
        if(!is_null($scan) && count($scan) > 0) {
            foreach ($scan as $file) {
                $pathInfo = @pathInfo($file);
                if($pathInfo['extension'] == 'db') {

                }
            }
        }else{
            print_r("Don't have FactionsPro database to convert.\n");
        }
    }

    public function onCompletion(Server $server)
    {
    }
}