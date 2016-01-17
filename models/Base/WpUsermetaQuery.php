<?php

namespace Base;

use \WpUsermeta as ChildWpUsermeta;
use \WpUsermetaQuery as ChildWpUsermetaQuery;
use \Exception;
use \PDO;
use Map\WpUsermetaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_usermeta' table.
 *
 *
 *
 * @method     ChildWpUsermetaQuery orderByUmetaId($order = Criteria::ASC) Order by the umeta_id column
 * @method     ChildWpUsermetaQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildWpUsermetaQuery orderByMetaKey($order = Criteria::ASC) Order by the meta_key column
 * @method     ChildWpUsermetaQuery orderByMetaValue($order = Criteria::ASC) Order by the meta_value column
 *
 * @method     ChildWpUsermetaQuery groupByUmetaId() Group by the umeta_id column
 * @method     ChildWpUsermetaQuery groupByUserId() Group by the user_id column
 * @method     ChildWpUsermetaQuery groupByMetaKey() Group by the meta_key column
 * @method     ChildWpUsermetaQuery groupByMetaValue() Group by the meta_value column
 *
 * @method     ChildWpUsermetaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpUsermetaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpUsermetaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpUsermetaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpUsermetaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpUsermetaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpUsermeta findOne(ConnectionInterface $con = null) Return the first ChildWpUsermeta matching the query
 * @method     ChildWpUsermeta findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpUsermeta matching the query, or a new ChildWpUsermeta object populated from the query conditions when no match is found
 *
 * @method     ChildWpUsermeta findOneByUmetaId(string $umeta_id) Return the first ChildWpUsermeta filtered by the umeta_id column
 * @method     ChildWpUsermeta findOneByUserId(string $user_id) Return the first ChildWpUsermeta filtered by the user_id column
 * @method     ChildWpUsermeta findOneByMetaKey(string $meta_key) Return the first ChildWpUsermeta filtered by the meta_key column
 * @method     ChildWpUsermeta findOneByMetaValue(string $meta_value) Return the first ChildWpUsermeta filtered by the meta_value column *

 * @method     ChildWpUsermeta requirePk($key, ConnectionInterface $con = null) Return the ChildWpUsermeta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsermeta requireOne(ConnectionInterface $con = null) Return the first ChildWpUsermeta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpUsermeta requireOneByUmetaId(string $umeta_id) Return the first ChildWpUsermeta filtered by the umeta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsermeta requireOneByUserId(string $user_id) Return the first ChildWpUsermeta filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsermeta requireOneByMetaKey(string $meta_key) Return the first ChildWpUsermeta filtered by the meta_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsermeta requireOneByMetaValue(string $meta_value) Return the first ChildWpUsermeta filtered by the meta_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpUsermeta[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpUsermeta objects based on current ModelCriteria
 * @method     ChildWpUsermeta[]|ObjectCollection findByUmetaId(string $umeta_id) Return ChildWpUsermeta objects filtered by the umeta_id column
 * @method     ChildWpUsermeta[]|ObjectCollection findByUserId(string $user_id) Return ChildWpUsermeta objects filtered by the user_id column
 * @method     ChildWpUsermeta[]|ObjectCollection findByMetaKey(string $meta_key) Return ChildWpUsermeta objects filtered by the meta_key column
 * @method     ChildWpUsermeta[]|ObjectCollection findByMetaValue(string $meta_value) Return ChildWpUsermeta objects filtered by the meta_value column
 * @method     ChildWpUsermeta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpUsermetaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpUsermetaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpUsermeta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpUsermetaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpUsermetaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpUsermetaQuery) {
            return $criteria;
        }
        $query = new ChildWpUsermetaQuery();
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
     * @return ChildWpUsermeta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpUsermetaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpUsermetaTableMap::DATABASE_NAME);
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
     * @return ChildWpUsermeta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT umeta_id, user_id, meta_key, meta_value FROM wp_usermeta WHERE umeta_id = :p0';
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
            /** @var ChildWpUsermeta $obj */
            $obj = new ChildWpUsermeta();
            $obj->hydrate($row);
            WpUsermetaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpUsermeta|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the umeta_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUmetaId(1234); // WHERE umeta_id = 1234
     * $query->filterByUmetaId(array(12, 34)); // WHERE umeta_id IN (12, 34)
     * $query->filterByUmetaId(array('min' => 12)); // WHERE umeta_id > 12
     * </code>
     *
     * @param     mixed $umetaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
     */
    public function filterByUmetaId($umetaId = null, $comparison = null)
    {
        if (is_array($umetaId)) {
            $useMinMax = false;
            if (isset($umetaId['min'])) {
                $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $umetaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($umetaId['max'])) {
                $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $umetaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $umetaId, $comparison);
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
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(WpUsermetaTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(WpUsermetaTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpUsermetaTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(WpUsermetaTableMap::COL_META_KEY, $metaKey, $comparison);
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
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(WpUsermetaTableMap::COL_META_VALUE, $metaValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpUsermeta $wpUsermeta Object to remove from the list of results
     *
     * @return $this|ChildWpUsermetaQuery The current query, for fluid interface
     */
    public function prune($wpUsermeta = null)
    {
        if ($wpUsermeta) {
            $this->addUsingAlias(WpUsermetaTableMap::COL_UMETA_ID, $wpUsermeta->getUmetaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_usermeta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsermetaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpUsermetaTableMap::clearInstancePool();
            WpUsermetaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsermetaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpUsermetaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpUsermetaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpUsermetaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpUsermetaQuery
