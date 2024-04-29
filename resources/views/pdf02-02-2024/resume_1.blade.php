<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @font-face {
            font-family: 'Poppins-Regular';
            font-weight: 400;
            font-style: normal;
            src: url("http://localhost/job_matched/fonts/Poppins-Regular.ttf") format("truetype");
        }

        @page {
            margin: 0px;
        }

        body {
            font-family: "Poppins-Regular";
            margin: 0px;
        }

        table {
            /* width: 500px; */
            margin: auto;
            border-collapse: collapse;
            font-family: 'Poppins-Regular'
        }

        td {
            padding: 0;
        }
    </style>
</head>

<body>
    <table style="width: 800px; background: #ceeae6;height:100%">
        <tr>
            <td style="width: 50%;padding: 50px 15px 0px 0px;">
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 20px 20px 20px 50px; background: white;">
                            @if(isset($_GET['type']) && $_GET['type'] == "local")
                            <img src="https://php9.appworkdemo.com/job-match/public/storage/app_users/profileImg.png" alt="profileImg" style="width: 100%;height: 370px;object-fit: cover;">
                            @else
                            <img src="{{asset('storage/' . $userData['get_app_user_data']['profile_photo_path']) }}" alt="profileImg" style="width: 100%;height: 370px;object-fit: cover;">
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td style="padding: 20px 20px 20px 50px; background: white;">
                            <h1 style="margin: 0; padding: 0;color: #2d5253; text-transform: uppercase;letter-spacing: 3px;font-size: 46px;line-height: 48px;font-weight: 700; font-family: 'Poppins', sans-serif;">
                                {{ $userData['get_app_user_data']['first_name']}} <br> {{ $userData['get_app_user_data']['last_name'] }}</h1>
                                <span
                                    style="f">{{ $userData['get_user_experiences'][count($userData['get_user_experiences']) - 1]['title'] }}</span><br>
                            <p style="margin: 0; padding-top: 8px; color: #313131;text-transform: uppercase;letter-spacing: 1px; font-size: 18px;line-height: 18px;font-weight: 600;font-style: italic;font-family: 'Poppins', sans-serif;">
                                <!-- {{ $userData['get_app_user_data']['industry']}} -->
                                @if(isset($lastExperience)){{ $lastExperience->title}} @endif
                            </p>
                        </td>

                    </tr>
                    <tr>
                        <td style="padding: 20px 20px 20px 50px; background: white;">
                            <h1 style="margin: 0; padding: 0;color: #2d5253; text-transform: uppercase;letter-spacing: 2px;font-size: 20px;line-height: 23px;font-weight: 700; font-family: 'Poppins', sans-serif;padding-bottom: 10px;">
                                CONTACT</h1>
                            <p style="margin: 0;color: #2d5354; font-family:'Poppins', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;">
                                <span style="vertical-align: middle;"><img src="{{ asset('assets/img/resume/mail.png') }}" alt="mail" style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img src="{{asset('assets/img/resume/dotImg.png') }}" alt="dotImg" style="vertical-align: middle; width: 6px;height: 6px;"></span> {{ $userData['get_app_user_data']['location']}}
                            </p>
                            <!-- <p style="margin: 0;color: #2d5354; font-family:'Poppins', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;padding-top: 5px;">
                                <span style="vertical-align: middle;"><img src="http://localhost/PROJECT/job_match/public/assets/img/resume/phone.png" alt="phone" style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span style="color: #2d5354;">+</span> 01-234-567-89
                            </p> -->
                            <!-- <p style="margin: 0;color: #2d5354; font-family:'Poppins', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;padding-top: 5px;">
                                <span style="vertical-align: middle;"><img src="http://localhost/PROJECT/job_match/public/assets/img/resume/web.png" alt="web" style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img src="http://localhost/PROJECT/job_match/public/assets/img/resume/dotImg.png" alt="dotImg" style="vertical-align: middle; width: 6px;height: 6px;"></span>www.website.com
                            </p> -->
                            <p style="margin: 0;color: #2d5354; font-family:'Poppins', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;padding-top: 5px;">
                                <span style="vertical-align: middle;"><img src="{{asset('assets/img/resume/mobile.png') }}" alt="mobile" style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img src="{{asset('assets/img/resume/dotImg.png') }}" alt="dotImg" style="vertical-align: middle; width: 6px;height: 6px;"></span>{{ $userData['get_app_user_data']['email']}}
                            </p>
                            <!-- <p style="margin: 0;color: #2d5354; font-family:'Poppins', sans-serif;text-decoration: none;font-size: 12px;line-height: 12px;padding-top: 5px;">
                                <span style="vertical-align: middle;"><img src="http://localhost/PROJECT/job_match/public/assets/img/resume/social.png" alt="social" style="width: 15px;padding-right:8px;vertical-align: middle;"></span><span><img src="http://localhost/PROJECT/job_match/public/assets/img/resume/dotImg.png" alt="dotImg" style="vertical-align: middle; width: 6px;height: 6px;"></span>@socialmedia
                            </p> -->
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 20px 20px 50px; background: white;">
                            <p style="    color: #70aaaf; font-family:'Poppins', sans-serif;letter-spacing: 1px; font-size: 15px; word-spacing: 3px; word-break: break-all;padding: 0px 0 0px 0;margin: 0;font-style: italic;">
                                {{ $userData['get_app_user_data']['executive_summary']}}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 50px 0 0px 0px;">
                <img src="{{asset('assets/img/resume/line_img.svg') }}" style="margin: 0px 0px; height: 980px; width: 10px;" />
            </td>
            <td style="width: 48%;vertical-align: top; padding: 70px 30px 50px 50px;">
                <table style="width: 100%; ">

                    <tr>
                        <td>
                            <p style="color: #61a8ad;  font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 21px; line-height: 20px; margin: 0px;padding: 20px 0 10px 0;;">
                                EDUCATIONS</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%; ">
                                @foreach ($userData['get_user_education'] as $educationDetail)
                                <tr style="position: relative;overflow: hidden;">
                                    <td style="
                                    vertical-align: top;  text-align: center;width: 24%;">
                                        <div style="position: relative;display: contents;">
                                            <div style="background-repeat: no-repeat;background-size: cover; width: 40px;height: 40px;position: relative;background-color: white; border-radius: 50%;margin: 0px auto 0px auto;top: 10px;">
                                                <p style="margin: 0;
                                        font-size: 12px;
                                        font-weight: 700;
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        z-index: 9;">{{ date('Y', strtotime($educationDetail['start_date']))}}</p>
                                            </div>

                                            @if (!$loop->last) <div style="width: 3px; background: white; position: absolute; right: 0; left: 36px; bottom: 0; top:50px; z-index: 1; height: 100%;">
                                        </div>
                                        @endif
                                        </div>
                                    </td>
                                    <td>

                                        <h6 style="padding: 15px 0px 3px 0px;margin: 0; font-weight: 500;font-size: 15px;letter-spacing: 1px;">
                                            {{$educationDetail['degree']}}
                                        </h6>
                                        <p style="margin: 0px;font-style: italic;font-size: 14px;font-weight: 500;padding-bottom:20px;">
                                            {{$educationDetail['school']}}
                                        </p>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="color: #61a8ad; font-family: 'Poppins', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 21px; line-height: 20px; padding: 20px 0 10px 0;margin:0;">
                                EXPERIENCES</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%; ">
                                @foreach ($userData['get_user_experiences'] as $userExperiences)
                                <tr style="position: relative;overflow: hidden;">
                                    <td style="
                                    vertical-align: top;  text-align: center;width: 24%;">
                                        <div style="position: relative;display: contents;">
                                            <div style="background-repeat: no-repeat;background-size: cover; width: 40px;height: 40px;position: relative;background-color: white; border-radius: 50%;margin: 0px auto 0px auto;top: 10px;">
                                                <p style="margin: 0;
                                        font-size: 12px;
                                        font-weight: 700;
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        z-index: 9;">{{ date('Y', strtotime($userExperiences['start_date']))}}</p>
                                            </div>
                                            @if (!$loop->last)
                                            <div style="width: 3px;  background: white; position: absolute;right: 0; left: 36px;bottom: 0; top:50px;z-index: 1;height:100%;"></div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>

                                        <h6 style="padding: 15px 0px 3px 0px;margin: 0;font-weight: 500;font-size: 15px;letter-spacing: 1px;      font-family: 'Poppins', sans-serif;">
                                            {{$userExperiences['title']}}
                                        </h6>
                                        <p style="margin: 0px;font-family: 'Poppins', sans-serif;font-style: italic;font-size: 14px;font-weight: 500;">
                                            {{$userExperiences['company']}}
                                        </p>
                                        <p style="padding-bottom: 10px; margin: 0px;font-family: 'Poppins', sans-serif;font-style: italic;font-size: 10px;font-weight: 500;"> <span>{{$userExperiences['job_duties']}}</span>
                                        </p>

                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <p style="color: #61a8ad; font-family: 'Poppins', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; font-size: 21px; line-height: 20px; margin: 0px;padding: 20px 0 10px 0;">
                                            Skills</p>
                                    </td>
                                </tr>
                                @if(isset($userData["get_user_statement_data"]))
                                @foreach($userData['get_user_statement_data'] as $getUserStatement)
                                <tr>
                                    <td>
                                        <div style=" height: 17px;border-radius: 10px;background: #2d5354;width: 90%;margin-bottom: 10px;position: relative;">
                                            <div style=" width: 90%;background: #FFFFFF;border-radius: 10px;height: 17px;position:absolute; top:0px;">
                                                <p style=" font-size: 10px;line-height:16px;padding-left: 15px;font-family: 'poppins-italic';position: absolute; top: 0px; bottom: 0px;margin:auto;">{{$getUserStatement['skill_name']}}</p>
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