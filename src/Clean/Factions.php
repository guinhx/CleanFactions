<?php

namespace Clean;

use Clean\async\LoadLocalStorage;
use Clean\command\FactionCommand;
use Clean\command\PoolCommand;
use Clean\command\subcommand\CreateSubCommand;
use Clean\event\player\CreateFactionPlayer;
use Clean\event\player\PlayerJoinEvent;
use Clean\event\view\ViewRequestEvent;
use Clean\event\view\ViewRequestFixEvent;
use Clean\object\Claim;
use Clean\object\Faction;
use Clean\provider\SQLiteProvider;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Factions extends PluginBase {
    const PREFIX = "[CleanFactions]";
    const VERSION = "1.0.0";
    /* @var Factions */
    private static $instance;
    /* @var Faction[] */
    private $factions = [];
    /* @var Claim[] */
    private $claims = [];

    /* @var SQLiteProvider */
    private $provider;

    public function onLoad()
    {
        $this->registerInstance();
        $this->saveResource("factions.db");
        $this->registerVariables();
        LoadLocalStorage::init();
    }

    public function onEnable()
    {
        $this->registerCommand();
        $this->registerEvent();
        self::debug("Loading state has finished, prepare to the war!");
        $this->getProvider()->getFactionsFromDatabase();
    }

    /**
     * @return Factions
     */
    public static function getInstance(): Factions
    {
        return self::$instance;
    }

    /**
     * @param Factions $instance
     */
    private function registerInstance(): void
    {
        self::$instance = $this;
    }

    private function registerCommand(): void {
        new FactionCommand();
        // SubCommands for FactionCommand
        PoolCommand::register(new CreateSubCommand());
    }

    private function registerEvent(): void {
        // Player Event's
        new CreateFactionPlayer();
        new PlayerJoinEvent();
        // Form View Event's
        new ViewRequestEvent();
        new ViewRequestFixEvent();
    }

    private function registerVariables() : void {
        $this->provider = new SQLiteProvider($this->getDataFolder());
    }

    /**
     * @return SQLiteProvider
     */
    public function getProvider(): SQLiteProvider
    {
        return $this->provider;
    }

    /**
     * @return Faction[]
     */
    public function getFactions(): array
    {
        return $this->factions;
    }

    /**
     * @param Faction[] $factions
     */
    public function setFactions(array $factions): void
    {
        $this->factions = $factions;
    }

    /**
     * @return Claim[]
     */
    public function getClaims(): array
    {
        return $this->claims;
    }

    /**
     * @param Claim[] $claims
     */
    public function setClaims(array $claims): void
    {
        $this->claims = $claims;
    }

    public function getFactionsManager() {
        return new FactionsManager();
    }

    /**
     * @param int $id
     * @return Faction|null
     */
    public function getFactionById(int $id) {
        return array_key_exists($id, $this->factions) ? $this->factions[$id] : null;
    }

    /**
     * @param $player
     * @return Faction|null
     */
    public function getFactionByPlayer($player) {
        if($player instanceof Player) {
            $player = $player->getName();
        }
        foreach ($this->factions as $faction) {
            if($faction->isOwner($player) || array_key_exists($player, $faction->getMembers())){
                return $faction;
            }
        }
        return null;
    }

    public function getFactionNameByPlayer($player) {
        if($player instanceof Player) {
            $player = $player->getName();
        }
        $faction = $this->getFactionByPlayer($player);
        return !is_null($faction) ? $faction->getName() : null;
    }

    public static function debug(string $message, bool $prefix = true) {
        $message = $prefix ? self::PREFIX . " " . $message : $message;
        Server::getInstance()->getLogger()->notice($message);
    }

}