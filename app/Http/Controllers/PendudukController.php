<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Penduduk;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Repository\PendudukRepository;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    protected $pendudukRepository;

    public function __construct(PendudukRepository $pendudukRepository)
    {
        $this->pendudukRepository = $pendudukRepository;
    }


    public function index()
    {
        return view('kelolaPenduduk', [
            'data' => $this->pendudukRepository->index(),
        ]);
    }

    public function filterProvinsi($id)
    {
        return view('kelolaPenduduk', [
            'data' => $this->pendudukRepository->filterProvinsi($id),
        ]);
    }
    public function filterKabupaten($id)
    {
        return view('kelolaPenduduk', [
            'data' => $this->pendudukRepository->filterKabupaten($id),
        ]);
    }

    public function kabupaten(Request $request)
    {
        $kabupaten = $this->pendudukRepository->kabupaten($request->prov_id);
        return response()->json($kabupaten);
    }

    public function store(StorePendudukRequest $request)
    {
        if ($request->validated()) {
            if ($this->pendudukRepository->store($request->all())) {
                return redirect('/kelolaPenduduk')->with('PendudukSuccess', 'Tambah Penduduk Berhasil');
            }
            return redirect('/kelolaPenduduk')->with('PendudukError', 'Tambah Penduduk Gagal');
        }
    }

    public function update(UpdatePendudukRequest $request, Penduduk $penduduk)
    {
        if ($request->validated()) {
            if ($this->pendudukRepository->update($request->all(), $penduduk)) {
                return redirect('/kelolaPenduduk')->with('PendudukSuccess', 'Edit Penduduk Berhasil');
            }
            return redirect('/kelolaPenduduk')->with('PendudukError', 'Edit Penduduk Gagal');
        }
    }

    public function destroy(Penduduk $penduduk)
    {
        if ($this->pendudukRepository->destroy($penduduk)) {
            return redirect('/kelolaPenduduk')->with('PendudukSuccess', 'Hapus Penduduk Berhasil');
        }
        return redirect('/kelolaPenduduk')->with('PendudukError', 'Hapus Penduduk Gagal');
    }

    public function laporan(Request $request)
    {
        $data = json_decode($request->laporan);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Tgl Lahir');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Jenis Kelamin');
        $sheet->setCellValue('G1', 'TimeStamp');
        $x = 2;
        $no = 1;
        for ($i = 0; $i <count($data); $i++) {
            $sheet->setCellValue('A' . $x, $no);
            $sheet->setCellValue('B' . $x, $data[$i]->name);
            $sheet->setCellValue('C' . $x, $data[$i]->nik);
            $sheet->setCellValue('D' . $x, $data[$i]->birth_date);
            $sheet->setCellValue('E' . $x, $data[$i]->prov . ", " . $data[$i]->kab);
            $sheet->setCellValue('F' . $x, $data[$i]->gender);
            $sheet->setCellValue('F' . $x, $data[$i]->updated_at);
            $x++;
            $no++;
        }

        $writer = new Xlsx($spreadsheet);
        $path = public_path() . '\excel\DataPenduduk.xlsx';
        $headers = array(
            'Content-Type: application/xlsx',
        );
        $writer->save($path);
        // // return redirect($path);
        return response()->download($path, 'DataPenduduk.xlsx', $headers);
    }
}
