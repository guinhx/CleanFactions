<?php

namespace Clean\command\subcommand;

use pocketmine\command\CommandSender;

abstract class BaseCommand
{

	/** @var mixed */
	protected $label;

	/** @var mixed */
	protected $name;

	/** @var mixed */
	protected $description;

	/** @var mixed */
	protected $permission;

	/** @var array */
	protected $aliases = [];

	/**
	 * BaseCommand constructor.
	 * @param $label
	 */
	public function __construct($label)
	{
		$this->label = $label;
	}

	/**
	 * @param CommandSender $sender
	 * @param array $args
	 */
	public function execute(CommandSender $sender, array $args): void
	{
		if (!$this->checkPermission($sender)) {
			$sender->sendMessage("You don't have permission to execute this command.");
		} else {
			$this->onCommand($sender, $args);
		}
	}

	/**
	 * @param CommandSender $sender
	 * @param String[] $args
     *
     * @return bool
     */
    abstract public function onCommand(CommandSender $sender, array $args) : bool;

    /**
     * @param CommandSender $target
     *
     * @return bool
     */
    public function checkPermission(CommandSender $target) : bool {
        if ($this->permission === null) {
            return true;
        } else {
            return $target->hasPermission($this->permission);
        }
    }

    /**
     * @param string $label
     *
     * @return bool
     */
    public function checkLabel(string $label) : bool{
        return strcasecmp($label, $this->label) === 0 || $this->aliases && in_array($label, $this->aliases);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission): void
    {
        $this->permission = $permission;
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @param array $aliases
     */
    public function setAliases(array $aliases): void
    {
        $this->aliases = $aliases;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

}