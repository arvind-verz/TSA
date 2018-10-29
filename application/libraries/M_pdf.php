<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_pdf
{
	public $mpdf;
    public function __construct()
    {
        include_once 'vendor/autoload.php';
        $this->mpdf = new Mpdf\Mpdf();
    }

    public function my_mPDF($filename)
    {
    	$ci = &get_instance();
    	$filename = $filename . ".pdf";
        $html = $ci->load->view('backend/extra/pdf_invoice_layout', '', true);
    	$ci->load->library('M_pdf');
        
		$ci->m_pdf->mpdf->WriteHTML($html);
		$ci->m_pdf->mpdf->Output('assets/files/pdf/invoice/' . $filename, \Mpdf\Output\Destination::FILE);
    }
}
