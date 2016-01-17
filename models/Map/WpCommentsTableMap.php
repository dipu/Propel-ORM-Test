<?php

namespace Map;

use \WpComments;
use \WpCommentsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'wp_comments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WpCommentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WpCommentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'wordpress';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wp_comments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WpComments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WpComments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the comment_ID field
     */
    const COL_COMMENT_ID = 'wp_comments.comment_ID';

    /**
     * the column name for the comment_post_ID field
     */
    const COL_COMMENT_POST_ID = 'wp_comments.comment_post_ID';

    /**
     * the column name for the comment_author field
     */
    const COL_COMMENT_AUTHOR = 'wp_comments.comment_author';

    /**
     * the column name for the comment_author_email field
     */
    const COL_COMMENT_AUTHOR_EMAIL = 'wp_comments.comment_author_email';

    /**
     * the column name for the comment_author_url field
     */
    const COL_COMMENT_AUTHOR_URL = 'wp_comments.comment_author_url';

    /**
     * the column name for the comment_author_IP field
     */
    const COL_COMMENT_AUTHOR_IP = 'wp_comments.comment_author_IP';

    /**
     * the column name for the comment_date field
     */
    const COL_COMMENT_DATE = 'wp_comments.comment_date';

    /**
     * the column name for the comment_date_gmt field
     */
    const COL_COMMENT_DATE_GMT = 'wp_comments.comment_date_gmt';

    /**
     * the column name for the comment_content field
     */
    const COL_COMMENT_CONTENT = 'wp_comments.comment_content';

    /**
     * the column name for the comment_karma field
     */
    const COL_COMMENT_KARMA = 'wp_comments.comment_karma';

    /**
     * the column name for the comment_approved field
     */
    const COL_COMMENT_APPROVED = 'wp_comments.comment_approved';

    /**
     * the column name for the comment_agent field
     */
    const COL_COMMENT_AGENT = 'wp_comments.comment_agent';

    /**
     * the column name for the comment_type field
     */
    const COL_COMMENT_TYPE = 'wp_comments.comment_type';

    /**
     * the column name for the comment_parent field
     */
    const COL_COMMENT_PARENT = 'wp_comments.comment_parent';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'wp_comments.user_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('CommentId', 'CommentPostId', 'CommentAuthor', 'CommentAuthorEmail', 'CommentAuthorUrl', 'CommentAuthorIp', 'CommentDate', 'CommentDateGmt', 'CommentContent', 'CommentKarma', 'CommentApproved', 'CommentAgent', 'CommentType', 'CommentParent', 'UserId', ),
        self::TYPE_CAMELNAME     => array('commentId', 'commentPostId', 'commentAuthor', 'commentAuthorEmail', 'commentAuthorUrl', 'commentAuthorIp', 'commentDate', 'commentDateGmt', 'commentContent', 'commentKarma', 'commentApproved', 'commentAgent', 'commentType', 'commentParent', 'userId', ),
        self::TYPE_COLNAME       => array(WpCommentsTableMap::COL_COMMENT_ID, WpCommentsTableMap::COL_COMMENT_POST_ID, WpCommentsTableMap::COL_COMMENT_AUTHOR, WpCommentsTableMap::COL_COMMENT_AUTHOR_EMAIL, WpCommentsTableMap::COL_COMMENT_AUTHOR_URL, WpCommentsTableMap::COL_COMMENT_AUTHOR_IP, WpCommentsTableMap::COL_COMMENT_DATE, WpCommentsTableMap::COL_COMMENT_DATE_GMT, WpCommentsTableMap::COL_COMMENT_CONTENT, WpCommentsTableMap::COL_COMMENT_KARMA, WpCommentsTableMap::COL_COMMENT_APPROVED, WpCommentsTableMap::COL_COMMENT_AGENT, WpCommentsTableMap::COL_COMMENT_TYPE, WpCommentsTableMap::COL_COMMENT_PARENT, WpCommentsTableMap::COL_USER_ID, ),
        self::TYPE_FIELDNAME     => array('comment_ID', 'comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_author_IP', 'comment_date', 'comment_date_gmt', 'comment_content', 'comment_karma', 'comment_approved', 'comment_agent', 'comment_type', 'comment_parent', 'user_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CommentId' => 0, 'CommentPostId' => 1, 'CommentAuthor' => 2, 'CommentAuthorEmail' => 3, 'CommentAuthorUrl' => 4, 'CommentAuthorIp' => 5, 'CommentDate' => 6, 'CommentDateGmt' => 7, 'CommentContent' => 8, 'CommentKarma' => 9, 'CommentApproved' => 10, 'CommentAgent' => 11, 'CommentType' => 12, 'CommentParent' => 13, 'UserId' => 14, ),
        self::TYPE_CAMELNAME     => array('commentId' => 0, 'commentPostId' => 1, 'commentAuthor' => 2, 'commentAuthorEmail' => 3, 'commentAuthorUrl' => 4, 'commentAuthorIp' => 5, 'commentDate' => 6, 'commentDateGmt' => 7, 'commentContent' => 8, 'commentKarma' => 9, 'commentApproved' => 10, 'commentAgent' => 11, 'commentType' => 12, 'commentParent' => 13, 'userId' => 14, ),
        self::TYPE_COLNAME       => array(WpCommentsTableMap::COL_COMMENT_ID => 0, WpCommentsTableMap::COL_COMMENT_POST_ID => 1, WpCommentsTableMap::COL_COMMENT_AUTHOR => 2, WpCommentsTableMap::COL_COMMENT_AUTHOR_EMAIL => 3, WpCommentsTableMap::COL_COMMENT_AUTHOR_URL => 4, WpCommentsTableMap::COL_COMMENT_AUTHOR_IP => 5, WpCommentsTableMap::COL_COMMENT_DATE => 6, WpCommentsTableMap::COL_COMMENT_DATE_GMT => 7, WpCommentsTableMap::COL_COMMENT_CONTENT => 8, WpCommentsTableMap::COL_COMMENT_KARMA => 9, WpCommentsTableMap::COL_COMMENT_APPROVED => 10, WpCommentsTableMap::COL_COMMENT_AGENT => 11, WpCommentsTableMap::COL_COMMENT_TYPE => 12, WpCommentsTableMap::COL_COMMENT_PARENT => 13, WpCommentsTableMap::COL_USER_ID => 14, ),
        self::TYPE_FIELDNAME     => array('comment_ID' => 0, 'comment_post_ID' => 1, 'comment_author' => 2, 'comment_author_email' => 3, 'comment_author_url' => 4, 'comment_author_IP' => 5, 'comment_date' => 6, 'comment_date_gmt' => 7, 'comment_content' => 8, 'comment_karma' => 9, 'comment_approved' => 10, 'comment_agent' => 11, 'comment_type' => 12, 'comment_parent' => 13, 'user_id' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('wp_comments');
        $this->setPhpName('WpComments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WpComments');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('comment_ID', 'CommentId', 'BIGINT', true, null, null);
        $this->addColumn('comment_post_ID', 'CommentPostId', 'BIGINT', true, null, 0);
        $this->addColumn('comment_author', 'CommentAuthor', 'VARCHAR', true, 255, null);
        $this->addColumn('comment_author_email', 'CommentAuthorEmail', 'VARCHAR', true, 100, '');
        $this->addColumn('comment_author_url', 'CommentAuthorUrl', 'VARCHAR', true, 200, '');
        $this->addColumn('comment_author_IP', 'CommentAuthorIp', 'VARCHAR', true, 100, '');
        $this->addColumn('comment_date', 'CommentDate', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('comment_date_gmt', 'CommentDateGmt', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('comment_content', 'CommentContent', 'LONGVARCHAR', true, null, null);
        $this->addColumn('comment_karma', 'CommentKarma', 'INTEGER', true, null, 0);
        $this->addColumn('comment_approved', 'CommentApproved', 'VARCHAR', true, 20, '1');
        $this->addColumn('comment_agent', 'CommentAgent', 'VARCHAR', true, 255, '');
        $this->addColumn('comment_type', 'CommentType', 'VARCHAR', true, 20, '');
        $this->addColumn('comment_parent', 'CommentParent', 'BIGINT', true, null, 0);
        $this->addColumn('user_id', 'UserId', 'BIGINT', true, null, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('CommentId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? WpCommentsTableMap::CLASS_DEFAULT : WpCommentsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (WpComments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WpCommentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WpCommentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WpCommentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WpCommentsTableMap::OM_CLASS;
            /** @var WpComments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WpCommentsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = WpCommentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WpCommentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WpComments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WpCommentsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_ID);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_POST_ID);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_AUTHOR);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_AUTHOR_EMAIL);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_AUTHOR_URL);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_AUTHOR_IP);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_DATE);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_DATE_GMT);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_CONTENT);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_KARMA);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_APPROVED);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_AGENT);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_TYPE);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_COMMENT_PARENT);
            $criteria->addSelectColumn(WpCommentsTableMap::COL_USER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.comment_ID');
            $criteria->addSelectColumn($alias . '.comment_post_ID');
            $criteria->addSelectColumn($alias . '.comment_author');
            $criteria->addSelectColumn($alias . '.comment_author_email');
            $criteria->addSelectColumn($alias . '.comment_author_url');
            $criteria->addSelectColumn($alias . '.comment_author_IP');
            $criteria->addSelectColumn($alias . '.comment_date');
            $criteria->addSelectColumn($alias . '.comment_date_gmt');
            $criteria->addSelectColumn($alias . '.comment_content');
            $criteria->addSelectColumn($alias . '.comment_karma');
            $criteria->addSelectColumn($alias . '.comment_approved');
            $criteria->addSelectColumn($alias . '.comment_agent');
            $criteria->addSelectColumn($alias . '.comment_type');
            $criteria->addSelectColumn($alias . '.comment_parent');
            $criteria->addSelectColumn($alias . '.user_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(WpCommentsTableMap::DATABASE_NAME)->getTable(WpCommentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WpCommentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WpCommentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WpCommentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WpComments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WpComments object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WpComments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WpCommentsTableMap::DATABASE_NAME);
            $criteria->add(WpCommentsTableMap::COL_COMMENT_ID, (array) $values, Criteria::IN);
        }

        $query = WpCommentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WpCommentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WpCommentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wp_comments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WpCommentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WpComments or Criteria object.
     *
     * @param mixed               $criteria Criteria or WpComments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WpComments object
        }

        if ($criteria->containsKey(WpCommentsTableMap::COL_COMMENT_ID) && $criteria->keyContainsValue(WpCommentsTableMap::COL_COMMENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpCommentsTableMap::COL_COMMENT_ID.')');
        }


        // Set the correct dbName
        $query = WpCommentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WpCommentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WpCommentsTableMap::buildTableMap();
