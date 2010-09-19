<?php



/**
 * This class defines the structure of the 'stock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.limbo3.map
 */
class StockTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'limbo3.map.StockTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('stock');
		$this->setPhpName('Stock');
		$this->setClassname('Stock');
		$this->setPackage('limbo3');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ITEM_ID', 'ItemId', 'INTEGER', 'item', 'ID', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', true, null, null);
		$this->addColumn('PRICE', 'Price', 'DOUBLE', true, null, null);
		$this->addColumn('CREATED', 'Created', 'TIMESTAMP', false, null, 'current_timestamp');
		$this->addColumn('SOLD_OUT', 'SoldOut', 'BOOLEAN', false, null, false);
		$this->addColumn('QUANTITY', 'Quantity', 'INTEGER', true, null, null);
		$this->addColumn('SOLD', 'Sold', 'INTEGER', true, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Item', 'Item', RelationMap::MANY_TO_ONE, array('item_id' => 'id', ), null, null);
    $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('Purchase', 'Purchase', RelationMap::ONE_TO_MANY, array('id' => 'stock_id', ), null, null);
	} // buildRelations()

} // StockTableMap
