<?php

namespace Clean\async;

use Clean\Factions;
use Clean\provider\SQLiteProvider;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class LoadLocalStorage extends AsyncTask
{

	/** @var string */
	private $path;

	public static function init(): void
	{
		Factions::debug("Loading all factions and claims from database to local storage..");
		Server::getInstance()->getAsyncPool()->submitTask(new LoadLocalStorage(Factions::getInstance()->getDataFolder()));
	}

	public function __construct(string $path)
	{
		$this->path = $path;
	}

	public function onRun()
	{
		$provider = new SQLiteProvider($this->path);
		$result = [
			'factions' => $provider->getFactionsFromDatabase(),
			'claims' => $provider->getClaimsFromDatabase()
		];
		$this->setResult($result);
	}

	public function onCompletion(Server $server)
	{
		Factions::getInstance()->setFactions($this->getResult()['factions']);
		Factions::getInstance()->setClaims($this->getResult()['claims']);
		Factions::debug("All factions and claims has been loaded from database.");
	}
}