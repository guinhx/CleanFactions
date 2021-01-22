<?php

namespace Clean\view;

use Clean\FactionPlayer;
use Clean\object\Faction;

class InfoFactionView extends BaseView
{

	/** @var Faction|null */
	private $faction;

	/**
	 * InfoFactionView constructor.
	 * @param Faction $faction
	 */
	public function __construct($faction = null)
	{
		$this->faction = $faction;
	}

	/**
	 * @return Faction|null
	 */
	public function getFaction(): ?Faction
	{
		return $this->faction;
	}

	public function load(FactionPlayer $player)
	{
		$faction = null;
		if (is_null($this->getFaction())) {
			if (!$player->hasFaction()) return;
			$faction = $player->getFaction();
			$this->setName("Sua facção");
		} else {
			$faction = $this->getFaction();
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
		if (is_null($this->getFaction()) && !$player->hasFaction()) {
			$player->sendMessage("§cOcorreu um erro na geração do menu.");
		} else {
			parent::send($player);
		}
	}

}