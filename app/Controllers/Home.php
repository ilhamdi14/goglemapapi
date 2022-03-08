<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
        return view('beranda');
    }
     public function halPeta()
     {
         return view('halPeta');
     }
     public function history()
     {
        return view('history');
        
     }

     public function simpan()
     {
        // $data = array(
        //     'nim'=>$this->input->post('awal'),
        //     'tujuan'=>$this->input->post('tujuan'),
        //     'radius'=>$this->input->post('radius'),
        //     'range'=>$this->input->post('range')
        //     );
        //     $this->db->insert('history',$data);

        
     }
}
