<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>dinajpureducationboard</title>
    <link rel="stylesheet" href="{{asset('assets/pdf/style.css')}}"/>
</head>
<body>
<div class="content">
    <table class="top_section">
        <tr>
            <td width="25%"></td>
            <td width="50%" style="text-align: center">
                <img class="logo" src="{{asset('assets/pdf/logo.jpg')}}"/>
                <p class="board_name">
                    মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, দিনাজপুর
                </p>
                <p class="website_link">www.dinajpureducationboard.gov.bd</p>
            </td>

            <td width="25%" style="text-align: right">
                <img class="mojib" src="{{asset('assets/pdf/Mujib_100_Logo.png')}}" alt=""/>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="84%">
                <div>বিষয় : <span class="subject">নাম, পিতার নাম, মাতার নাম সংশােধন</span></div>
                সুত্র : আপনার আবেদন আইডি
                <span style="font-size: 12px">{{data_get($application,'application_no')}}</span>
            </td>
            <td width="16%" style="text-align: right">তারিখঃ {{$application->created_at->format('d-m-Y')}}</td>
        </tr>
    </table>

    <p class="des">
        কর্তৃপক্ষের নির্দেশক্রমে জানানাে যাচ্ছে যে, আপনার আবেদনের প্রেক্ষিতে
        {{$application->created_at->format('d-m-Y')}} তারিখের নাম সংশােধন কমিটির অনুমােদনক্রমে ও পরবর্তী বাের্ড
        কমিটির অনুমােদন সাপেক্ষে ২ নম্বর ছকে প্রয়ােজনীয় সংশােধন করা হ’ল। এ
        আদেশে কোন প্রকার ভুলত্রুটি বা অসংগতি পরিলক্ষিত হলে আদেশটি বাতিল বা পুন;
        সংশােধন করার ক্ষমতা বাের্ড কর্তৃপক্ষ সংরক্ষণ করে।
    </p>
    <table class="inner_table">
        <tr>
            <td style="text-align: center"><h3 style="font-weight: 600;">পরীক্ষার নাম</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">নিবন্ধন নম্বর</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">রােল নম্বর</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">পাসের সন</h3></td>
        </tr>

        @if(!blank($exams))
            <tr>
                <td style="text-align: center">{{data_get($exams,'exam')}}</td>
                <td style="text-align: center">{{data_get($exams,'reg_no')}}</td>
                <td style="text-align: center">{{data_get($exams,'roll_no')}}</td>
                <td style="text-align: center">{{data_get($exams,'passing_year')}}</td>
            </tr>
        @endif
    </table>
    <p class="table_category">ছক-১: যে সকল পরীক্ষায় পরিবর্তন হবে।</p>
    <table class="inner_table">
        <tr>
            <td style="text-align: center"><h3 style="font-weight: 600;">যা সংশােধন হবে</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">ভূল তথ্য [আগে যা ছিল]</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">সঠিক তথ্য [এখন যা হবে]</h3></td>
        </tr>

        @if(data_get($application,'cor_name'))
            <tr>
                <td>নাম</td>
                <td>{{data_get($student,'name')}}</td>
                <td>{{data_get($application,'cor_name')}}</td>
            </tr>
        @endif

        @if(data_get($application,'cor_father_name'))
            <tr>
                <td>পিতার নাম</td>
                <td>{{data_get($student,'father_name')}}</td>
                <td>{{data_get($application,'cor_father_name')}}</td>
            </tr>
        @endif

        @if(data_get($application,'cor_mother_name'))
            <tr>
                <td>মাতার নাম</td>
                <td>{{data_get($student,'mother_name')}}</td>
                <td>{{data_get($application,'cor_mother_name')}}</td>
            </tr>
        @endif

    </table>
    <p class="table_category">ছক-২: যে সকল তথ্য পরিবর্তন হবে।</p>

    <table>
        <tr>
            <td width="40%">
                <p>{{data_get($student,'name')}} (আবেদনকারী)</p>
                <p>{{data_get($student,'phone')}}</p>
            </td>
            <td width="32%"></td>
            <td style="text-align: center; font-size: 14px">
                <p>স্বাঃ</p>
                <p>(মীর আশরাফ আলী)</p>
                <p>উপ-সচিব (বৃত্তি শাখা)</p>
                <p>মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, ঢাকা</p>
            </td>
        </tr>
    </table>

    <p>
        অবগতি ও প্রয়ােজনীয় ব্যবস্থা গ্রহনের অনুরােধ জানিয়ে অনুলিপি প্রেরণ
        করা হ'ল :
    </p>

    <ul class="note">
        <li>১। কলেজ পরিদর্শক,মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, ঢাকা।</li>
        <li>
            ২। বিদ্যালয় পরিদর্শক,মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, ঢাকা।
        </li>
        <li>
            ৩। সিনিয়র সিস্টেম এনালিস্ট, কম্পিউটার শাখা,মাধ্যমিক ও উচ্চমাধ্যমিক
            শিক্ষা বাের্ড, ঢাকা (সংরক্ষিত আর্কাইভ এবং ইন্টারনেট সংশােধনের জন্যে)।
        </li>
        <li>
            ৪। উপ-পরীক্ষা নিয়ন্ত্রক (সনদ), মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড,
            ঢাকা।
        </li>
        <li>৫। সংরক্ষিত নথি।</li>
    </ul>

    <table>
        <tr>
            <td width="72%"></td>
            <td style="text-align: center">
                (মীর আশরাফ আলী) <br/>
                উপ-সচিব (বৃত্তি শাখা) <br/>
                মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, ঢাকা
            </td>
        </tr>
    </table>
    <p class="info" style="text-align: center">
        বিঃ দ্রঃ পত্র ইস্যুর ১৮০ দিনের মধ্যে বাের্ডের সনদ শাখা /বিদ্যালয় শাখা /
        কলেজ শাখা হতে যাবতীয় মূল কাগজপত্র সংশােধন করে নিতে হবে। অন্যথায়
        পুনরায় আবেদন করতে হবে
    </p>
</div>
</body>
</html>
