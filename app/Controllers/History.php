<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
{
    protected $historyModel;
    public function __construct()
    {
        $this->historyModel = new HistoryModel();

    }
    public function index()
    {
        $history = $this->historyModel->findAll();
        $data =[
            'title'=>'Daftar History',
            'history'=>$history
        ];
        return view('/history',$data);
    }
    public function simpan()
    {
        
        $this->historyModel->save([
                'awal'=>$this->request->getVar('awal'),
                'tujuan'=>$this->request->getVar('tujuan'),
                'radius'=>$this->request->getVar('radius'),
                'jarak'=>$this->request->getVar('jarak'),
            ]);

            return redirect()->to('/history');
    }

}