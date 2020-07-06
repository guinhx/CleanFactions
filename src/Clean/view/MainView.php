<?php

namespace Clean\view;

use Clean\enum\MemberRole;
use Clean\FactionPlayer;

class MainView extends BaseView {

    public function load(FactionPlayer $player)
    {
        $this->setName("Factions: Inicio");
        $this->setContent("§eOpções disponiveis: ");
        if(!$player->hasFaction()) {
            $this->addButton([
                "Fundar uma facção",
                "(Mais detalhes)"
            ], function (FactionPlayer $player) {

            });
            $this->addButton([
                "Entrar em uma facção",
                "(Mais detalhes)"
            ], function (FactionPlayer $player) {

            });
        }else{
            switch ($player->getRole()) {
                case MemberRole::OWNER:
                    $this->addButton([
                        "Gerenciar facção",
                        "(Visualizar opções)"
                    ], function (FactionPlayer $player) {

                    });
                    $this->addButton([
                        "Gerenciar membros",
                        "(Visualizar opções)"
                    ], function (FactionPlayer $player) {

                    });
                    $this->addButton([
                        "Deletar sua facção"
                    ], function (FactionPlayer $player) {

                    });
                    break;
                case MemberRole::OFFICER:
                case MemberRole::MEMBER:
                    $this->addButton([
                        "Abandonar facção"
                    ], function (FactionPlayer $player) {

                    });
                    break;
            }
        }
        $this->addButton([
            "Visualizar uma facção",
            "(Mais detalhes)"
        ], function (FactionPlayer $player) {

        });
        $this->addButton([
            "Ranking de facções",
            "(Mais detalhes)"
        ], function (FactionPlayer $player) {

        });
    }
}