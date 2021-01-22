<?php

namespace Clean\event\player;

use Clean\async\LoadPlayerData;
use Clean\Factions;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\event\player\PlayerJoinEvent as JoinEvent;

class PlayerJoinEvent implements Listener
{

	private $plugin;

	public function __construct()
	{
		$this->plugin = Factions::getInstance();
		$this->plugin->getServer()->getPluginManager()->registerEvents($this, $this->plugin);
	}

	public function onJoin(JoinEvent $event)
	{
		Server::getInstance()->getAsyncPool()->submitTask(new LoadPlayerData($event->getPlayer()->getName()));
	}

}