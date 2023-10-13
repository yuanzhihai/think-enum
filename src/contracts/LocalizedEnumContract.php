<?php

namespace yuanzhihai\enum\think\contracts;
interface LocalizedEnumContract
{
    /**
     * Get the default localization key.
     *
     * @return string
     */
    public static function getLocalizationKey();
}