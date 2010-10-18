<?php


/**
 * Base class that represents a query for the 'transfer' table.
 *
 * 
 *
 * @method     TransferQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TransferQuery orderByFromUser($order = Criteria::ASC) Order by the from_user column
 * @method     TransferQuery orderByToUser($order = Criteria::ASC) Order by the to_user column
 * @method     TransferQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     TransferQuery orderByReason($order = Criteria::ASC) Order by the reason column
 * @method     TransferQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     TransferQuery groupById() Group by the id column
 * @method     TransferQuery groupByFromUser() Group by the from_user column
 * @method     TransferQuery groupByToUser() Group by the to_user column
 * @method     TransferQuery groupByAmount() Group by the amount column
 * @method     TransferQuery groupByReason() Group by the reason column
 * @method     TransferQuery groupByCreated() Group by the created column
 *
 * @method     TransferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TransferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TransferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TransferQuery leftJoinUserFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFrom relation
 * @method     TransferQuery rightJoinUserFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFrom relation
 * @method     TransferQuery innerJoinUserFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFrom relation
 *
 * @method     TransferQuery leftJoinUserTo($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserTo relation
 * @method     TransferQuery rightJoinUserTo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserTo relation
 * @method     TransferQuery innerJoinUserTo($relationAlias = null) Adds a INNER JOIN clause to the query using the UserTo relation
 *
 * @method     TransferQuery leftJoinBalanceLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the BalanceLog relation
 * @method     TransferQuery rightJoinBalanceLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BalanceLog relation
 * @method     TransferQuery innerJoinBalanceLog($relationAlias = null) Adds a INNER JOIN clause to the query using the BalanceLog relation
 *
 * @method     Transfer findOne(PropelPDO $con = null) Return the first Transfer matching the query
 * @method     Transfer findOneOrCreate(PropelPDO $con = null) Return the first Transfer matching the query, or a new Transfer object populated from the query conditions when no match is found
 *
 * @method     Transfer findOneById(int $id) Return the first Transfer filtered by the id column
 * @method     Transfer findOneByFromUser(int $from_user) Return the first Transfer filtered by the from_user column
 * @method     Transfer findOneByToUser(int $to_user) Return the first Transfer filtered by the to_user column
 * @method     Transfer findOneByAmount(double $amount) Return the first Transfer filtered by the amount column
 * @method     Transfer findOneByReason(string $reason) Return the first Transfer filtered by the reason column
 * @method     Transfer findOneByCreated(string $created) Return the first Transfer filtered by the created column
 *
 * @method     array findById(int $id) Return Transfer objects filtered by the id column
 * @method     array findByFromUser(int $from_user) Return Transfer objects filtered by the from_user column
 * @method     array findByToUser(int $to_user) Return Transfer objects filtered by the to_user column
 * @method     array findByAmount(double $amount) Return Transfer objects filtered by the amount column
 * @method     array findByReason(string $reason) Return Transfer objects filtered by the reason column
 * @method     array findByCreated(string $created) Return Transfer objects filtered by the created column
 *
 * @package    propel.generator.limbo3.om
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
	 * Filter the query on the from_user column
	 * 
	 * @param     int|array $fromUser The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByFromUser($fromUser = null, $comparison = null)
	{
		if (is_array($fromUser)) {
			$useMinMax = false;
			if (isset($fromUser['min'])) {
				$this->addUsingAlias(TransferPeer::FROM_USER, $fromUser['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fromUser['max'])) {
				$this->addUsingAlias(TransferPeer::FROM_USER, $fromUser['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::FROM_USER, $fromUser, $comparison);
	}

	/**
	 * Filter the query on the to_user column
	 * 
	 * @param     int|array $toUser The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByToUser($toUser = null, $comparison = null)
	{
		if (is_array($toUser)) {
			$useMinMax = false;
			if (isset($toUser['min'])) {
				$this->addUsingAlias(TransferPeer::TO_USER, $toUser['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($toUser['max'])) {
				$this->addUsingAlias(TransferPeer::TO_USER, $toUser['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TransferPeer::TO_USER, $toUser, $comparison);
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
	 * Filter the query on the reason column
	 * 
	 * @param     string $reason The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByReason($reason = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($reason)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $reason)) {
				$reason = str_replace('*', '%', $reason);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(TransferPeer::REASON, $reason, $comparison);
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
	public function filterByUserFrom($user, $comparison = null)
	{
		return $this
			->addUsingAlias(TransferPeer::FROM_USER, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the UserFrom relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function joinUserFrom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserFrom');
		
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
			$this->addJoinObject($join, 'UserFrom');
		}
		
		return $this;
	}

	/**
	 * Use the UserFrom relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserFromQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserFrom($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserFrom', 'UserQuery');
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByUserTo($user, $comparison = null)
	{
		return $this
			->addUsingAlias(TransferPeer::TO_USER, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the UserTo relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function joinUserTo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserTo');
		
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
			$this->addJoinObject($join, 'UserTo');
		}
		
		return $this;
	}

	/**
	 * Use the UserTo relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserToQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUserTo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserTo', 'UserQuery');
	}

	/**
	 * Filter the query by a related BalanceLog object
	 *
	 * @param     BalanceLog $balanceLog  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function filterByBalanceLog($balanceLog, $comparison = null)
	{
		return $this
			->addUsingAlias(TransferPeer::ID, $balanceLog->getTransferId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the BalanceLog relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TransferQuery The current query, for fluid interface
	 */
	public function joinBalanceLog($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('BalanceLog');
		
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
			$this->addJoinObject($join, 'BalanceLog');
		}
		
		return $this;
	}

	/**
	 * Use the BalanceLog relation BalanceLog object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BalanceLogQuery A secondary query class using the current class as primary query
	 */
	public function useBalanceLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBalanceLog($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'BalanceLog', 'BalanceLogQuery');
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
