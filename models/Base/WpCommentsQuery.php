<?php

namespace Base;

use \WpComments as ChildWpComments;
use \WpCommentsQuery as ChildWpCommentsQuery;
use \Exception;
use \PDO;
use Map\WpCommentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_comments' table.
 *
 *
 *
 * @method     ChildWpCommentsQuery orderByCommentId($order = Criteria::ASC) Order by the comment_ID column
 * @method     ChildWpCommentsQuery orderByCommentPostId($order = Criteria::ASC) Order by the comment_post_ID column
 * @method     ChildWpCommentsQuery orderByCommentAuthor($order = Criteria::ASC) Order by the comment_author column
 * @method     ChildWpCommentsQuery orderByCommentAuthorEmail($order = Criteria::ASC) Order by the comment_author_email column
 * @method     ChildWpCommentsQuery orderByCommentAuthorUrl($order = Criteria::ASC) Order by the comment_author_url column
 * @method     ChildWpCommentsQuery orderByCommentAuthorIp($order = Criteria::ASC) Order by the comment_author_IP column
 * @method     ChildWpCommentsQuery orderByCommentDate($order = Criteria::ASC) Order by the comment_date column
 * @method     ChildWpCommentsQuery orderByCommentDateGmt($order = Criteria::ASC) Order by the comment_date_gmt column
 * @method     ChildWpCommentsQuery orderByCommentContent($order = Criteria::ASC) Order by the comment_content column
 * @method     ChildWpCommentsQuery orderByCommentKarma($order = Criteria::ASC) Order by the comment_karma column
 * @method     ChildWpCommentsQuery orderByCommentApproved($order = Criteria::ASC) Order by the comment_approved column
 * @method     ChildWpCommentsQuery orderByCommentAgent($order = Criteria::ASC) Order by the comment_agent column
 * @method     ChildWpCommentsQuery orderByCommentType($order = Criteria::ASC) Order by the comment_type column
 * @method     ChildWpCommentsQuery orderByCommentParent($order = Criteria::ASC) Order by the comment_parent column
 * @method     ChildWpCommentsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method     ChildWpCommentsQuery groupByCommentId() Group by the comment_ID column
 * @method     ChildWpCommentsQuery groupByCommentPostId() Group by the comment_post_ID column
 * @method     ChildWpCommentsQuery groupByCommentAuthor() Group by the comment_author column
 * @method     ChildWpCommentsQuery groupByCommentAuthorEmail() Group by the comment_author_email column
 * @method     ChildWpCommentsQuery groupByCommentAuthorUrl() Group by the comment_author_url column
 * @method     ChildWpCommentsQuery groupByCommentAuthorIp() Group by the comment_author_IP column
 * @method     ChildWpCommentsQuery groupByCommentDate() Group by the comment_date column
 * @method     ChildWpCommentsQuery groupByCommentDateGmt() Group by the comment_date_gmt column
 * @method     ChildWpCommentsQuery groupByCommentContent() Group by the comment_content column
 * @method     ChildWpCommentsQuery groupByCommentKarma() Group by the comment_karma column
 * @method     ChildWpCommentsQuery groupByCommentApproved() Group by the comment_approved column
 * @method     ChildWpCommentsQuery groupByCommentAgent() Group by the comment_agent column
 * @method     ChildWpCommentsQuery groupByCommentType() Group by the comment_type column
 * @method     ChildWpCommentsQuery groupByCommentParent() Group by the comment_parent column
 * @method     ChildWpCommentsQuery groupByUserId() Group by the user_id column
 *
 * @method     ChildWpCommentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpCommentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpCommentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpCommentsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpCommentsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpCommentsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpComments findOne(ConnectionInterface $con = null) Return the first ChildWpComments matching the query
 * @method     ChildWpComments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpComments matching the query, or a new ChildWpComments object populated from the query conditions when no match is found
 *
 * @method     ChildWpComments findOneByCommentId(string $comment_ID) Return the first ChildWpComments filtered by the comment_ID column
 * @method     ChildWpComments findOneByCommentPostId(string $comment_post_ID) Return the first ChildWpComments filtered by the comment_post_ID column
 * @method     ChildWpComments findOneByCommentAuthor(string $comment_author) Return the first ChildWpComments filtered by the comment_author column
 * @method     ChildWpComments findOneByCommentAuthorEmail(string $comment_author_email) Return the first ChildWpComments filtered by the comment_author_email column
 * @method     ChildWpComments findOneByCommentAuthorUrl(string $comment_author_url) Return the first ChildWpComments filtered by the comment_author_url column
 * @method     ChildWpComments findOneByCommentAuthorIp(string $comment_author_IP) Return the first ChildWpComments filtered by the comment_author_IP column
 * @method     ChildWpComments findOneByCommentDate(string $comment_date) Return the first ChildWpComments filtered by the comment_date column
 * @method     ChildWpComments findOneByCommentDateGmt(string $comment_date_gmt) Return the first ChildWpComments filtered by the comment_date_gmt column
 * @method     ChildWpComments findOneByCommentContent(string $comment_content) Return the first ChildWpComments filtered by the comment_content column
 * @method     ChildWpComments findOneByCommentKarma(int $comment_karma) Return the first ChildWpComments filtered by the comment_karma column
 * @method     ChildWpComments findOneByCommentApproved(string $comment_approved) Return the first ChildWpComments filtered by the comment_approved column
 * @method     ChildWpComments findOneByCommentAgent(string $comment_agent) Return the first ChildWpComments filtered by the comment_agent column
 * @method     ChildWpComments findOneByCommentType(string $comment_type) Return the first ChildWpComments filtered by the comment_type column
 * @method     ChildWpComments findOneByCommentParent(string $comment_parent) Return the first ChildWpComments filtered by the comment_parent column
 * @method     ChildWpComments findOneByUserId(string $user_id) Return the first ChildWpComments filtered by the user_id column *

 * @method     ChildWpComments requirePk($key, ConnectionInterface $con = null) Return the ChildWpComments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOne(ConnectionInterface $con = null) Return the first ChildWpComments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpComments requireOneByCommentId(string $comment_ID) Return the first ChildWpComments filtered by the comment_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentPostId(string $comment_post_ID) Return the first ChildWpComments filtered by the comment_post_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentAuthor(string $comment_author) Return the first ChildWpComments filtered by the comment_author column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentAuthorEmail(string $comment_author_email) Return the first ChildWpComments filtered by the comment_author_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentAuthorUrl(string $comment_author_url) Return the first ChildWpComments filtered by the comment_author_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentAuthorIp(string $comment_author_IP) Return the first ChildWpComments filtered by the comment_author_IP column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentDate(string $comment_date) Return the first ChildWpComments filtered by the comment_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentDateGmt(string $comment_date_gmt) Return the first ChildWpComments filtered by the comment_date_gmt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentContent(string $comment_content) Return the first ChildWpComments filtered by the comment_content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentKarma(int $comment_karma) Return the first ChildWpComments filtered by the comment_karma column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentApproved(string $comment_approved) Return the first ChildWpComments filtered by the comment_approved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentAgent(string $comment_agent) Return the first ChildWpComments filtered by the comment_agent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentType(string $comment_type) Return the first ChildWpComments filtered by the comment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByCommentParent(string $comment_parent) Return the first ChildWpComments filtered by the comment_parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpComments requireOneByUserId(string $user_id) Return the first ChildWpComments filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpComments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpComments objects based on current ModelCriteria
 * @method     ChildWpComments[]|ObjectCollection findByCommentId(string $comment_ID) Return ChildWpComments objects filtered by the comment_ID column
 * @method     ChildWpComments[]|ObjectCollection findByCommentPostId(string $comment_post_ID) Return ChildWpComments objects filtered by the comment_post_ID column
 * @method     ChildWpComments[]|ObjectCollection findByCommentAuthor(string $comment_author) Return ChildWpComments objects filtered by the comment_author column
 * @method     ChildWpComments[]|ObjectCollection findByCommentAuthorEmail(string $comment_author_email) Return ChildWpComments objects filtered by the comment_author_email column
 * @method     ChildWpComments[]|ObjectCollection findByCommentAuthorUrl(string $comment_author_url) Return ChildWpComments objects filtered by the comment_author_url column
 * @method     ChildWpComments[]|ObjectCollection findByCommentAuthorIp(string $comment_author_IP) Return ChildWpComments objects filtered by the comment_author_IP column
 * @method     ChildWpComments[]|ObjectCollection findByCommentDate(string $comment_date) Return ChildWpComments objects filtered by the comment_date column
 * @method     ChildWpComments[]|ObjectCollection findByCommentDateGmt(string $comment_date_gmt) Return ChildWpComments objects filtered by the comment_date_gmt column
 * @method     ChildWpComments[]|ObjectCollection findByCommentContent(string $comment_content) Return ChildWpComments objects filtered by the comment_content column
 * @method     ChildWpComments[]|ObjectCollection findByCommentKarma(int $comment_karma) Return ChildWpComments objects filtered by the comment_karma column
 * @method     ChildWpComments[]|ObjectCollection findByCommentApproved(string $comment_approved) Return ChildWpComments objects filtered by the comment_approved column
 * @method     ChildWpComments[]|ObjectCollection findByCommentAgent(string $comment_agent) Return ChildWpComments objects filtered by the comment_agent column
 * @method     ChildWpComments[]|ObjectCollection findByCommentType(string $comment_type) Return ChildWpComments objects filtered by the comment_type column
 * @method     ChildWpComments[]|ObjectCollection findByCommentParent(string $comment_parent) Return ChildWpComments objects filtered by the comment_parent column
 * @method     ChildWpComments[]|ObjectCollection findByUserId(string $user_id) Return ChildWpComments objects filtered by the user_id column
 * @method     ChildWpComments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpCommentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpCommentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpComments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpCommentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpCommentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpCommentsQuery) {
            return $criteria;
        }
        $query = new ChildWpCommentsQuery();
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
     * @return ChildWpComments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpCommentsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpCommentsTableMap::DATABASE_NAME);
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
     * @return ChildWpComments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT comment_ID, comment_post_ID, comment_author, comment_author_email, comment_author_url, comment_author_IP, comment_date, comment_date_gmt, comment_content, comment_karma, comment_approved, comment_agent, comment_type, comment_parent, user_id FROM wp_comments WHERE comment_ID = :p0';
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
            /** @var ChildWpComments $obj */
            $obj = new ChildWpComments();
            $obj->hydrate($row);
            WpCommentsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpComments|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the comment_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentId(1234); // WHERE comment_ID = 1234
     * $query->filterByCommentId(array(12, 34)); // WHERE comment_ID IN (12, 34)
     * $query->filterByCommentId(array('min' => 12)); // WHERE comment_ID > 12
     * </code>
     *
     * @param     mixed $commentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentId($commentId = null, $comparison = null)
    {
        if (is_array($commentId)) {
            $useMinMax = false;
            if (isset($commentId['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $commentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentId['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $commentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $commentId, $comparison);
    }

    /**
     * Filter the query on the comment_post_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentPostId(1234); // WHERE comment_post_ID = 1234
     * $query->filterByCommentPostId(array(12, 34)); // WHERE comment_post_ID IN (12, 34)
     * $query->filterByCommentPostId(array('min' => 12)); // WHERE comment_post_ID > 12
     * </code>
     *
     * @param     mixed $commentPostId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentPostId($commentPostId = null, $comparison = null)
    {
        if (is_array($commentPostId)) {
            $useMinMax = false;
            if (isset($commentPostId['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_POST_ID, $commentPostId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentPostId['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_POST_ID, $commentPostId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_POST_ID, $commentPostId, $comparison);
    }

    /**
     * Filter the query on the comment_author column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentAuthor('fooValue');   // WHERE comment_author = 'fooValue'
     * $query->filterByCommentAuthor('%fooValue%'); // WHERE comment_author LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentAuthor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentAuthor($commentAuthor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentAuthor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentAuthor)) {
                $commentAuthor = str_replace('*', '%', $commentAuthor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_AUTHOR, $commentAuthor, $comparison);
    }

    /**
     * Filter the query on the comment_author_email column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentAuthorEmail('fooValue');   // WHERE comment_author_email = 'fooValue'
     * $query->filterByCommentAuthorEmail('%fooValue%'); // WHERE comment_author_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentAuthorEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentAuthorEmail($commentAuthorEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentAuthorEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentAuthorEmail)) {
                $commentAuthorEmail = str_replace('*', '%', $commentAuthorEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_AUTHOR_EMAIL, $commentAuthorEmail, $comparison);
    }

    /**
     * Filter the query on the comment_author_url column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentAuthorUrl('fooValue');   // WHERE comment_author_url = 'fooValue'
     * $query->filterByCommentAuthorUrl('%fooValue%'); // WHERE comment_author_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentAuthorUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentAuthorUrl($commentAuthorUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentAuthorUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentAuthorUrl)) {
                $commentAuthorUrl = str_replace('*', '%', $commentAuthorUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_AUTHOR_URL, $commentAuthorUrl, $comparison);
    }

    /**
     * Filter the query on the comment_author_IP column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentAuthorIp('fooValue');   // WHERE comment_author_IP = 'fooValue'
     * $query->filterByCommentAuthorIp('%fooValue%'); // WHERE comment_author_IP LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentAuthorIp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentAuthorIp($commentAuthorIp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentAuthorIp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentAuthorIp)) {
                $commentAuthorIp = str_replace('*', '%', $commentAuthorIp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_AUTHOR_IP, $commentAuthorIp, $comparison);
    }

    /**
     * Filter the query on the comment_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentDate('2011-03-14'); // WHERE comment_date = '2011-03-14'
     * $query->filterByCommentDate('now'); // WHERE comment_date = '2011-03-14'
     * $query->filterByCommentDate(array('max' => 'yesterday')); // WHERE comment_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $commentDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentDate($commentDate = null, $comparison = null)
    {
        if (is_array($commentDate)) {
            $useMinMax = false;
            if (isset($commentDate['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE, $commentDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentDate['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE, $commentDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE, $commentDate, $comparison);
    }

    /**
     * Filter the query on the comment_date_gmt column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentDateGmt('2011-03-14'); // WHERE comment_date_gmt = '2011-03-14'
     * $query->filterByCommentDateGmt('now'); // WHERE comment_date_gmt = '2011-03-14'
     * $query->filterByCommentDateGmt(array('max' => 'yesterday')); // WHERE comment_date_gmt > '2011-03-13'
     * </code>
     *
     * @param     mixed $commentDateGmt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentDateGmt($commentDateGmt = null, $comparison = null)
    {
        if (is_array($commentDateGmt)) {
            $useMinMax = false;
            if (isset($commentDateGmt['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE_GMT, $commentDateGmt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentDateGmt['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE_GMT, $commentDateGmt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_DATE_GMT, $commentDateGmt, $comparison);
    }

    /**
     * Filter the query on the comment_content column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentContent('fooValue');   // WHERE comment_content = 'fooValue'
     * $query->filterByCommentContent('%fooValue%'); // WHERE comment_content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentContent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentContent($commentContent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentContent)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentContent)) {
                $commentContent = str_replace('*', '%', $commentContent);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_CONTENT, $commentContent, $comparison);
    }

    /**
     * Filter the query on the comment_karma column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentKarma(1234); // WHERE comment_karma = 1234
     * $query->filterByCommentKarma(array(12, 34)); // WHERE comment_karma IN (12, 34)
     * $query->filterByCommentKarma(array('min' => 12)); // WHERE comment_karma > 12
     * </code>
     *
     * @param     mixed $commentKarma The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentKarma($commentKarma = null, $comparison = null)
    {
        if (is_array($commentKarma)) {
            $useMinMax = false;
            if (isset($commentKarma['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_KARMA, $commentKarma['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentKarma['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_KARMA, $commentKarma['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_KARMA, $commentKarma, $comparison);
    }

    /**
     * Filter the query on the comment_approved column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentApproved('fooValue');   // WHERE comment_approved = 'fooValue'
     * $query->filterByCommentApproved('%fooValue%'); // WHERE comment_approved LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentApproved The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentApproved($commentApproved = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentApproved)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentApproved)) {
                $commentApproved = str_replace('*', '%', $commentApproved);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_APPROVED, $commentApproved, $comparison);
    }

    /**
     * Filter the query on the comment_agent column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentAgent('fooValue');   // WHERE comment_agent = 'fooValue'
     * $query->filterByCommentAgent('%fooValue%'); // WHERE comment_agent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentAgent The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentAgent($commentAgent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentAgent)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentAgent)) {
                $commentAgent = str_replace('*', '%', $commentAgent);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_AGENT, $commentAgent, $comparison);
    }

    /**
     * Filter the query on the comment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentType('fooValue');   // WHERE comment_type = 'fooValue'
     * $query->filterByCommentType('%fooValue%'); // WHERE comment_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $commentType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentType($commentType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($commentType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $commentType)) {
                $commentType = str_replace('*', '%', $commentType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_TYPE, $commentType, $comparison);
    }

    /**
     * Filter the query on the comment_parent column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentParent(1234); // WHERE comment_parent = 1234
     * $query->filterByCommentParent(array(12, 34)); // WHERE comment_parent IN (12, 34)
     * $query->filterByCommentParent(array('min' => 12)); // WHERE comment_parent > 12
     * </code>
     *
     * @param     mixed $commentParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByCommentParent($commentParent = null, $comparison = null)
    {
        if (is_array($commentParent)) {
            $useMinMax = false;
            if (isset($commentParent['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_PARENT, $commentParent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentParent['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_PARENT, $commentParent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_PARENT, $commentParent, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WpCommentsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentsTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpComments $wpComments Object to remove from the list of results
     *
     * @return $this|ChildWpCommentsQuery The current query, for fluid interface
     */
    public function prune($wpComments = null)
    {
        if ($wpComments) {
            $this->addUsingAlias(WpCommentsTableMap::COL_COMMENT_ID, $wpComments->getCommentId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_comments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpCommentsTableMap::clearInstancePool();
            WpCommentsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpCommentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpCommentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpCommentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpCommentsQuery
