<?php

namespace Clean;

use Clean\enum\MemberRole;
use pocketmine\Player;

class FactionPlayer extends Player {
    private $fid = "";
    private $role = MemberRole::UNKNOWN;

    /**
     * @return int
     */
    public function getFid(): int
    {
        return $this->fid;
    }

    /**
     * @param int $fid
     */
    public function setFid($fid): void
    {
        $this->fid = $fid;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }


    /**
     * @return bool
     */
    public function hasFaction(): bool {
        return is_numeric($this->fid) && !is_null($this->fid);
    }

    /**
     * @return object\Faction|null
     */
    public function getFaction() {
        return Factions::getInstance()->getFactionByPlayer($this);
    }
}