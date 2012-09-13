<?
	function is_cur_page($obj, $controller, $method) {
		return ($controller==$obj->router->class && $method==$obj->router->method);
	}
?>