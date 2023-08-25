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
 * builddatatype module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      lexique
 * @since        1.0.0
 * @min_xoops    2.5.10
 * @author       TDM XOOPS - Email:info@email.com - Website:https://xoops.org
 */

use XoopsModules\Lexique;


/**
 * Class Object Handler Lex__datatypes
 */
class Lex__datatypesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__datatypes', Lex__datatypes::class, 'dtype_id', 'dtype_name');
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
     * Get Count Lex__datatypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__datatypes($start = 0, $limit = 0, $sort = 'dtype_id ASC, dtype_name', $order = 'ASC')
    {
        $crCountLex__datatypes = new \CriteriaCompo();
        $crCountLex__datatypes = $this->getLex__datatypesCriteria($crCountLex__datatypes, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__datatypes);
    }

    /**
     * Get All Lex__datatypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__datatypes($start = 0, $limit = 0, $sort = 'dtype_id ASC, dtype_name', $order = 'ASC')
    {
        $crAllLex__datatypes = new \CriteriaCompo();
        $crAllLex__datatypes = $this->getLex__datatypesCriteria($crAllLex__datatypes, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__datatypes);
    }

    /**
     * Get Criteria Lex__datatypes
     * @param        $crLex__datatypes
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__datatypesCriteria($crLex__datatypes, $start, $limit, $sort, $order)
    {
        $crLex__datatypes->setStart($start);
        $crLex__datatypes->setLimit($limit);
        $crLex__datatypes->setSort($sort);
        $crLex__datatypes->setOrder($order);
        return $crLex__datatypes;
    }
}
