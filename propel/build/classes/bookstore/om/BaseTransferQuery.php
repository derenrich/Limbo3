<?php


/**
 * Base class that represents a query for the 'transfer' table.
 *
 * 
 *
 * @method     TransferQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TransferQuery orderByFrom($order = Criteria::ASC) Order by the from column
 * @method     TransferQuery orderByTo($order = Criteria::ASC) Order by the to column
 * @method     TransferQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     TransferQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     TransferQuery groupById() Group by the id column
 * @method     TransferQuery groupByFrom() Group by the from column
 * @method     TransferQuery groupByTo() Group by the to column
 * @method     TransferQuery groupByAmount() Group by the amount column
 * @method     TransferQuery groupByCreated() Group by the created column
 *
 * @method     TransferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TransferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TransferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TransferQuery leftJoinUserRelatedByFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByFrom relation
 * @method     TransferQuery rightJoinUserRelatedByFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByFrom relation
 * @method     TransferQuery innerJoinUserRelatedByFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByFrom relation
 *
 * @method     TransferQuery leftJoinUserRelatedByTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByTo relation
 * @method     TransferQuery rightJoinUserRelatedByTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByTo relation
 * @method     TransferQuery innerJoinUserRelatedByTo($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByTo relation
 *
 * @method     Transfer findOne(PropelPDO $con = null) Return the first Transfer matching the query
 * @method     Transfer findOneOrCreate(PropelPDO $con = null) Return the first Transfer matching the query, or a new Transfer object populated from the query conditions when no match is found
 *
 * @method     Transfer findOneById(int $id) Return the first Transfer filtered by the id column
 * @method     Transfer findOneByFrom(int $from) Return the first Transfer filtered by the from column
 * @method     Transfer findOneByTo(int $to) Return the first Transfer filtered by the to column
 * @method     Transfer findOneByAmount(double $amount) Return the first Transfer filtered by the amount column
 * @method     Transfer findOneByCreated(string $created) Return the first Transfer filtered by the created column
 *
 * @method     array findById(int $id) Return Transfer objects filtered by the id column
 * @method     array findByFrom(int $from) Return Transfer objects filtered by the from column
 * @method     array findByTo(int $to) Return Transfer objects filtered by the to column
 * @method     array findByAmount(double $amount) Return Transfer objects filtered by the amount column
 * @method     array findByCreated(string $created) Return Transfer objects filtered by the created column
 *
 * @package    propel.generator.bookstore.om
 */
abstract class BaseTransferQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseTransferQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'Transfer', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TransferQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TransferQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TransferQuery) {
			return $criteria;
		}
		$query = new TransferQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Transfer|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = TransferPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TransferPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TransferPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TransferPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the from column
	 * 
	 * @param     int|array $from The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByFrom($from = null, $comparison = null)
	{
		if (is_array($from)) {
			$useMinMax = false;
			if (isset($from['min'])) {
				$this->addUsingAlias(TransferPeer::FROM, $from['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($from['max'])) {
				$this->addUsingAlias(TransferPeer::FROM, $from['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::FROM, $from, $comparison);
	}

	/**
	 * Filter the query on the to column
	 * 
	 * @param     int|array $to The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByTo($to = null, $comparison = null)
	{
		if (is_array($to)) {
			$useMinMax = false;
			if (isset($to['min'])) {
				$this->addUsingAlias(TransferPeer::TO, $to['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($to['max'])) {
				$this->addUsingAlias(TransferPeer::TO, $to['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::TO, $to, $comparison);
	}

	/**
	 * Filter the query on the amount column
	 * 
	 * @param     double|array $amount The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByAmount($amount = null, $comparison = null)
	{
		if (is_array($amount)) {
			$useMinMax = false;
			if (isset($amount['min'])) {
				$this->addUsingAlias(TransferPeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($amount['max'])) {
				$this->addUsingAlias(TransferPeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::AMOUNT, $amount, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     string|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(TransferPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(TransferPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByUserRelatedByFrom($user, $comparison = null)
	{
		return $this
			->addUsingAlias(TransferPeer::FROM, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the UserRelatedByFrom relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function joinUserRelatedByFrom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserRelatedByFrom');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'UserRelatedByFrom');
		}
		
		return $this;
	}

	/**
	 * Use the UserRelatedByFrom relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserRelatedByFromQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserRelatedByFrom($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserRelatedByFrom', 'UserQuery');
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByUserRelatedByTo($user, $comparison = null)
	{
		return $this
			->addUsingAlias(TransferPeer::TO, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the UserRelatedByTo relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function joinUserRelatedByTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserRelatedByTo');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'UserRelatedByTo');
		}
		
		return $this;
	}

	/**
	 * Use the UserRelatedByTo relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserRelatedByToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserRelatedByTo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserRelatedByTo', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Transfer $transfer Object to remove from the list of results
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function prune($transfer = null)
	{
		if ($transfer) {
			$this->addUsingAlias(TransferPeer::ID, $transfer->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseTransferQuery
