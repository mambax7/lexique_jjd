<?php

declare(strict_types=1);

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
 * CommentsUpdate
 *
 * @param mixed  $itemId
 * @param mixed  $itemNumb
 * @return bool
 */
function lexiqueCommentsUpdate($itemId, $itemNumb)
{
    // Get instance of module
    $helper = \XoopsModules\Lexique\Helper::getInstance();
    $lex__valuesHandler = $helper->getHandler('Lex__values');
    $valId = (int)$itemId;
    $lex__valuesObj = $lex__valuesHandler->get($valId);
    $lex__valuesObj->setVar('val_comments', (int)$itemNumb);
    if ($lex__valuesHandler->insert($lex__valuesObj)) {
        return true;
    }
    return false;
}

/**
 * CommentsApprove
 *
 * @param mixed $comment
 * @return bool
 */
function lexiqueCommentsApprove($comment)
{
    // Notification event
    // Get instance of module
    $helper = \XoopsModules\Lexique\Helper::getInstance();
    $lex__valuesHandler = $helper->getHandler('Lex__values');
    $valId = $comment->getVar('com_itemid');
    $lex__valuesObj = $lex__valuesHandler->get($valId);
    $ = $lex__valuesObj->getVar('');

    $tags = [];
    $tags['ITEM_NAME'] = $;
    $tags['ITEM_URL']  = \XOOPS_URL . '/modules/lexique/lex__values.php?op=show&val_id=' . $valId;
    $notificationHandler = \xoops_getHandler('notification');
    // Event modify notification
    $notificationHandler->triggerEvent('global', 0, 'global_comment', $tags);
    $notificationHandler->triggerEvent('lex__values', $valId, 'lex__value_comment', $tags);
    return true;

}


