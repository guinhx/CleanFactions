<?php

namespace Clean\view;

use Clean\FactionPlayer;
use Clean\view\icon\ButtonIcon;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\Player;

abstract class BaseView {
    protected $name = "";
    protected $content = "";
    protected $buttons = [];
    protected $form;

    private function generate()
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

    public function getCallable()
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
    public function setName(string $name) {
        $this->name = $name;
    }
    public function setType(int $type)
    {
        $this->type = $type;
    }
    public function setContent($content)
    {
        if(is_array($content)) $content = implode("\n", $content);
        $this->content = $content;
    }
    public function addButton($name, callable $callback, $image = null)
    {
        if(is_array($name)) $name = implode("\n", $name);
        if($image == null) $image = new ButtonIcon();
        $this->buttons[count($this->buttons)] = [
            "name" => $name,
            "callable" => $callback,
            "image" => $image
        ];
    }

    public abstract function load(FactionPlayer $player);

    public function send(FactionPlayer $player)
    {
        $this->load($player);
        $this->generate();
        $player->sendForm($this->form);
    }
}