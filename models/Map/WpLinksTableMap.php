<?php

namespace Map;

use \WpLinks;
use \WpLinksQuery;
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
 * This class defines the structure of the 'wp_links' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WpLinksTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WpLinksTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'wordpress';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wp_links';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WpLinks';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WpLinks';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the link_id field
     */
    const COL_LINK_ID = 'wp_links.link_id';

    /**
     * the column name for the link_url field
     */
    const COL_LINK_URL = 'wp_links.link_url';

    /**
     * the column name for the link_name field
     */
    const COL_LINK_NAME = 'wp_links.link_name';

    /**
     * the column name for the link_image field
     */
    const COL_LINK_IMAGE = 'wp_links.link_image';

    /**
     * the column name for the link_target field
     */
    const COL_LINK_TARGET = 'wp_links.link_target';

    /**
     * the column name for the link_description field
     */
    const COL_LINK_DESCRIPTION = 'wp_links.link_description';

    /**
     * the column name for the link_visible field
     */
    const COL_LINK_VISIBLE = 'wp_links.link_visible';

    /**
     * the column name for the link_owner field
     */
    const COL_LINK_OWNER = 'wp_links.link_owner';

    /**
     * the column name for the link_rating field
     */
    const COL_LINK_RATING = 'wp_links.link_rating';

    /**
     * the column name for the link_updated field
     */
    const COL_LINK_UPDATED = 'wp_links.link_updated';

    /**
     * the column name for the link_rel field
     */
    const COL_LINK_REL = 'wp_links.link_rel';

    /**
     * the column name for the link_notes field
     */
    const COL_LINK_NOTES = 'wp_links.link_notes';

    /**
     * the column name for the link_rss field
     */
    const COL_LINK_RSS = 'wp_links.link_rss';

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
        self::TYPE_PHPNAME       => array('LinkId', 'LinkUrl', 'LinkName', 'LinkImage', 'LinkTarget', 'LinkDescription', 'LinkVisible', 'LinkOwner', 'LinkRating', 'LinkUpdated', 'LinkRel', 'LinkNotes', 'LinkRss', ),
        self::TYPE_CAMELNAME     => array('linkId', 'linkUrl', 'linkName', 'linkImage', 'linkTarget', 'linkDescription', 'linkVisible', 'linkOwner', 'linkRating', 'linkUpdated', 'linkRel', 'linkNotes', 'linkRss', ),
        self::TYPE_COLNAME       => array(WpLinksTableMap::COL_LINK_ID, WpLinksTableMap::COL_LINK_URL, WpLinksTableMap::COL_LINK_NAME, WpLinksTableMap::COL_LINK_IMAGE, WpLinksTableMap::COL_LINK_TARGET, WpLinksTableMap::COL_LINK_DESCRIPTION, WpLinksTableMap::COL_LINK_VISIBLE, WpLinksTableMap::COL_LINK_OWNER, WpLinksTableMap::COL_LINK_RATING, WpLinksTableMap::COL_LINK_UPDATED, WpLinksTableMap::COL_LINK_REL, WpLinksTableMap::COL_LINK_NOTES, WpLinksTableMap::COL_LINK_RSS, ),
        self::TYPE_FIELDNAME     => array('link_id', 'link_url', 'link_name', 'link_image', 'link_target', 'link_description', 'link_visible', 'link_owner', 'link_rating', 'link_updated', 'link_rel', 'link_notes', 'link_rss', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('LinkId' => 0, 'LinkUrl' => 1, 'LinkName' => 2, 'LinkImage' => 3, 'LinkTarget' => 4, 'LinkDescription' => 5, 'LinkVisible' => 6, 'LinkOwner' => 7, 'LinkRating' => 8, 'LinkUpdated' => 9, 'LinkRel' => 10, 'LinkNotes' => 11, 'LinkRss' => 12, ),
        self::TYPE_CAMELNAME     => array('linkId' => 0, 'linkUrl' => 1, 'linkName' => 2, 'linkImage' => 3, 'linkTarget' => 4, 'linkDescription' => 5, 'linkVisible' => 6, 'linkOwner' => 7, 'linkRating' => 8, 'linkUpdated' => 9, 'linkRel' => 10, 'linkNotes' => 11, 'linkRss' => 12, ),
        self::TYPE_COLNAME       => array(WpLinksTableMap::COL_LINK_ID => 0, WpLinksTableMap::COL_LINK_URL => 1, WpLinksTableMap::COL_LINK_NAME => 2, WpLinksTableMap::COL_LINK_IMAGE => 3, WpLinksTableMap::COL_LINK_TARGET => 4, WpLinksTableMap::COL_LINK_DESCRIPTION => 5, WpLinksTableMap::COL_LINK_VISIBLE => 6, WpLinksTableMap::COL_LINK_OWNER => 7, WpLinksTableMap::COL_LINK_RATING => 8, WpLinksTableMap::COL_LINK_UPDATED => 9, WpLinksTableMap::COL_LINK_REL => 10, WpLinksTableMap::COL_LINK_NOTES => 11, WpLinksTableMap::COL_LINK_RSS => 12, ),
        self::TYPE_FIELDNAME     => array('link_id' => 0, 'link_url' => 1, 'link_name' => 2, 'link_image' => 3, 'link_target' => 4, 'link_description' => 5, 'link_visible' => 6, 'link_owner' => 7, 'link_rating' => 8, 'link_updated' => 9, 'link_rel' => 10, 'link_notes' => 11, 'link_rss' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('wp_links');
        $this->setPhpName('WpLinks');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WpLinks');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('link_id', 'LinkId', 'BIGINT', true, null, null);
        $this->addColumn('link_url', 'LinkUrl', 'VARCHAR', true, 255, '');
        $this->addColumn('link_name', 'LinkName', 'VARCHAR', true, 255, '');
        $this->addColumn('link_image', 'LinkImage', 'VARCHAR', true, 255, '');
        $this->addColumn('link_target', 'LinkTarget', 'VARCHAR', true, 25, '');
        $this->addColumn('link_description', 'LinkDescription', 'VARCHAR', true, 255, '');
        $this->addColumn('link_visible', 'LinkVisible', 'VARCHAR', true, 20, 'Y');
        $this->addColumn('link_owner', 'LinkOwner', 'BIGINT', true, null, 1);
        $this->addColumn('link_rating', 'LinkRating', 'INTEGER', true, null, 0);
        $this->addColumn('link_updated', 'LinkUpdated', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('link_rel', 'LinkRel', 'VARCHAR', true, 255, '');
        $this->addColumn('link_notes', 'LinkNotes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('link_rss', 'LinkRss', 'VARCHAR', true, 255, '');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WpLinksTableMap::CLASS_DEFAULT : WpLinksTableMap::OM_CLASS;
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
     * @return array           (WpLinks object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WpLinksTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WpLinksTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WpLinksTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WpLinksTableMap::OM_CLASS;
            /** @var WpLinks $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WpLinksTableMap::addInstanceToPool($obj, $key);
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
            $key = WpLinksTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WpLinksTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WpLinks $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WpLinksTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_ID);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_URL);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_NAME);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_IMAGE);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_TARGET);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_DESCRIPTION);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_VISIBLE);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_OWNER);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_RATING);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_UPDATED);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_REL);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_NOTES);
            $criteria->addSelectColumn(WpLinksTableMap::COL_LINK_RSS);
        } else {
            $criteria->addSelectColumn($alias . '.link_id');
            $criteria->addSelectColumn($alias . '.link_url');
            $criteria->addSelectColumn($alias . '.link_name');
            $criteria->addSelectColumn($alias . '.link_image');
            $criteria->addSelectColumn($alias . '.link_target');
            $criteria->addSelectColumn($alias . '.link_description');
            $criteria->addSelectColumn($alias . '.link_visible');
            $criteria->addSelectColumn($alias . '.link_owner');
            $criteria->addSelectColumn($alias . '.link_rating');
            $criteria->addSelectColumn($alias . '.link_updated');
            $criteria->addSelectColumn($alias . '.link_rel');
            $criteria->addSelectColumn($alias . '.link_notes');
            $criteria->addSelectColumn($alias . '.link_rss');
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
        return Propel::getServiceContainer()->getDatabaseMap(WpLinksTableMap::DATABASE_NAME)->getTable(WpLinksTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WpLinksTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WpLinksTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WpLinksTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WpLinks or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WpLinks object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WpLinksTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WpLinks) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WpLinksTableMap::DATABASE_NAME);
            $criteria->add(WpLinksTableMap::COL_LINK_ID, (array) $values, Criteria::IN);
        }

        $query = WpLinksQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WpLinksTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WpLinksTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wp_links table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WpLinksQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WpLinks or Criteria object.
     *
     * @param mixed               $criteria Criteria or WpLinks object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpLinksTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WpLinks object
        }

        if ($criteria->containsKey(WpLinksTableMap::COL_LINK_ID) && $criteria->keyContainsValue(WpLinksTableMap::COL_LINK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpLinksTableMap::COL_LINK_ID.')');
        }


        // Set the correct dbName
        $query = WpLinksQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WpLinksTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WpLinksTableMap::buildTableMap();
