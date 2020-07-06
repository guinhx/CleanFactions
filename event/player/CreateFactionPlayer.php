<?php

namespace Clean\event\player;

use Clean\FactionPlayer;
use Clean\Factions;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;

class CreateFactionPlayer implements Listener {
    private $plugin;
    public function __construct()
    {
        $this->plugin = Factions::getInstance();
        $this->plugin->getServer()->getPluginManager()->registerEvents($this, $this->plugin);
    }

    public function onCreate(PlayerCreationEvent $event) {
        $event->setPlayerClass(FactionPlayer::class);
    }
}