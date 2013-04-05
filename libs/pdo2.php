<?php
/**
 * Classe impl�mentant le singleton pour PDO
 */
class PDO2 extends PDO {

	private static $_instance;
	
	/**
	 * @brief      Constructeur : h�ritage public obligatoire par h�ritage de PDO
	 */
	public function __construct( ) 
	{
	}

	/**
	 * @brief      Le getInstance nous permet d'acc�der � l'instrance de notre objet instance
	 *
	 * @return  	L'instance de PDO
	 */
	public static function getInstance() 
	{
		if (!isset(self::$_instance)) 
		{	
			try 
			{
				self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
			} 
			catch (PDOException $e) 
			{
				echo $e;
			}
		} 
		return self::$_instance; 
	}
}
?>
