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
 * Class Object Handler Lex__labels
 */
class Lex__labelsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__labels', Lex__labels::class, 'lab_id', '');
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
     * Get Count Lex__labels in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__labels($start = 0, $limit = 0, $sort = 'lab_id', $order = 'ASC')
    {
        $crCountLex__labels = new \CriteriaCompo();
        $crCountLex__labels = $this->getLex__labelsCriteria($crCountLex__labels, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__labels);
    }

    /**
     * Get All Lex__labels in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__labels($start = 0, $limit = 0, $sort = 'lab_id', $order = 'ASC')
    {
        $crAllLex__labels = new \CriteriaCompo();
        $crAllLex__labels = $this->getLex__labelsCriteria($crAllLex__labels, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__labels);
    }

    /**
     * Get Criteria Lex__labels
     * @param        $crLex__labels
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__labelsCriteria($crLex__labels, $start, $limit, $sort, $order)
    {
        $crLex__labels->setStart($start);
        $crLex__labels->setLimit($limit);
        $crLex__labels->setSort($sort);
        $crLex__labels->setOrder($order);
        return $crLex__labels;
    }
}
