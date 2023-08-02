<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Actions\HapusUsulanAction;
use App\Admin\Actions\UbahUsulan;
use App\Admin\Actions\UbahUsulanAction;
use App\Admin\Extensions\UsulanRow;
use App\Models\KategoriLayanan;
use App\Models\RiwayatUsulan;
use App\Models\RiwayatUsulanLog;
use Closure;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class FormRequest extends Form
{
    protected $record_id;
    protected $profile_id;
    protected $record_ref_id;
    protected $kategori_id;
    protected $view;
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Kategori Layanan';

    public function setRecordId($record_id)
    {
        $this->record_id = $record_id;
    }
    public function getRecordId()
    {
        return $this->record_id;
    }

    public function setRecordRefId($record_ref_id)
    {
        $this->record_ref_id = $record_ref_id;
    }
    public function getRecordRefId()
    {
        return $this->record_ref_id;
    }
    public function setKategoriId($kategori_id)
    {
        $this->kategori_id = $kategori_id;
    }
    public function getKategoriId()
    {
        return $this->kategori_id;
    }
    public function getProfileId()
    {
        return request()->profile_uid;
    }
    public function init()
    {
        if (method_exists($this, 'grid')) {
            $grid =  $this->grid();
            $_this = $this;
            $grid->actions(function ($actions) use ($_this) {
                $actions->disableView();
                $actions->disableEdit();
                $actions->disableDelete();
                $actions->add(new UbahUsulanAction($_this->getKategoriId(),$this->getKey()));
                $actions->add(new HapusUsulanAction($_this->getKategoriId(),$this->getKey()));
            });
            return $grid;
        }
        return $this;
    }
    
    public function createRequestDropFromRecord($kategori_id,$record_ref_id,$status_id){
        $usulan = new RiwayatUsulan();
        $usulan->kategori_layanan_id = $kategori_id;
        $usulan->ref_id = $record_ref_id;
        $usulan->requestor = Admin::user()->getAuthIdentifier();
        $usulan->new_data = json_encode(request()->all());
        $usulan->old_data = json_encode($this->refData());
        $usulan->status_id = $status_id;
        $usulan->action = 3;
        $changes = $usulan->getDirty();
        $usulan->save();
    }
    public function createRequestChangeFromRecord($kategori_id,$record_ref_id,$status_id){
        $usulan = new RiwayatUsulan();
        $usulan->kategori_layanan_id = $kategori_id;
        $usulan->ref_id = $record_ref_id;
        $usulan->requestor = Admin::user()->getAuthIdentifier();
        $usulan->new_data = json_encode(request()->all());
        $usulan->old_data = json_encode($this->refData());
        $usulan->status_id = $status_id;
        $usulan->action = 2;
        $changes = $usulan->getDirty();
        $usulan->save();

        $log = new RiwayatUsulanLog();
        $log->user_id = Admin::user()->getAuthIdentifier();
        $log->request_id = $usulan->id;
        $log->log = "Membuat usulan dari kategori {$kategori_id} record ref {$record_ref_id}";
        $log->dirty_data = json_encode($changes);
        $log->save();
        admin_success('Informasi','Usulan berhasil di proses');
        return redirect(route('admin.usulan.detail',['id'=>$usulan->id]));
    }
    public function editRequest(RiwayatUsulan $usulan,$status_id){
        $usulan->requestor = Admin::user()->getAuthIdentifier();
        $usulan->new_data = json_encode(request()->all());
        $usulan->status_id = $status_id;
        $changes  = $usulan->getDirty();
        $usulan->save();
        
        $log = new RiwayatUsulanLog();
        $log->user_id = Admin::user()->getAuthIdentifier();
        $log->request_id = $usulan->id;
        $log->log = "Mengubah usulan dari kategori {$usulan->kategori_id} record  {$usulan->id}";
        $log->dirty_data = json_encode($changes);
        $log->save();

        admin_success('Informasi','Usulan berhasil di proses');
        return redirect(route('admin.usulan.detail',['id'=>$usulan->id]));
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->buildForm();
        //$this->action(route('admin.usulan.proses'));
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function newData()
    {
        if ($this->record_id) {
            $record = RiwayatUsulan::findOrFail($this->getRecordId());
            $data =  json_decode($record->new_data, true);
            return $data;
        }
    }
    public function data(){
        if ($this->record_id) {
            $record = RiwayatUsulan::findOrFail($this->getRecordId());
            $data =  json_decode($record->new_data, true);
            return $data;
        }
        if($this->record_ref_id){
            return $this->refData();
        }
    }
    public function oldData()
    {
        if ($this->record_id) {
            $record = RiwayatUsulan::findOrFail($this->getRecordId());
            return json_decode($record->old_data,true);
        }
    }
   
    public $able2draft = true;
    public $able2send = true;
    public $able2verify = false;
    public function render()
    {
        $this->prepareForm();

        $this->prepareHandle();

        $vars = $this->getVariables();
        $vars['oldData'] = $this->oldData();
        $vars['able2verify'] = $this->able2verify;
        $vars['able2draft'] = $this->able2draft;
        $vars['able2send'] = $this->able2send;
        $vars['record_id'] = $this->record_id;
        $vars['record_ref_id'] = $this->record_ref_id;
        $vars['kategori_layanan_id']=$this->kategori_id;
        $form = view($this->view, $vars)->render();

        if (!($title = $this->title()) || !$this->inbox) {
            return $form;
        }

        return (new Box($title, $form))->render();
    }
    public function view($view){
        $this->view = $view;
    }
    public function onTerima(RiwayatUsulan $usulan){

    }
    public function onTolak(RiwayatUsulan $usulan){
        
    }
}
