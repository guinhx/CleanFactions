<?php

namespace Clean\enum;

class MemberRole {
    const UNKNOWN = 0;
    const MEMBER = 1;
    const OFFICER = 2;
    const OWNER = 3;

    public static function getName(int $role) {
        switch ($role) {
            case self::MEMBER:
                return "Member";
            case self::OFFICER:
                return "Officer";
            case self::OWNER:
                return "Leader";
            case self::UNKNOWN:
            default:
                return "unknown";
        }
    }
}