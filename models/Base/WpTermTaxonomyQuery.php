<?php

namespace Base;

use \WpTermTaxonomy as ChildWpTermTaxonomy;
use \WpTermTaxonomyQuery as ChildWpTermTaxonomyQuery;
use \Exception;
use \PDO;
use Map\WpTermTaxonomyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_term_taxonomy' table.
 *
 *
 *
 * @method     ChildWpTermTaxonomyQuery orderByTermTaxonomyId($order = Criteria::ASC) Order by the term_taxonomy_id column
 * @method     ChildWpTermTaxonomyQuery orderByTermId($order = Criteria::ASC) Order by the term_id column
 * @method     ChildWpTermTaxonomyQuery orderByTaxonomy($order = Criteria::ASC) Order by the taxonomy column
 * @method     ChildWpTermTaxonomyQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildWpTermTaxonomyQuery orderByParent($order = Criteria::ASC) Order by the parent column
 * @method     ChildWpTermTaxonomyQuery orderByCount($order = Criteria::ASC) Order by the count column
 *
 * @method     ChildWpTermTaxonomyQuery groupByTermTaxonomyId() Group by the term_taxonomy_id column
 * @method     ChildWpTermTaxonomyQuery groupByTermId() Group by the term_id column
 * @method     ChildWpTermTaxonomyQuery groupByTaxonomy() Group by the taxonomy column
 * @method     ChildWpTermTaxonomyQuery groupByDescription() Group by the description column
 * @method     ChildWpTermTaxonomyQuery groupByParent() Group by the parent column
 * @method     ChildWpTermTaxonomyQuery groupByCount() Group by the count column
 *
 * @method     ChildWpTermTaxonomyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpTermTaxonomyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpTermTaxonomyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpTermTaxonomyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpTermTaxonomyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpTermTaxonomyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpTermTaxonomy findOne(ConnectionInterface $con = null) Return the first ChildWpTermTaxonomy matching the query
 * @method     ChildWpTermTaxonomy findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpTermTaxonomy matching the query, or a new ChildWpTermTaxonomy object populated from the query conditions when no match is found
 *
 * @method     ChildWpTermTaxonomy findOneByTermTaxonomyId(string $term_taxonomy_id) Return the first ChildWpTermTaxonomy filtered by the term_taxonomy_id column
 * @method     ChildWpTermTaxonomy findOneByTermId(string $term_id) Return the first ChildWpTermTaxonomy filtered by the term_id column
 * @method     ChildWpTermTaxonomy findOneByTaxonomy(string $taxonomy) Return the first ChildWpTermTaxonomy filtered by the taxonomy column
 * @method     ChildWpTermTaxonomy findOneByDescription(string $description) Return the first ChildWpTermTaxonomy filtered by the description column
 * @method     ChildWpTermTaxonomy findOneByParent(string $parent) Return the first ChildWpTermTaxonomy filtered by the parent column
 * @method     ChildWpTermTaxonomy findOneByCount(string $count) Return the first ChildWpTermTaxonomy filtered by the count column *

 * @method     ChildWpTermTaxonomy requirePk($key, ConnectionInterface $con = null) Return the ChildWpTermTaxonomy by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOne(ConnectionInterface $con = null) Return the first ChildWpTermTaxonomy matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTermTaxonomy requireOneByTermTaxonomyId(string $term_taxonomy_id) Return the first ChildWpTermTaxonomy filtered by the term_taxonomy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOneByTermId(string $term_id) Return the first ChildWpTermTaxonomy filtered by the term_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOneByTaxonomy(string $taxonomy) Return the first ChildWpTermTaxonomy filtered by the taxonomy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOneByDescription(string $description) Return the first ChildWpTermTaxonomy filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOneByParent(string $parent) Return the first ChildWpTermTaxonomy filtered by the parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermTaxonomy requireOneByCount(string $count) Return the first ChildWpTermTaxonomy filtered by the count column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTermTaxonomy[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpTermTaxonomy objects based on current ModelCriteria
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByTermTaxonomyId(string $term_taxonomy_id) Return ChildWpTermTaxonomy objects filtered by the term_taxonomy_id column
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByTermId(string $term_id) Return ChildWpTermTaxonomy objects filtered by the term_id column
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByTaxonomy(string $taxonomy) Return ChildWpTermTaxonomy objects filtered by the taxonomy column
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByDescription(string $description) Return ChildWpTermTaxonomy objects filtered by the description column
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByParent(string $parent) Return ChildWpTermTaxonomy objects filtered by the parent column
 * @method     ChildWpTermTaxonomy[]|ObjectCollection findByCount(string $count) Return ChildWpTermTaxonomy objects filtered by the count column
 * @method     ChildWpTermTaxonomy[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpTermTaxonomyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpTermTaxonomyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpTermTaxonomy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpTermTaxonomyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpTermTaxonomyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpTermTaxonomyQuery) {
            return $criteria;
        }
        $query = new ChildWpTermTaxonomyQuery();
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
     * @return ChildWpTermTaxonomy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpTermTaxonomyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpTermTaxonomyTableMap::DATABASE_NAME);
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
     * @return ChildWpTermTaxonomy A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT term_taxonomy_id, term_id, taxonomy, description, parent, count FROM wp_term_taxonomy WHERE term_taxonomy_id = :p0';
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
            /** @var ChildWpTermTaxonomy $obj */
            $obj = new ChildWpTermTaxonomy();
            $obj->hydrate($row);
            WpTermTaxonomyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpTermTaxonomy|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the term_taxonomy_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTermTaxonomyId(1234); // WHERE term_taxonomy_id = 1234
     * $query->filterByTermTaxonomyId(array(12, 34)); // WHERE term_taxonomy_id IN (12, 34)
     * $query->filterByTermTaxonomyId(array('min' => 12)); // WHERE term_taxonomy_id > 12
     * </code>
     *
     * @param     mixed $termTaxonomyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByTermTaxonomyId($termTaxonomyId = null, $comparison = null)
    {
        if (is_array($termTaxonomyId)) {
            $useMinMax = false;
            if (isset($termTaxonomyId['min'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termTaxonomyId['max'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId, $comparison);
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
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByTermId($termId = null, $comparison = null)
    {
        if (is_array($termId)) {
            $useMinMax = false;
            if (isset($termId['min'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_ID, $termId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termId['max'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_ID, $termId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_ID, $termId, $comparison);
    }

    /**
     * Filter the query on the taxonomy column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxonomy('fooValue');   // WHERE taxonomy = 'fooValue'
     * $query->filterByTaxonomy('%fooValue%'); // WHERE taxonomy LIKE '%fooValue%'
     * </code>
     *
     * @param     string $taxonomy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByTaxonomy($taxonomy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taxonomy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $taxonomy)) {
                $taxonomy = str_replace('*', '%', $taxonomy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TAXONOMY, $taxonomy, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the parent column
     *
     * Example usage:
     * <code>
     * $query->filterByParent(1234); // WHERE parent = 1234
     * $query->filterByParent(array(12, 34)); // WHERE parent IN (12, 34)
     * $query->filterByParent(array('min' => 12)); // WHERE parent > 12
     * </code>
     *
     * @param     mixed $parent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByParent($parent = null, $comparison = null)
    {
        if (is_array($parent)) {
            $useMinMax = false;
            if (isset($parent['min'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_PARENT, $parent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parent['max'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_PARENT, $parent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_PARENT, $parent, $comparison);
    }

    /**
     * Filter the query on the count column
     *
     * Example usage:
     * <code>
     * $query->filterByCount(1234); // WHERE count = 1234
     * $query->filterByCount(array(12, 34)); // WHERE count IN (12, 34)
     * $query->filterByCount(array('min' => 12)); // WHERE count > 12
     * </code>
     *
     * @param     mixed $count The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function filterByCount($count = null, $comparison = null)
    {
        if (is_array($count)) {
            $useMinMax = false;
            if (isset($count['min'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_COUNT, $count['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($count['max'])) {
                $this->addUsingAlias(WpTermTaxonomyTableMap::COL_COUNT, $count['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermTaxonomyTableMap::COL_COUNT, $count, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpTermTaxonomy $wpTermTaxonomy Object to remove from the list of results
     *
     * @return $this|ChildWpTermTaxonomyQuery The current query, for fluid interface
     */
    public function prune($wpTermTaxonomy = null)
    {
        if ($wpTermTaxonomy) {
            $this->addUsingAlias(WpTermTaxonomyTableMap::COL_TERM_TAXONOMY_ID, $wpTermTaxonomy->getTermTaxonomyId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_term_taxonomy table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermTaxonomyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpTermTaxonomyTableMap::clearInstancePool();
            WpTermTaxonomyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermTaxonomyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpTermTaxonomyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpTermTaxonomyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpTermTaxonomyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpTermTaxonomyQuery
