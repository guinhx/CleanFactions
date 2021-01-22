<?php

namespace Clean;

use Clean\enum\MemberRole;
use pocketmine\Player;

class FactionPlayer extends Player {

	/** @var int */
    private $fid = -1;

    /** @var int */
    private $role = MemberRole::UNKNOWN;

    public function resetData() {
        $this->fid = -1;
        $this->role = MemberRole::UNKNOWN;
    }

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
        return is_numeric($this->fid) && $this->fid != -1;
    }

    /**
     * @return object\Faction|null
     */
    public function getFaction() {
        return Factions::getInstance()->getFactionByPlayer($this);
    }
}