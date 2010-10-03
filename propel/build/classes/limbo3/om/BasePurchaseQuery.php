<?php


/**
 * Base class that represents a query for the 'purchase' table.
 *
 * 
 *
 * @method     PurchaseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     PurchaseQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     PurchaseQuery orderByStockId($order = Criteria::ASC) Order by the stock_id column
 * @method     PurchaseQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     PurchaseQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     PurchaseQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     PurchaseQuery orderByPrice($order = Criteria::ASC) Order by the price column
 *
 * @method     PurchaseQuery groupById() Group by the id column
 * @method     PurchaseQuery groupByUserId() Group by the user_id column
 * @method     PurchaseQuery groupByStockId() Group by the stock_id column
 * @method     PurchaseQuery groupByItemId() Group by the item_id column
 * @method     PurchaseQuery groupByQuantity() Group by the quantity column
 * @method     PurchaseQuery groupByCreated() Group by the created column
 * @method     PurchaseQuery groupByPrice() Group by the price column
 *
 * @method     PurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     PurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     PurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     PurchaseQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     PurchaseQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     PurchaseQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     PurchaseQuery leftJoinStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stock relation
 * @method     PurchaseQuery rightJoinStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stock relation
 * @method     PurchaseQuery innerJoinStock($relationAlias = null) Adds a INNER JOIN clause to the query using the Stock relation
 *
 * @method     PurchaseQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     PurchaseQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     PurchaseQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     Purchase findOne(PropelPDO $con = null) Return the first Purchase matching the query
 * @method     Purchase findOneOrCreate(PropelPDO $con = null) Return the first Purchase matching the query, or a new Purchase object populated from the query conditions when no match is found
 *
 * @method     Purchase findOneById(int $id) Return the first Purchase filtered by the id column
 * @method     Purchase findOneByUserId(int $user_id) Return the first Purchase filtered by the user_id column
 * @method     Purchase findOneByStockId(int $stock_id) Return the first Purchase filtered by the stock_id column
 * @method     Purchase findOneByItemId(int $item_id) Return the first Purchase filtered by the item_id column
 * @method     Purchase findOneByQuantity(int $quantity) Return the first Purchase filtered by the quantity column
 * @method     Purchase findOneByCreated(string $created) Return the first Purchase filtered by the created column
 * @method     Purchase findOneByPrice(double $price) Return the first Purchase filtered by the price column
 *
 * @method     array findById(int $id) Return Purchase objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return Purchase objects filtered by the user_id column
 * @method     array findByStockId(int $stock_id) Return Purchase objects filtered by the stock_id column
 * @method     array findByItemId(int $item_id) Return Purchase objects filtered by the item_id column
 * @method     array findByQuantity(int $quantity) Return Purchase objects filtered by the quantity column
 * @method     array findByCreated(string $created) Return Purchase objects filtered by the created column
 * @method     array findByPrice(double $price) Return Purchase objects filtered by the price column
 *
 * @package    propel.generator.limbo3.om
 */
abstract class BasePurchaseQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BasePurchaseQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'Purchase', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new PurchaseQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    PurchaseQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof PurchaseQuery) {
			return $criteria;
		}
		$query = new PurchaseQuery();
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
	 * @return    Purchase|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = PurchasePeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(PurchasePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(PurchasePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(PurchasePeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the user_id column
	 * 
	 * @param     int|array $userId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByUserId($userId = null, $comparison = null)
	{
		if (is_array($userId)) {
			$useMinMax = false;
			if (isset($userId['min'])) {
				$this->addUsingAlias(PurchasePeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($userId['max'])) {
				$this->addUsingAlias(PurchasePeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::USER_ID, $userId, $comparison);
	}

	/**
	 * Filter the query on the stock_id column
	 * 
	 * @param     int|array $stockId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByStockId($stockId = null, $comparison = null)
	{
		if (is_array($stockId)) {
			$useMinMax = false;
			if (isset($stockId['min'])) {
				$this->addUsingAlias(PurchasePeer::STOCK_ID, $stockId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($stockId['max'])) {
				$this->addUsingAlias(PurchasePeer::STOCK_ID, $stockId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::STOCK_ID, $stockId, $comparison);
	}

	/**
	 * Filter the query on the item_id column
	 * 
	 * @param     int|array $itemId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByItemId($itemId = null, $comparison = null)
	{
		if (is_array($itemId)) {
			$useMinMax = false;
			if (isset($itemId['min'])) {
				$this->addUsingAlias(PurchasePeer::ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($itemId['max'])) {
				$this->addUsingAlias(PurchasePeer::ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::ITEM_ID, $itemId, $comparison);
	}

	/**
	 * Filter the query on the quantity column
	 * 
	 * @param     int|array $quantity The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByQuantity($quantity = null, $comparison = null)
	{
		if (is_array($quantity)) {
			$useMinMax = false;
			if (isset($quantity['min'])) {
				$this->addUsingAlias(PurchasePeer::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($quantity['max'])) {
				$this->addUsingAlias(PurchasePeer::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::QUANTITY, $quantity, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     string|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(PurchasePeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(PurchasePeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query on the price column
	 * 
	 * @param     double|array $price The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByPrice($price = null, $comparison = null)
	{
		if (is_array($price)) {
			$useMinMax = false;
			if (isset($price['min'])) {
				$this->addUsingAlias(PurchasePeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($price['max'])) {
				$this->addUsingAlias(PurchasePeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(PurchasePeer::PRICE, $price, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		return $this
			->addUsingAlias(PurchasePeer::USER_ID, $user->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
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
	 * Filter the query by a related Stock object
	 *
	 * @param     Stock $stock  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByStock($stock, $comparison = null)
	{
		return $this
			->addUsingAlias(PurchasePeer::STOCK_ID, $stock->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Stock relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function joinStock($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Stock');
		
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
			$this->addJoinObject($join, 'Stock');
		}
		
		return $this;
	}

	/**
	 * Use the Stock relation Stock object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StockQuery A secondary query class using the current class as primary query
	 */
	public function useStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinStock($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Stock', 'StockQuery');
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item $item  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function filterByItem($item, $comparison = null)
	{
		return $this
			->addUsingAlias(PurchasePeer::ITEM_ID, $item->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Item relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function joinItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Item');
		
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
			$this->addJoinObject($join, 'Item');
		}
		
		return $this;
	}

	/**
	 * Use the Item relation Item object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery A secondary query class using the current class as primary query
	 */
	public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinItem($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Item', 'ItemQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Purchase $purchase Object to remove from the list of results
	 *
	 * @return    PurchaseQuery The current query, for fluid interface
	 */
	public function prune($purchase = null)
	{
		if ($purchase) {
			$this->addUsingAlias(PurchasePeer::ID, $purchase->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BasePurchaseQuery
