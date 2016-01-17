<?php

namespace Base;

use \WpUsers as ChildWpUsers;
use \WpUsersQuery as ChildWpUsersQuery;
use \Exception;
use \PDO;
use Map\WpUsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'wp_users' table.
 *
 *
 *
 * @method     ChildWpUsersQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildWpUsersQuery orderByUserLogin($order = Criteria::ASC) Order by the user_login column
 * @method     ChildWpUsersQuery orderByUserPass($order = Criteria::ASC) Order by the user_pass column
 * @method     ChildWpUsersQuery orderByUserNicename($order = Criteria::ASC) Order by the user_nicename column
 * @method     ChildWpUsersQuery orderByUserEmail($order = Criteria::ASC) Order by the user_email column
 * @method     ChildWpUsersQuery orderByUserUrl($order = Criteria::ASC) Order by the user_url column
 * @method     ChildWpUsersQuery orderByUserRegistered($order = Criteria::ASC) Order by the user_registered column
 * @method     ChildWpUsersQuery orderByUserActivationKey($order = Criteria::ASC) Order by the user_activation_key column
 * @method     ChildWpUsersQuery orderByUserStatus($order = Criteria::ASC) Order by the user_status column
 * @method     ChildWpUsersQuery orderByDisplayName($order = Criteria::ASC) Order by the display_name column
 *
 * @method     ChildWpUsersQuery groupById() Group by the ID column
 * @method     ChildWpUsersQuery groupByUserLogin() Group by the user_login column
 * @method     ChildWpUsersQuery groupByUserPass() Group by the user_pass column
 * @method     ChildWpUsersQuery groupByUserNicename() Group by the user_nicename column
 * @method     ChildWpUsersQuery groupByUserEmail() Group by the user_email column
 * @method     ChildWpUsersQuery groupByUserUrl() Group by the user_url column
 * @method     ChildWpUsersQuery groupByUserRegistered() Group by the user_registered column
 * @method     ChildWpUsersQuery groupByUserActivationKey() Group by the user_activation_key column
 * @method     ChildWpUsersQuery groupByUserStatus() Group by the user_status column
 * @method     ChildWpUsersQuery groupByDisplayName() Group by the display_name column
 *
 * @method     ChildWpUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWpUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWpUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWpUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWpUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWpUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWpUsers findOne(ConnectionInterface $con = null) Return the first ChildWpUsers matching the query
 * @method     ChildWpUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWpUsers matching the query, or a new ChildWpUsers object populated from the query conditions when no match is found
 *
 * @method     ChildWpUsers findOneById(string $ID) Return the first ChildWpUsers filtered by the ID column
 * @method     ChildWpUsers findOneByUserLogin(string $user_login) Return the first ChildWpUsers filtered by the user_login column
 * @method     ChildWpUsers findOneByUserPass(string $user_pass) Return the first ChildWpUsers filtered by the user_pass column
 * @method     ChildWpUsers findOneByUserNicename(string $user_nicename) Return the first ChildWpUsers filtered by the user_nicename column
 * @method     ChildWpUsers findOneByUserEmail(string $user_email) Return the first ChildWpUsers filtered by the user_email column
 * @method     ChildWpUsers findOneByUserUrl(string $user_url) Return the first ChildWpUsers filtered by the user_url column
 * @method     ChildWpUsers findOneByUserRegistered(string $user_registered) Return the first ChildWpUsers filtered by the user_registered column
 * @method     ChildWpUsers findOneByUserActivationKey(string $user_activation_key) Return the first ChildWpUsers filtered by the user_activation_key column
 * @method     ChildWpUsers findOneByUserStatus(int $user_status) Return the first ChildWpUsers filtered by the user_status column
 * @method     ChildWpUsers findOneByDisplayName(string $display_name) Return the first ChildWpUsers filtered by the display_name column *

 * @method     ChildWpUsers requirePk($key, ConnectionInterface $con = null) Return the ChildWpUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOne(ConnectionInterface $con = null) Return the first ChildWpUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpUsers requireOneById(string $ID) Return the first ChildWpUsers filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserLogin(string $user_login) Return the first ChildWpUsers filtered by the user_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserPass(string $user_pass) Return the first ChildWpUsers filtered by the user_pass column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserNicename(string $user_nicename) Return the first ChildWpUsers filtered by the user_nicename column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserEmail(string $user_email) Return the first ChildWpUsers filtered by the user_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserUrl(string $user_url) Return the first ChildWpUsers filtered by the user_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserRegistered(string $user_registered) Return the first ChildWpUsers filtered by the user_registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserActivationKey(string $user_activation_key) Return the first ChildWpUsers filtered by the user_activation_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByUserStatus(int $user_status) Return the first ChildWpUsers filtered by the user_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWpUsers requireOneByDisplayName(string $display_name) Return the first ChildWpUsers filtered by the display_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWpUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWpUsers objects based on current ModelCriteria
 * @method     ChildWpUsers[]|ObjectCollection findById(string $ID) Return ChildWpUsers objects filtered by the ID column
 * @method     ChildWpUsers[]|ObjectCollection findByUserLogin(string $user_login) Return ChildWpUsers objects filtered by the user_login column
 * @method     ChildWpUsers[]|ObjectCollection findByUserPass(string $user_pass) Return ChildWpUsers objects filtered by the user_pass column
 * @method     ChildWpUsers[]|ObjectCollection findByUserNicename(string $user_nicename) Return ChildWpUsers objects filtered by the user_nicename column
 * @method     ChildWpUsers[]|ObjectCollection findByUserEmail(string $user_email) Return ChildWpUsers objects filtered by the user_email column
 * @method     ChildWpUsers[]|ObjectCollection findByUserUrl(string $user_url) Return ChildWpUsers objects filtered by the user_url column
 * @method     ChildWpUsers[]|ObjectCollection findByUserRegistered(string $user_registered) Return ChildWpUsers objects filtered by the user_registered column
 * @method     ChildWpUsers[]|ObjectCollection findByUserActivationKey(string $user_activation_key) Return ChildWpUsers objects filtered by the user_activation_key column
 * @method     ChildWpUsers[]|ObjectCollection findByUserStatus(int $user_status) Return ChildWpUsers objects filtered by the user_status column
 * @method     ChildWpUsers[]|ObjectCollection findByDisplayName(string $display_name) Return ChildWpUsers objects filtered by the display_name column
 * @method     ChildWpUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WpUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\WpUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'wordpress', $modelName = '\\WpUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWpUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWpUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWpUsersQuery) {
            return $criteria;
        }
        $query = new ChildWpUsersQuery();
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
     * @return ChildWpUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = WpUsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpUsersTableMap::DATABASE_NAME);
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
     * @return ChildWpUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, user_activation_key, user_status, display_name FROM wp_users WHERE ID = :p0';
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
            /** @var ChildWpUsers $obj */
            $obj = new ChildWpUsers();
            $obj->hydrate($row);
            WpUsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWpUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WpUsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WpUsersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_login column
     *
     * Example usage:
     * <code>
     * $query->filterByUserLogin('fooValue');   // WHERE user_login = 'fooValue'
     * $query->filterByUserLogin('%fooValue%'); // WHERE user_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userLogin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserLogin($userLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userLogin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userLogin)) {
                $userLogin = str_replace('*', '%', $userLogin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_LOGIN, $userLogin, $comparison);
    }

    /**
     * Filter the query on the user_pass column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPass('fooValue');   // WHERE user_pass = 'fooValue'
     * $query->filterByUserPass('%fooValue%'); // WHERE user_pass LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userPass The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserPass($userPass = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userPass)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userPass)) {
                $userPass = str_replace('*', '%', $userPass);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_PASS, $userPass, $comparison);
    }

    /**
     * Filter the query on the user_nicename column
     *
     * Example usage:
     * <code>
     * $query->filterByUserNicename('fooValue');   // WHERE user_nicename = 'fooValue'
     * $query->filterByUserNicename('%fooValue%'); // WHERE user_nicename LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userNicename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserNicename($userNicename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userNicename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userNicename)) {
                $userNicename = str_replace('*', '%', $userNicename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_NICENAME, $userNicename, $comparison);
    }

    /**
     * Filter the query on the user_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUserEmail('fooValue');   // WHERE user_email = 'fooValue'
     * $query->filterByUserEmail('%fooValue%'); // WHERE user_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserEmail($userEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userEmail)) {
                $userEmail = str_replace('*', '%', $userEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_EMAIL, $userEmail, $comparison);
    }

    /**
     * Filter the query on the user_url column
     *
     * Example usage:
     * <code>
     * $query->filterByUserUrl('fooValue');   // WHERE user_url = 'fooValue'
     * $query->filterByUserUrl('%fooValue%'); // WHERE user_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserUrl($userUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userUrl)) {
                $userUrl = str_replace('*', '%', $userUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_URL, $userUrl, $comparison);
    }

    /**
     * Filter the query on the user_registered column
     *
     * Example usage:
     * <code>
     * $query->filterByUserRegistered('2011-03-14'); // WHERE user_registered = '2011-03-14'
     * $query->filterByUserRegistered('now'); // WHERE user_registered = '2011-03-14'
     * $query->filterByUserRegistered(array('max' => 'yesterday')); // WHERE user_registered > '2011-03-13'
     * </code>
     *
     * @param     mixed $userRegistered The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserRegistered($userRegistered = null, $comparison = null)
    {
        if (is_array($userRegistered)) {
            $useMinMax = false;
            if (isset($userRegistered['min'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_USER_REGISTERED, $userRegistered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userRegistered['max'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_USER_REGISTERED, $userRegistered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_REGISTERED, $userRegistered, $comparison);
    }

    /**
     * Filter the query on the user_activation_key column
     *
     * Example usage:
     * <code>
     * $query->filterByUserActivationKey('fooValue');   // WHERE user_activation_key = 'fooValue'
     * $query->filterByUserActivationKey('%fooValue%'); // WHERE user_activation_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userActivationKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserActivationKey($userActivationKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userActivationKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userActivationKey)) {
                $userActivationKey = str_replace('*', '%', $userActivationKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_ACTIVATION_KEY, $userActivationKey, $comparison);
    }

    /**
     * Filter the query on the user_status column
     *
     * Example usage:
     * <code>
     * $query->filterByUserStatus(1234); // WHERE user_status = 1234
     * $query->filterByUserStatus(array(12, 34)); // WHERE user_status IN (12, 34)
     * $query->filterByUserStatus(array('min' => 12)); // WHERE user_status > 12
     * </code>
     *
     * @param     mixed $userStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByUserStatus($userStatus = null, $comparison = null)
    {
        if (is_array($userStatus)) {
            $useMinMax = false;
            if (isset($userStatus['min'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_USER_STATUS, $userStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userStatus['max'])) {
                $this->addUsingAlias(WpUsersTableMap::COL_USER_STATUS, $userStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_USER_STATUS, $userStatus, $comparison);
    }

    /**
     * Filter the query on the display_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayName('fooValue');   // WHERE display_name = 'fooValue'
     * $query->filterByDisplayName('%fooValue%'); // WHERE display_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $displayName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function filterByDisplayName($displayName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($displayName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $displayName)) {
                $displayName = str_replace('*', '%', $displayName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(WpUsersTableMap::COL_DISPLAY_NAME, $displayName, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWpUsers $wpUsers Object to remove from the list of results
     *
     * @return $this|ChildWpUsersQuery The current query, for fluid interface
     */
    public function prune($wpUsers = null)
    {
        if ($wpUsers) {
            $this->addUsingAlias(WpUsersTableMap::COL_ID, $wpUsers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wp_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WpUsersTableMap::clearInstancePool();
            WpUsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WpUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WpUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WpUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WpUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WpUsersQuery
