<?php

namespace App\Service;

use App\Models\Application;

class ExportDataService
{
    public function queryPendingData($keyword)
    {
        $query = Application::with('exams')->pending();

        if (!blank($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('sonali_sheba_no', 'LIKE', "%" . $keyword . "%")
                    ->orWhereHas('student', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('father_name', 'like', '%' . $keyword . '%')
                            ->orWhere('mother_name', 'like', '%' . $keyword . '%')
                            ->orWhere('eiin_no', 'like', '%' . $keyword . '%')
                            ->orWhere('center_code', 'like', '%' . $keyword . '%')
                            ->orWhere('phone', 'like', '%' . $keyword . '%');
                    })->orWhereHas('exams', function ($q) use ($keyword) {
                        $q->where('roll_no', 'like', '%' . $keyword . '%')
                            ->orWhere('reg_no', 'like', '%' . $keyword . '%');
                    });
            });
        }

        return $query->get()->map(function ($item, $key) {

            $exam = $item->exams->map(function ($item) {
                return $item->exam->title;
            })->implode(',');

            $passingYear = $item->exams->map(function ($item) {
                return $item->passing_year;
            })->toArray();

            $rollNo = $item->exams->map(function ($item) {
                return $item->roll_no;
            })->toArray();

            $regNo = $item->exams->map(function ($item) {
                return $item->reg_no;
            })->toArray();

            $session = $item->exams->map(function ($item) {
                return $item->session;
            })->toArray();

            return [
                'sl'              => ($key + 1),
                'exam'            => $exam,
                'passing_year'    => rtrim(implode(',', $passingYear), ','),
                'roll_no'         => rtrim(implode(',', $rollNo), ','),
                'reg_no'          => rtrim(implode(',', $regNo), ','),
                'session'         => rtrim(implode(',', $session), ','),
                'name'            => data_get($item, 'student.name'),
                'cor_name'        => data_get($item, 'cor_name'),
                'cor_father_name' => data_get($item, 'cor_father_name'),
                'cor_mother_name' => data_get($item, 'cor_mother_name'),
                'cor_religion'    => data_get($item, 'cor_religion'),
                'cor_gender'      => data_get($item, 'cor_gender'),
                'cor_dob'         => data_get($item, 'cor_dob'),
                'sonali_sheba_no' => data_get($item, 'sonali_sheba_no'),
            ];
        })->toArray();
    }

    public function queryLiterallyData($keyword)
    {
        $query = Application::with('exams')->correction();

        if (!blank($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('sonali_sheba_no', 'LIKE', "%" . $keyword . "%")
                    ->orWhereHas('student', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('father_name', 'like', '%' . $keyword . '%')
                            ->orWhere('mother_name', 'like', '%' . $keyword . '%')
                            ->orWhere('eiin_no', 'like', '%' . $keyword . '%')
                            ->orWhere('center_code', 'like', '%' . $keyword . '%')
                            ->orWhere('phone', 'like', '%' . $keyword . '%');
                    })->orWhereHas('exams', function ($q) use ($keyword) {
                        $q->where('roll_no', 'like', '%' . $keyword . '%')
                            ->orWhere('reg_no', 'like', '%' . $keyword . '%');
                    });
            });
        }

        return $query->get()->map(function ($item, $key) {
            $exam = $item->exams->map(function ($item) {
                return $item->exam->title;
            })->implode(',');

            $passingYear = $item->exams->map(function ($item) {
                return $item->passing_year;
            })->toArray();

            $rollNo = $item->exams->map(function ($item) {
                return $item->roll_no;
            })->toArray();

            $regNo = $item->exams->map(function ($item) {
                return $item->reg_no;
            })->toArray();

            $session = $item->exams->map(function ($item) {
                return $item->session;
            })->toArray();

            return [
                'sl'              => ($key + 1),
                'exam'            => $exam,
                'passing_year'    => rtrim(implode(',', $passingYear), ','),
                'roll_no'         => rtrim(implode(',', $rollNo), ','),
                'reg_no'          => rtrim(implode(',', $regNo), ','),
                'session'         => rtrim(implode(',', $session), ','),
                'name'            => data_get($item, 'student.name'),
                'cor_name'        => data_get($item, 'cor_name'),
                'cor_father_name' => data_get($item, 'cor_father_name'),
                'cor_mother_name' => data_get($item, 'cor_mother_name'),
                'cor_religion'    => data_get($item, 'cor_religion'),
                'cor_gender'      => data_get($item, 'cor_gender'),
                'cor_dob'         => data_get($item, 'cor_dob'),
                'sonali_sheba_no' => data_get($item, 'sonali_sheba_no'),
            ];
        })->toArray();
    }

    public function queryMeetingData($keyword)
    {
        $query = Application::with('exams')->meeting();

        if (!blank($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('sonali_sheba_no', 'LIKE', "%" . $keyword . "%")
                    ->orWhereHas('student', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('father_name', 'like', '%' . $keyword . '%')
                            ->orWhere('mother_name', 'like', '%' . $keyword . '%')
                            ->orWhere('eiin_no', 'like', '%' . $keyword . '%')
                            ->orWhere('center_code', 'like', '%' . $keyword . '%')
                            ->orWhere('phone', 'like', '%' . $keyword . '%');
                    })->orWhereHas('exams', function ($q) use ($keyword) {
                        $q->where('roll_no', 'like', '%' . $keyword . '%')
                            ->orWhere('reg_no', 'like', '%' . $keyword . '%');
                    });
            });
        }

        return $query->get()->map(function ($item, $key) {
            $exam = $item->exams->map(function ($item) {
                return $item->exam->title;
            })->implode(',');

            $passingYear = $item->exams->map(function ($item) {
                return $item->passing_year;
            })->toArray();

            $rollNo = $item->exams->map(function ($item) {
                return $item->roll_no;
            })->toArray();

            $regNo = $item->exams->map(function ($item) {
                return $item->reg_no;
            })->toArray();

            $session = $item->exams->map(function ($item) {
                return $item->session;
            })->toArray();

            return [
                'sl'              => ($key + 1),
                'exam'            => $exam,
                'passing_year'    => rtrim(implode(',', $passingYear), ','),
                'roll_no'         => rtrim(implode(',', $rollNo), ','),
                'reg_no'          => rtrim(implode(',', $regNo), ','),
                'session'         => rtrim(implode(',', $session), ','),
                'name'            => data_get($item, 'student.name'),
                'cor_name'        => data_get($item, 'cor_name'),
                'cor_father_name' => data_get($item, 'cor_father_name'),
                'cor_mother_name' => data_get($item, 'cor_mother_name'),
                'cor_religion'    => data_get($item, 'cor_religion'),
                'cor_gender'      => data_get($item, 'cor_gender'),
                'cor_dob'         => data_get($item, 'cor_dob'),
                'sonali_sheba_no' => data_get($item, 'sonali_sheba_no'),
            ];
        })->toArray();
    }

    public function queryApproveData($keyword)
    {
        $query = Application::with('exams')->approve();

        if (!blank($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('sonali_sheba_no', 'LIKE', "%" . $keyword . "%")
                    ->orWhereHas('student', function ($query) use ($keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('father_name', 'like', '%' . $keyword . '%')
                            ->orWhere('mother_name', 'like', '%' . $keyword . '%')
                            ->orWhere('eiin_no', 'like', '%' . $keyword . '%')
                            ->orWhere('center_code', 'like', '%' . $keyword . '%')
                            ->orWhere('phone', 'like', '%' . $keyword . '%');
                    })->orWhereHas('exams', function ($q) use ($keyword) {
                        $q->where('roll_no', 'like', '%' . $keyword . '%')
                            ->orWhere('reg_no', 'like', '%' . $keyword . '%');
                    });
            });
        }

        return $query->get()->map(function ($item, $key) {

            $exam = $item->exams->map(function ($item) {
                return $item->exam->title;
            })->implode(',');

            $passingYear = $item->exams->map(function ($item) {
                return $item->passing_year;
            })->toArray();

            $rollNo = $item->exams->map(function ($item) {
                return $item->roll_no;
            })->toArray();

            $regNo = $item->exams->map(function ($item) {
                return $item->reg_no;
            })->toArray();

            $session = $item->exams->map(function ($item) {
                return $item->session;
            })->toArray();

            return [
                'sl'              => ($key + 1),
                'exam'            => $exam,
                'passing_year'    => rtrim(implode(',', $passingYear), ','),
                'roll_no'         => rtrim(implode(',', $rollNo), ','),
                'reg_no'          => rtrim(implode(',', $regNo), ','),
                'session'         => rtrim(implode(',', $session), ','),
                'name'            => data_get($item, 'student.name'),
                'cor_name'        => data_get($item, 'cor_name'),
                'cor_father_name' => data_get($item, 'cor_father_name'),
                'cor_mother_name' => data_get($item, 'cor_mother_name'),
                'cor_religion'    => data_get($item, 'cor_religion'),
                'cor_gender'      => data_get($item, 'cor_gender'),
                'cor_dob'         => data_get($item, 'cor_dob'),
                'sonali_sheba_no' => data_get($item, 'sonali_sheba_no'),
            ];
        })->toArray();
    }
}
