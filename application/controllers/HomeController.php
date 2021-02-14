<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'libraries/easybitcoin.php');


class HomeController extends CI_Controller {

	public function index()
	{   
        $bitcoin = $this->connect();
        $this->getLatestBlocks($bitcoin);
        $this->load->view('home');
	}

    public function connect()
    {
        $this->load->helper('file');
        $file_info = file_get_contents(APPPATH.'/helpers/connect_info.txt');
        $connect_info = preg_split('#\s+#', $file_info);
        $bitcoin = new Bitcoin($connect_info[0], $connect_info[1], $connect_info[2], $connect_info[3]);
        return $bitcoin;
    }

    public function getLatestBlocks($bitcoin){
        $blocks[];
        for($i = 0; $i < 5; $i++)
        {
            $visina=$bitcoin->getblockcount();
            $hash=$bitcoin->getblockhash($visina - $i);
            $block = $bitcoin->getblock($hash);
            array_push($block);
            print_r($block['height']);
            echo "\n";
        }
        return $blocks;
    }


}
?>