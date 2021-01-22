<?php

namespace Clean\provider;

use Clean\async\ConvertFromFactionsPro;
use Clean\object\Claim;
use Clean\object\Faction;
use Clean\object\Member;
use pocketmine\Server;
use SQLite3;

class SQLiteProvider {

	/** @var SQLite3 */
    private $database;

    /** @var string */
    private $path;

	/**
	 * SQLiteProvider constructor.
	 * @param string $path
	 */
	public function __construct(string $path)
    {
        $this->path = $path;
        $this->database = new SQLite3($path . "factions.db");
    }

    public function convertFromFactionsPro() {
        Server::getInstance()->getAsyncPool()->submitTask(new ConvertFromFactionsPro($this->path . "convert/"));
    }

    public function setFactionsFromLocal() {
		// TODO: Set all factions from local storage
    }

	/**
	 * @return Faction[]
	 */
	public function getFactionsFromDatabase(): array
	{
        $factions = [];
        $res = $this->database->query("SELECT * FROM faction");
        while ($data = $res->fetchArray(SQLITE3_ASSOC)) {
            $faction = new Faction();
            $faction->setId($data['fid']);
            $faction->setAbbrev($data['abbrev']);
            $faction->setName($data['name']);
            $faction->setDescription($data['desc']);
            $faction->setOwner($data['owner']);
            $faction->setPower($data['power']);
            $faction->setPowerLimit($data['powermax']);
            $faction->setMemberLimit($data['limit']);
            $members = [];
            $_res = $this->database->query("SELECT * FROM member WHERE fid ='".$faction->getId()."'");
            while ($mData = $_res->fetchArray(SQLITE3_ASSOC)) {
                $member = new Member();
                $member->setFid($mData['fid']);
                $member->setName($mData['name']);
                $member->setRole($mData['role']);
                $members[strtolower($member->getName())] = $member;
            }
            $faction->setMembers($members);
            $factions[$faction->getId()] = $faction;
        }
        return $factions;
    }

    public function setClaimsFromLocal(): void
	{
		// TODO: Set claims from local storage
    }

	/**
	 * @return Claim[]
	 */
	public function getClaimsFromDatabase(): array
	{
        $claims = [];
        $res = $this->database->query("SELECT * FROM claim");
        while ($data = $res->fetchArray(SQLITE3_ASSOC)) {
            $claim = new Claim();
            $claim->setFid($data['fid']);
            $claim->setOwner($data['owner']);
            $claim->setX($data['x']);
            $claim->setZ($data['z']);
            $claim->setWorld($data['world']);
            $claims[$data['x'].":".$data['z']] = $claim;
        }
        return $claims;
    }
}