<?php

namespace Clean\object;

use Clean\enum\MemberRole;

class Member
{

	/** @var int */
	private $fid = 0;

	/** @var string */
	private $name = "";

	/** @var int */
	private $role = MemberRole::MEMBER;

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
    public function setFid(int $fid): void
    {
        $this->fid = $fid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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

}