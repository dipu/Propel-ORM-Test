<?php

namespace Base;

use \WpTermRelationships as ChildWpTermRelationships;
use \WpTermRelationshipsQuery as ChildWpTermRelationshipsQuery;
use \Exception;
use \PDO;
use Map\WpTermRelationshipsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_term_relationships' table.
 *
 *
 *
 * @method     ChildWpTermRelationshipsQuery orderByObjectId($order = Criteria::ASC) Order by the object_id column
 * @method     ChildWpTermRelationshipsQuery orderByTermTaxonomyId($order = Criteria::ASC) Order by the term_taxonomy_id column
 * @method     ChildWpTermRelationshipsQuery orderByTermOrder($order = Criteria::ASC) Order by the term_order column
 *
 * @method     ChildWpTermRelationshipsQuery groupByObjectId() Group by the object_id column
 * @method     ChildWpTermRelationshipsQuery groupByTermTaxonomyId() Group by the term_taxonomy_id column
 * @method     ChildWpTermRelationshipsQuery groupByTermOrder() Group by the term_order column
 *
 * @method     ChildWpTermRelationshipsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpTermRelationshipsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpTermRelationshipsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpTermRelationshipsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpTermRelationshipsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpTermRelationshipsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpTermRelationships findOne(ConnectionInterface $con = null) Return the first ChildWpTermRelationships matching the query
 * @method     ChildWpTermRelationships findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpTermRelationships matching the query, or a new ChildWpTermRelationships object populated from the query conditions when no match is found
 *
 * @method     ChildWpTermRelationships findOneByObjectId(string $object_id) Return the first ChildWpTermRelationships filtered by the object_id column
 * @method     ChildWpTermRelationships findOneByTermTaxonomyId(string $term_taxonomy_id) Return the first ChildWpTermRelationships filtered by the term_taxonomy_id column
 * @method     ChildWpTermRelationships findOneByTermOrder(int $term_order) Return the first ChildWpTermRelationships filtered by the term_order column *

 * @method     ChildWpTermRelationships requirePk($key, ConnectionInterface $con = null) Return the ChildWpTermRelationships by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermRelationships requireOne(ConnectionInterface $con = null) Return the first ChildWpTermRelationships matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTermRelationships requireOneByObjectId(string $object_id) Return the first ChildWpTermRelationships filtered by the object_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermRelationships requireOneByTermTaxonomyId(string $term_taxonomy_id) Return the first ChildWpTermRelationships filtered by the term_taxonomy_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpTermRelationships requireOneByTermOrder(int $term_order) Return the first ChildWpTermRelationships filtered by the term_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpTermRelationships[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpTermRelationships objects based on current ModelCriteria
 * @method     ChildWpTermRelationships[]|ObjectCollection findByObjectId(string $object_id) Return ChildWpTermRelationships objects filtered by the object_id column
 * @method     ChildWpTermRelationships[]|ObjectCollection findByTermTaxonomyId(string $term_taxonomy_id) Return ChildWpTermRelationships objects filtered by the term_taxonomy_id column
 * @method     ChildWpTermRelationships[]|ObjectCollection findByTermOrder(int $term_order) Return ChildWpTermRelationships objects filtered by the term_order column
 * @method     ChildWpTermRelationships[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpTermRelationshipsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpTermRelationshipsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpTermRelationships', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpTermRelationshipsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpTermRelationshipsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpTermRelationshipsQuery) {
            return $criteria;
        }
        $query = new ChildWpTermRelationshipsQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$object_id, $term_taxonomy_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWpTermRelationships|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpTermRelationshipsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpTermRelationshipsTableMap::DATABASE_NAME);
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
     * @return ChildWpTermRelationships A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT object_id, term_taxonomy_id, term_order FROM wp_term_relationships WHERE object_id = :p0 AND term_taxonomy_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWpTermRelationships $obj */
            $obj = new ChildWpTermRelationships();
            $obj->hydrate($row);
            WpTermRelationshipsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildWpTermRelationships|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(WpTermRelationshipsTableMap::COL_OBJECT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(WpTermRelationshipsTableMap::COL_OBJECT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the object_id column
     *
     * Example usage:
     * <code>
     * $query->filterByObjectId(1234); // WHERE object_id = 1234
     * $query->filterByObjectId(array(12, 34)); // WHERE object_id IN (12, 34)
     * $query->filterByObjectId(array('min' => 12)); // WHERE object_id > 12
     * </code>
     *
     * @param     mixed $objectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function filterByObjectId($objectId = null, $comparison = null)
    {
        if (is_array($objectId)) {
            $useMinMax = false;
            if (isset($objectId['min'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_OBJECT_ID, $objectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objectId['max'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_OBJECT_ID, $objectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermRelationshipsTableMap::COL_OBJECT_ID, $objectId, $comparison);
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
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function filterByTermTaxonomyId($termTaxonomyId = null, $comparison = null)
    {
        if (is_array($termTaxonomyId)) {
            $useMinMax = false;
            if (isset($termTaxonomyId['min'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termTaxonomyId['max'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID, $termTaxonomyId, $comparison);
    }

    /**
     * Filter the query on the term_order column
     *
     * Example usage:
     * <code>
     * $query->filterByTermOrder(1234); // WHERE term_order = 1234
     * $query->filterByTermOrder(array(12, 34)); // WHERE term_order IN (12, 34)
     * $query->filterByTermOrder(array('min' => 12)); // WHERE term_order > 12
     * </code>
     *
     * @param     mixed $termOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function filterByTermOrder($termOrder = null, $comparison = null)
    {
        if (is_array($termOrder)) {
            $useMinMax = false;
            if (isset($termOrder['min'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_ORDER, $termOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($termOrder['max'])) {
                $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_ORDER, $termOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpTermRelationshipsTableMap::COL_TERM_ORDER, $termOrder, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpTermRelationships $wpTermRelationships Object to remove from the list of results
     *
     * @return $this|ChildWpTermRelationshipsQuery The current query, for fluid interface
     */
    public function prune($wpTermRelationships = null)
    {
        if ($wpTermRelationships) {
            $this->addCond('pruneCond0', $this->getAliasedColName(WpTermRelationshipsTableMap::COL_OBJECT_ID), $wpTermRelationships->getObjectId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(WpTermRelationshipsTableMap::COL_TERM_TAXONOMY_ID), $wpTermRelationships->getTermTaxonomyId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_term_relationships table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermRelationshipsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpTermRelationshipsTableMap::clearInstancePool();
            WpTermRelationshipsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpTermRelationshipsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpTermRelationshipsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpTermRelationshipsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpTermRelationshipsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpTermRelationshipsQuery
