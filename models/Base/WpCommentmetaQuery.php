<?php

namespace Base;

use \WpCommentmeta as ChildWpCommentmeta;
use \WpCommentmetaQuery as ChildWpCommentmetaQuery;
use \Exception;
use \PDO;
use Map\WpCommentmetaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_commentmeta' table.
 *
 *
 *
 * @method     ChildWpCommentmetaQuery orderByMetaId($order = Criteria::ASC) Order by the meta_id column
 * @method     ChildWpCommentmetaQuery orderByCommentId($order = Criteria::ASC) Order by the comment_id column
 * @method     ChildWpCommentmetaQuery orderByMetaKey($order = Criteria::ASC) Order by the meta_key column
 * @method     ChildWpCommentmetaQuery orderByMetaValue($order = Criteria::ASC) Order by the meta_value column
 *
 * @method     ChildWpCommentmetaQuery groupByMetaId() Group by the meta_id column
 * @method     ChildWpCommentmetaQuery groupByCommentId() Group by the comment_id column
 * @method     ChildWpCommentmetaQuery groupByMetaKey() Group by the meta_key column
 * @method     ChildWpCommentmetaQuery groupByMetaValue() Group by the meta_value column
 *
 * @method     ChildWpCommentmetaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpCommentmetaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpCommentmetaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpCommentmetaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpCommentmetaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpCommentmetaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpCommentmeta findOne(ConnectionInterface $con = null) Return the first ChildWpCommentmeta matching the query
 * @method     ChildWpCommentmeta findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpCommentmeta matching the query, or a new ChildWpCommentmeta object populated from the query conditions when no match is found
 *
 * @method     ChildWpCommentmeta findOneByMetaId(string $meta_id) Return the first ChildWpCommentmeta filtered by the meta_id column
 * @method     ChildWpCommentmeta findOneByCommentId(string $comment_id) Return the first ChildWpCommentmeta filtered by the comment_id column
 * @method     ChildWpCommentmeta findOneByMetaKey(string $meta_key) Return the first ChildWpCommentmeta filtered by the meta_key column
 * @method     ChildWpCommentmeta findOneByMetaValue(string $meta_value) Return the first ChildWpCommentmeta filtered by the meta_value column *

 * @method     ChildWpCommentmeta requirePk($key, ConnectionInterface $con = null) Return the ChildWpCommentmeta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpCommentmeta requireOne(ConnectionInterface $con = null) Return the first ChildWpCommentmeta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpCommentmeta requireOneByMetaId(string $meta_id) Return the first ChildWpCommentmeta filtered by the meta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpCommentmeta requireOneByCommentId(string $comment_id) Return the first ChildWpCommentmeta filtered by the comment_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpCommentmeta requireOneByMetaKey(string $meta_key) Return the first ChildWpCommentmeta filtered by the meta_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpCommentmeta requireOneByMetaValue(string $meta_value) Return the first ChildWpCommentmeta filtered by the meta_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpCommentmeta[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpCommentmeta objects based on current ModelCriteria
 * @method     ChildWpCommentmeta[]|ObjectCollection findByMetaId(string $meta_id) Return ChildWpCommentmeta objects filtered by the meta_id column
 * @method     ChildWpCommentmeta[]|ObjectCollection findByCommentId(string $comment_id) Return ChildWpCommentmeta objects filtered by the comment_id column
 * @method     ChildWpCommentmeta[]|ObjectCollection findByMetaKey(string $meta_key) Return ChildWpCommentmeta objects filtered by the meta_key column
 * @method     ChildWpCommentmeta[]|ObjectCollection findByMetaValue(string $meta_value) Return ChildWpCommentmeta objects filtered by the meta_value column
 * @method     ChildWpCommentmeta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpCommentmetaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpCommentmetaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpCommentmeta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpCommentmetaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpCommentmetaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpCommentmetaQuery) {
            return $criteria;
        }
        $query = new ChildWpCommentmetaQuery();
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
     * @return ChildWpCommentmeta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpCommentmetaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpCommentmetaTableMap::DATABASE_NAME);
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
     * @return ChildWpCommentmeta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT meta_id, comment_id, meta_key, meta_value FROM wp_commentmeta WHERE meta_id = :p0';
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
            /** @var ChildWpCommentmeta $obj */
            $obj = new ChildWpCommentmeta();
            $obj->hydrate($row);
            WpCommentmetaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpCommentmeta|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the meta_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaId(1234); // WHERE meta_id = 1234
     * $query->filterByMetaId(array(12, 34)); // WHERE meta_id IN (12, 34)
     * $query->filterByMetaId(array('min' => 12)); // WHERE meta_id > 12
     * </code>
     *
     * @param     mixed $metaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByMetaId($metaId = null, $comparison = null)
    {
        if (is_array($metaId)) {
            $useMinMax = false;
            if (isset($metaId['min'])) {
                $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $metaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($metaId['max'])) {
                $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $metaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $metaId, $comparison);
    }

    /**
     * Filter the query on the comment_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCommentId(1234); // WHERE comment_id = 1234
     * $query->filterByCommentId(array(12, 34)); // WHERE comment_id IN (12, 34)
     * $query->filterByCommentId(array('min' => 12)); // WHERE comment_id > 12
     * </code>
     *
     * @param     mixed $commentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByCommentId($commentId = null, $comparison = null)
    {
        if (is_array($commentId)) {
            $useMinMax = false;
            if (isset($commentId['min'])) {
                $this->addUsingAlias(WpCommentmetaTableMap::COL_COMMENT_ID, $commentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($commentId['max'])) {
                $this->addUsingAlias(WpCommentmetaTableMap::COL_COMMENT_ID, $commentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_COMMENT_ID, $commentId, $comparison);
    }

    /**
     * Filter the query on the meta_key column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaKey('fooValue');   // WHERE meta_key = 'fooValue'
     * $query->filterByMetaKey('%fooValue%'); // WHERE meta_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metaKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByMetaKey($metaKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metaKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $metaKey)) {
                $metaKey = str_replace('*', '%', $metaKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_META_KEY, $metaKey, $comparison);
    }

    /**
     * Filter the query on the meta_value column
     *
     * Example usage:
     * <code>
     * $query->filterByMetaValue('fooValue');   // WHERE meta_value = 'fooValue'
     * $query->filterByMetaValue('%fooValue%'); // WHERE meta_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $metaValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function filterByMetaValue($metaValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($metaValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $metaValue)) {
                $metaValue = str_replace('*', '%', $metaValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpCommentmetaTableMap::COL_META_VALUE, $metaValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpCommentmeta $wpCommentmeta Object to remove from the list of results
     *
     * @return $this|ChildWpCommentmetaQuery The current query, for fluid interface
     */
    public function prune($wpCommentmeta = null)
    {
        if ($wpCommentmeta) {
            $this->addUsingAlias(WpCommentmetaTableMap::COL_META_ID, $wpCommentmeta->getMetaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_commentmeta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentmetaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpCommentmetaTableMap::clearInstancePool();
            WpCommentmetaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpCommentmetaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpCommentmetaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpCommentmetaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpCommentmetaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpCommentmetaQuery
