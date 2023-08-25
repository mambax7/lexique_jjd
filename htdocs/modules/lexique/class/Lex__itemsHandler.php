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

use XoopsModules\Lexique;


/**
 * Class Object Handler Lex__items
 */
class Lex__itemsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__items', Lex__items::class, 'item_id', 'item_name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param null fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null)
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Lex__items in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__items($crCountLex__items, $start = 0, $limit = 0, $sort = 'item_id', $order = 'ASC')
    {
        if (!$crCountLex__items) $crCountLex__items = new \CriteriaCompo();
        $crCountLex__items = $this->getLex__itemsCriteria($crCountLex__items, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__items);
    }

    /**
     * Get All Lex__items in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__items($crAllLex__items, $start = 0, $limit = 0, $sort = 'item_id', $order = 'ASC')
    {
        if (!$crAllLex__items) $crAllLex__items = new \CriteriaCompo();
        $crAllLex__items = $this->getLex__itemsCriteria($crAllLex__items, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__items);
    }

    /**
     * Get Criteria Lex__items
     * @param        $crLex__items
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__itemsCriteria($crLex__items, $start, $limit, $sort, $order)
    {
        $crLex__items->setStart($start);
        $crLex__items->setLimit($limit);
        $crLex__items->setSort($sort);
        $crLex__items->setOrder($order);
        return $crLex__items;
    }
}
