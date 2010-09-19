<?php


/**
 * Base class that represents a query for the 'stock' table.
 *
 * 
 *
 * @method     StockQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     StockQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     StockQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method     StockQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     StockQuery orderByUpc($order = Criteria::ASC) Order by the UPC column
 *
 * @method     StockQuery groupById() Group by the id column
 * @method     StockQuery groupByItemId() Group by the item_id column
 * @method     StockQuery groupByBalance() Group by the balance column
 * @method     StockQuery groupByCreated() Group by the created column
 * @method     StockQuery groupByUpc() Group by the UPC column
 *
 * @method     StockQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     StockQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     StockQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     StockQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     StockQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     StockQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     Stock findOne(PropelPDO $con = null) Return the first Stock matching the query
 * @method     Stock findOneOrCreate(PropelPDO $con = null) Return the first Stock matching the query, or a new Stock object populated from the query conditions when no match is found
 *
 * @method     Stock findOneById(int $id) Return the first Stock filtered by the id column
 * @method     Stock findOneByItemId(int $item_id) Return the first Stock filtered by the item_id column
 * @method     Stock findOneByBalance(double $balance) Return the first Stock filtered by the balance column
 * @method     Stock findOneByCreated(string $created) Return the first Stock filtered by the created column
 * @method     Stock findOneByUpc(string $UPC) Return the first Stock filtered by the UPC column
 *
 * @method     array findById(int $id) Return Stock objects filtered by the id column
 * @method     array findByItemId(int $item_id) Return Stock objects filtered by the item_id column
 * @method     array findByBalance(double $balance) Return Stock objects filtered by the balance column
 * @method     array findByCreated(string $created) Return Stock objects filtered by the created column
 * @method     array findByUpc(string $UPC) Return Stock objects filtered by the UPC column
 *
 * @package    propel.generator.bookstore.om
 */
abstract class BaseStockQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseStockQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'Stock', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new StockQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    StockQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof StockQuery) {
			return $criteria;
		}
		$query = new StockQuery();
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
	 * @return    Stock|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = StockPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(StockPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(StockPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(StockPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the item_id column
	 * 
	 * @param     int|array $itemId The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByItemId($itemId = null, $comparison = null)
	{
		if (is_array($itemId)) {
			$useMinMax = false;
			if (isset($itemId['min'])) {
				$this->addUsingAlias(StockPeer::ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($itemId['max'])) {
				$this->addUsingAlias(StockPeer::ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StockPeer::ITEM_ID, $itemId, $comparison);
	}

	/**
	 * Filter the query on the balance column
	 * 
	 * @param     double|array $balance The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByBalance($balance = null, $comparison = null)
	{
		if (is_array($balance)) {
			$useMinMax = false;
			if (isset($balance['min'])) {
				$this->addUsingAlias(StockPeer::BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($balance['max'])) {
				$this->addUsingAlias(StockPeer::BALANCE, $balance['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StockPeer::BALANCE, $balance, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     string|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(StockPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(StockPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(StockPeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query on the UPC column
	 * 
	 * @param     string $upc The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByUpc($upc = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($upc)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $upc)) {
				$upc = str_replace('*', '%', $upc);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(StockPeer::UPC, $upc, $comparison);
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item $item  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function filterByItem($item, $comparison = null)
	{
		return $this
			->addUsingAlias(StockPeer::ITEM_ID, $item->getId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Item relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    StockQuery The current query, for fluid interface
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
	 * @param     Stock $stock Object to remove from the list of results
	 *
	 * @return    StockQuery The current query, for fluid interface
	 */
	public function prune($stock = null)
	{
		if ($stock) {
			$this->addUsingAlias(StockPeer::ID, $stock->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseStockQuery
