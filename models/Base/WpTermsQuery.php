<?php

namespace Base;

use \WpTerms as ChildWpTerms;
use \WpTermsQuery as ChildWpTermsQuery;
use \Exception;
use \PDO;
use Map\WpTermsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_terms' table.
 *
 *
 *
 * @method     ChildWpTermsQuery orderByTermId($order = Criteria::ASC) Order by the term_id column
 * @method     ChildWpTermsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildWpTermsQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     ChildWpTermsQuery orderByTermGroup($order = Criteria::ASC) Order by the term_group column
 *
 * @method     ChildWpTermsQuery groupByTermId() Group by the term_id column
 * @method     ChildWpTermsQuery groupByName() Group by the name column
 * @method     ChildWpTermsQuery groupBySlug() Group by the slug column
 * @method     ChildWpTermsQuery groupByTermGroup() Group by the term_group column
 *
 * @method     ChildWpTermsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpTermsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpTermsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpTermsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpTermsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpTermsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpTerms findOne(ConnectionInterface $con = null) Return the first ChildWpTerms matching the query
 * @method     ChildWpTerms findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpTerms matching the query, or a new ChildWpTerms object populated from the query conditions when no match is found
 *
 * @method     ChildWpTerms findOneByTermId(string $term_id) Return the first ChildWpTerms filtered by the term_id column
 * @method     ChildWpTerms findOneByName(string $name) Return the first ChildWpTerms filtered by the name column
 * @method     ChildWpTerms findOneBySlug(string $slug) Return the first ChildWpTerms filtered by the slug column
 * @method     ChildWpTerms findOneByTermGroup(string $term_group) Return the first ChildWpTerms filtered by the term_group column *

 * @method     ChildWpTerms requirePk($key, ConnectionInterface $con = null) Return the ChildWpTerms by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTerms requireOne(ConnectionInterface $con = null) Return the first ChildWpTerms matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTerms requireOneByTermId(string $term_id) Return the first ChildWpTerms filtered by the term_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTerms requireOneByName(string $name) Return the first ChildWpTerms filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTerms requireOneBySlug(string $slug) Return the first ChildWpTerms filtered by the slug column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTerms requireOneByTermGroup(string $term_group) Return the first ChildWpTerms filtered by the term_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTerms[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpTerms objects based on current ModelCriteria
 * @method     ChildWpTerms[]|ObjectCollection findByTermId(string $term_id) Return ChildWpTerms objects filtered by the term_id column
 * @method     ChildWpTerms[]|ObjectCollection findByName(string $name) Return ChildWpTerms objects filtered by the name column
 * @method     ChildWpTerms[]|ObjectCollection findBySlug(string $slug) Return ChildWpTerms objects filtered by the slug column
 * @method     ChildWpTerms[]|ObjectCollection findByTermGroup(string $term_group) Return ChildWpTerms objects filtered by the term_group column
 * @method     ChildWpTerms[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpTermsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpTermsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpTerms', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpTermsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpTermsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpTermsQuery) {
            return $criteria;
        }
        $query = new ChildWpTermsQuery();
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
     * @return ChildWpTerms|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpTermsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpTermsTableMap::DATABASE_NAME);
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
     * @return ChildWpTerms A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT term_id, name, slug, term_group FROM wp_terms WHERE term_id = :p0';
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
            /** @var ChildWpTerms $obj */
            $obj = new ChildWpTerms();
            $obj->hydrate($row);
            WpTermsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpTerms|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the term_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTermId(1234); // WHERE term_id = 1234
     * $query->filterByTermId(array(12, 34)); // WHERE term_id IN (12, 34)
     * $query->filterByTermId(array('min' => 12)); // WHERE term_id > 12
     * </code>
     *
     * @param     mixed $termId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterByTermId($termId = null, $comparison = null)
    {
        if (is_array($termId)) {
            $useMinMax = false;
            if (isset($termId['min'])) {
                $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $termId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termId['max'])) {
                $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $termId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $termId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpTermsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpTermsTableMap::COL_SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the term_group column
     *
     * Example usage:
     * <code>
     * $query->filterByTermGroup(1234); // WHERE term_group = 1234
     * $query->filterByTermGroup(array(12, 34)); // WHERE term_group IN (12, 34)
     * $query->filterByTermGroup(array('min' => 12)); // WHERE term_group > 12
     * </code>
     *
     * @param     mixed $termGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function filterByTermGroup($termGroup = null, $comparison = null)
    {
        if (is_array($termGroup)) {
            $useMinMax = false;
            if (isset($termGroup['min'])) {
                $this->addUsingAlias(WpTermsTableMap::COL_TERM_GROUP, $termGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termGroup['max'])) {
                $this->addUsingAlias(WpTermsTableMap::COL_TERM_GROUP, $termGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermsTableMap::COL_TERM_GROUP, $termGroup, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpTerms $wpTerms Object to remove from the list of results
     *
     * @return $this|ChildWpTermsQuery The current query, for fluid interface
     */
    public function prune($wpTerms = null)
    {
        if ($wpTerms) {
            $this->addUsingAlias(WpTermsTableMap::COL_TERM_ID, $wpTerms->getTermId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_terms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpTermsTableMap::clearInstancePool();
            WpTermsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpTermsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpTermsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpTermsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpTermsQuery
