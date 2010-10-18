<?php



/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'limbo3.map.UserTableMap';

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
		$this->setName('user');
		$this->setPhpName('User');
		$this->setClassname('User');
		$this->setPackage('limbo3');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USERNAME', 'Username', 'VARCHAR', true, 255, null);
		$this->addColumn('PANDORA_USERNAME', 'PandoraUsername', 'VARCHAR', false, 255, null);
		$this->addColumn('REAL_NAME', 'RealName', 'VARCHAR', false, 255, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255, null);
		$this->addColumn('BALANCE', 'Balance', 'DOUBLE', true, null, 0);
		$this->addColumn('CREATED', 'Created', 'TIMESTAMP', false, null, 'current_timestamp');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('BalanceLog', 'BalanceLog', RelationMap::ONE_TO_ONE, array('id' => 'id', ), null, null);
    $this->addRelation('Stock', 'Stock', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
    $this->addRelation('Purchase', 'Purchase', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
    $this->addRelation('Deposit', 'Deposit', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null);
    $this->addRelation('TransferRelatedByFromUser', 'Transfer', RelationMap::ONE_TO_MANY, array('id' => 'from_user', ), null, null);
    $this->addRelation('TransferRelatedByToUser', 'Transfer', RelationMap::ONE_TO_MANY, array('id' => 'to_user', ), null, null);
	} // buildRelations()

} // UserTableMap
