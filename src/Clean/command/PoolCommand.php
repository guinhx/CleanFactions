<?php

namespace Clean\command;

use Clean\command\subcommand\BaseCommand;
use pocketmine\command\CommandSender;

class PoolCommand
{

	/** @var BaseCommand[] */
	private static $subCommands = [];

	/**
	 * @param BaseCommand $subCommand
	 * @return bool
	 */
	public static function register(BaseCommand $subCommand): bool
	{
		if (!isset(self::$subCommands[$subCommand->getLabel()])) {
			self::$subCommands[$subCommand->getLabel()] = $subCommand;
			return true;
		}
		return false;
	}

	/**
	 * @param array $subList
	 * @return bool
	 */
	public static function registerAll(array $subList): bool
	{
		foreach ($subList as $subCommand) {
			if (!self::register($subCommand)) {
				new \Exception("Already exists {$subCommand} subcommand registered.");
			}
		}
		return true;
	}

	/**
	 * @param string $label
	 * @return bool
	 */
	public static function remove(string $label): bool
	{
		if (isset(self::$subCommands[$label])) {
			unset(self::$subCommands[$label]);
			return true;
		}
		return false;
	}

	/**
	 * @return array
	 */
    public static function getSubCommands(): array
    {
        return self::$subCommands;
	}

	/**
	 * @param array $subCommands
	 */
	public static function setSubCommands(array $subCommands): void
	{
		self::$subCommands = $subCommands;
	}

	/**
	 * @param CommandSender $sender
	 * @param array $args
	 * @return bool
	 */
	public function handle(CommandSender $sender, array $args): bool
	{
		if (!empty($args[0])) {
			$label = array_shift($args);
			foreach (self::getSubCommands() as $key => $value) {
				if ($value->checkLabel($label)) {
					$value->execute($sender, $args);
					return true;
				}
			}
		}
		return false;
    }
}