<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Actions\CustomRowAction;
use App\Models\Employee;
use App\Models\RiwayatUsulan;
use App\Models\RiwayatUsulanLog;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FF extends Form
{
    public $able2draft = true;
    public $able2send = true;
    public $able2verify = false;
    public $employee_id;

    /**
     * The form title.
     *
     * @var string
     */
    public $title = '...';

    public $old_data = [];

    public function __construct()
    {
        parent::__construct(new RiwayatUsulan());
        $this->builder = new FormBuilder($this);
    }


    public function edit($data = []): Form
    {
        $this->setView('admin.form-request');
        $this->fields()->each(function (Field $field) use ($data) {

            if (!in_array($field->column(), $this->ignored, true)) {

                $field->fill($data);
            }
        });

        return $this;
    }
    public function store($kategori_layanan_id = null, $ref_id = null, $status_id = null, $action = null)
    {
        $data = \request()->all();
        // Handle validation errors.
        if ($validationMessages = $this->validationMessages($data)) {
            return $this->responseValidationError($validationMessages);
        }

        if (($response = $this->prepare($data)) instanceof Response) {
            return $response;
        }
        DB::transaction(function () use ($status_id, $kategori_layanan_id, $action, $ref_id) {
            $inserts = $this->prepareInsert($this->updates);
            $usulan = new RiwayatUsulan();
            $usulan->new_data = json_encode($inserts);
            $usulan->employee_id = Admin::user()->obj_employee->id;
            $usulan->status_id = $status_id;
            $usulan->old_data = json_encode(session('old_data'));
            $usulan->kategori_layanan_id = $kategori_layanan_id;
            $usulan->ref_id = $ref_id;
            $usulan->action  = $action;
            $usulan->requestor = Admin::user()->getAuthIdentifier();
            $usulan->save();

            $rul = new RiwayatUsulanLog();
            $rul->request_id = $usulan->id;
            $rul->log = "Membuat usulan #{$usulan->id} kategori {$kategori_layanan_id} status {$status_id}";
            $rul->dirty_data = $usulan->new_data;
            $rul->user_id = Admin::user()->getAuthIdentifier();
            $rul->save();
        });
        if (($response = $this->callSaved()) instanceof Response) {
            return $response;
        }

        if ($response = $this->ajaxResponse(trans('admin.save_succeeded'))) {
            return $response;
        }

        return $this->redirectAfterStore();
    }
    public function update($id, $data = null, $status_id = null, $action = null)
    {
        $data = ($data) ?: request()->all();

        $isEditable = $this->isEditable($data);

        if (($data = $this->handleColumnUpdates($id, $data)) instanceof Response) {
            return $data;
        }


        /* @var Model $this ->model */
        $builder = $this->model();

        if ($this->isSoftDeletes) {
            $builder = $builder->withTrashed();
        }

        $this->model = $builder->with($this->getRelations())->findOrFail($id);

        $this->setFieldOriginalValue();

        // Handle validation errors.
        if ($validationMessages = $this->validationMessages($data)) {
            if (!$isEditable) {
                return back()->withInput()->withErrors($validationMessages);
            }

            return response()->json(['errors' => Arr::dot($validationMessages->getMessages())], 422);
        }

        if (($response = $this->prepare($data)) instanceof Response) {
            return $response;
        }

        DB::transaction(function () use ($id, $status_id, $action) {
            $updates = $this->prepareUpdate($this->updates);
            $usulan = RiwayatUsulan::findOrFail($id);
            $usulan->new_data = json_encode($updates);
            $usulan->status_id = $status_id;
            $usulan->action = $action;
            $usulan->save();

            $rul = new RiwayatUsulanLog();
            $rul->request_id = $usulan->id;
            $rul->log = "Memperbaharui usulan #{$usulan->id}  status {$status_id}";
            $rul->dirty_data = $usulan->new_data;
            $rul->user_id = Admin::user()->getAuthIdentifier();
            $rul->save();
        });

        if (($result = $this->callSaved()) instanceof Response) {
            return $result;
        }

        if ($response = $this->ajaxResponse(trans('admin.update_succeeded'))) {
            return $response;
        }

        return $this->redirectAfterUpdate($id);
    }
    public function onEditForm($id)
    {
        $record = RiwayatUsulan::findOrFail($id);
        $data = json_decode($record->new_data, true);
        $old_data = json_decode($record->old_data, true);
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
    public function onTerima($usulan)
    {
        if ($usulan->action == 1) { //Buat Baru
            $inserted_data = json_decode($usulan->new_data, true);
            $record = new $usulan->obj_kategori_layanan->form_request_model();
            foreach ($inserted_data as $key => $val) {
                $record->$key = $val;
            }
            $record->employee_id = $usulan->employee_id;
            return $record->save();
        } else if ($usulan->action == 2) { //Edit
            $updated_data = json_decode($usulan->new_data, true);
            $record = $usulan->obj_kategori_layanan->form_request_model::findOrFail($usulan->ref_id);
            foreach ($updated_data as $key => $val) {
                $record->$key = $val;
            }
            return $record->save();
        } else if ($usulan->action == 3) { //Edit
            $updated_data = json_decode($usulan->new_data, true);
            $record = $usulan->obj_kategori_layanan->form_request_model::findOrFail($usulan->ref_id);
            return $record->delete();
        }
        throw new Exception("belum di buat fn");
    }
    public function onTolak($usulan)
    {
        throw new Exception("belum di buat fn");
    }
    public function onRefCreateForm($ref_id)
    {
        dd("fn belum dibuat");
    }
    public function show($kategori_id)
    {
        if (method_exists($this, 'grid')) {
            $grid =  $this->grid();
            $grid->actions(function ($actions) use ($kategori_id) {
                $actions->disableEdit();
                $actions->disableView();
                $actions->disableDelete();
                $actions->add(new CustomRowAction("Ubah", route("admin.usulan.record.ubah", ['kategori_id' => $kategori_id, 'record_ref_id' => $this->getKey()])));
                $actions->add(new CustomRowAction("Hapus", route("admin.usulan.record.hapus", ['kategori_id' => $kategori_id, 'record_ref_id' => $this->getKey()])));
            });
            $grid->model()->where('employee_id', $this->employee_id);
            return $grid;
        }
        return $this;
    }
}
