<?php

namespace Clean\command\subcommand;

use pocketmine\command\CommandSender;

class CreateSubCommand extends BaseCommand {
    public function __construct()
    {
        parent::__construct('create');
    }

    public function onCommand(CommandSender $sender, array $args): bool
    {
        return true;
    }
}