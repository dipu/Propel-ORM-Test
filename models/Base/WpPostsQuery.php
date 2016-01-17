<?php

namespace Base;

use \WpPosts as ChildWpPosts;
use \WpPostsQuery as ChildWpPostsQuery;
use \Exception;
use \PDO;
use Map\WpPostsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_posts' table.
 *
 *
 *
 * @method     ChildWpPostsQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildWpPostsQuery orderByPostAuthor($order = Criteria::ASC) Order by the post_author column
 * @method     ChildWpPostsQuery orderByPostDate($order = Criteria::ASC) Order by the post_date column
 * @method     ChildWpPostsQuery orderByPostDateGmt($order = Criteria::ASC) Order by the post_date_gmt column
 * @method     ChildWpPostsQuery orderByPostContent($order = Criteria::ASC) Order by the post_content column
 * @method     ChildWpPostsQuery orderByPostTitle($order = Criteria::ASC) Order by the post_title column
 * @method     ChildWpPostsQuery orderByPostExcerpt($order = Criteria::ASC) Order by the post_excerpt column
 * @method     ChildWpPostsQuery orderByPostStatus($order = Criteria::ASC) Order by the post_status column
 * @method     ChildWpPostsQuery orderByCommentStatus($order = Criteria::ASC) Order by the comment_status column
 * @method     ChildWpPostsQuery orderByPingStatus($order = Criteria::ASC) Order by the ping_status column
 * @method     ChildWpPostsQuery orderByPostPassword($order = Criteria::ASC) Order by the post_password column
 * @method     ChildWpPostsQuery orderByPostName($order = Criteria::ASC) Order by the post_name column
 * @method     ChildWpPostsQuery orderByToPing($order = Criteria::ASC) Order by the to_ping column
 * @method     ChildWpPostsQuery orderByPinged($order = Criteria::ASC) Order by the pinged column
 * @method     ChildWpPostsQuery orderByPostModified($order = Criteria::ASC) Order by the post_modified column
 * @method     ChildWpPostsQuery orderByPostModifiedGmt($order = Criteria::ASC) Order by the post_modified_gmt column
 * @method     ChildWpPostsQuery orderByPostContentFiltered($order = Criteria::ASC) Order by the post_content_filtered column
 * @method     ChildWpPostsQuery orderByPostParent($order = Criteria::ASC) Order by the post_parent column
 * @method     ChildWpPostsQuery orderByGuid($order = Criteria::ASC) Order by the guid column
 * @method     ChildWpPostsQuery orderByMenuOrder($order = Criteria::ASC) Order by the menu_order column
 * @method     ChildWpPostsQuery orderByPostType($order = Criteria::ASC) Order by the post_type column
 * @method     ChildWpPostsQuery orderByPostMimeType($order = Criteria::ASC) Order by the post_mime_type column
 * @method     ChildWpPostsQuery orderByCommentCount($order = Criteria::ASC) Order by the comment_count column
 *
 * @method     ChildWpPostsQuery groupById() Group by the ID column
 * @method     ChildWpPostsQuery groupByPostAuthor() Group by the post_author column
 * @method     ChildWpPostsQuery groupByPostDate() Group by the post_date column
 * @method     ChildWpPostsQuery groupByPostDateGmt() Group by the post_date_gmt column
 * @method     ChildWpPostsQuery groupByPostContent() Group by the post_content column
 * @method     ChildWpPostsQuery groupByPostTitle() Group by the post_title column
 * @method     ChildWpPostsQuery groupByPostExcerpt() Group by the post_excerpt column
 * @method     ChildWpPostsQuery groupByPostStatus() Group by the post_status column
 * @method     ChildWpPostsQuery groupByCommentStatus() Group by the comment_status column
 * @method     ChildWpPostsQuery groupByPingStatus() Group by the ping_status column
 * @method     ChildWpPostsQuery groupByPostPassword() Group by the post_password column
 * @method     ChildWpPostsQuery groupByPostName() Group by the post_name column
 * @method     ChildWpPostsQuery groupByToPing() Group by the to_ping column
 * @method     ChildWpPostsQuery groupByPinged() Group by the pinged column
 * @method     ChildWpPostsQuery groupByPostModified() Group by the post_modified column
 * @method     ChildWpPostsQuery groupByPostModifiedGmt() Group by the post_modified_gmt column
 * @method     ChildWpPostsQuery groupByPostContentFiltered() Group by the post_content_filtered column
 * @method     ChildWpPostsQuery groupByPostParent() Group by the post_parent column
 * @method     ChildWpPostsQuery groupByGuid() Group by the guid column
 * @method     ChildWpPostsQuery groupByMenuOrder() Group by the menu_order column
 * @method     ChildWpPostsQuery groupByPostType() Group by the post_type column
 * @method     ChildWpPostsQuery groupByPostMimeType() Group by the post_mime_type column
 * @method     ChildWpPostsQuery groupByCommentCount() Group by the comment_count column
 *
 * @method     ChildWpPostsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpPostsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpPostsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpPostsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpPostsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpPostsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpPosts findOne(ConnectionInterface $con = null) Return the first ChildWpPosts matching the query
 * @method     ChildWpPosts findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpPosts matching the query, or a new ChildWpPosts object populated from the query conditions when no match is found
 *
 * @method     ChildWpPosts findOneById(string $ID) Return the first ChildWpPosts filtered by the ID column
 * @method     ChildWpPosts findOneByPostAuthor(string $post_author) Return the first ChildWpPosts filtered by the post_author column
 * @method     ChildWpPosts findOneByPostDate(string $post_date) Return the first ChildWpPosts filtered by the post_date column
 * @method     ChildWpPosts findOneByPostDateGmt(string $post_date_gmt) Return the first ChildWpPosts filtered by the post_date_gmt column
 * @method     ChildWpPosts findOneByPostContent(string $post_content) Return the first ChildWpPosts filtered by the post_content column
 * @method     ChildWpPosts findOneByPostTitle(string $post_title) Return the first ChildWpPosts filtered by the post_title column
 * @method     ChildWpPosts findOneByPostExcerpt(string $post_excerpt) Return the first ChildWpPosts filtered by the post_excerpt column
 * @method     ChildWpPosts findOneByPostStatus(string $post_status) Return the first ChildWpPosts filtered by the post_status column
 * @method     ChildWpPosts findOneByCommentStatus(string $comment_status) Return the first ChildWpPosts filtered by the comment_status column
 * @method     ChildWpPosts findOneByPingStatus(string $ping_status) Return the first ChildWpPosts filtered by the ping_status column
 * @method     ChildWpPosts findOneByPostPassword(string $post_password) Return the first ChildWpPosts filtered by the post_password column
 * @method     ChildWpPosts findOneByPostName(string $post_name) Return the first ChildWpPosts filtered by the post_name column
 * @method     ChildWpPosts findOneByToPing(string $to_ping) Return the first ChildWpPosts filtered by the to_ping column
 * @method     ChildWpPosts findOneByPinged(string $pinged) Return the first ChildWpPosts filtered by the pinged column
 * @method     ChildWpPosts findOneByPostModified(string $post_modified) Return the first ChildWpPosts filtered by the post_modified column
 * @method     ChildWpPosts findOneByPostModifiedGmt(string $post_modified_gmt) Return the first ChildWpPosts filtered by the post_modified_gmt column
 * @method     ChildWpPosts findOneByPostContentFiltered(string $post_content_filtered) Return the first ChildWpPosts filtered by the post_content_filtered column
 * @method     ChildWpPosts findOneByPostParent(string $post_parent) Return the first ChildWpPosts filtered by the post_parent column
 * @method     ChildWpPosts findOneByGuid(string $guid) Return the first ChildWpPosts filtered by the guid column
 * @method     ChildWpPosts findOneByMenuOrder(int $menu_order) Return the first ChildWpPosts filtered by the menu_order column
 * @method     ChildWpPosts findOneByPostType(string $post_type) Return the first ChildWpPosts filtered by the post_type column
 * @method     ChildWpPosts findOneByPostMimeType(string $post_mime_type) Return the first ChildWpPosts filtered by the post_mime_type column
 * @method     ChildWpPosts findOneByCommentCount(string $comment_count) Return the first ChildWpPosts filtered by the comment_count column *

 * @method     ChildWpPosts requirePk($key, ConnectionInterface $con = null) Return the ChildWpPosts by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOne(ConnectionInterface $con = null) Return the first ChildWpPosts matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpPosts requireOneById(string $ID) Return the first ChildWpPosts filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostAuthor(string $post_author) Return the first ChildWpPosts filtered by the post_author column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostDate(string $post_date) Return the first ChildWpPosts filtered by the post_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostDateGmt(string $post_date_gmt) Return the first ChildWpPosts filtered by the post_date_gmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostContent(string $post_content) Return the first ChildWpPosts filtered by the post_content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostTitle(string $post_title) Return the first ChildWpPosts filtered by the post_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostExcerpt(string $post_excerpt) Return the first ChildWpPosts filtered by the post_excerpt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostStatus(string $post_status) Return the first ChildWpPosts filtered by the post_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByCommentStatus(string $comment_status) Return the first ChildWpPosts filtered by the comment_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPingStatus(string $ping_status) Return the first ChildWpPosts filtered by the ping_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostPassword(string $post_password) Return the first ChildWpPosts filtered by the post_password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostName(string $post_name) Return the first ChildWpPosts filtered by the post_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByToPing(string $to_ping) Return the first ChildWpPosts filtered by the to_ping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPinged(string $pinged) Return the first ChildWpPosts filtered by the pinged column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostModified(string $post_modified) Return the first ChildWpPosts filtered by the post_modified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostModifiedGmt(string $post_modified_gmt) Return the first ChildWpPosts filtered by the post_modified_gmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostContentFiltered(string $post_content_filtered) Return the first ChildWpPosts filtered by the post_content_filtered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostParent(string $post_parent) Return the first ChildWpPosts filtered by the post_parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByGuid(string $guid) Return the first ChildWpPosts filtered by the guid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByMenuOrder(int $menu_order) Return the first ChildWpPosts filtered by the menu_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostType(string $post_type) Return the first ChildWpPosts filtered by the post_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByPostMimeType(string $post_mime_type) Return the first ChildWpPosts filtered by the post_mime_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPosts requireOneByCommentCount(string $comment_count) Return the first ChildWpPosts filtered by the comment_count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpPosts[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpPosts objects based on current ModelCriteria
 * @method     ChildWpPosts[]|ObjectCollection findById(string $ID) Return ChildWpPosts objects filtered by the ID column
 * @method     ChildWpPosts[]|ObjectCollection findByPostAuthor(string $post_author) Return ChildWpPosts objects filtered by the post_author column
 * @method     ChildWpPosts[]|ObjectCollection findByPostDate(string $post_date) Return ChildWpPosts objects filtered by the post_date column
 * @method     ChildWpPosts[]|ObjectCollection findByPostDateGmt(string $post_date_gmt) Return ChildWpPosts objects filtered by the post_date_gmt column
 * @method     ChildWpPosts[]|ObjectCollection findByPostContent(string $post_content) Return ChildWpPosts objects filtered by the post_content column
 * @method     ChildWpPosts[]|ObjectCollection findByPostTitle(string $post_title) Return ChildWpPosts objects filtered by the post_title column
 * @method     ChildWpPosts[]|ObjectCollection findByPostExcerpt(string $post_excerpt) Return ChildWpPosts objects filtered by the post_excerpt column
 * @method     ChildWpPosts[]|ObjectCollection findByPostStatus(string $post_status) Return ChildWpPosts objects filtered by the post_status column
 * @method     ChildWpPosts[]|ObjectCollection findByCommentStatus(string $comment_status) Return ChildWpPosts objects filtered by the comment_status column
 * @method     ChildWpPosts[]|ObjectCollection findByPingStatus(string $ping_status) Return ChildWpPosts objects filtered by the ping_status column
 * @method     ChildWpPosts[]|ObjectCollection findByPostPassword(string $post_password) Return ChildWpPosts objects filtered by the post_password column
 * @method     ChildWpPosts[]|ObjectCollection findByPostName(string $post_name) Return ChildWpPosts objects filtered by the post_name column
 * @method     ChildWpPosts[]|ObjectCollection findByToPing(string $to_ping) Return ChildWpPosts objects filtered by the to_ping column
 * @method     ChildWpPosts[]|ObjectCollection findByPinged(string $pinged) Return ChildWpPosts objects filtered by the pinged column
 * @method     ChildWpPosts[]|ObjectCollection findByPostModified(string $post_modified) Return ChildWpPosts objects filtered by the post_modified column
 * @method     ChildWpPosts[]|ObjectCollection findByPostModifiedGmt(string $post_modified_gmt) Return ChildWpPosts objects filtered by the post_modified_gmt column
 * @method     ChildWpPosts[]|ObjectCollection findByPostContentFiltered(string $post_content_filtered) Return ChildWpPosts objects filtered by the post_content_filtered column
 * @method     ChildWpPosts[]|ObjectCollection findByPostParent(string $post_parent) Return ChildWpPosts objects filtered by the post_parent column
 * @method     ChildWpPosts[]|ObjectCollection findByGuid(string $guid) Return ChildWpPosts objects filtered by the guid column
 * @method     ChildWpPosts[]|ObjectCollection findByMenuOrder(int $menu_order) Return ChildWpPosts objects filtered by the menu_order column
 * @method     ChildWpPosts[]|ObjectCollection findByPostType(string $post_type) Return ChildWpPosts objects filtered by the post_type column
 * @method     ChildWpPosts[]|ObjectCollection findByPostMimeType(string $post_mime_type) Return ChildWpPosts objects filtered by the post_mime_type column
 * @method     ChildWpPosts[]|ObjectCollection findByCommentCount(string $comment_count) Return ChildWpPosts objects filtered by the comment_count column
 * @method     ChildWpPosts[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpPostsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpPostsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpPosts', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpPostsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpPostsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpPostsQuery) {
            return $criteria;
        }
        $query = new ChildWpPostsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWpPosts|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpPostsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpPostsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWpPosts A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count FROM wp_posts WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWpPosts $obj */
            $obj = new ChildWpPosts();
            $obj->hydrate($row);
            WpPostsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildWpPosts|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpPostsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpPostsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the post_author column
     *
     * Example usage:
     * <code>
     * $query->filterByPostAuthor(1234); // WHERE post_author = 1234
     * $query->filterByPostAuthor(array(12, 34)); // WHERE post_author IN (12, 34)
     * $query->filterByPostAuthor(array('min' => 12)); // WHERE post_author > 12
     * </code>
     *
     * @param     mixed $postAuthor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostAuthor($postAuthor = null, $comparison = null)
    {
        if (is_array($postAuthor)) {
            $useMinMax = false;
            if (isset($postAuthor['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_AUTHOR, $postAuthor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postAuthor['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_AUTHOR, $postAuthor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_AUTHOR, $postAuthor, $comparison);
    }

    /**
     * Filter the query on the post_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPostDate('2011-03-14'); // WHERE post_date = '2011-03-14'
     * $query->filterByPostDate('now'); // WHERE post_date = '2011-03-14'
     * $query->filterByPostDate(array('max' => 'yesterday')); // WHERE post_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $postDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostDate($postDate = null, $comparison = null)
    {
        if (is_array($postDate)) {
            $useMinMax = false;
            if (isset($postDate['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE, $postDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postDate['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE, $postDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE, $postDate, $comparison);
    }

    /**
     * Filter the query on the post_date_gmt column
     *
     * Example usage:
     * <code>
     * $query->filterByPostDateGmt('2011-03-14'); // WHERE post_date_gmt = '2011-03-14'
     * $query->filterByPostDateGmt('now'); // WHERE post_date_gmt = '2011-03-14'
     * $query->filterByPostDateGmt(array('max' => 'yesterday')); // WHERE post_date_gmt > '2011-03-13'
     * </code>
     *
     * @param     mixed $postDateGmt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostDateGmt($postDateGmt = null, $comparison = null)
    {
        if (is_array($postDateGmt)) {
            $useMinMax = false;
            if (isset($postDateGmt['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE_GMT, $postDateGmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postDateGmt['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE_GMT, $postDateGmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_DATE_GMT, $postDateGmt, $comparison);
    }

    /**
     * Filter the query on the post_content column
     *
     * Example usage:
     * <code>
     * $query->filterByPostContent('fooValue');   // WHERE post_content = 'fooValue'
     * $query->filterByPostContent('%fooValue%'); // WHERE post_content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postContent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostContent($postContent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postContent)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postContent)) {
                $postContent = str_replace('*', '%', $postContent);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_CONTENT, $postContent, $comparison);
    }

    /**
     * Filter the query on the post_title column
     *
     * Example usage:
     * <code>
     * $query->filterByPostTitle('fooValue');   // WHERE post_title = 'fooValue'
     * $query->filterByPostTitle('%fooValue%'); // WHERE post_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostTitle($postTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postTitle)) {
                $postTitle = str_replace('*', '%', $postTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_TITLE, $postTitle, $comparison);
    }

    /**
     * Filter the query on the post_excerpt column
     *
     * Example usage:
     * <code>
     * $query->filterByPostExcerpt('fooValue');   // WHERE post_excerpt = 'fooValue'
     * $query->filterByPostExcerpt('%fooValue%'); // WHERE post_excerpt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postExcerpt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostExcerpt($postExcerpt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postExcerpt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postExcerpt)) {
                $postExcerpt = str_replace('*', '%', $postExcerpt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_EXCERPT, $postExcerpt, $comparison);
    }

    /**
     * Filter the query on the post_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPostStatus('fooValue');   // WHERE post_status = 'fooValue'
     * $query->filterByPostStatus('%fooValue%'); // WHERE post_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostStatus($postStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postStatus)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postStatus)) {
                $postStatus = str_replace('*', '%', $postStatus);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_STATUS, $postStatus, $comparison);
    }

    /**
     * Filter the query on the comment_status column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentStatus('fooValue');   // WHERE comment_status = 'fooValue'
     * $query->filterByCommentStatus('%fooValue%'); // WHERE comment_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByCommentStatus($commentStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentStatus)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentStatus)) {
                $commentStatus = str_replace('*', '%', $commentStatus);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_COMMENT_STATUS, $commentStatus, $comparison);
    }

    /**
     * Filter the query on the ping_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPingStatus('fooValue');   // WHERE ping_status = 'fooValue'
     * $query->filterByPingStatus('%fooValue%'); // WHERE ping_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pingStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPingStatus($pingStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pingStatus)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pingStatus)) {
                $pingStatus = str_replace('*', '%', $pingStatus);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_PING_STATUS, $pingStatus, $comparison);
    }

    /**
     * Filter the query on the post_password column
     *
     * Example usage:
     * <code>
     * $query->filterByPostPassword('fooValue');   // WHERE post_password = 'fooValue'
     * $query->filterByPostPassword('%fooValue%'); // WHERE post_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postPassword The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostPassword($postPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postPassword)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postPassword)) {
                $postPassword = str_replace('*', '%', $postPassword);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_PASSWORD, $postPassword, $comparison);
    }

    /**
     * Filter the query on the post_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPostName('fooValue');   // WHERE post_name = 'fooValue'
     * $query->filterByPostName('%fooValue%'); // WHERE post_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostName($postName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postName)) {
                $postName = str_replace('*', '%', $postName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_NAME, $postName, $comparison);
    }

    /**
     * Filter the query on the to_ping column
     *
     * Example usage:
     * <code>
     * $query->filterByToPing('fooValue');   // WHERE to_ping = 'fooValue'
     * $query->filterByToPing('%fooValue%'); // WHERE to_ping LIKE '%fooValue%'
     * </code>
     *
     * @param     string $toPing The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByToPing($toPing = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toPing)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $toPing)) {
                $toPing = str_replace('*', '%', $toPing);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_TO_PING, $toPing, $comparison);
    }

    /**
     * Filter the query on the pinged column
     *
     * Example usage:
     * <code>
     * $query->filterByPinged('fooValue');   // WHERE pinged = 'fooValue'
     * $query->filterByPinged('%fooValue%'); // WHERE pinged LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pinged The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPinged($pinged = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pinged)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pinged)) {
                $pinged = str_replace('*', '%', $pinged);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_PINGED, $pinged, $comparison);
    }

    /**
     * Filter the query on the post_modified column
     *
     * Example usage:
     * <code>
     * $query->filterByPostModified('2011-03-14'); // WHERE post_modified = '2011-03-14'
     * $query->filterByPostModified('now'); // WHERE post_modified = '2011-03-14'
     * $query->filterByPostModified(array('max' => 'yesterday')); // WHERE post_modified > '2011-03-13'
     * </code>
     *
     * @param     mixed $postModified The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostModified($postModified = null, $comparison = null)
    {
        if (is_array($postModified)) {
            $useMinMax = false;
            if (isset($postModified['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED, $postModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postModified['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED, $postModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED, $postModified, $comparison);
    }

    /**
     * Filter the query on the post_modified_gmt column
     *
     * Example usage:
     * <code>
     * $query->filterByPostModifiedGmt('2011-03-14'); // WHERE post_modified_gmt = '2011-03-14'
     * $query->filterByPostModifiedGmt('now'); // WHERE post_modified_gmt = '2011-03-14'
     * $query->filterByPostModifiedGmt(array('max' => 'yesterday')); // WHERE post_modified_gmt > '2011-03-13'
     * </code>
     *
     * @param     mixed $postModifiedGmt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostModifiedGmt($postModifiedGmt = null, $comparison = null)
    {
        if (is_array($postModifiedGmt)) {
            $useMinMax = false;
            if (isset($postModifiedGmt['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED_GMT, $postModifiedGmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postModifiedGmt['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED_GMT, $postModifiedGmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_MODIFIED_GMT, $postModifiedGmt, $comparison);
    }

    /**
     * Filter the query on the post_content_filtered column
     *
     * Example usage:
     * <code>
     * $query->filterByPostContentFiltered('fooValue');   // WHERE post_content_filtered = 'fooValue'
     * $query->filterByPostContentFiltered('%fooValue%'); // WHERE post_content_filtered LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postContentFiltered The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostContentFiltered($postContentFiltered = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postContentFiltered)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postContentFiltered)) {
                $postContentFiltered = str_replace('*', '%', $postContentFiltered);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_CONTENT_FILTERED, $postContentFiltered, $comparison);
    }

    /**
     * Filter the query on the post_parent column
     *
     * Example usage:
     * <code>
     * $query->filterByPostParent(1234); // WHERE post_parent = 1234
     * $query->filterByPostParent(array(12, 34)); // WHERE post_parent IN (12, 34)
     * $query->filterByPostParent(array('min' => 12)); // WHERE post_parent > 12
     * </code>
     *
     * @param     mixed $postParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostParent($postParent = null, $comparison = null)
    {
        if (is_array($postParent)) {
            $useMinMax = false;
            if (isset($postParent['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_PARENT, $postParent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postParent['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_POST_PARENT, $postParent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_PARENT, $postParent, $comparison);
    }

    /**
     * Filter the query on the guid column
     *
     * Example usage:
     * <code>
     * $query->filterByGuid('fooValue');   // WHERE guid = 'fooValue'
     * $query->filterByGuid('%fooValue%'); // WHERE guid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $guid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByGuid($guid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guid)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $guid)) {
                $guid = str_replace('*', '%', $guid);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_GUID, $guid, $comparison);
    }

    /**
     * Filter the query on the menu_order column
     *
     * Example usage:
     * <code>
     * $query->filterByMenuOrder(1234); // WHERE menu_order = 1234
     * $query->filterByMenuOrder(array(12, 34)); // WHERE menu_order IN (12, 34)
     * $query->filterByMenuOrder(array('min' => 12)); // WHERE menu_order > 12
     * </code>
     *
     * @param     mixed $menuOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByMenuOrder($menuOrder = null, $comparison = null)
    {
        if (is_array($menuOrder)) {
            $useMinMax = false;
            if (isset($menuOrder['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_MENU_ORDER, $menuOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($menuOrder['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_MENU_ORDER, $menuOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_MENU_ORDER, $menuOrder, $comparison);
    }

    /**
     * Filter the query on the post_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPostType('fooValue');   // WHERE post_type = 'fooValue'
     * $query->filterByPostType('%fooValue%'); // WHERE post_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostType($postType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postType)) {
                $postType = str_replace('*', '%', $postType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_TYPE, $postType, $comparison);
    }

    /**
     * Filter the query on the post_mime_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPostMimeType('fooValue');   // WHERE post_mime_type = 'fooValue'
     * $query->filterByPostMimeType('%fooValue%'); // WHERE post_mime_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postMimeType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByPostMimeType($postMimeType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postMimeType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postMimeType)) {
                $postMimeType = str_replace('*', '%', $postMimeType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_POST_MIME_TYPE, $postMimeType, $comparison);
    }

    /**
     * Filter the query on the comment_count column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentCount(1234); // WHERE comment_count = 1234
     * $query->filterByCommentCount(array(12, 34)); // WHERE comment_count IN (12, 34)
     * $query->filterByCommentCount(array('min' => 12)); // WHERE comment_count > 12
     * </code>
     *
     * @param     mixed $commentCount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function filterByCommentCount($commentCount = null, $comparison = null)
    {
        if (is_array($commentCount)) {
            $useMinMax = false;
            if (isset($commentCount['min'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_COMMENT_COUNT, $commentCount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentCount['max'])) {
                $this->addUsingAlias(WpPostsTableMap::COL_COMMENT_COUNT, $commentCount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostsTableMap::COL_COMMENT_COUNT, $commentCount, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpPosts $wpPosts Object to remove from the list of results
     *
     * @return $this|ChildWpPostsQuery The current query, for fluid interface
     */
    public function prune($wpPosts = null)
    {
        if ($wpPosts) {
            $this->addUsingAlias(WpPostsTableMap::COL_ID, $wpPosts->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_posts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpPostsTableMap::clearInstancePool();
            WpPostsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpPostsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpPostsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpPostsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpPostsQuery
