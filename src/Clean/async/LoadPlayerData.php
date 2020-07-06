<?php

namespace Clean\async;

use Clean\enum\MemberRole;
use Clean\FactionPlayer;
use Clean\Factions;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class LoadPlayerData extends AsyncTask {
    private $nickname;
    public function __construct(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function onRun()
    {
    }

    public function onCompletion(Server $server)
    {
        $player = $server->getPlayerExact($this->nickname);
        if(!is_null($player) && $player instanceof FactionPlayer) {
            $faction = Factions::getInstance()->getFactionByPlayer($player);
            if($faction != null) {
                $player->setFid($faction->getId());
                if($faction->isOwner($player->getName())) {
                    $player->setRole(MemberRole::OWNER);
                }else{
                    $player->setRole($faction->getMember($player->getName())->getRole());
                }
            }
        }
    }
}