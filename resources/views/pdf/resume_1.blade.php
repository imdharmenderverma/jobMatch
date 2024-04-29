
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    {{-- <style>
        body {
            margin: 0;
            padding: 0;
            font-family: verdana;
            padding: 0px;
            background: #ceeae6;
        }

        table {
            width: 100%;
        }

        table {
            border-collapse: collapse;

        }

        .table th {
            font-weight: bold;
        }

        .bold td {
            font-weight: bold;
        }

        table th,
        table td {
            font-size: 12px;
            text-align: left;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 5px;
            font-size: 12px;
            text-align: center;
        }

        h3 {
            margin: 0;
            padding: 10px;
        }

        .border {
            border: 2px solid #000;
            padding: 25px;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .bold td {
            font-weight: bold;
        }
    </style> --}}

    <style>
        @font-face {
            font-family: 'Roboto-Regular';
            font-weight: 400;
            font-style: normal;
            src: url("{{ URL::to('/') }}/assets/fonts/Roboto/Roboto-Regular.ttf") format("truetype");

        }

        @page {
            margin: 0px;
        }

        body {
            font-family: "Roboto-Regular";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 5px dased red;
        }

        td {
            padding: 0;
        }
        .border {
            display: table;
            border: 5px dased red;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <table border="0" cellspacing="0" cellpadding="0"  valign="top"
        style=" background: #ceeae6; border: 1px solid #afafaf; width: 100%; border: 0; height:100%; ">
        <tr  valign="top">
            <td style="width:50%;padding: 0; vertical-align: top" valign="top">
                <table border="0" cellspacing="0" cellpadding="0" style="background: white;">
                    <tr>
                        <td style="padding: 0 20px 0 50px; vertical-align: top">
                            <div style="margin-bottom: 40px;">
                                @if (isset($_GET['type']) && $_GET['type'] == 'local')
                                    <img src="https://php9.appworkdemo.com/job-match/public/storage/app_users/profileImg.png"
                                        alt="profileImg" style="width: 100%;height: 370px;object-fit: cover;">
                                @else
                                    <img src="<?= public_path() . '/storage/' . $userData['get_app_user_data']['profile_photo_path'] ?>"
                                        alt="profileImg" style="width: 100%;height: 370px;object-fit: cover;">
                                @endif
                            </div>
                            <div style="margin-bottom: 40px;">
                                <h1
                                    style="margin: 0; padding: 0;color: #2d5253; text-transform: uppercase;letter-spacing: 3px;font-size: 46px;line-height: 48px;font-weight: 700; font-family: 'Roboto-Regular', sans-serif;">
                                    {{ $userData['get_app_user_data']['first_name'] }} <br>
                                    {{ $userData['get_app_user_data']['last_name'] }}
                                </h1>
                                <p
                                    style="margin: 0; padding-top: 8px; color: #313131;text-transform: uppercase;letter-spacing: 1px; font-size: 18px;line-height: 18px;font-weight: 600;font-style: italic;font-family: 'Roboto-Regular', sans-serif;">                                    
                                    @if (isset($lastExperience))
                                        {{ $lastExperience->title }}
                                    @endif
                                </p>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h1
                                    style="margin: 0; padding: 0;color: #2d5253; text-transform: uppercase;letter-spacing: 2px;font-size: 20px;line-height: 23px;font-weight: 700; font-family: 'Roboto-Regular', sans-serif;padding-bottom: 10px;">
                                    CONTACT</h1>                                  
                                    
                                <p
                                    style="margin: 0;color: #2d5354; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;">
                                    <span style="vertical-align: middle;"><img
                                            src="<?= public_path() . '/assets/img/resume/mail.png' ?>" alt="mail"
                                            style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img
                                            src="<?= public_path() . '/assets/img/resume/dotImg.png' ?>" alt="dotImg"
                                            style="vertical-align: middle; width: 6px;height: 6px;"></span>
                                    {{ $userData['get_app_user_data']['location'] }}
                                </p>
                                <p
                                    style="margin: 0;color: #2d5354; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;padding-top: 5px;">
                                    <span style="vertical-align: middle;"><img
                                            src="<?= public_path() . '/assets/img/resume/mobile.png' ?>" alt="mobile"
                                            style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img
                                            src="<?= public_path() . '/assets/img/resume/dotImg.png' ?>" alt="dotImg"
                                            style="vertical-align: middle; width: 6px;height: 6px;"></span>{{ $userData['get_app_user_data']['email'] }}
                                </p>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <p
                                    style="    color: #70aaaf; font-family:'Roboto-Regular', sans-serif;letter-spacing: 1px; font-size: 15px; word-spacing: 3px; word-break: break-all;padding: 0px 0 0px 0;margin: 0;font-style: italic;">
                                    {{ $userData['get_app_user_data']['executive_summary'] }}
                                </p>
                            </div>
                            <div>
                                <p
                                    style="color: #70aaaf; font-family:'Roboto-Regular', sans-serif;font-style: italic;font-size: 10px;word-spacing: 3px; word-break: break-all;margin: 0;">
                                    {{ $userData['get_app_user_data']['executive_summary'] }}
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>                
            </td>
            <td style="vertical-align: top; padding: 20px 0 20px" valign="top">
                {{-- <div style="background: white; height: 100%; width: 3px; display: block">.</div> --}}
                <img src="<?= public_path() . '/assets/img/resume/line_img.svg' ?>"
                    style="margin: 0px 0px;  width: 10px;" />
                    {{-- cemntr --}}
            </td>
            <td style="vertical-align: top; width:50%; padding: 70px 30px 50px 50px;" valign="top">
                <table border="0" cellspacing="0" cellpadding="0">

                    <tr>
                        <td>
                            <p
                                style="color: #61a8ad;  font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 21px; line-height: 20px; margin: 0px;padding: 20px 0 10px 0;font-family: 'Roboto-Regular', sans-serif;">
                                EDUCATIONS</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                @foreach ($userData['get_user_education'] as $educationDetail)
                                    <tr style="position: relative;overflow: hidden;">
                                        <td
                                            style="
                                    vertical-align: top;  text-align: center;width: 24%;">
                                            <div style="position: relative;display: contents;">
                                                <div
                                                    style="background-repeat: no-repeat;background-size: cover; width: 40px;height: 40px;position: relative;background-color: white; border-radius: 50%;margin: 0px auto 0px auto;top: 0px;z-index: 99;">
                                                    <p
                                                        style="margin: 0;
                                        font-size: 12px;
                                        font-weight: 700;
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        font-family: 'Roboto-Regular', sans-serif;
                                        z-index: 9;">
                                                        {{ date('Y', strtotime($educationDetail['start_date'])) }}</p>
                                                </div>

                                                @if (!$loop->last)
                                                    <div
                                                        style="width: 3px; background: white; position: absolute; right: 0; left: 36px; bottom: 0; top:0px; z-index: 1; ">
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>

                                            <h6
                                                style="padding: 15px 0px 3px 0px;margin: 0; font-weight: 700;font-size: 15px;letter-spacing: 1px;font-family: 'Roboto-Regular', sans-serif;">
                                                {{ $educationDetail['degree'] }}
                                            </h6>
                                            <p
                                                style="margin: 0px;font-style: italic;font-size: 14px;font-weight: 500;padding-bottom:20px;font-family: 'Roboto-Regular', sans-serif;">
                                                {{ $educationDetail['school'] }}
                                            </p>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p
                                style="color: #61a8ad; font-family: 'Roboto-Regular', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 21px; line-height: 20px; padding: 20px 0 10px 0;margin:0;">
                                EXPERIENCES</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                @foreach ($userData['get_user_experiences'] as $userExperiences)
                                    <tr style="position: relative;overflow:hidden;">
                                        <td
                                            style="
                                    vertical-align: top;  text-align: center;width: 24%;">
                                            <div style="position: relative;display: contents;">
                                                <div
                                                    style="background-repeat: no-repeat;background-size: cover; width: 40px;height: 40px;position: relative;background-color: white; border-radius: 50%;margin: 0px auto 0px auto;top: 0px;z-index: 99;">
                                                    <p
                                                        style="margin: 0;
                                        font-size: 12px;
                                        font-weight: 700;
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        font-family: 'Roboto-Regular', sans-serif; font-weight: 700;
                                        z-index: 9;">
                                                        {{ date('Y', strtotime($userExperiences['start_date'])) }}</p>
                                                </div>
                                                @if (!$loop->last)
                                                    <div
                                                        style="width: 3px;  background: white; position: absolute;right: 0; left: 36px;bottom: 0; top:0px;z-index: 0;">
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>

                                            <h6
                                                style="padding: 15px 0px 3px 0px;margin: 0;font-size: 15px;letter-spacing: 1px;      font-family: 'Roboto-Regular', sans-serif;font-weight: 700;">
                                                {{ $userExperiences['title'] }}
                                            </h6>
                                            <p
                                                style="margin: 0px;font-family: 'Roboto-Regular', sans-serif;font-style: italic;font-size: 14px;font-weight: 500;">
                                                {{ $userExperiences['company'] }}
                                            </p>
                                            <p
                                                style="padding-bottom:10px; margin: 0px;font-family: 'Roboto-Regular', sans-serif;font-style: italic;font-size: 10px;font-weight: 500;">
                                                <span>{{ $userExperiences['job_duties'] }}</span>
                                            </p>

                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <p
                                            style="color: #61a8ad; font-family: 'Roboto-Regular', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 21px; line-height: 20px; margin: 0px;padding: 20px 0 10px 0;">
                                            Skills</p>
                                    </td>
                                </tr>
                                @if (isset($userData['get_user_statement_data']))
                                    @foreach ($userData['get_user_statement_data'] as $getUserStatement)
                                        <tr>
                                            <td>
                                                <div
                                                    style=" height: 17px;border-radius: 10px;background: #2d5354;width: 90%;margin-bottom: 10px;position: relative;">
                                                    <div
                                                        style=" width: 90%;background: #FFFFFF;border-radius: 10px;height: 17px;position:absolute; top:0px;">
                                                        <p
                                                            style=" font-size: 10px;line-height:16px;padding-left: 15px;font-family: 'Roboto-Regular-italic';position: absolute; top: 0px; bottom: 0px;margin:auto;">
                                                            {{ $getUserStatement['skill_name'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </td>
                    </tr>

                </table>
               
            </td>
        </tr>
    </table>
</body>

</html>
