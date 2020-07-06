<?php

namespace Clean\command\subcommand;

use Clean\FactionPlayer;
use Clean\view\CreateFactionView;
use pocketmine\command\CommandSender;

class CreateSubCommand extends BaseCommand {
    public function __construct()
    {
        parent::__construct('create');
    }

    public function onCommand(CommandSender $sender, array $args): bool
    {
        if($sender instanceof FactionPlayer) {
            $view = new CreateFactionView();
            $view->send($sender);
        }
        return true;
    }
}