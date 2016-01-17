<?php

namespace Map;

use \WpTermTaxonomy;
use \WpTermTaxonomyQuery;
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
 * This class defines the structure of the 'wp_term_taxonomy' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WpTermTaxonomyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WpTermTaxonomyTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'wordpress';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wp_term_taxonomy';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WpTermTaxonomy';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WpTermTaxonomy';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the term_taxonomy_id field
     */
    const COL_TERM_TAXONOMY_ID = 'wp_term_taxonomy.term_taxonomy_id';

    /**
     * the column name for the term_id field
     */
    const COL_TERM_ID = 'wp_term_taxonomy.term_id';

    /**
     * the column name for the taxonomy field
     */
    const COL_TAXONOMY = 'wp_term_taxonomy.taxonomy';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'wp_term_taxonomy.description';

    /**
     * the column name for the parent field
     */
    const COL_PARENT = 'wp_term_taxonomy.parent';

    /**
     * the column name for the count field
     */
    const COL_COUNT = 'wp_term_taxonomy.count';

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
        self::TYPE_PHPNAME       => array('TermTaxonomyId', 'TermId', 'Taxonomy', 'Description', 'Parent', 'Count', ),
        self::TYPE_CAMELNAME     => array('termTaxonomyId', 'termId', 'taxonomy', 'description', 'parent', 'count', ),
        self::TYPE_COLNAME       => array(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, WpTermTaxonomyTableMap::COL_TERM_ID, WpTermTaxonomyTableMap::COL_TAXONOMY, WpTermTaxonomyTableMap::COL_DESCRIPTION, WpTermTaxonomyTableMap::COL_PARENT, WpTermTaxonomyTableMap::COL_COUNT, ),
        self::TYPE_FIELDNAME     => array('term_taxonomy_id', 'term_id', 'taxonomy', 'description', 'parent', 'count', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('TermTaxonomyId' => 0, 'TermId' => 1, 'Taxonomy' => 2, 'Description' => 3, 'Parent' => 4, 'Count' => 5, ),
        self::TYPE_CAMELNAME     => array('termTaxonomyId' => 0, 'termId' => 1, 'taxonomy' => 2, 'description' => 3, 'parent' => 4, 'count' => 5, ),
        self::TYPE_COLNAME       => array(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID => 0, WpTermTaxonomyTableMap::COL_TERM_ID => 1, WpTermTaxonomyTableMap::COL_TAXONOMY => 2, WpTermTaxonomyTableMap::COL_DESCRIPTION => 3, WpTermTaxonomyTableMap::COL_PARENT => 4, WpTermTaxonomyTableMap::COL_COUNT => 5, ),
        self::TYPE_FIELDNAME     => array('term_taxonomy_id' => 0, 'term_id' => 1, 'taxonomy' => 2, 'description' => 3, 'parent' => 4, 'count' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('wp_term_taxonomy');
        $this->setPhpName('WpTermTaxonomy');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WpTermTaxonomy');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('term_taxonomy_id', 'TermTaxonomyId', 'BIGINT', true, null, null);
        $this->addColumn('term_id', 'TermId', 'BIGINT', true, null, 0);
        $this->addColumn('taxonomy', 'Taxonomy', 'VARCHAR', true, 32, '');
        $this->addColumn('description', 'Description', 'CLOB', true, null, null);
        $this->addColumn('parent', 'Parent', 'BIGINT', true, null, 0);
        $this->addColumn('count', 'Count', 'BIGINT', true, null, 0);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TermTaxonomyId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WpTermTaxonomyTableMap::CLASS_DEFAULT : WpTermTaxonomyTableMap::OM_CLASS;
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
     * @return array           (WpTermTaxonomy object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WpTermTaxonomyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WpTermTaxonomyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WpTermTaxonomyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WpTermTaxonomyTableMap::OM_CLASS;
            /** @var WpTermTaxonomy $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WpTermTaxonomyTableMap::addInstanceToPool($obj, $key);
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
            $key = WpTermTaxonomyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WpTermTaxonomyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WpTermTaxonomy $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WpTermTaxonomyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID);
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_TERM_ID);
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_TAXONOMY);
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_PARENT);
            $criteria->addSelectColumn(WpTermTaxonomyTableMap::COL_COUNT);
        } else {
            $criteria->addSelectColumn($alias . '.term_taxonomy_id');
            $criteria->addSelectColumn($alias . '.term_id');
            $criteria->addSelectColumn($alias . '.taxonomy');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.parent');
            $criteria->addSelectColumn($alias . '.count');
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
        return Propel::getServiceContainer()->getDatabaseMap(WpTermTaxonomyTableMap::DATABASE_NAME)->getTable(WpTermTaxonomyTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WpTermTaxonomyTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WpTermTaxonomyTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WpTermTaxonomyTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WpTermTaxonomy or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WpTermTaxonomy object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermTaxonomyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WpTermTaxonomy) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WpTermTaxonomyTableMap::DATABASE_NAME);
            $criteria->add(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, (array) $values, Criteria::IN);
        }

        $query = WpTermTaxonomyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WpTermTaxonomyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WpTermTaxonomyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wp_term_taxonomy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WpTermTaxonomyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WpTermTaxonomy or Criteria object.
     *
     * @param mixed               $criteria Criteria or WpTermTaxonomy object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermTaxonomyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WpTermTaxonomy object
        }

        if ($criteria->containsKey(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID) && $criteria->keyContainsValue(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID.')');
        }


        // Set the correct dbName
        $query = WpTermTaxonomyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WpTermTaxonomyTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WpTermTaxonomyTableMap::buildTableMap();
