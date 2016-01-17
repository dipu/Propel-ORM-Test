<?php

namespace Map;

use \WpUsers;
use \WpUsersQuery;
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
 * This class defines the structure of the 'wp_users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WpUsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WpUsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'wordpress';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wp_users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WpUsers';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WpUsers';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'wp_users.ID';

    /**
     * the column name for the user_login field
     */
    const COL_USER_LOGIN = 'wp_users.user_login';

    /**
     * the column name for the user_pass field
     */
    const COL_USER_PASS = 'wp_users.user_pass';

    /**
     * the column name for the user_nicename field
     */
    const COL_USER_NICENAME = 'wp_users.user_nicename';

    /**
     * the column name for the user_email field
     */
    const COL_USER_EMAIL = 'wp_users.user_email';

    /**
     * the column name for the user_url field
     */
    const COL_USER_URL = 'wp_users.user_url';

    /**
     * the column name for the user_registered field
     */
    const COL_USER_REGISTERED = 'wp_users.user_registered';

    /**
     * the column name for the user_activation_key field
     */
    const COL_USER_ACTIVATION_KEY = 'wp_users.user_activation_key';

    /**
     * the column name for the user_status field
     */
    const COL_USER_STATUS = 'wp_users.user_status';

    /**
     * the column name for the display_name field
     */
    const COL_DISPLAY_NAME = 'wp_users.display_name';

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
        self::TYPE_PHPNAME       => array('Id', 'UserLogin', 'UserPass', 'UserNicename', 'UserEmail', 'UserUrl', 'UserRegistered', 'UserActivationKey', 'UserStatus', 'DisplayName', ),
        self::TYPE_CAMELNAME     => array('id', 'userLogin', 'userPass', 'userNicename', 'userEmail', 'userUrl', 'userRegistered', 'userActivationKey', 'userStatus', 'displayName', ),
        self::TYPE_COLNAME       => array(WpUsersTableMap::COL_ID, WpUsersTableMap::COL_USER_LOGIN, WpUsersTableMap::COL_USER_PASS, WpUsersTableMap::COL_USER_NICENAME, WpUsersTableMap::COL_USER_EMAIL, WpUsersTableMap::COL_USER_URL, WpUsersTableMap::COL_USER_REGISTERED, WpUsersTableMap::COL_USER_ACTIVATION_KEY, WpUsersTableMap::COL_USER_STATUS, WpUsersTableMap::COL_DISPLAY_NAME, ),
        self::TYPE_FIELDNAME     => array('ID', 'user_login', 'user_pass', 'user_nicename', 'user_email', 'user_url', 'user_registered', 'user_activation_key', 'user_status', 'display_name', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserLogin' => 1, 'UserPass' => 2, 'UserNicename' => 3, 'UserEmail' => 4, 'UserUrl' => 5, 'UserRegistered' => 6, 'UserActivationKey' => 7, 'UserStatus' => 8, 'DisplayName' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userLogin' => 1, 'userPass' => 2, 'userNicename' => 3, 'userEmail' => 4, 'userUrl' => 5, 'userRegistered' => 6, 'userActivationKey' => 7, 'userStatus' => 8, 'displayName' => 9, ),
        self::TYPE_COLNAME       => array(WpUsersTableMap::COL_ID => 0, WpUsersTableMap::COL_USER_LOGIN => 1, WpUsersTableMap::COL_USER_PASS => 2, WpUsersTableMap::COL_USER_NICENAME => 3, WpUsersTableMap::COL_USER_EMAIL => 4, WpUsersTableMap::COL_USER_URL => 5, WpUsersTableMap::COL_USER_REGISTERED => 6, WpUsersTableMap::COL_USER_ACTIVATION_KEY => 7, WpUsersTableMap::COL_USER_STATUS => 8, WpUsersTableMap::COL_DISPLAY_NAME => 9, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'user_login' => 1, 'user_pass' => 2, 'user_nicename' => 3, 'user_email' => 4, 'user_url' => 5, 'user_registered' => 6, 'user_activation_key' => 7, 'user_status' => 8, 'display_name' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('wp_users');
        $this->setPhpName('WpUsers');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WpUsers');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('user_login', 'UserLogin', 'VARCHAR', true, 60, '');
        $this->addColumn('user_pass', 'UserPass', 'VARCHAR', true, 64, '');
        $this->addColumn('user_nicename', 'UserNicename', 'VARCHAR', true, 50, '');
        $this->addColumn('user_email', 'UserEmail', 'VARCHAR', true, 100, '');
        $this->addColumn('user_url', 'UserUrl', 'VARCHAR', true, 100, '');
        $this->addColumn('user_registered', 'UserRegistered', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('user_activation_key', 'UserActivationKey', 'VARCHAR', true, 60, '');
        $this->addColumn('user_status', 'UserStatus', 'INTEGER', true, null, 0);
        $this->addColumn('display_name', 'DisplayName', 'VARCHAR', true, 250, '');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WpUsersTableMap::CLASS_DEFAULT : WpUsersTableMap::OM_CLASS;
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
     * @return array           (WpUsers object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WpUsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WpUsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WpUsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WpUsersTableMap::OM_CLASS;
            /** @var WpUsers $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WpUsersTableMap::addInstanceToPool($obj, $key);
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
            $key = WpUsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WpUsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WpUsers $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WpUsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WpUsersTableMap::COL_ID);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_LOGIN);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_PASS);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_NICENAME);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_EMAIL);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_URL);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_REGISTERED);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_ACTIVATION_KEY);
            $criteria->addSelectColumn(WpUsersTableMap::COL_USER_STATUS);
            $criteria->addSelectColumn(WpUsersTableMap::COL_DISPLAY_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.user_login');
            $criteria->addSelectColumn($alias . '.user_pass');
            $criteria->addSelectColumn($alias . '.user_nicename');
            $criteria->addSelectColumn($alias . '.user_email');
            $criteria->addSelectColumn($alias . '.user_url');
            $criteria->addSelectColumn($alias . '.user_registered');
            $criteria->addSelectColumn($alias . '.user_activation_key');
            $criteria->addSelectColumn($alias . '.user_status');
            $criteria->addSelectColumn($alias . '.display_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(WpUsersTableMap::DATABASE_NAME)->getTable(WpUsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WpUsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WpUsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WpUsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WpUsers or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WpUsers object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WpUsers) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WpUsersTableMap::DATABASE_NAME);
            $criteria->add(WpUsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WpUsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WpUsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WpUsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wp_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WpUsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WpUsers or Criteria object.
     *
     * @param mixed               $criteria Criteria or WpUsers object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WpUsers object
        }

        if ($criteria->containsKey(WpUsersTableMap::COL_ID) && $criteria->keyContainsValue(WpUsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpUsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WpUsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WpUsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WpUsersTableMap::buildTableMap();
