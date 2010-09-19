<?php


/**
 * Base class that represents a query for the 'item' table.
 *
 * 
 *
 * @method     ItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ItemQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ItemQuery orderByBalance($order = Criteria::ASC) Order by the balance column
 * @method     ItemQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method     ItemQuery groupById() Group by the id column
 * @method     ItemQuery groupByName() Group by the name column
 * @method     ItemQuery groupByBalance() Group by the balance column
 * @method     ItemQuery groupByCreated() Group by the created column
 *
 * @method     ItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ItemQuery leftJoinStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the Stock relation
 * @method     ItemQuery rightJoinStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Stock relation
 * @method     ItemQuery innerJoinStock($relationAlias = null) Adds a INNER JOIN clause to the query using the Stock relation
 *
 * @method     Item findOne(PropelPDO $con = null) Return the first Item matching the query
 * @method     Item findOneOrCreate(PropelPDO $con = null) Return the first Item matching the query, or a new Item object populated from the query conditions when no match is found
 *
 * @method     Item findOneById(int $id) Return the first Item filtered by the id column
 * @method     Item findOneByName(string $name) Return the first Item filtered by the name column
 * @method     Item findOneByBalance(double $balance) Return the first Item filtered by the balance column
 * @method     Item findOneByCreated(string $created) Return the first Item filtered by the created column
 *
 * @method     array findById(int $id) Return Item objects filtered by the id column
 * @method     array findByName(string $name) Return Item objects filtered by the name column
 * @method     array findByBalance(double $balance) Return Item objects filtered by the balance column
 * @method     array findByCreated(string $created) Return Item objects filtered by the created column
 *
 * @package    propel.generator.bookstore.om
 */
abstract class BaseItemQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseItemQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'limbo3', $modelName = 'Item', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ItemQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ItemQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ItemQuery) {
			return $criteria;
		}
		$query = new ItemQuery();
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
	 * @return    Item|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ItemPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ItemPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ItemPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ItemPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * @param     string $name The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ItemPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the balance column
	 * 
	 * @param     double|array $balance The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBalance($balance = null, $comparison = null)
	{
		if (is_array($balance)) {
			$useMinMax = false;
			if (isset($balance['min'])) {
				$this->addUsingAlias(ItemPeer::BALANCE, $balance['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($balance['max'])) {
				$this->addUsingAlias(ItemPeer::BALANCE, $balance['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::BALANCE, $balance, $comparison);
	}

	/**
	 * Filter the query on the created column
	 * 
	 * @param     string|array $created The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByCreated($created = null, $comparison = null)
	{
		if (is_array($created)) {
			$useMinMax = false;
			if (isset($created['min'])) {
				$this->addUsingAlias(ItemPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($created['max'])) {
				$this->addUsingAlias(ItemPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::CREATED, $created, $comparison);
	}

	/**
	 * Filter the query by a related Stock object
	 *
	 * @param     Stock $stock  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByStock($stock, $comparison = null)
	{
		return $this
			->addUsingAlias(ItemPeer::ID, $stock->getItemId(), $comparison);
	}

	/**
	 * Adds a JOIN clause to the query using the Stock relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     Item $item Object to remove from the list of results
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function prune($item = null)
	{
		if ($item) {
			$this->addUsingAlias(ItemPeer::ID, $item->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseItemQuery
