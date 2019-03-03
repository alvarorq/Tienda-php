<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
   {
      $mpdf = new \Mpdf\Mpdf();
      $html = $this->load->view('html_to_pdf',[],true);
      $mpdf->WriteHTML($html);
      $mpdf->Output(); // opens in browser
      //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
   }
}
