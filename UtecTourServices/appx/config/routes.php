<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Routes Edificios
$route['Edificios/listado']['GET'] = 'edificios_controller/listaEdificios';
$route['Edificios/guardarDatos']['POST'] = 'edificios_controller/guardarDatos';
$route['Edificios/borrarDatos']['POST'] = 'edificios_controller/borrarDatos';

//Routes Seccion
$route['Seccion/listado']['GET'] = 'seccion_controller/listaSecciones';
$route['Seccion/guardarDatos']['POST'] = 'seccion_controller/guardarDatos';
$route['Seccion/borrarDatos']['POST'] = 'seccion_controller/borrarDatos';

//Routes Tipo Accion
$route['TAccion/listado']['GET'] = 'tipoAccion_controller/listaTiposAcciones';
$route['TAccion/guardarDatos']['POST'] = 'tipoAccion_controller/guardarDatos';
$route['TAccion/borrarDatos']['POST'] = 'tipoAccion_controller/borrarDatos';

//Routes idiomas
$route['Idiomas/listado']['GET'] = 'idiomas_controller/listaIdiomas';
$route['Idiomas/guardarDatos']['POST'] = 'idiomas_controller/guardarDatos';
$route['Idiomas/borrarDatos']['POST'] = 'idiomas_controller/borrarDatos';

//Routes idiomas
$route['Texto/listado']['GET'] = 'texto_controller/listaTextos';
$route['Texto/guardarDatos']['POST'] = 'texto_controller/guardarDatos';
$route['Texto/borrarDatos']['POST'] = 'texto_controller/borrarDatos';

//Routes Recursos
$route['Recursos/listado']['GET'] = 'recurso_controller/listaRecursos';
$route['Recursos/guardarDatos']['POST'] = 'recurso_controller/guardarDatos';
$route['Recursos/borrarDatos']['POST'] = 'recurso_controller/borrarDatos';

//Routes usuarios
$route['Usuarios/listado']['GET'] = 'usuarios_controller/listaUsuarios';
$route['Usuarios/guardarDatos']['POST'] = 'usuarios_controller/guardarDatos';
$route['Usuarios/borrarDatos']['POST'] = 'usuarios_controller/borrarDatos';

//Funciones
$route['Fun/Login']['POST'] = 'funciones_controller/Login';