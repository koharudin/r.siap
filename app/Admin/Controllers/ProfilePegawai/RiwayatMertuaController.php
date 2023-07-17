<?php
namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatOrangTua;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\MessageBag;

class RiwayatMertuaController extends ProfileController
{
    public $activeTab = 'riwayat_mertua';
    public $klasifikasi_id = 24;      
    public $use_document = false;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Mertua';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatOrangTua());
        $grid->model()->whereIn("status",[3,4]);
        $grid->model()->orderBy('status','asc');
        $grid->column('name', __('NAMA'));
        $grid->column('status', __('STATUS'))->display(function ($status) {
            if($status==4){
                return "Ibu";
            }
            else if ($status==3){
                return "Ayah";
            }
            else return "-";
        });
        $grid->column('birth_date', __('TGL LAHIR'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(RiwayatOrangTua::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('NAMA'));
        $show->field('status', __('STATUS'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatOrangTua());
        
        
        if($form->isCreating()){
            $form->select('status')->options(['3'=>'Mertua Ayah','4'=>'Mertua Ibu'])->required(true);
        }

        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->textarea('alamat', __('ALAMAT'));
        $form->text('telepon', __('TELEPON'));

        $_this=$this;
        $form->saving(function (Form $form) use($_this)  {
            if($form->isCreating()){
                $orang_tua = RiwayatOrangTua::where('employee_id',$_this->getProfileId())->where('status',$form->status)->get()->first();
                if($orang_tua){
                    $error = new MessageBag([
                        'title'   => 'Pesan...',
                        'message' => 'Data orang tua sudah ada',
                    ]);
                
                    return back()->with(compact('error'));
                }
            }
        });
        return $form;
    }
}
