<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Application;
use App\Models\ApproveApplication;
use App\Models\User;
use App\Service\CommonService;
use App\Service\StudentDetails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;

class StudentController extends Controller
{


    public function index()
    {
        return view('frontend.pages.index');
    }


    public function downloadPdf(Application $application)
    {
        $mpdf = $this->configMpdf();
        $user        = User::where('eiin_no', 444444)->first();
        $approveDate = ApproveApplication::where('application_id', data_get($application, 'id'))->where('user_id', 668)->first();
        $curCollege  = data_get($application, 'student.academicInfo.college_name') . ' (' . data_get($application, 'student.academicInfo.eiin_no') . ')';
        $adCollege   = data_get($application, 'college_name') . ' (' . data_get($application, 'to_college_eiin') . ')';
        $sharok      = data_get($application, 'sharok_no');
        $student = [
            'name'          => data_get($application, 'student.name'),
            'current_col'   => $curCollege,
            'admission_col' => $adCollege,
            'subject_comp'  => data_get($application, 'student.academicInfo.subject_comp'),
            'subject_optn'  => data_get($application, 'student.academicInfo.subject_optn'),
            'ssc_info'      => data_get($application, 'student.academicInfo.ssc_roll_no') . ', ' .
                data_get($application, 'student.academicInfo.ssc_reg_no') . ', ' .
                data_get($application, 'student.academicInfo.ssc_pass_year') . ', ' .
                data_get($application, 'student.academicInfo.ssc_bord'),
        ];
        $view = view('pdf.approve-student', compact('sharok', 'student', 'user', 'approveDate'));
        $mpdf->WriteHTML($view->render());
        $fileName = 'tc_' . data_get($application, 'student.name') . '.pdf';
        $mpdf->Output($fileName, 'D');
    }


    protected function configMpdf()
    {
        $defaultConfig     = (new ConfigVariables())->getDefaults();
        $fontDirs          = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData          = $defaultFontConfig['fontdata'];
        return new Mpdf([
            'tempDir'  => storage_path('tempdir'),
            'fontDir'  => array_merge($fontDirs, [
                public_path('assets/fonts'),
            ]),
            'fontdata' => $fontData + [
                    'nikosh'  => [
                        'R'      => "Nikosh.ttf",
                        'useOTL' => 0xFF,
                    ],
                    'dm-sans' => [
                        'R'      => "DMSans-Regular.ttf",
                        'B'      => "DMSans-Bold.ttf",
                        'useOTL' => 0xFF,
                    ],
                ],

            'default_font'     => 'dm-sans',
            'mode'             => 'utf-8',
            'autoScriptToLang' => true,
            'autoLangToFont'   => true,
            'format'           => 'A4',
        ]);
    }

}
