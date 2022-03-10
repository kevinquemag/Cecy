<?php

namespace App\Http\Controllers\V1\Cecy;

use App\Http\Controllers\Controller;
use App\Models\Cecy\Certificate;
use App\Http\Requests\V1\Cecy\Certificates\IndexCertificateRequest;
use App\Models\Cecy\Catalogue;
use App\Http\Requests\V1\Core\Files\UploadFileRequest;
use App\Models\Cecy\Registration;
use App\Models\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Exports\ParticipantExport;
use App\Imports\CertificatesImport;
use Maatwebsite\Excel\Facades\Excel;
class CertificateController extends Controller
{
    //Descargar certificado del curso
    // CertificateController
    public function downloadCertificateByParticipant(IndexCertificateRequest $request, Registration $registration, Catalogue $catalogue, File $file)
    {
        //$participant = Participant::firstWhere('user_id', $request->user()->id);
        $certificate = $registration->certificate()->where(['state' => function ($state) {
            $state->where('code', 'APPROVED')->first();
        }]);
        return $catalogue->downloadFileCertificates($file);
    }

    //Subir certificado Firmado
    // CerticateController
    public function uploadFileCertificateFirm(UploadFileRequest $request, Catalogue $catalogue)
    {

        return $catalogue->uploadFileCertificateFirm($request);
    }

    //Carga de codigos certificado excel
    // CerticateController
    public function uploadFileCertificate(UploadFileRequest $request, Catalogue $catalogue)
    {
        return $catalogue->uploadFileCertificate($request);
    }

    //Descarga de certificados generados
    // CerticateController
    public function downloadFileCertificates(Catalogue $catalogue, File $file)
    {
        return $catalogue->downloadFileCertificates($file);
    }

    //Genera los Pdfs del estudiante 
    //CertificateController
    public function generatePdf(){
    $pdf = PDF::loadView('reports/certificate-student');
    $pdf->setOptions([
        'orientation' => 'landscape',
        'page-size' => 'a4'
    ]);

    return $pdf->inline('Certificado.pdf');

    }

     //Genera los Pdfs del instructor
    //CertificateController
    public function generatePdfInstructor(){
        $pdf = PDF::loadView('reports/certificate-instructor');
        $pdf->setOptions([
            'orientation' => 'landscape',
            'page-size' => 'a4'
        ]);
    
        return $pdf->inline('Certificado.pdf');
    
        }


    public function exportToXlsl (){
        return Excel::download(new ParticipantExport, 'Certificado.xlsx');
    }

    public function import (){
        return view ('reports.certificate-student');
    }


    public function importData(Request $request) {
        Excel::import(new CertificatesImport, request()->file('excel'));
        
    }
    

}
