<?php

namespace Clean\command;

use Clean\command\subcommand\BaseCommand;
use pocketmine\command\CommandSender;

class PoolCommand {
    private static $subCommands = [];
    public static function register(BaseCommand $subcommand): bool {
        if(!isset(self::$subCommands[$subcommand->getLabel()])) {
            self::$subCommands[$subcommand->getLabel()] = $subcommand;
            return true;
        }
        return false;
    }

    public static function registerAll(array $subList): bool {
        foreach ($subList as $subCommand) {
            if(!self::register($subCommand)) {
                new \Exception("Already exists {$subCommand} subcommand registered.");
            }
        }
        return true;
    }

    public static function remove(string $label): bool {
        if(isset(self::$subCommands[$label])) {
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

    public function handle(CommandSender $sender, array $args) {
        if (!empty($args[0])) {
            $label = array_shift($args);
            foreach (self::getSubCommands() as $key => $value) {
                if ($value->checkLabel($label)) {
                    $value->execute($sender, $args);
                    return true;
                }
            }
        }
    }
}