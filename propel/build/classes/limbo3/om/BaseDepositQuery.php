<?php


/**
 * Base class that represents a query for the 'deposit' table.
 *
 * 
 *
 * @method     DepositQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     DepositQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     DepositQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     DepositQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     DepositQuery groupById() Group by the id column
 * @method     DepositQuery groupByUserId() Group by the user_id column
 * @method     DepositQuery groupByAmount() Group by the amount column
 * @method     DepositQuery groupByCreated() Group by the created column
 *
 * @method     DepositQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     DepositQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     DepositQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     DepositQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     DepositQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     DepositQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     DepositQuery leftJoinBalanceLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the BalanceLog relation
 * @method     DepositQuery rightJoinBalanceLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BalanceLog relation
 * @method     DepositQuery innerJoinBalanceLog($relationAlias = null) Adds a INNER JOIN clause to the query using the BalanceLog relation
 *
 * @method     Deposit findOne(PropelPDO $con = null) Return the first Deposit matching the query
 * @method     Deposit findOneOrCreate(PropelPDO $con = null) Return the first Deposit matching the query, or a new Deposit object populated from the query conditions when no match is found
 *
 * @method     Deposit findOneById(int $id) Return the first Deposit filtered by the id column
 * @method     Deposit findOneByUserId(int $user_id) Return the first Deposit filtered by the user_id column
 * @method     Deposit findOneByAmount(double $amount) Return the first Deposit filtered by the amount column
 * @method     Deposit findOneByCreated(string $created) Return the first Deposit filtered by the created column
 *
 * @method     array findById(int $id) Return Deposit objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Deposit objects filtered by the user_id column
 * @method     array findByAmount(double $amount) Return Deposit objects filtered by the amount column
 * @method     array findByCreated(string $created) Return Deposit objects filtered by the created column
 *
 * @package    propel.generator.limbo3.om
 */
abstract class BaseDepositQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseDepositQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'Deposit', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new DepositQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    DepositQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof DepositQuery) {
			return $criteria;
		}
		$query = new DepositQuery();
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
	 * @return    Deposit|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = DepositPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(DepositPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(DepositPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(DepositPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(DepositPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(DepositPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DepositPeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the amount column
	 * 
	 * @param     double|array $amount The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByAmount($amount = null, $comparison = null)
	{
		if (is_array($amount)) {
			$useMinMax = false;
			if (isset($amount['min'])) {
				$this->addUsingAlias(DepositPeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($amount['max'])) {
				$this->addUsingAlias(DepositPeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DepositPeer::AMOUNT, $amount, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     string|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(DepositPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(DepositPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DepositPeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		return $this
			->addUsingAlias(DepositPeer::USER_ID, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');
		
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
			$this->addJoinObject($join, 'User');
		}
		
		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Filter the query by a related BalanceLog object
	 *
	 * @param     BalanceLog $balanceLog  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function filterByBalanceLog($balanceLog, $comparison = null)
	{
		return $this
			->addUsingAlias(DepositPeer::ID, $balanceLog->getDepositId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the BalanceLog relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DepositQuery The current query, for fluid interface
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
	 * @param     Deposit $deposit Object to remove from the list of results
	 *
	 * @return    DepositQuery The current query, for fluid interface
	 */
	public function prune($deposit = null)
	{
		if ($deposit) {
			$this->addUsingAlias(DepositPeer::ID, $deposit->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseDepositQuery
