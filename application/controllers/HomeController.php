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

    public function getBlockInfo($hash){
        $this->load->helper('url');
        $count=0;
        $transaction_data = array();
        if(empty($hash))
        {
            $hash = $this->uri->segment(3);
        }
        $bitcoin = $this->connect();
        $block = $bitcoin->getblock($hash,2);
        $complete_info = array();
        $total_fee = 0;

        foreach($block['tx'] as $transaction){ //kroz transakcije
            $fee_curent = 0;
            $flag = false;
            $trans_vout = array();
            $trans_vin = array();
            $trans_union = array();

            if($count++ == 0)
            {
                $address = "COINBASE";
                $flag = true;
                $temp_array = array("COINBASE" => 0);
                array_push($trans_vin, $temp_array);
            }
            else
            {
                $previous_trans = $this->getInputofTransaction($transaction, $bitcoin);
                foreach($previous_trans as $current)
                {
                    
                    $address = $current['scriptPubKey']['addresses'][0];
                    $temp_array = array($address => $current['value']);
                    $fee_curent += $current['value'];
                    array_push($trans_vin, $temp_array);
                }
            }
            array_push($trans_union, $trans_vin);

            for($i=0;$i<count($transaction['vout']);$i++)
            {    
                // Ako key addresses ne postoji ili ako u asm pise OP_RETURN odma upisat prazan string
                if(strstr($transaction['vout'][$i]['scriptPubKey']['asm'], "OP_RETURN"))
                {
                    $address = "OP_RETURN";
                }
                else if(array_key_exists('addresses', $transaction['vout'][$i]['scriptPubKey']) == false)
                {
                    $address = "";
                }
                else
                {
                    $address = $transaction['vout'][$i]['scriptPubKey']['addresses'][0];
                }
                $temp_array = array($address => $transaction['vout'][$i]['value']);
                if($flag == false)
                {
                    $fee_curent -= $transaction['vout'][$i]['value'];
                }

                array_push($trans_vout, $temp_array);
            }
            $total_fee += $fee_curent;
            array_push($trans_union, $trans_vout);
            $complete_info[$transaction['txid']] = $trans_union;
        }
        $data['complete_info'] = $complete_info;
        $data['total_fee'] = $total_fee;
        $data['block'] = $block;
        $this->load->view('block', $data);
    }


    public function getTransactionInfo($hash){
        $this->load->helper('url');
        if(empty($hash))
        {
            $hash = $this->uri->segment(3);
        }

        $bitcoin = $this->connect();
        $transaction = $bitcoin->getrawtransaction($hash,true);

        if (array_key_exists('blockhash', $transaction)==false) {
            $transaction["confirmations"] = "0";
            $transaction["status"] = "Unconfirmed";
            $transaction["blockhash"] ="Mempool";
        }
        else{
            $transaction["status"] = "Confirmed";
            $blockHeight=array();
            $blockHeight=$bitcoin->getblock($transaction['blockhash']); //razlog: na primjeru explorer-a prikazana visina a ne hash 
            $transaction["blockhash"]=$blockHeight['height'];
        }
        $voutTotal=0;
        foreach($transaction['vout'] as $output){
            $voutTotal+=$output['value'];
        }
        $input=$this->getInputofTransaction($transaction,$bitcoin);
        $transaction['prev_output']=$input;

        $vinTotal=0;
        foreach($input as $currentVin){
            $vinTotal+=$currentVin['value'];
        }

        $transaction['totalOutput']=$voutTotal;
        $transaction['totalInput']=$vinTotal;
        $transaction['fee']=$vinTotal-$voutTotal;

        $data['transaction'] = $transaction;
        $this->load->view('transaction', $data);
    }

    public function getInputofTransaction($transaction, $bitcoin){
        $txid=array();
        $transakcija_temp=array();
        $vout_prev_transaction=array();
        //dohvaćam txid i vout iz vin polja trenutne transakcije
        foreach($transaction['vin'] as $vin){
            $txid[$vin['txid']]=$vin['vout'];
        }
        //pozivam getrawtransaction za svaki id
        //dohvaćam njihove izlaze
        foreach ($txid as $id=>$value){
            $transakcija_temp=$bitcoin->getrawtransaction($id, true);
            for($i=0;$i<count($transakcija_temp['vout']);$i++){
                if($i == $value)
                {
                    array_push($vout_prev_transaction, $transakcija_temp['vout'][$i]);
                }
            }
        }
        return $vout_prev_transaction;
    }

    public function searchFunction(){
        $input=$this->input->post('inputValue');
        $bitcoin = $this->connect();
        $block= $bitcoin->getblock($input);

        //ako nije unesen text u input da se osvježi stranica
        if(empty($input)){
            $this->index();
        }

        if(empty($block)){
            $transaction =  $bitcoin->getrawtransaction($input,true);
            if(empty($transaction)){
                $this->load->view('errors/html/custom_error');
            }
            else
            {
                // view: Transaction
                $this->getTransactionInfo($transaction['txid']);
            }
        }
        else
        {
            // view: block
            $this->getBlockInfo($input);
        }
    }
}
?>