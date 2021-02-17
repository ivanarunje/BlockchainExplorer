<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'libraries/easybitcoin.php');

class HomeController extends CI_Controller {

	public function index()
	{   
        $bitcoin = $this->connect();
        $data=array();
        $data['blocks'] = $this->getLatestBlocks($bitcoin);
        $data['transactions'] = $this->getLatestTransactions($bitcoin);
        $this->load->view('home',$data);
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
        $blocks = array();
        for($i = 0; $i < 8; $i++)
        {
            $visina=$bitcoin->getblockcount();
            $hash=$bitcoin->getblockhash($visina - $i);
            $block = $bitcoin->getblock($hash);
            array_push($blocks, $block);
        }
        return $blocks;
    }

    public function getLatestTransactions($bitcoin){
        $transactions = $bitcoin->getrawmempool();
        $array_trans = array();
        $count = 0;
        foreach ($transactions as $current)
        {
            $transaction = $bitcoin->getmempoolentry($current);
            $array_trans[$current] = $transaction;
            $count++;
        }
        array_multisort(array_column($array_trans, 'time'), SORT_DESC, $array_trans);
        return array_slice($array_trans, 0, 8);
    }

    public function getBlockInfo($hash = 0){
        $this->load->helper('url');
        $hash = $this->uri->segment(3);
        $bitcoin = $this->connect();
        $block = $bitcoin->getblock($hash, 2); 

        $data['block'] = $block;
        $this->load->view('block', $data);
    }

}
?>