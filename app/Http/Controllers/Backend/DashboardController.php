<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApproveApplication;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Service\DataService;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Storage;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;


class DashboardController extends Controller
{

    public function index()
    {
        $pending  = Application::pending()->count();
        $approved = Application::approve()->count();
        return view('backend.dashboard.index', compact('pending', 'approved'));
    }

    public function getPending()
    {
        $user     = auth()->user();
        $userRole = data_get($user, 'user_role');

//        if ($userRole == 3 || $userRole == 4) {
//            return view('backend.dashboard.pending-list');
//        }
        return view('backend.college.index');
    }


    //=============================================
    public function details(Application $application)
    {
        $data = resolve(DataService::class)->transformApplication($application);
        return view('backend.application.details', compact('data'));
    }

    public function downloadMarksheet(Application $application)
    {
        $attachment = data_get($application, 'student.academicInfo.attachment');
        return Storage::disk('public')->download($attachment);
    }



    public function downloadPdf(Application $application)
    {
//        $defaultConfig     = (new ConfigVariables())->getDefaults();
//        $fontDirs          = $defaultConfig['fontDir'];
//        $defaultFontConfig = (new FontVariables())->getDefaults();
//        $fontData          = $defaultFontConfig['fontdata'];
//        $mpdf              = new Mpdf([
//            'tempDir'  => storage_path('tempdir'),
//            'fontDir'  => array_merge($fontDirs, [
//                public_path('assets/fonts'),
//            ]),
//            'fontdata' => $fontData + [
//                    'nikosh'  => [
//                        'R'      => "Nikosh.ttf",
//                        'useOTL' => 0xFF,
//                    ],
//                    'dm-sans' => [
//                        'R'      => "DMSans-Regular.ttf",
//                        'B'      => "DMSans-Bold.ttf",
//                        'useOTL' => 0xFF,
//                    ],
//                ],
//
//            'default_font'     => 'dm-sans',
//            'mode'             => 'utf-8',
//            'autoScriptToLang' => true,
//            'autoLangToFont'   => true,
//            'format'           => 'A4',
//        ]);

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

//        $view = view('pdf.approve-student', compact('sharok', 'student', 'user', 'approveDate'));
//        $mpdf->WriteHTML($view->render());
//
//        $fileName = 'tc_' . data_get($application, 'student.name') . '.pdf';
//        $mpdf->Output($fileName, 'D');

        return view('pdf.approve-student', compact('sharok', 'student', 'user', 'approveDate'));
    }






    public function downloadApproveList()
    {
        $defaultConfig     = (new ConfigVariables())->getDefaults();
        $fontDirs          = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData          = $defaultFontConfig['fontdata'];
        $sharok            = Application::approve()->with('student.academicInfo')->get();
        $applications      = $sharok->groupBy('sharok_no')->toArray();
        $user              = User::where('eiin_no', 444444)->first();

        $mpdf = new Mpdf([
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

        if (!blank($applications)) {

            foreach ($applications as $sharok => $items) {

                $itemData    = collect($items)->first();
                $approveDate = ApproveApplication::where('application_id', data_get($itemData, 'id'))->where('user_id', 668)->first();

                $mpdf->AddPage();

                $item = collect($items)->map(function ($item) {
                    $curCollege = data_get($item, 'student.academic_info.college_name') .
                        ' (' . data_get($item, 'student.academic_info.eiin_no') . ')';
                    $adCollege  = data_get($item, 'college_name') .
                        ' (' . data_get($item, 'to_college_eiin') . ')';

                    return [
                        'name'          => data_get($item, 'student.name'),
                        'current_col'   => $curCollege,
                        'admission_col' => $adCollege,
                        'subject_comp'  => data_get($item, 'student.academic_info.subject_comp'),
                        'subject_optn'  => data_get($item, 'student.academic_info.subject_optn'),
                        'ssc_info'      => data_get($item, 'student.academic_info.ssc_roll_no') . ', ' . data_get($item, 'student.academic_info.ssc_reg_no') . ', ' .
                            data_get($item, 'student.academic_info.ssc_pass_year') . ', ' .
                            data_get($item, 'student.academic_info.ssc_bord'),
                    ];
                });
                $view = view('pdf.approve-pdf', compact('sharok', 'item', 'user','approveDate'));
                $mpdf->WriteHTML($view->render());
            }
        }

        $fileName = 'tc-' . now()->format('d-m-Y') . '.pdf';
        $mpdf->Output($fileName, 'D');
    }

    //===============================================

    public function getApprove()
    {
        return view('backend.dashboard.approve-list');
    }

    public function comments()
    {
        return view('backend.comment.index');
    }

    public function signatures()
    {
        return view('backend.signature.index');
    }

    public function sitAdjust()
    {
        return view('backend.adjust.index');
    }

    //================================ student =========================

    public function student()
    {
        $student = auth()->guard('student')->user();
        return view('backend.student.index', compact('student'));
    }

    public function college()
    {
        return view('backend.college.index');
    }
}
