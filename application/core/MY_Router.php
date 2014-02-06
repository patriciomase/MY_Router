<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/*
	CUSTOM ROUTER FUNCTION TO CHECK FOR SLUG PLUS CONTROLLERS */
 
class MY_Router extends CI_Router{

    public function __construct(){

        parent::__construct();

        $this->config =& load_class('Config', 'core');
        $this->uri =& load_class('URI', 'core');
        
        require_once(BASEPATH.'database/DB'.EXT);
        $this->db = DB();
    }


	public function _set_routing(){

		$routes = $this->db
			->where('active', 1)
			->get('routes')
			->result();

		foreach ($routes as $route) {

			$this->routes[$route->slug] = $route->real_destiny;
			$this->routes[$route->slug . '/(:any)'] = $route->real_destiny . '/$1';
		}

		parent::_set_routing();
	}
}
 