<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Alternate Session Class (utilizing PHP's native session) because the default one Sucks!
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Munir Ahmad	
 * @created         04/06/2009
 * @link						http://github.com/munirehmad/Xession
 */

class Xession
{
	protected $_CI;
	protected $_FLASHDATA_KEY = '_f_d_'; 	// must be pretty unique to avoid collision with setdata()
	
	function __construct( $config = array() )
	{
    $this->_CI =& get_instance();

		session_start();


		// flash data chores
		if ( isset($_SESSION[$this->_FLASHDATA_KEY]) )
		{
			foreach ( $_SESSION[$this->_FLASHDATA_KEY] as $k => &$v )
			{
				if ( $v['n'] < 1 )
					unset($_SESSION[$this->_FLASHDATA_KEY][$k]);
				else
					$v['n']--;
			}
		}

		//var_dump($_SESSION);
	}
	
	function set( $key, $val = '' )
	{
		if ( is_array($key) )
		{
			foreach( $key as $k => $val )
				$_SESSION[$k] = $val;

			return;
		}

		$_SESSION[$key] = $val;
	}

	function setflash( $key, $val = '' )
	{
		if ( is_array($key) )
		{
			foreach( $key as $k => $val )
			{
				//echo '<p>Got '.$k.' => '.$val.'</p>';
				$_SESSION[$this->_FLASHDATA_KEY][$k] = array( 'd' => $val, 'n' => 1 );
			}

			return;
		}

		$_SESSION[$this->_FLASHDATA_KEY][$key] = array( 'd' => $val, 'n' => 1);
	}

	function getflash( $key )
	{
		return isset($_SESSION[$this->_FLASHDATA_KEY][$key]) ? $_SESSION[$this->_FLASHDATA_KEY][$key]['d'] : NULL;
	}

	function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key][$n] : NULL;
	}

}

