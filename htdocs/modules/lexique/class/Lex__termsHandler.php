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
 * Class Object Handler Lex__terms
 */
//class Lex__termsHandler extends \XoopsPersistableObjectHandler
class Lex__termsHandler extends Lex__adoHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'lexique_lex__terms', Lex__terms::class, 'term_id', '');
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
     * Get Count Lex__terms in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountLex__terms($start = 0, $limit = 0, $sort = 'term_id', $order = 'ASC')
    {
        $crCountLex__terms = new \CriteriaCompo();
        $crCountLex__terms = $this->getLex__termsCriteria($crCountLex__terms, $start, $limit, $sort, $order);
        return $this->getCount($crCountLex__terms);
    }

    /**
     * Get All Lex__terms in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllLex__terms($start = 0, $limit = 0, $sort = 'term_id', $order = 'ASC')
    {
        $crAllLex__terms = new \CriteriaCompo();
        $crAllLex__terms = $this->getLex__termsCriteria($crAllLex__terms, $start, $limit, $sort, $order);
        return $this->getAll($crAllLex__terms);
    }

    /**
     * Get Criteria Lex__terms
     * @param        $crLex__terms
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getLex__termsCriteria($crLex__terms, $start, $limit, $sort, $order)
    {
        $crLex__terms->setStart($start);
        $crLex__terms->setLimit($limit);
        $crLex__terms->setSort($sort);
        $crLex__terms->setOrder($order);
        return $crLex__terms;
    }
}
