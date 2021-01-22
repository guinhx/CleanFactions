<?php

namespace Clean\async;

use Clean\Factions;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class ConvertFromFactionsPro extends AsyncTask
{

	/** @var string */
	private $path;

	/**
	 * ConvertFromFactionsPro constructor.
	 * @param string $path
	 */
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
					// TODO: Load from db extension
				}
            }
        }else{
            print_r("Don't have FactionsPro database to convert.\n");
        }
    }

    public function onCompletion(Server $server)
	{
		// TODO: Add actions after complete load
	}
}