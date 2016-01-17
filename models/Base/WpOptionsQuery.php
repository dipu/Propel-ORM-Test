<?php

namespace Base;

use \WpOptions as ChildWpOptions;
use \WpOptionsQuery as ChildWpOptionsQuery;
use \Exception;
use \PDO;
use Map\WpOptionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_options' table.
 *
 *
 *
 * @method     ChildWpOptionsQuery orderByOptionId($order = Criteria::ASC) Order by the option_id column
 * @method     ChildWpOptionsQuery orderByOptionName($order = Criteria::ASC) Order by the option_name column
 * @method     ChildWpOptionsQuery orderByOptionValue($order = Criteria::ASC) Order by the option_value column
 * @method     ChildWpOptionsQuery orderByAutoload($order = Criteria::ASC) Order by the autoload column
 *
 * @method     ChildWpOptionsQuery groupByOptionId() Group by the option_id column
 * @method     ChildWpOptionsQuery groupByOptionName() Group by the option_name column
 * @method     ChildWpOptionsQuery groupByOptionValue() Group by the option_value column
 * @method     ChildWpOptionsQuery groupByAutoload() Group by the autoload column
 *
 * @method     ChildWpOptionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpOptionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpOptionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpOptionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpOptionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpOptionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpOptions findOne(ConnectionInterface $con = null) Return the first ChildWpOptions matching the query
 * @method     ChildWpOptions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpOptions matching the query, or a new ChildWpOptions object populated from the query conditions when no match is found
 *
 * @method     ChildWpOptions findOneByOptionId(string $option_id) Return the first ChildWpOptions filtered by the option_id column
 * @method     ChildWpOptions findOneByOptionName(string $option_name) Return the first ChildWpOptions filtered by the option_name column
 * @method     ChildWpOptions findOneByOptionValue(string $option_value) Return the first ChildWpOptions filtered by the option_value column
 * @method     ChildWpOptions findOneByAutoload(string $autoload) Return the first ChildWpOptions filtered by the autoload column *

 * @method     ChildWpOptions requirePk($key, ConnectionInterface $con = null) Return the ChildWpOptions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpOptions requireOne(ConnectionInterface $con = null) Return the first ChildWpOptions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpOptions requireOneByOptionId(string $option_id) Return the first ChildWpOptions filtered by the option_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpOptions requireOneByOptionName(string $option_name) Return the first ChildWpOptions filtered by the option_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpOptions requireOneByOptionValue(string $option_value) Return the first ChildWpOptions filtered by the option_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpOptions requireOneByAutoload(string $autoload) Return the first ChildWpOptions filtered by the autoload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpOptions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpOptions objects based on current ModelCriteria
 * @method     ChildWpOptions[]|ObjectCollection findByOptionId(string $option_id) Return ChildWpOptions objects filtered by the option_id column
 * @method     ChildWpOptions[]|ObjectCollection findByOptionName(string $option_name) Return ChildWpOptions objects filtered by the option_name column
 * @method     ChildWpOptions[]|ObjectCollection findByOptionValue(string $option_value) Return ChildWpOptions objects filtered by the option_value column
 * @method     ChildWpOptions[]|ObjectCollection findByAutoload(string $autoload) Return ChildWpOptions objects filtered by the autoload column
 * @method     ChildWpOptions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpOptionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpOptionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpOptions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpOptionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpOptionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpOptionsQuery) {
            return $criteria;
        }
        $query = new ChildWpOptionsQuery();
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
     * @return ChildWpOptions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpOptionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpOptionsTableMap::DATABASE_NAME);
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
     * @return ChildWpOptions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT option_id, option_name, option_value, autoload FROM wp_options WHERE option_id = :p0';
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
            /** @var ChildWpOptions $obj */
            $obj = new ChildWpOptions();
            $obj->hydrate($row);
            WpOptionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpOptions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the option_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOptionId(1234); // WHERE option_id = 1234
     * $query->filterByOptionId(array(12, 34)); // WHERE option_id IN (12, 34)
     * $query->filterByOptionId(array('min' => 12)); // WHERE option_id > 12
     * </code>
     *
     * @param     mixed $optionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByOptionId($optionId = null, $comparison = null)
    {
        if (is_array($optionId)) {
            $useMinMax = false;
            if (isset($optionId['min'])) {
                $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $optionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($optionId['max'])) {
                $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $optionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $optionId, $comparison);
    }

    /**
     * Filter the query on the option_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOptionName('fooValue');   // WHERE option_name = 'fooValue'
     * $query->filterByOptionName('%fooValue%'); // WHERE option_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $optionName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByOptionName($optionName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($optionName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $optionName)) {
                $optionName = str_replace('*', '%', $optionName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_NAME, $optionName, $comparison);
    }

    /**
     * Filter the query on the option_value column
     *
     * Example usage:
     * <code>
     * $query->filterByOptionValue('fooValue');   // WHERE option_value = 'fooValue'
     * $query->filterByOptionValue('%fooValue%'); // WHERE option_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $optionValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByOptionValue($optionValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($optionValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $optionValue)) {
                $optionValue = str_replace('*', '%', $optionValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_VALUE, $optionValue, $comparison);
    }

    /**
     * Filter the query on the autoload column
     *
     * Example usage:
     * <code>
     * $query->filterByAutoload('fooValue');   // WHERE autoload = 'fooValue'
     * $query->filterByAutoload('%fooValue%'); // WHERE autoload LIKE '%fooValue%'
     * </code>
     *
     * @param     string $autoload The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function filterByAutoload($autoload = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($autoload)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $autoload)) {
                $autoload = str_replace('*', '%', $autoload);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpOptionsTableMap::COL_AUTOLOAD, $autoload, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpOptions $wpOptions Object to remove from the list of results
     *
     * @return $this|ChildWpOptionsQuery The current query, for fluid interface
     */
    public function prune($wpOptions = null)
    {
        if ($wpOptions) {
            $this->addUsingAlias(WpOptionsTableMap::COL_OPTION_ID, $wpOptions->getOptionId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_options table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpOptionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpOptionsTableMap::clearInstancePool();
            WpOptionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpOptionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpOptionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpOptionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpOptionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpOptionsQuery
