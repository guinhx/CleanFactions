<?php

namespace Clean\command;

use Clean\FactionPlayer;
use Clean\Factions;
use Clean\view\MainView;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class FactionCommand extends Command
{

	/** @var Factions */
	private $plugin;

	public function __construct()
	{
		parent::__construct("factions", "§rManage you faction.");
		$this->setAliases(['f']);
		$this->plugin = Factions::getInstance();
		$this->plugin->getServer()->getCommandMap()->register("factions", $this);
	}

	/**
	 * @return Factions
	 */
	public function getPlugin(): Factions
	{
		return $this->plugin;
	}

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param array $args
	 * @return mixed|void
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if ($sender instanceof FactionPlayer) {
			if (count($args) > 0) {
				$pool = new PoolCommand();
				$pool->handle($sender, $args);
			} else {
				$view = new MainView();
				$view->send($sender);
			}
		}
    }
}