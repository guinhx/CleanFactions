<?php

namespace Clean\view;

use Clean\enum\MemberRole;
use Clean\FactionPlayer;
use Clean\Factions;

class MainView extends BaseView
{

	public function load(FactionPlayer $player)
	{
		$this->setName("Factions: Inicio");
		$this->setContent("§eOpções disponiveis: ");
		if (!$player->hasFaction()) {
			$this->addButton([
				"Fundar uma facção",
				"(Mais detalhes)"
			], function (FactionPlayer $player) {
				$view = new CreateFactionView();
				$view->send($player);
			});
			$this->addButton([
				"Entrar em uma facção",
				"(Mais detalhes)"
			], function (FactionPlayer $player) {

			});
		} else {
			$this->addButton([
				"Informações da facção",
				"(Mais detalhes)"
			], function (FactionPlayer $player) {
				$infoView = new InfoFactionView();
				$infoView->send($player);
			});
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
						if (Factions::getInstance()->removeFaction($player->getFaction())) {
							$player->sendMessage("§aSua facção foi deletada com sucesso.");
						} else {
							$player->sendMessage("§cOcorreu um erro ao deletar, tente novamente mais tarde.");
						}
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