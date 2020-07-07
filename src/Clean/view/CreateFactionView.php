<?php

namespace Clean\view;

use Clean\async\LoadPlayerData;
use Clean\enum\MemberRole;
use Clean\FactionPlayer;
use Clean\Factions;
use Clean\object\Faction;
use Clean\object\Member;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\Player;
use pocketmine\Server;

class CreateFactionView {
    /* @var CustomForm */
    private $form;

    public function getCallback() {
        return function (Player $player, $data) {
            if(is_array($data)) {
                if(empty($data[1]) || empty($data[2])) {
                    $player->sendMessage("§cOps! Parece que você esqueceu de preencher algum campo.");
                }else{
                	$result = Factions::getInstance()->createFaction($data[1], $data[2], $player->getName(), $data[3]);
                	if($result) {
						$player->sendMessage("§aVocê fundou a facção [" . $data[2] . "] " . $data[1] . " comece agora mesmo a recrutar membros.");
					}else{
                		$player->sendMessage("§cAlgo de errado aconteceu na hora da criação da facção.");
					}
                }
            }
        };
    }

    public function load(FactionPlayer $player) {
        $this->form = new CustomForm($this->getCallback());
        $this->form->setTitle("Fundar facção");
        $this->form->addLabel("§eUma facção é uma grande responsabilidade, recrute jogadores e prepare-se para o inesperado!\n");
        $this->form->addInput("§6*Escolha um nome:", "e.g. Vikings");
        $this->form->addInput("§6*Abrev. do nome:", "e.g. VKG");
        $this->form->addInput("§6Escolha uma descrição:");
    }

    public function send(FactionPlayer $player){
        if(!$player->hasFaction()) {
            $this->load($player);
            $player->sendForm($this->form);
        }else{
            $player->sendMessage("§cVocê já está em uma facção, saia ou delete sua atual para continuar.");
        }
    }
}