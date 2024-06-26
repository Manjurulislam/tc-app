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
            <td width="10%">
                <img class="logo" src="{{asset('assets/pdf/logo.jpg')}}"/>
            </td>
            <td width="80%" style="text-align: center">
                <p class="board_name">
                    মাধ্যমিক ও উচ্চমাধ্যমিক শিক্ষা বাের্ড, দিনাজপুর
                </p>
                <p class="website_link">Web: www.dinajpureducationboard.gov.bd, email :
                    dinajpureducationboard@gmail.com</p>
            </td>

            <td width="10%" style="text-align: right">
                {{--                <img class="mojib" src="{{asset('assets/pdf/Mujib_100_Logo.png')}}" alt=""/>--}}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="84%">
                <div>স্মারক নং - <span class="subject">{{$sharok}}</span></div>
            </td>
            <td width="16%" style="text-align: right">
                তারিখঃ {{data_get($approveDate,'approve_at') ? data_get($approveDate,'approve_at')->format('d-m-Y') : ''}}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>
                <div>
                    <span style="font-size: 22px" class="subject">বিষয় : ২০২৩-২০২৪ শিক্ষাবর্ষে একাদশ শ্রেণিতে অধ্যয়নরত শিক্ষার্থীদের ছাড়পত্রের মাধ্যমে ভর্তির অনুমতি প্রদান প্রসঙ্গে।</span>
                </div>
            </td>
        </tr>
    </table>

    <p class="des">
        ২০২৩-২০২৪ শিক্ষাবর্ষে একাদশ শ্রেণিতে অধ্যয়নরত নিম্ন বর্ণিত শিক্ষার্থীর আবেদন ও সংশ্লিষ্ট কলেজের অধ্যক্ষের
        সুপারিশের প্রেক্ষিতে ছাড়পত্রের মাধ্যমে ভর্তির জন্য নির্দেশক্রমে অনুমতি প্রদান করা হলো। অনুমতি পত্র ইস্যুর ১৫
        (পনের) দিনের মধ্যে শিক্ষার্থীর ভর্তির কার্য সম্পাদন করতে হবে।
    </p>

    <br>
    <table class="inner_table">
        <tr>
            {{--            <td style="text-align: center"><h3 style="font-weight: 600;">ক্রঃ নং</h3></td>--}}
            <td style="text-align: center"><h3 style="font-weight: 600;">আবেদনকারীর নাম</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">বর্তমান কলেজের নাম ও EIIN নম্বর</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">ভর্তিচ্ছু কলেজের নাম ও EIIN নম্বর</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">পঠিত বিষয়সমূহ</h3></td>
            <td style="text-align: center"><h3 style="font-weight: 600;">এসএসসি’র পাসের রোল, রেজিঃ, সন ও বোর্ড</h3></td>
        </tr>
        <tr>
            {{--                    <td style="text-align: center">{{$loop->index + 1}}</td>--}}
            <td style="text-align: center">{{data_get($student,'name')}}</td>
            <td style="text-align: center">{{data_get($student,'current_col')}}</td>
            <td style="text-align: center">{{data_get($student,'admission_col')}}</td>
            <td style="text-align: center" width="20%">{{data_get($student,'subject_comp')}}</td>
            <td style="text-align: center">{{data_get($student,'ssc_info')}}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td width="72%" style="font-size: 22px">
                অধ্যক্ষ <br>
                সংশ্লিষ্ট কলেজ সমূহ।
            </td>
            <td style="text-align: center; font-size: 18px">
                @if($user->signature_image)
                    <div>
                        <img src="{{asset('storage/'.$user->signature_image)}}" class="img-fluid" alt="signature">
                    </div>
                @endif
                কলেজ পরিদর্শক <br/>
                মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড <br/>
                দিনাজপুর। <br>
            </td>
        </tr>
    </table>

    <br>
    <br>
    <table>
        <tr>
            <td width="50%">স্মারক নং - <span class="subject">{{$sharok}}</span></td>
            <td width="34%"></td>
            <td width="16%">
                <span>তারিখঃ {{data_get($approveDate,'approve_at') ? data_get($approveDate,'approve_at')->format('d-m-Y') : ''}}</span>
            </td>
        </tr>
    </table>
    <br>

    <ul class="note">
        <li>অবগতির জন্য অনুলিপি :</li>
        <li>১। পরীক্ষা নিয়ন্ত্রক, মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড, দিনাজপুর।</li>
        <li>২। সিনিয়র সিস্টেম এনালিস্ট, মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড, দিনাজপুর।</li>
        <li>৩। পিএসটু, চেয়ারম্যান অত্র শিক্ষা বোর্ড।</li>
        <li>৪। অধ্যক্ষ, সংশ্লিষ্ট কলেজ সমূহ।</li>
        <li>৫। ওয়েব সাইট কপি।</li>
        <li>৬। অফিস কপি।</li>
    </ul>

    <table>
        <tr>
            <td width="72%"></td>
            <td style="text-align: center; font-size: 18px">
                @if($user->signature_image)
                    <div>
                        <img src="{{asset('storage/'.$user->signature_image)}}" class="img-fluid" alt="signature">
                    </div>
                @endif
                কলেজ পরিদর্শক <br/>
                মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড <br/>
                দিনাজপুর।
            </td>
        </tr>
    </table>
</div>
</body>
</html>
