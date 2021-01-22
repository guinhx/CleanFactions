<?php

namespace Clean\object;

class Claim {

	/** @var int */
    private $fid;

    /** @var string */
    private $owner;

    /** @var int */
    private $x;

    /** @var int */
    private $z;

    /** @var string */
    private $world;

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
	 * @return int
	 */
	public function getX(): int
	{
		return $this->x;
	}

	/**
	 * @param int $x
	 */
	public function setX(int $x): void
	{
		$this->x = $x;
	}

	/**
	 * @return int
	 */
	public function getZ(): int
	{
		return $this->z;
	}

	/**
	 * @param int $z
	 */
	public function setZ(int $z): void
	{
		$this->z = $z;
	}

	/**
	 * @return string
	 */
	public function getWorld(): string
	{
		return $this->world;
	}

	/**
	 * @param string $world
	 */
	public function setWorld(string $world): void
	{
		$this->world = $world;
	}

}