<?php

namespace Clean\view\icon;

class ButtonIcon {

	/** @var int */
    private $type = -1;

    /** @var string */
    private $path;

    public function __construct(int $type = -1, string $path = "")
    {
        $this->type = $type;
        $this->path = $path;
    }

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @return bool
	 */
	public function isValid(): bool
    {
        return $this->type != -1;
    }
}