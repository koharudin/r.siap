<?php

namespace App\Http\Controllers;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\Request as RequestPelayanan;
use App\Models\RequestCategory;
use App\Models\RequestLog;
use App\Models\RequestStep;
use Exception;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class DaftarUsulanController extends Controller
{
    public function list()
    {
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();

        return response()->json($employee->obj_requests()->getQuery()->with(['obj_status', 'obj_kategori'])->orderBy('created_at', 'desc')->paginate());
    }
    public function store()
    {
        $action = request()->input("action");
        $id = request()->input("id");
        $layanan_id  = request()->input("layanan_id");
        $ref_data = json_decode(request()->input("ref_data"));
        $new_data = json_decode(request()->input("new_data"));
        if ($new_data == null) {
            $new_data = new stdClass;
        }
        DB::beginTransaction();
        $user = FacadesAuth::user();
        $request_category = RequestCategory::find($layanan_id);
        $cls =  $request_category->acceptedclass;
        // $cls = "App\Http\Controllers\VerifikasiController";
        if ($cls == "") {
            throw new Exception("VerifiedClass masih kosong " . $cls);
        }
        $cls = "App\Models\VerifiedClass\\" . $cls;
        if (!class_exists($cls)) {
            throw new Exception("Turunan dari VerifiedClass tidak ditemukan " . $cls);
        }

        $ac = new $cls();
        if (!is_subclass_of($cls, AcceptedClass::class)) {
            throw new Exception(" VerifiedClass harus turunan dari AcceptedClass");
        }
        if(method_exists($ac,"checkSubmit")){
           // $ac->checkSubmit();
        }
       

        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();
        try {
            $request = new RequestPelayanan();

            $request->action = $action;
            $request->category_id = $layanan_id;
            $request->employee_id =  $employee->id;
            $request->creator = $user->id;
            $request->status_id = RequestStep::SEND;

            $files = request()->file("files-dokumen_pendukung");
            $data_files = [];
            if (request()->hasFile('files-dokumen_pendukung')) {

                $disk_layanan = Storage::disk("minio_layanan");
                foreach ($files as $file) {
                    $ext = "." . $file->getClientOriginalExtension();
                    $randomFileName = "usulan_" . md5(uniqid()) . $ext;
                    $data_files[] = $randomFileName;
                    $disk_layanan->putFileAs("/", $file, $randomFileName);
                }
                $new_data->dokumen_pendukung = $data_files;
            } else {
                if ($action == 3) //penghapusan
                {
                } else throw new Exception("Tidak ada file");
            }
            $request->data = [
                "action" => $action,
                "id" => $id,
                "ref_data" => $ref_data,
                "new_data" => $action == 3 ? $ref_data : $new_data
            ];
            $request->save();
            $requestLog = new RequestLog();
            $requestLog->user_id = $user->id;
            $requestLog->request_id = $request->id;
            $requestLog->values = [
                "status_id" => RequestStep::SEND,
                "keterangan" => "Pembuatan Usulan ",
                "ref_data" => $ref_data,
                "new_data" => $action == 3 ? $ref_data : $new_data
            ];
            $requestLog->save();
            DB::commit();
            return response()->json([
                "uuid" => $request->uuid,
                "files" => $files
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json("Tidak dapat menyimpan ke database <br>" . $e->getMessage(), 500);
        }
    }
    public function edit($uuid)
    {
        $request = RequestPelayanan::where("uuid", $uuid)->with(['obj_status', 'obj_kategori', 'obj_employee', 'obj_logs', 'obj_logs.obj_user'])->first();
        if ($request) {
            if ($request->status_id < 5) {
                return response()->json(["uuid" => $uuid, "data" => $request], 200);
            } else return response()->json(["message" => "Usulan tidak bisa di edit"], 500);
        }
        return response()->json(["uuid" => $uuid], 404);
    }
    public function update($uuid)
    {
        DB::beginTransaction();
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();
        try {
            $request = RequestPelayanan::where("uuid", $uuid)->get()->first();
            if (!$request) {
                return response()->json(["message" => "Usulan tidak ditemukan"], 404);
            }
            if ($request->status_id >= 5) {
                return response()->json(["request" => $request, "message" => "Status usulan sudah di Tolak/Terima. Usulan tidak bisa di update"], 500);
            }
            $files = request()->file("files-dokumen_pendukung");

            $new_data = json_decode(request()->input("new_data"));
            if ($new_data == null) {
                $new_data = new stdClass;
            }

            if (request()->hasFile('files-dokumen_pendukung')) {
                $data_files = [];
                $disk_layanan = Storage::disk("minio_layanan");
                foreach ($files as $file) {
                    $ext = "." . $file->getClientOriginalExtension();
                    $randomFileName = "usulan_" . md5(uniqid()) . $ext;
                    $data_files[] = $randomFileName;
                    $disk_layanan->putFileAs("/", $file, $randomFileName);
                }
                $new_data->dokumen_pendukung = $data_files;
            }

            $request->status_id = RequestStep::SEND;
            $data = $request->data;
            $data["new_data"] = $new_data;
            $request->data = $data;
            $request->save();

            $requestLog = new RequestLog();
            $requestLog->user_id = $user->id;
            $requestLog->request_id = $request->id;
            $requestLog->values = [
                "status_id" => RequestStep::SEND,
                "keterangan" => "Update Kembali Usulan ",
                "new_data" => $new_data
            ];
            $requestLog->save();
            DB::commit();
            return response()->json([
                "uuid" => $request->uuid,
                "message" => "Usulan berhasil disimpan",
                "files" => $files
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json(["message" => "Usulan gagal di update", "systemMesage" => $e->getMessage()], 500);
        }
    }
    public function detail($uuid)
    {
        $request = RequestPelayanan::where("uuid", $uuid)->with(['obj_status', 'obj_kategori', 'obj_employee', 'obj_logs', 'obj_logs.obj_user'])->first();
        if ($request) {
            return response()->json(["uuid" => $uuid, "data" => $request], 200);
        }
        return response()->json(["uuid" => $uuid], 404);
    }
    public function hapus($uuid)
    {
        $request = RequestPelayanan::where("uuid", $uuid)->first();
        if ($request) {
            $request->delete();
            return response()->json(["uuid" => $uuid, "data" => $request], 200);
        }
        return response()->json(["uuid" => $uuid], 404);
    }
}
