<?php

namespace Base;

use \WpPostmeta as ChildWpPostmeta;
use \WpPostmetaQuery as ChildWpPostmetaQuery;
use \Exception;
use \PDO;
use Map\WpPostmetaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_postmeta' table.
 *
 *
 *
 * @method     ChildWpPostmetaQuery orderByMetaId($order = Criteria::ASC) Order by the meta_id column
 * @method     ChildWpPostmetaQuery orderByPostId($order = Criteria::ASC) Order by the post_id column
 * @method     ChildWpPostmetaQuery orderByMetaKey($order = Criteria::ASC) Order by the meta_key column
 * @method     ChildWpPostmetaQuery orderByMetaValue($order = Criteria::ASC) Order by the meta_value column
 *
 * @method     ChildWpPostmetaQuery groupByMetaId() Group by the meta_id column
 * @method     ChildWpPostmetaQuery groupByPostId() Group by the post_id column
 * @method     ChildWpPostmetaQuery groupByMetaKey() Group by the meta_key column
 * @method     ChildWpPostmetaQuery groupByMetaValue() Group by the meta_value column
 *
 * @method     ChildWpPostmetaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpPostmetaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpPostmetaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpPostmetaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpPostmetaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpPostmetaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpPostmeta findOne(ConnectionInterface $con = null) Return the first ChildWpPostmeta matching the query
 * @method     ChildWpPostmeta findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpPostmeta matching the query, or a new ChildWpPostmeta object populated from the query conditions when no match is found
 *
 * @method     ChildWpPostmeta findOneByMetaId(string $meta_id) Return the first ChildWpPostmeta filtered by the meta_id column
 * @method     ChildWpPostmeta findOneByPostId(string $post_id) Return the first ChildWpPostmeta filtered by the post_id column
 * @method     ChildWpPostmeta findOneByMetaKey(string $meta_key) Return the first ChildWpPostmeta filtered by the meta_key column
 * @method     ChildWpPostmeta findOneByMetaValue(string $meta_value) Return the first ChildWpPostmeta filtered by the meta_value column *

 * @method     ChildWpPostmeta requirePk($key, ConnectionInterface $con = null) Return the ChildWpPostmeta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPostmeta requireOne(ConnectionInterface $con = null) Return the first ChildWpPostmeta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpPostmeta requireOneByMetaId(string $meta_id) Return the first ChildWpPostmeta filtered by the meta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPostmeta requireOneByPostId(string $post_id) Return the first ChildWpPostmeta filtered by the post_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPostmeta requireOneByMetaKey(string $meta_key) Return the first ChildWpPostmeta filtered by the meta_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpPostmeta requireOneByMetaValue(string $meta_value) Return the first ChildWpPostmeta filtered by the meta_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpPostmeta[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpPostmeta objects based on current ModelCriteria
 * @method     ChildWpPostmeta[]|ObjectCollection findByMetaId(string $meta_id) Return ChildWpPostmeta objects filtered by the meta_id column
 * @method     ChildWpPostmeta[]|ObjectCollection findByPostId(string $post_id) Return ChildWpPostmeta objects filtered by the post_id column
 * @method     ChildWpPostmeta[]|ObjectCollection findByMetaKey(string $meta_key) Return ChildWpPostmeta objects filtered by the meta_key column
 * @method     ChildWpPostmeta[]|ObjectCollection findByMetaValue(string $meta_value) Return ChildWpPostmeta objects filtered by the meta_value column
 * @method     ChildWpPostmeta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpPostmetaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpPostmetaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpPostmeta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpPostmetaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpPostmetaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpPostmetaQuery) {
            return $criteria;
        }
        $query = new ChildWpPostmetaQuery();
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
     * @return ChildWpPostmeta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpPostmetaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpPostmetaTableMap::DATABASE_NAME);
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
     * @return ChildWpPostmeta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT meta_id, post_id, meta_key, meta_value FROM wp_postmeta WHERE meta_id = :p0';
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
            /** @var ChildWpPostmeta $obj */
            $obj = new ChildWpPostmeta();
            $obj->hydrate($row);
            WpPostmetaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpPostmeta|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
     */
    public function filterByMetaId($metaId = null, $comparison = null)
    {
        if (is_array($metaId)) {
            $useMinMax = false;
            if (isset($metaId['min'])) {
                $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $metaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($metaId['max'])) {
                $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $metaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $metaId, $comparison);
    }

    /**
     * Filter the query on the post_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPostId(1234); // WHERE post_id = 1234
     * $query->filterByPostId(array(12, 34)); // WHERE post_id IN (12, 34)
     * $query->filterByPostId(array('min' => 12)); // WHERE post_id > 12
     * </code>
     *
     * @param     mixed $postId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
     */
    public function filterByPostId($postId = null, $comparison = null)
    {
        if (is_array($postId)) {
            $useMinMax = false;
            if (isset($postId['min'])) {
                $this->addUsingAlias(WpPostmetaTableMap::COL_POST_ID, $postId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postId['max'])) {
                $this->addUsingAlias(WpPostmetaTableMap::COL_POST_ID, $postId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpPostmetaTableMap::COL_POST_ID, $postId, $comparison);
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
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(WpPostmetaTableMap::COL_META_KEY, $metaKey, $comparison);
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
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(WpPostmetaTableMap::COL_META_VALUE, $metaValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpPostmeta $wpPostmeta Object to remove from the list of results
     *
     * @return $this|ChildWpPostmetaQuery The current query, for fluid interface
     */
    public function prune($wpPostmeta = null)
    {
        if ($wpPostmeta) {
            $this->addUsingAlias(WpPostmetaTableMap::COL_META_ID, $wpPostmeta->getMetaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_postmeta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostmetaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpPostmetaTableMap::clearInstancePool();
            WpPostmetaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostmetaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpPostmetaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpPostmetaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpPostmetaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpPostmetaQuery
