<?php
 
class MY_Router extends CI_Router
{
    private $_reverseRoutes = NULL;
 
    CONST ARR_ROUTE_POS      = 0;
    CONST ARR_ROUTE_NAME_POS = 1;
 
    function _parse_routes()
    {
		// Do we even have any custom routing to deal with?
		// There is a default scaffolding trigger, so we'll look just for 1
		if (count($this->routes) == 1)
		{
			$this->_set_request($this->uri->segments);
			return;
		}
 
		// Turn the segment array into a URI string
		$uri = implode('/', $this->uri->segments);
 
		// Is there a literal match?  If so we're done
		if (isset($this->routes[$uri]))
		{
			$this->_set_request(explode('/', $this->routes[$uri][self::ARR_ROUTE_POS]));
			return;
		}
 
		// Loop through the route array looking for wild-cards
		foreach ($this->routes as $key => $val)
		{
			// Convert wild-cards to RegEx
            //echo "$key --> ";
			$key = preg_replace('/\:\w+/', '[\w\-_]+', $key);
            //echo "$key <br />";
			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $uri))
			{
				// Do we have a back-reference?
				if (strpos($val[self::ARR_ROUTE_POS], '$') !== FALSE AND strpos($key, '(') !== FALSE)
				{
					$val = preg_replace('#^'.$key.'$#', $val[self::ARR_ROUTE_POS], $uri);   
				}
 
				$this->_set_request(explode('/', $val));
				return;
			}
		}
 
		// If we got this far it means we didn't encounter a
		// matching route so we'll set the site default route
		$this->_set_request($this->uri->segments);
    }
 
    function _buildReverseRoutes()
    {
        $reverse_routes = array();
 
        foreach($this->routes as $route => $info)
        {
            # If this is a default route or scaffolding key, ignore it
            if(!is_array($info)) continue;
 
            $name = $info[self::ARR_ROUTE_NAME_POS];
            $reverse_routes[$name] = $route;
        }
 
        $this->_reverseRoutes = & $reverse_routes;
    }
 
    function reverseRoute($route_name, $args_keyval = array())
    {
        if($this->_reverseRoutes === NULL)
            $this->_buildReverseRoutes();
 
        if(!array_key_exists($route_name, $this->_reverseRoutes))
            show_error("No reverse route found for '$route_name'");
 
        $route = $this->_reverseRoutes[$route_name];
 
        foreach($args_keyval as $key => $val)
        {
            $route = str_replace("(:$key)", $val, $route);
        }
 
        return $route;
    }
}