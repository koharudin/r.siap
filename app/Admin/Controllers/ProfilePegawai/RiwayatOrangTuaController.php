<?php
namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\RiwayatOrangTua;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\URL;

class RiwayatOrangTuaController extends ProfileController
{
    public $activeTab = 'riwayat_orangtua';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Orang Tua';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatOrangTua());
       
        $grid->column('id', __('ID'));
        $grid->column('name', __('NAMA'));
        $grid->column('status', __('STATUS'))->display(function ($status) {
            if($status==2){
                return "Istri";
            }
            else if ($status==1){
                return "Suami";
            }
            else return "-";
        });
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
        $form->hidden('employee_id', __('Employee id'));
        $form->text('name', __('NAMA'));
        $form->select('status')->config('minimumInputLength',0)->options(function ($id) {
            $ls = config('app.sistem.kedudukan_pernikahan');
            if ($ls && @$ls[$id]) {
                return [$id => $ls[$id]];
            }
        })->ajax(URL::to('/api/kedudukan_pernikahan'));
        $form->hidden('employee_id',request()->route('profile_id'));
        return $form;
    }
}
