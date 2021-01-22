<?php

namespace Clean\object;

use Clean\enum\MemberRole;

class Faction
{

	/** @var int */
	private $id = 0;

	/** @var mixed */
	private $abbrev;

	/** @var string */
	private $name = "";

	/** @var string */
	private $description = "";

	/** @var string */
	private $owner = "";

	/** @var Member[] */
	private $members = [];

	/** @var int */
	private $memberLimit = 10;

	/** @var int[] */
	private $claimIds = [];

	/** @var int */
	private $power = 0;

	/** @var int */
	private $powerLimit = 50;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAbbrev()
    {
        return $this->abbrev;
    }

    /**
     * @param mixed $abbrev
     */
    public function setAbbrev($abbrev): void
    {
        $this->abbrev = $abbrev;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
	}

	/**
	 * @param string $owner
	 * @return bool
	 * */
	public function isOwner(string $owner): bool
	{
		return strtolower($this->owner) == strtolower($owner);
	}

	/**
	 * @param string $name
	 * @param int $role
	 */
	public function insertMember(string $name, int $role = MemberRole::MEMBER)
	{
		$member = new Member();
		$member->setFid($this->id);
		$member->setName($name);
		$member->setRole($role);
		$this->members[strtolower($name)] = $member;
	}

	/**
	 * @param string $name
	 */
	public function removeMember(string $name)
	{
		unset($this->members[strtolower($name)]);
	}

	/**
	 * @param string $name
	 * @return Member|null
	 */
	public function getMember(string $name)
	{
		return array_key_exists(strtolower($name), $this->members) ? $this->members[strtolower($name)] : null;
	}

    /**
     * @return Member[]
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array $members
     */
    public function setMembers(array $members): void
    {
        $this->members = $members;
    }

    /**
     * @return int
     */
    public function getMemberLimit(): int
    {
        return $this->memberLimit;
    }

    /**
     * @param int $memberLimit
     */
    public function setMemberLimit(int $memberLimit): void
    {
        $this->memberLimit = $memberLimit;
    }

    /**
     * @return array
     */
    public function getClaimIds(): array
    {
        return $this->claimIds;
    }

    /**
     * @param array $claimIds
     */
    public function setClaimIds(array $claimIds): void
    {
        $this->claimIds = $claimIds;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    /**
     * @return int
     */
    public function getPowerLimit(): int
    {
        return $this->powerLimit;
    }

    /**
     * @param int $powerLimit
     */
    public function setPowerLimit(int $powerLimit): void
    {
        $this->powerLimit = $powerLimit;
    }

}