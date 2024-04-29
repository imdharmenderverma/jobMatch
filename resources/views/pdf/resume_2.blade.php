<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template 3</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto-Regular&display=swap" rel="stylesheet"> -->
    <!-- font-family: 'Roboto-Regular', sans-serif; -->
    <style>
        body {
            font-family: "Roboto-Regular";
            margin: 0px;
            padding: 0px;
        }

        @font-face {
            font-family: 'Roboto-Regular';
            font-weight: 400;
            font-style: normal;
            src: url("{{ URL::to('/') }}/assets/fonts/Roboto/Roboto-Regular.ttf") format("truetype");

        }

        @page {
            margin: 0px;
        }


        table {
            max-width: 800px;
            margin: auto;
            border-collapse: collapse;
        }

        td {
            padding: 0;
        }

        /* For Chrome or Safari */
        progress::-webkit-progress-bar {
            background-color: #eeeeee;
        }

        progress::-webkit-progress-value {
            background-color: #578b93 !important;
        }


        /* For Firefox */
        progress {
            background-color: #eee;
        }

        progress::-moz-progress-bar {
            background-color: #578b93 !important;
        }

        /* For IE10 */
        progress {
            background-color: #eee;
        }

        progress {
            background-color: #578b93;
        }

        td.td-w {
            width: 1%;
        }

        .cus-line {
            position: relative;
        }

        /* .cus-line::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 5px;
            background: red;
            right: 0;
            top: 0
        } */
    </style>
</head>

