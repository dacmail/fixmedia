<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "reports";
$route['404_override'] = '';

$route['noticia/nueva'] = array('/reports/create','reports-create');
$route['reporte/enviar/(:id)'] = array('/reports/send/$1','reports-send');
$route['reporte/borrador'] = array('/reports/preview','reports-preview');
$route['reporte/guardar'] = array('/reports/save','reports-save');
$route['noticia/(:slug)'] = array('/reports/view/$1','reports-view');
$route['noticia/(:slug)/(:share)'] = array('/reports/view/$1/$2','reports-view-share');
$route['usuario/salir'] = array('/auth/logout','logout');
$route['usuario/entrar'] = array('/auth/login','login');
$route['usuario/cambiar_clave'] = array('/auth/change_password','change_password');
$route['usuario/registro'] = array('/auth/create_user','register');
$route['pagina/(:page)'] = array('reports/index/$1','home-paged');
$route['pendientes'] = array('reports/pendings','home-pending');
$route['pendientes/pagina/(:page)'] = array('reports/pendings/$1','home-pending-paged');
$route['recientes'] = array('reports/recents','home-recents');
$route['recientes/pagina/(:page)'] = array('reports/recents/$1','home-recents-paged');
$route['usuario/(:username)'] = array('/member/index/$1','user-profile');
$route['usuario/(:username)/page/(:page)'] = array('/member/index/$1/$2','user-profile-paged');
$route['usuario/editar'] = array('/member/edit','user-edit');
$route['usuario/guardar'] = array('/member/save','user-save');
$route['fuente/(:sitename)'] = array('/source/index/$1','source-profile');
$route['fuente/(:sitename)/page/(:page)'] = array('/source/index/$1/$2','source-profile-paged');
$route['estaticas/(:page)'] = array('/pages/view/$1','statics');


/* End of file routes.php */
/* Location: ./application/config/routes.php */