<?php


namespace Clean\view;


use Clean\FactionPlayer;
use Clean\object\Faction;

class InfoFactionView extends BaseView
{

	/** @var Faction */
	private $faction;

	/**
	 * InfoFactionView constructor.
	 * @param Faction $faction
	 */
	public function __construct($faction = null)
	{
		$this->faction = $faction;
	}


	public function load(FactionPlayer $player)
	{
		$faction = null;
		if (is_null($this->faction)) {
			if (!$player->hasFaction()) return;
			$faction = $player->getFaction();
			$this->setName("Sua facção");
		} else {
			$faction = $this->faction;
			$this->setName("Informações da facção: {$faction->getAbbrev()}");
		}
		$this->setContent("Nome: {$faction->getName()}");
		$this->addButton("Voltar", function (FactionPlayer $player) {
			$mainView = new MainView();
			$mainView->send($player);
		});
	}

	public function send(FactionPlayer $player)
	{
		if (is_null($this->faction) && !$player->hasFaction()) {
			$player->sendMessage("§cOcorreu um erro na geração do menu.");
		} else {
			parent::send($player);
		}
	}

}