<body>
    <table class="print-area" style="width: 100%; height: 100%;">

        <tr>
            <td style="padding: 0;">
                <table style="width: 100%;">
                    <tr>
                        <td
                            style="width: 40%; padding: 40px 0 30px; background-color: #282828; vertical-align: top;height: 93.7%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="padding: 0;">
                                        <h1 class="cus-line"
                                            style="margin: 0; padding-left: 55px; padding-bottom: 25px; font-size: 30px; font-family: 'Roboto-Regular', sans-serif; color: #f1f1f2; line-height: 35px; font-weight: 600; letter-spacing: 4px">
                                            {{ $userData['get_app_user_data']['first_name'] }}<br>
                                            {{ $userData['get_app_user_data']['last_name'] }}
                                        </h1>

                                        <img src="<?= public_path() . '/assets/img/resume/skyLine.png' ?>"
                                            alt="user"
                                            style="height: 140px; width:40%; position:absolute; z-index:0; top:42px; opacity:0.1;">
                                        <img src="<?= public_path() . '/storage/' . $userData['get_app_user_data']['profile_photo_path'] ?>"
                                            alt="user" width="275"
                                            style="height: 285px; position:relative; z-index:1;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left:65px">
                                        <p
                                            style="position:relative; margin: 0; color: #f1f1f2; text-transform: uppercase;letter-spacing: 2px;font-size: 20px; line-height: 23px;font-weight: 700; padding-top: 35px; font-family: 'Roboto-Regular', sans-serif;padding-bottom: 10px;">

                                            <img src="<?= public_path() . '/assets/img/resume/square.png' ?>"
                                                alt="square" style="position:absolute; top:39px; left:-25px;"> CONTACT
                                        </p>
                                        <p
                                            style="margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif; text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;">
                                            <span style="vertical-align: middle;padding-right: 8px;"><img
                                                    src="<?= public_path() . '/assets/img/resume/w-mail.png' ?>"
                                                    alt="mail"
                                                    style="width: 12px;    vertical-align: middle; padding-right: 8px;"></span><span><img
                                                    src="<?= public_path() . '/assets/img/resume/w-dot.png' ?>"
                                                    alt="dotImg"
                                                    style="vertical-align: middle; width: 5px;height: 5px; "></span>
                                            {{ $userData['get_app_user_data']['location'] }}
                                        </p>
                                        <!-- <p style="margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;"><img src="<?= public_path() . '/assets/img/resume/w-web.png' ?>" alt="web" style="width: 12px;    vertical-align: middle;padding-right: 8px;"></span><span><img src="<?= public_path() . '/assets/img/resume/w-dot.png' ?>" alt="dotImg" style="vertical-align: middle; width: 5px;height: 5px; "></span>
                                            www.website.com
                                        </p> -->
                                        <p
                                            style="margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;">

                                                <img src="<?= public_path() . '/assets/img/resume/w-mobile.png' ?>"
                                                    alt="web"
                                                    style="width: 12px;    vertical-align: middle;padding-right: 8px;"></span><span><img
                                                    src="<?= public_path() . '/assets/img/resume/w-dot.png' ?>"
                                                    alt="dotImg"
                                                    style="vertical-align: middle; width: 5px;height: 5px; "></span>
                                            {{ $userData['get_app_user_data']['email'] }}
                                        </p>
                                        <!-- <p style="margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;"><img src="<?= public_path() . '/assets/img/resume/w-social.png' ?>" alt="mobile" style="width: 12px;    vertical-align: middle;padding-right: 8px;"></span><span><img src="<?= public_path() . '/assets/img/resume/w-dot.png' ?>" alt="dotImg" style="vertical-align: middle; width: 5px;height: 5px; "></span>
                                            @socialmedia
                                        </p> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 65px;">
                                        <p
                                            style="position:relative; margin: 0; color: #f1f1f2; text-transform: uppercase;letter-spacing: 2px;font-size: 20px; line-height: 23px;font-weight: 700; padding-top: 60px; font-family: 'Roboto-Regular', sans-serif;padding-bottom: 10px;">

                                            <img src="<?= public_path() . '/assets/img/resume/square.png' ?>"
                                                alt="square" style="position:absolute; top:64px; left:-25px;"> SKILL
                                        </p>
                                        <table style="width: 100%;">
                                            @if (isset($userData['get_user_statement_data']))
                                                @foreach ($userData['get_user_statement_data'] as $getUserStatement)
                                                    <tr>
                                                        <td style="padding: 0;vertical-align: top">
                                                            <table
                                                                style="display: table; width: 100%; vertical-align: middle">
                                                                <td class="td-w"
                                                                    style="display: table-cell; vertical-align: middle;  height: 15px;">
                                                                    <label for="file"
                                                                        style="font-size: 10px; white-space: nowrap;font-family:'Roboto-Regular', sans-serif; color: #f1f1f2;font-style:italic; padding-right: 8px;">{{ $getUserStatement['skill_name'] }}</label>
                                                                </td>
                                                                <td
                                                                    style="display: table-cell;vertical-align: middle; width: 50%; ">
                                                                    <div
                                                                        style="background-color: #eeeeee; width: 100%; position: relative; height: 3px;">
                                                                        <span
                                                                            style="height: 3px; background: #578b93; position: absolute; top: 0; width: 50%; left: 0;"></span>
                                                                    </div>
                                                                </td>
                                                            </table>
                                                        </td>
                                                        {{-- <td style="width: 80%;">
                                                    <div style="background-color: #eeeeee; width: 100%; position: relative; height: 3px;">
                                                        <span style="height: 3px; background: #578b93; width: 50%; position: absolute; top: 0;"></span>
                                                    </div>
                                                </td> --}}
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 52px 0 0 0;">
                                        <img src="<?= public_path() . '/assets/img/resume/skyLine.png' ?>"
                                            alt="" style=" width: 170px; height: 62px;">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 0;">
                                        <!-- <p style="margin: 0; padding-top: 51px; padding-left: 55px; font-family:'Roboto-Regular', sans-serif; color: #f1f1f2; font-size: 20px;">
                                            “ It's not what you <br>
                                            achieve, it's what <br>
                                            you overcome ”
                                        </p> -->
                                        <!-- <p style="padding-top: 50px; margin: 0;"></p>
                                        <p style="padding-left: 55px; margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;">
                                                <img src="<?= public_path() . '/assets/img/resume/w-insta.png' ?>" alt="web" style="width: 12px;    vertical-align: middle;padding-right:5px;"></span>
                                            www.instagram.com
                                        </p>
                                        <p style="padding-left: 55px; margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;">
                                                <img src="<?= public_path() . '/assets/img/resume/w-twitter.png' ?>" alt="web" style="width: 12px;    vertical-align: middle;padding-right:5px;"></span>
                                            www.twitter.com
                                        </p>
                                        <p style="padding-left: 55px; margin: 0;color: #f1f1f2; font-family:'Roboto-Regular', sans-serif;text-decoration: none;font-size: 10px; font-style:italic; line-height: 12px;padding-top: 7px;">
                                            <span style="vertical-align: middle;padding-right: 8px;">
                                                <img src="<?= public_path() . '/assets/img/resume/w-fb.png' ?>" alt="web" style="width: 12px;vertical-align: middle; padding-right:5px;"></span>
                                            www.facebook.com
                                        </p> -->
                                    </td>
                                </tr>
                            </table>







                        </td>
                        <td
                            style="width: 60%; padding: 40px 55px 30px; background-color: #f1f1f2; vertical-align: top;height: 93.7%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="text-align: right;">
                                        <!-- <p style="padding: 0; margin: 0; font-size: 12px; font-style:italic; font-family:'Roboto-Regular', sans-serif; color: #282828;">
                                            MORE PORTFOLIOS ON</p>
                                        <p style="padding: 0; margin: 0; font-size: 20px; font-family:'Roboto-Regular', sans-serif; color: #282828;">
                                            <b>
                                                WWW.YOURWEBSITE.COM
                                            </b>
                                        </p> -->
                                        <p
                                            style="padding-top: 10px;margin:0; color: #578b93; font-size: 15px; font-style: italic; font-family:'Roboto-Regular', sans-serif;">
                                            @if (isset($lastExperience))
                                                {{ $lastExperience->title }}
                                            @endif

                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div>
                                            <p
                                                style="position:relative; padding-top: 40px; font-size: 18px; padding-bottom: 2px; font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-weight: bold; letter-spacing: 1px;">

                                                <img src="<?= public_path() . '/assets/img/resume/w-square.png' ?>"
                                                    alt="square" style="position:absolute; top:48px; left:-22px;">
                                                ABOUT ME
                                            </p>
                                            <p style="background-color: #578b93;  height: 2px; width: 100%;">
                                            </p>
                                            <p
                                                style="margin: 0; padding-top: 10px; font-family:'Roboto-Regular', sans-serif; font-style: italic; font-size: 13px;     word-spacing: 0.5px; color: #4c595e; letter-spacing: 0.5px;">
                                                {{ $userData['get_app_user_data']['executive_summary'] }}
                                            </p>
                                            <!-- <p style="margin: 0; padding-top: 15px; font-family:'Roboto-Regular', sans-serif; font-style: italic; font-size: 10px; color: #4c595e; line-height: 14px;">
                                                {{ $userData['get_app_user_data']['executive_summary'] }}
                                            </p> -->
                                    </td>
                                    </div>
                                </tr>
                                <tr>
                                    <td style="padding-top: 55px;">
                                        <div>

                                            <p
                                                style="position:relative; font-size: 18px; padding-bottom: 2px; font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-weight: bold; letter-spacing: 1px;">
                                                <img src="<?= public_path() . '/assets/img/resume/w-square.png' ?>"
                                                    alt="square" style="position:absolute; top:7px; left:-22px;">
                                                EDUCATIONS
                                            </p>
                                            <p style="background-color: #578b93;  height: 2px; width: 100%;"></p>
                                            <table style="width: 100%;">
                                                @foreach ($userData['get_user_education'] as $educationDetail)
                                                    <tr>
                                                        <td
                                                            style="width: 5%; padding: 0; padding-top: 15px; padding-right: 35px; vertical-align: top;">
                                                            <?php
                                                            $tagImageUrl = public_path('assets/img/resume/tag.png');
                                                            ?>
                                                            <div
                                                                style="background-image: url('<?= $tagImageUrl ?>');width: 55px;
                                                    height: 30px;
                                                    background-repeat: no-repeat;
                                                    background-size: contain;
                                                    background-position: center;position: relative;">
                                                                <p
                                                                    style="margin: 0;font-size: 12px; font-style: italic; font-family:'Roboto-Regular', sans-serif; color: #edf5f5;    position: absolute;
                                                            top: 50%;
                                                            left: 42%;
                                                            transform: translate(-50%, -42%);">
                                                                    {{ date('Y', strtotime($educationDetail['start_date'])) }}
                                                                </p>

                                                            </div>
                                                        </td>
                                                        <td style="padding: 0; padding-top: 10px;">
                                                            <p
                                                                style="margin: 0; font-size: 17px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-weight: 600; letter-spacing: 1px;">
                                                                {{ $educationDetail['degree'] }}
                                                            </p>
                                                            <p
                                                                style="margin: 0; font-size: 13px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-style: italic;">
                                                                {{ $educationDetail['school'] }}
                                                            </p>
                                                            <!-- <p style="margin: 0; font-size: 10px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-style: italic;">
                                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                                            sed diam nonummy nibh euismod tincidunt ut laoreet
                                                            dolore magna</p> -->
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table>
                                    </td>
                                    </div>
                                </tr>
                                <tr>
                                    <td style="padding-top: 55px; ">
                                        <div>
                                            <p
                                                style="position:relative; font-size: 18px; padding-bottom: 2px; font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-weight: bold; letter-spacing: 1px;">
                                                <img src="<?= public_path() . '/assets/img/resume/w-square.png' ?>"
                                                    alt="square" style="position:absolute; top:7px; left:-22px;">
                                                EXPERIENCES
                                            </p>
                                            <p style="background-color: #578b93;  height: 2px; width: 100%;"></p>
                                            <table style="width: 100%;">
                                                @foreach ($userData['get_user_experiences'] as $userExperiences)
                                                    <tr>
                                                        <td
                                                            style="width: 5%; padding: 0; padding-top: 15px; padding-right: 35px; vertical-align: top;">
                                                            <?php
                                                            $tagImageUrl = public_path('assets/img/resume/tag.png');
                                                            ?>
                                                            <div
                                                                style="background-image: url('<?= $tagImageUrl ?>');
                                                    width: 55px;
                                                    height: 30px;
                                                    background-repeat: no-repeat;
                                                    background-size: contain;
                                                    background-position: center;position: relative;">
                                                                <p
                                                                    style="margin: 0;font-size: 12px; font-style: italic; font-family:'Roboto-Regular', sans-serif; color: #edf5f5;    position: absolute;
                                                            top: 50%;
                                                            left: 42%;
                                                            transform: translate(-50%, -42%);">
                                                                    {{ date('Y', strtotime($userExperiences['start_date'])) }}
                                                                </p>

                                                            </div>
                                                        </td>
                                                        <td style="padding: 0; padding-top: 10px;">
                                                            <p
                                                                style="margin: 0; font-size: 17px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-weight: 600; letter-spacing: 1px;">
                                                                {{ $userExperiences['title'] }}
                                                            </p>
                                                            <p
                                                                style="margin: 0; font-size: 13px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-style: italic;">
                                                                {{ $userExperiences['company'] }}
                                                            </p>
                                                            <p
                                                                style="margin: 0; font-size: 10px;font-family:'Roboto-Regular', sans-serif; color: #3d4745; font-style: italic;">
                                                                {{ $userExperiences['job_duties'] }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </table>
                                    </td>
                                    </div>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
