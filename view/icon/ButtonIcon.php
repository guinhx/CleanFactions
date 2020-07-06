<?php

namespace Clean\view\icon;

class ButtonIcon {
    private $type = -1;
    private $path;
    public function __construct(int $type = -1, string $path = "")
    {
        $this->type = $type;
        $this->path = $path;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function isValid()
    {
        return $this->type != -1;
    }
}