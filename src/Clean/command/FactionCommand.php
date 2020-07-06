<?php

namespace Clean\command;

use Clean\FactionPlayer;
use Clean\Factions;
use Clean\view\MainView;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class FactionCommand extends Command {
    private $plugin;
    public function __construct()
    {
        parent::__construct("factions", "§rManage you faction.");
        $this->setAliases(['f']);
        $this->plugin = Factions::getInstance();
        $this->plugin->getServer()->getCommandMap()->register("factions", $this);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof FactionPlayer) {
            if(count($args) > 0) {
                $pool = new PoolCommand();
                $pool->handle($sender, $args);
            }else{
                $view = new MainView();
                $view->send($sender);
            }
        }
    }
}