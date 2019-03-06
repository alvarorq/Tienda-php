<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php', (array)$output);
	}

	public function muestra_productos()
	{
		$this->grocery_crud->set_table('productos');
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function muestra_Categorias()
	{
		$this->grocery_crud->set_table('categorias'); //$this->grocery_crud->columns('nombre','codigo','descripcion','precio', 'cantidad_dispo');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}

	public function muestra_Usuarios()
	{
		$this->grocery_crud->set_table('usuarios'); //$this->grocery_crud->columns('nombre','codigo','descripcion','precio', 'cantidad_dispo');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '', 'js_files' => array(), 'css_files' => array()));
	}
}
