<?php

namespace Clean\event\view;

use Clean\Factions;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

class ViewRequestEvent implements Listener {
    /* @var Factions */
    public $plugin;
    private $forms = [];
    public function __construct() {
        $this->plugin = Factions::getInstance();
        $this->plugin->getServer()->getPluginManager()->registerEvents($this, $this->plugin);
        new ViewRequestFixEvent();
    }

    // form sent to player
    public function onDataPacketSend(DataPacketSendEvent $event)
    {
        $pk = $event->getPacket();
        if($pk instanceof ModalFormRequestPacket) {
            $player = $event->getPlayer();
            if(!array_key_exists($player->getXuid(), $this->forms)){
                $this->forms[$player->getXuid()] = 1;
            }else{
                $event->setCancelled(true);
            }
        }
    }
    // server receive response of form when has make submit or closed of same.
    public function onPacketReceive(DataPacketReceiveEvent $event)
    {
        $pk = $event->getPacket();
        $player = $event->getPlayer();
        if($pk instanceof ModalFormResponsePacket) {
            if(array_key_exists($player->getXuid(), $this->forms)){
                unset($this->forms[$player->getXuid()]);
            }
        }
    }

    public function onQuit(\pocketmine\event\player\PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        if(array_key_exists($player->getXuid(), $this->forms)) {
            unset($this->forms[$player->getXuid()]);
        }
    }
}