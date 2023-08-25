<?php

declare(strict_types=1);


namespace XoopsModules\Lexique;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Lexique module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:jjdelalandre@orange.fr - Website:https://oritheque.fr
 */

/**
 * Interface  Constants
 */
interface Constants
{
    // Constants for tables
    public const TABLE_LEX__ITEMS = 0;
    public const TABLE_LEX__LABELS = 1;
    public const TABLE_LEX__LISTS = 2;
    public const TABLE_LEX__PARAMS = 3;
    public const TABLE_LEX__PROPERTYS = 4;
    public const TABLE_LEX__TERMS = 5;
    public const TABLE_LEX__VALUES = 6;

    // Constants for status
    public const STATUS_NONE      = 0;
    public const STATUS_OFFLINE   = 1;
    public const STATUS_SUBMITTED = 2;
    public const STATUS_APPROVED  = 3;
    public const STATUS_BROKEN    = 4;

    // Constants for permissions
    public const PERM_GLOBAL_NONE    = 0;
    public const PERM_GLOBAL_VIEW    = 1;
    public const PERM_GLOBAL_SUBMIT  = 2;
    public const PERM_GLOBAL_APPROVE = 3;

}
