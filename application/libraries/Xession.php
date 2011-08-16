<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Alternate Session Class because default one Sucks!
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    		Libraries
 * @author        	Munir Ahmad	
 * @created					08/15/2011
 * @link						http://github.com/munirehmad/Xession/
 */

class Xession
{
	protected $_CI;
	
	function __construct( $config = array() )
	{
		$this->_CI =& get_instance();

		session_start();


		// flash data chores
		if ( isset($_SESSION['f']) )
		{
			foreach ( $_SESSION['f'] as $k => &$v )
			{
				if ( $v['n'] < 1 )
					unset($_SESSION['f'][$k]);
				else
					$v['n']--;
			}
		}

		//var_dump($_SESSION);
	}
	
	function set( $key, $val )
	{
		if ( is_array($key) )
		{
			foreach( $key as $k => $val )
				$_SESSION[$k] = $val;

			return;
		}

		$_SESSION[$key] = $val;
	}

	function setflash( $data = array() )
	{
		foreach( $data as $k => $val )
		{
			//echo '<p>Got '.$k.' => '.$val.'</p>';
			$_SESSION['f'][$k] = array( 'd' => $val, 'n' => 1 );
		}
	}

	function getflash( $key )
	{
		return isset($_SESSION['f'][$key]) ? $_SESSION['f'][$key]['d'] : NULL;
	}

	function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key][$n] : NULL;
	}

}

