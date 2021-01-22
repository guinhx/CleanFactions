<?php

namespace Clean\view;

use Clean\FactionPlayer;
use Clean\view\icon\ButtonIcon;
use jojoe77777\FormAPI\Form;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\Player;

abstract class BaseView {

	/** @var string */
    protected $name = "";

    /** @var string */
    protected $content = "";

    /** @var array */
    protected $buttons = [];

    /** @var Form|null */
    protected $form;

	/** @var int */
	private $type;

	private function generate(): void
    {
        $this->form = new SimpleForm($this->getCallable());
        $this->form->setTitle($this->name);
        if($this->content != null) $this->form->setContent($this->content);
        foreach($this->buttons as $key => $data)
        {
            $icon = $data["image"];
            if($icon->isValid()){
                $this->form->addButton($data['name'], $icon->getType(), $icon->getPath());
            }else{
                $this->form->addButton($data['name']);
            }
        }
    }

    public function getCallable(): callable
    {
        $buttons = $this->buttons;
        return function (Player $player, $data) use(&$buttons)
        {
            if(is_numeric($data))
            {
                $buttons[$data]["callable"]($player);
            }
        };
    }

	/**
	 * @param string $name
	 */
	public function setName(string $name) {
        $this->name = $name;
    }

	/**
	 * @param int $type
	 */
	public function setType(int $type)
    {
        $this->type = $type;
    }

	/**
	 * @param $content
	 */
	public function setContent($content): void
    {
        if(is_array($content)) $content = implode("\n", $content);
        $this->content = $content;
    }

	/**
	 * @param $name
	 * @param callable $callback
	 * @param null $image
	 */
	public function addButton($name, callable $callback, $image = null): void
    {
        if(is_array($name)) $name = implode("\n", $name);
        if($image == null) $image = new ButtonIcon();
        $this->buttons[count($this->buttons)] = [
            "name" => $name,
            "callable" => $callback,
            "image" => $image
        ];
    }

	/**
	 * @param FactionPlayer $player
	 */
	public abstract function load(FactionPlayer $player);

	/**
	 * @param FactionPlayer $player
	 */
	public function send(FactionPlayer $player)
    {
        $this->load($player);
        $this->generate();
        $player->sendForm($this->form);
    }
}