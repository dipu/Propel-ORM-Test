<?php

namespace Map;

use \WpPosts;
use \WpPostsQuery;
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
 * This class defines the structure of the 'wp_posts' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class WpPostsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.WpPostsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'wordpress';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'wp_posts';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\WpPosts';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'WpPosts';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 23;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 23;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'wp_posts.ID';

    /**
     * the column name for the post_author field
     */
    const COL_POST_AUTHOR = 'wp_posts.post_author';

    /**
     * the column name for the post_date field
     */
    const COL_POST_DATE = 'wp_posts.post_date';

    /**
     * the column name for the post_date_gmt field
     */
    const COL_POST_DATE_GMT = 'wp_posts.post_date_gmt';

    /**
     * the column name for the post_content field
     */
    const COL_POST_CONTENT = 'wp_posts.post_content';

    /**
     * the column name for the post_title field
     */
    const COL_POST_TITLE = 'wp_posts.post_title';

    /**
     * the column name for the post_excerpt field
     */
    const COL_POST_EXCERPT = 'wp_posts.post_excerpt';

    /**
     * the column name for the post_status field
     */
    const COL_POST_STATUS = 'wp_posts.post_status';

    /**
     * the column name for the comment_status field
     */
    const COL_COMMENT_STATUS = 'wp_posts.comment_status';

    /**
     * the column name for the ping_status field
     */
    const COL_PING_STATUS = 'wp_posts.ping_status';

    /**
     * the column name for the post_password field
     */
    const COL_POST_PASSWORD = 'wp_posts.post_password';

    /**
     * the column name for the post_name field
     */
    const COL_POST_NAME = 'wp_posts.post_name';

    /**
     * the column name for the to_ping field
     */
    const COL_TO_PING = 'wp_posts.to_ping';

    /**
     * the column name for the pinged field
     */
    const COL_PINGED = 'wp_posts.pinged';

    /**
     * the column name for the post_modified field
     */
    const COL_POST_MODIFIED = 'wp_posts.post_modified';

    /**
     * the column name for the post_modified_gmt field
     */
    const COL_POST_MODIFIED_GMT = 'wp_posts.post_modified_gmt';

    /**
     * the column name for the post_content_filtered field
     */
    const COL_POST_CONTENT_FILTERED = 'wp_posts.post_content_filtered';

    /**
     * the column name for the post_parent field
     */
    const COL_POST_PARENT = 'wp_posts.post_parent';

    /**
     * the column name for the guid field
     */
    const COL_GUID = 'wp_posts.guid';

    /**
     * the column name for the menu_order field
     */
    const COL_MENU_ORDER = 'wp_posts.menu_order';

    /**
     * the column name for the post_type field
     */
    const COL_POST_TYPE = 'wp_posts.post_type';

    /**
     * the column name for the post_mime_type field
     */
    const COL_POST_MIME_TYPE = 'wp_posts.post_mime_type';

    /**
     * the column name for the comment_count field
     */
    const COL_COMMENT_COUNT = 'wp_posts.comment_count';

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
        self::TYPE_PHPNAME       => array('Id', 'PostAuthor', 'PostDate', 'PostDateGmt', 'PostContent', 'PostTitle', 'PostExcerpt', 'PostStatus', 'CommentStatus', 'PingStatus', 'PostPassword', 'PostName', 'ToPing', 'Pinged', 'PostModified', 'PostModifiedGmt', 'PostContentFiltered', 'PostParent', 'Guid', 'MenuOrder', 'PostType', 'PostMimeType', 'CommentCount', ),
        self::TYPE_CAMELNAME     => array('id', 'postAuthor', 'postDate', 'postDateGmt', 'postContent', 'postTitle', 'postExcerpt', 'postStatus', 'commentStatus', 'pingStatus', 'postPassword', 'postName', 'toPing', 'pinged', 'postModified', 'postModifiedGmt', 'postContentFiltered', 'postParent', 'guid', 'menuOrder', 'postType', 'postMimeType', 'commentCount', ),
        self::TYPE_COLNAME       => array(WpPostsTableMap::COL_ID, WpPostsTableMap::COL_POST_AUTHOR, WpPostsTableMap::COL_POST_DATE, WpPostsTableMap::COL_POST_DATE_GMT, WpPostsTableMap::COL_POST_CONTENT, WpPostsTableMap::COL_POST_TITLE, WpPostsTableMap::COL_POST_EXCERPT, WpPostsTableMap::COL_POST_STATUS, WpPostsTableMap::COL_COMMENT_STATUS, WpPostsTableMap::COL_PING_STATUS, WpPostsTableMap::COL_POST_PASSWORD, WpPostsTableMap::COL_POST_NAME, WpPostsTableMap::COL_TO_PING, WpPostsTableMap::COL_PINGED, WpPostsTableMap::COL_POST_MODIFIED, WpPostsTableMap::COL_POST_MODIFIED_GMT, WpPostsTableMap::COL_POST_CONTENT_FILTERED, WpPostsTableMap::COL_POST_PARENT, WpPostsTableMap::COL_GUID, WpPostsTableMap::COL_MENU_ORDER, WpPostsTableMap::COL_POST_TYPE, WpPostsTableMap::COL_POST_MIME_TYPE, WpPostsTableMap::COL_COMMENT_COUNT, ),
        self::TYPE_FIELDNAME     => array('ID', 'post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_title', 'post_excerpt', 'post_status', 'comment_status', 'ping_status', 'post_password', 'post_name', 'to_ping', 'pinged', 'post_modified', 'post_modified_gmt', 'post_content_filtered', 'post_parent', 'guid', 'menu_order', 'post_type', 'post_mime_type', 'comment_count', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PostAuthor' => 1, 'PostDate' => 2, 'PostDateGmt' => 3, 'PostContent' => 4, 'PostTitle' => 5, 'PostExcerpt' => 6, 'PostStatus' => 7, 'CommentStatus' => 8, 'PingStatus' => 9, 'PostPassword' => 10, 'PostName' => 11, 'ToPing' => 12, 'Pinged' => 13, 'PostModified' => 14, 'PostModifiedGmt' => 15, 'PostContentFiltered' => 16, 'PostParent' => 17, 'Guid' => 18, 'MenuOrder' => 19, 'PostType' => 20, 'PostMimeType' => 21, 'CommentCount' => 22, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'postAuthor' => 1, 'postDate' => 2, 'postDateGmt' => 3, 'postContent' => 4, 'postTitle' => 5, 'postExcerpt' => 6, 'postStatus' => 7, 'commentStatus' => 8, 'pingStatus' => 9, 'postPassword' => 10, 'postName' => 11, 'toPing' => 12, 'pinged' => 13, 'postModified' => 14, 'postModifiedGmt' => 15, 'postContentFiltered' => 16, 'postParent' => 17, 'guid' => 18, 'menuOrder' => 19, 'postType' => 20, 'postMimeType' => 21, 'commentCount' => 22, ),
        self::TYPE_COLNAME       => array(WpPostsTableMap::COL_ID => 0, WpPostsTableMap::COL_POST_AUTHOR => 1, WpPostsTableMap::COL_POST_DATE => 2, WpPostsTableMap::COL_POST_DATE_GMT => 3, WpPostsTableMap::COL_POST_CONTENT => 4, WpPostsTableMap::COL_POST_TITLE => 5, WpPostsTableMap::COL_POST_EXCERPT => 6, WpPostsTableMap::COL_POST_STATUS => 7, WpPostsTableMap::COL_COMMENT_STATUS => 8, WpPostsTableMap::COL_PING_STATUS => 9, WpPostsTableMap::COL_POST_PASSWORD => 10, WpPostsTableMap::COL_POST_NAME => 11, WpPostsTableMap::COL_TO_PING => 12, WpPostsTableMap::COL_PINGED => 13, WpPostsTableMap::COL_POST_MODIFIED => 14, WpPostsTableMap::COL_POST_MODIFIED_GMT => 15, WpPostsTableMap::COL_POST_CONTENT_FILTERED => 16, WpPostsTableMap::COL_POST_PARENT => 17, WpPostsTableMap::COL_GUID => 18, WpPostsTableMap::COL_MENU_ORDER => 19, WpPostsTableMap::COL_POST_TYPE => 20, WpPostsTableMap::COL_POST_MIME_TYPE => 21, WpPostsTableMap::COL_COMMENT_COUNT => 22, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'post_author' => 1, 'post_date' => 2, 'post_date_gmt' => 3, 'post_content' => 4, 'post_title' => 5, 'post_excerpt' => 6, 'post_status' => 7, 'comment_status' => 8, 'ping_status' => 9, 'post_password' => 10, 'post_name' => 11, 'to_ping' => 12, 'pinged' => 13, 'post_modified' => 14, 'post_modified_gmt' => 15, 'post_content_filtered' => 16, 'post_parent' => 17, 'guid' => 18, 'menu_order' => 19, 'post_type' => 20, 'post_mime_type' => 21, 'comment_count' => 22, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, )
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
        $this->setName('wp_posts');
        $this->setPhpName('WpPosts');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\WpPosts');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('post_author', 'PostAuthor', 'BIGINT', true, null, 0);
        $this->addColumn('post_date', 'PostDate', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('post_date_gmt', 'PostDateGmt', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('post_content', 'PostContent', 'CLOB', true, null, null);
        $this->addColumn('post_title', 'PostTitle', 'LONGVARCHAR', true, null, null);
        $this->addColumn('post_excerpt', 'PostExcerpt', 'LONGVARCHAR', true, null, null);
        $this->addColumn('post_status', 'PostStatus', 'VARCHAR', true, 20, 'publish');
        $this->addColumn('comment_status', 'CommentStatus', 'VARCHAR', true, 20, 'open');
        $this->addColumn('ping_status', 'PingStatus', 'VARCHAR', true, 20, 'open');
        $this->addColumn('post_password', 'PostPassword', 'VARCHAR', true, 20, '');
        $this->addColumn('post_name', 'PostName', 'VARCHAR', true, 200, '');
        $this->addColumn('to_ping', 'ToPing', 'LONGVARCHAR', true, null, null);
        $this->addColumn('pinged', 'Pinged', 'LONGVARCHAR', true, null, null);
        $this->addColumn('post_modified', 'PostModified', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('post_modified_gmt', 'PostModifiedGmt', 'TIMESTAMP', true, null, '0000-00-00 00:00:00');
        $this->addColumn('post_content_filtered', 'PostContentFiltered', 'CLOB', true, null, null);
        $this->addColumn('post_parent', 'PostParent', 'BIGINT', true, null, 0);
        $this->addColumn('guid', 'Guid', 'VARCHAR', true, 255, '');
        $this->addColumn('menu_order', 'MenuOrder', 'INTEGER', true, null, 0);
        $this->addColumn('post_type', 'PostType', 'VARCHAR', true, 20, 'post');
        $this->addColumn('post_mime_type', 'PostMimeType', 'VARCHAR', true, 100, '');
        $this->addColumn('comment_count', 'CommentCount', 'BIGINT', true, null, 0);
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
        return $withPrefix ? WpPostsTableMap::CLASS_DEFAULT : WpPostsTableMap::OM_CLASS;
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
     * @return array           (WpPosts object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = WpPostsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WpPostsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WpPostsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WpPostsTableMap::OM_CLASS;
            /** @var WpPosts $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WpPostsTableMap::addInstanceToPool($obj, $key);
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
            $key = WpPostsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WpPostsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WpPosts $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WpPostsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WpPostsTableMap::COL_ID);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_AUTHOR);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_DATE);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_DATE_GMT);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_CONTENT);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_TITLE);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_EXCERPT);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_STATUS);
            $criteria->addSelectColumn(WpPostsTableMap::COL_COMMENT_STATUS);
            $criteria->addSelectColumn(WpPostsTableMap::COL_PING_STATUS);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_PASSWORD);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_NAME);
            $criteria->addSelectColumn(WpPostsTableMap::COL_TO_PING);
            $criteria->addSelectColumn(WpPostsTableMap::COL_PINGED);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_MODIFIED);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_MODIFIED_GMT);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_CONTENT_FILTERED);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_PARENT);
            $criteria->addSelectColumn(WpPostsTableMap::COL_GUID);
            $criteria->addSelectColumn(WpPostsTableMap::COL_MENU_ORDER);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_TYPE);
            $criteria->addSelectColumn(WpPostsTableMap::COL_POST_MIME_TYPE);
            $criteria->addSelectColumn(WpPostsTableMap::COL_COMMENT_COUNT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.post_author');
            $criteria->addSelectColumn($alias . '.post_date');
            $criteria->addSelectColumn($alias . '.post_date_gmt');
            $criteria->addSelectColumn($alias . '.post_content');
            $criteria->addSelectColumn($alias . '.post_title');
            $criteria->addSelectColumn($alias . '.post_excerpt');
            $criteria->addSelectColumn($alias . '.post_status');
            $criteria->addSelectColumn($alias . '.comment_status');
            $criteria->addSelectColumn($alias . '.ping_status');
            $criteria->addSelectColumn($alias . '.post_password');
            $criteria->addSelectColumn($alias . '.post_name');
            $criteria->addSelectColumn($alias . '.to_ping');
            $criteria->addSelectColumn($alias . '.pinged');
            $criteria->addSelectColumn($alias . '.post_modified');
            $criteria->addSelectColumn($alias . '.post_modified_gmt');
            $criteria->addSelectColumn($alias . '.post_content_filtered');
            $criteria->addSelectColumn($alias . '.post_parent');
            $criteria->addSelectColumn($alias . '.guid');
            $criteria->addSelectColumn($alias . '.menu_order');
            $criteria->addSelectColumn($alias . '.post_type');
            $criteria->addSelectColumn($alias . '.post_mime_type');
            $criteria->addSelectColumn($alias . '.comment_count');
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
        return Propel::getServiceContainer()->getDatabaseMap(WpPostsTableMap::DATABASE_NAME)->getTable(WpPostsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(WpPostsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(WpPostsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new WpPostsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a WpPosts or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or WpPosts object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \WpPosts) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WpPostsTableMap::DATABASE_NAME);
            $criteria->add(WpPostsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = WpPostsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WpPostsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WpPostsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wp_posts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return WpPostsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WpPosts or Criteria object.
     *
     * @param mixed               $criteria Criteria or WpPosts object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WpPosts object
        }

        if ($criteria->containsKey(WpPostsTableMap::COL_ID) && $criteria->keyContainsValue(WpPostsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WpPostsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = WpPostsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // WpPostsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
WpPostsTableMap::buildTableMap();
