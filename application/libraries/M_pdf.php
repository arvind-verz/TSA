<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_pdf
{
    public function __construct()
    {
        include_once 'vendor/autoload.php';
    }

    public function download_my_mPDF($filename)
    {
        $this->mpdf = new Mpdf\Mpdf();
        $data['invoice_data'] = get_invoice_by_filename($filename);
    	$ci = &get_instance();
        $html = $ci->load->view('backend/extra/pdf_invoice_layout', $data, true);
        
		$this->mpdf->WriteHTML($html);
		$this->mpdf->Output('assets/files/pdf/invoice/' . $filename, \Mpdf\Output\Destination::FILE);
    }
}
