<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"> -->

      <title>Job match</title>
      <link type="text/css" href="../../../public/assets/fonts.css" rel="stylesheet" media="screen" />
      <style>
            @page {
                  margin: 0px;
            }

            table {
                  margin: auto;
                  font-weight: normal;
                  border-collapse: collapse;
            }

            body {
                  padding: 0px;
                  margin: 0px;
                  font-family: 'Roboto-Regular'
            }

            @font-face {
            font-family: 'Roboto-Regular';
            font-weight: 400;
            font-style: normal;
            src: url("{{ URL::to('/') }}/assets/fonts/Roboto/Roboto-Regular.ttf") format("truetype");
        }
      </style>
</head>

<body>
      <table style="width: 800px; margin: auto; background-color: #fff; border-collapse: collapse; padding:0px 0px 0px 30px">
            <tr>
                  <td style="padding: 15px 45px 0px;">
                        <table style="width: 100%;">
                              <tr>
                                    <td style="width: 50%; font-size: 35px; line-height: 45px; color: #fd7212; font-family: 'Roboto-Regular', sans-serif; font-weight: 700; vertical-align: bottom;">
                                          {{ $userData['get_app_user_data']['first_name']}} {{ $userData['get_app_user_data']['last_name'] }}
                                    </td>
                                    <td style="width: 50%; text-align: right; padding: 0px 30px 0px 0px;">
                                          <img src="<?= public_path() . '/assets/img/resume/logo.png'; ?>" style="height: 95px; width: 140px; object-fit: contain; opacity: 0.3;" />
                                    </td>
                              </tr>
                        </table>
                  </td>
            </tr>


            <tr>
                  <td style="padding: 0px 10 0px;">
                        <table style="width: 100%;">
                              <tr>
                                    <td style="padding: 18px 0px 0px 0px; width: 3%;">
                                          <img src="<?= public_path() . '/assets/img/resume/skill-round.svg'; ?>" style="margin: 0px 0px; height: 12px; width: 12px;" />
                                    </td>
                                    <td style="padding: 0; width: 97%;">
                                          <p style="height: 2px; background-color: #61a8ad; width: 100%;  margin: 10px 0px 0px;"></p>
                                    </td>
                              </tr>
                        </table>
                  </td>
            </tr>

            <tr>
                  <td style="padding: 0px 21px 0px 35px;">
                        <table style="width: 100%;">
                              <tr>
                                    <td style="width: 70%; font-size: 30px; line-height: 30px; color: #7a7a7a;">
                                          <h1 style="color: #575962;font-size: 21px;line-height: 27px;margin: 10px 0px 0px 0px;font-family: 'Roboto-Regular', sans-serif;
                                    font-weight: 300;">I’m a <span style="font-family: 'Roboto-Regular', sans-serif; font-weight: 700;">{{ $userData['get_user_experiences'][count($userData['get_user_experiences']) - 1]['title'] }}</h1>
                                    </td>


                                    <!-- <td style=" padding: 0px 5px 0px 0px; width:2px">
                                          <img src="<?= public_path() . '/assets/img/resume/facebook.svg'; ?>" style="height: 30px; width: 30px; object-fit: contain; padding-top: 5px;" />
                                    </td>
                                    <td style="padding: 0px 5px 0px 0px; width:2px">
                                          <img src="<?= public_path() . '/assets/img/resume/facebook.svg'; ?>" style="height: 30px; width: 30px; object-fit: contain; padding-top: 5px;" />
                                    </td>
                                    <td style="padding: 0px 50px 0px 2px; width:2px">
                                          <img src="<?= public_path() . '/assets/img/resume/facebook.svg'; ?>" style="height: 30px; width: 30px; object-fit: contain; padding-top: 5px;" />
                                    </td> -->
                              </tr>
                        </table>
                  </td>
            </tr>

            <tr>
                  <td>
                        <table style="width: 100%; margin: 20px 0px 0px 25px;">
                              <tr>
                                    <td style="width: 35%; background-image: <?= public_path() . '/assets/img/resume/bg-img.svg'; ?>;  background-color: #bad4d4;vertical-align: top; padding-top: 30px;">
                                          <table style="width: 100%;">
                                                <tr>
                                                      <td style="vertical-align: middle;position: relative ;padding-bottom: 30px;">
                                                            <p style="margin: 0px; position: absolute; top: 2.2%; height: 30px;left: 6%; transform: translate(-50% , -50%); color: #fff;z-index: 6; font-family: 'Roboto-Regular', sans-serif; min-width: 80px;text-align: start;font-weight: 700;">ABOUT</p>
                                                            <div style="height: 40px; width: 240px;background: #61a8ad; border-radius: 0px 30px 30px 0px; position: absolute; left: -20%; top: 0;z-index:1;"></div>
                                                      </td>

                                                </tr>
                                                <tr>
                                                      <td style="padding: 0px 0px 10px;">
                                                            <!-- <img src="<?= public_path() . 'assets/img/resume/about-bg.svg'; ?>" style="object-fit: cover; height: 40px; width: 240px;" /> -->
                                                            <p style="color: #808080; max-width: 250px; font-size: 13px; line-height: 20px; margin: 0px 0px 0px; font-family: 'Poppins-Regular'; font-weight: 100;padding: 30px 30px 20px;
                                                            "> {{ $userData['get_app_user_data']['executive_summary']}}</p>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td style="vertical-align: middle;position: relative ;padding-bottom: 30px;">
                                                            <p style="margin: 0px; position: absolute; top: 2.2%; height: 30px; left: 6%; transform: translate(-50% , -50%); color: #fff; z-index: 6; font-family: 'Roboto-Regular', sans-serif; min-width: 80px; text-align: start;font-weight: 700;">CONTACT</p>
                                                            <div style="height: 40px; width: 240px; background: #61a8ad; border-radius: 0px 30px 30px 0px; position: absolute; left: -20%; top: 0;z-index:1;"></div>
                                                      </td>
                                                </tr>
                                                <tr>

                                                      <td style="padding: 10px 0px 50px;">
                                                            <!-- <img src="<?= public_path() . 'assets/img/resume/contact-bg.svg'; ?>" style="object-fit: cover; height: 40px; width: 240px;" /> -->
                                                            <p style="padding: 30px 30px 0px; margin: 0px; font-size: 16px; line-height: 20px; color: #000; font-family: 'Roboto-Regular', sans-serif; font-weight: 700; opacity: 0.6;">
                                                                  {{ $userData['get_app_user_data']['email'] }}
                                                            </p>
                                                            <!-- <p style="padding: 0px 30px 0px; margin: 2px 0px 0px; font-size: 15px; line-height: 20px; color: #808080; font-family: 'Roboto-Regular', sans-serif; font-weight: 400;">
                                                                  +603 1234 567</p> -->
                                                            <p style="color: #808080; max-width: 250px; font-size: 13px; line-height: 20px; margin: 0px 0px 0px; font-family: 'Roboto-Regular', sans-serif; font-weight: 100;padding: 10px 30px 0px;
                                                            ">{{ $userData['get_app_user_data']['location'] }}</p>
                                                      </td>
                                                </tr>

                                                <tr>
                                                      <td style="vertical-align: middle;position: relative ;padding-bottom: 30px;">
                                                            <p style=" margin: 0px; position: absolute; top: 2.2%; height: 30px; left: 6%; transform: translate(-50% , -50%); color: #fff;z-index: 6;font-family: 'Roboto-Regular', sans-serif; min-width: 80px; text-align: start;font-weight: 700;">EDUCATION</p>
                                                            <div style="height: 40px; width: 240px; background: #61a8ad; border-radius: 0px 30px 30px 0px; position: absolute; left: -20%; top: 0; z-index:1;"></div>

                                                      </td>

                                                </tr>
                                                <tr>
                                                      <td style="padding: 30px 0px 0px;">
                                                            @foreach ($userData['get_user_education'] as $educationDetail)
                                                            <div>
                                                                  <!-- <img src="<?= public_path() . 'assets/img/resume/education-bg.svg'; ?>" style="object-fit: cover; height: 40px; width: 240px;" /> -->
                                                                  <p style="color: #808080; font-size: 13px; line-height: 20px; margin: 0px 0px 0px; font-family: 'Roboto-Regular', sans-serif; font-weight: 100;padding: 10px 30px 0px;">
                                                                        {{$educationDetail['degree']}} /<span style="color: #808080; font-size: 13px; line-height: 20px; font-family: 'Roboto-Regular', sans-serif; font-weight: 100;"></span>
                                                                  </p>
                                                                  <p style="color: #808080; font-size: 13px; line-height: 20px; margin: 0px 0px 0px; font-family: 'Roboto-Regular', sans-serif; font-weight: 100;padding: 0px 30px 0px;">
                                                                        {{$educationDetail['school']}}/ <span style="color: #808080; font-size: 13px; line-height: 20px; margin: 0px 0px 0px; font-family: 'Roboto-Regular', sans-serif; font-weight: 100;">{{ date('Y', strtotime($educationDetail['start_date']))}}</span>
                                                                  </p>
                                                            </div>
                                                            @endforeach
                                                      </td>
                                                </tr>

                                          </table>
                                    </td>
                                    <td style="width: 5%; padding: 0px 0px 0px 60px;">
                                          <table>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-round.svg'; ?>" style="margin: 10px 0px; height: 12px; width: 12px;" />
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-one-line.svg'; ?>" style="padding: 0px 0px 0px 5px;  height:355px; width:2px;" />
                                                      </td>
                                                </tr>
                                          </table>
                                          <table>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-round.svg'; ?>" style="margin: 10px 0px; height: 12px; width: 12px;" />
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-one-line.svg'; ?>" style="padding: 0px 0px 0px 5px; ; height:188px; width:2px;" />
                                                      </td>
                                                </tr>
                                          </table>
                                          <table>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-round.svg'; ?>" style="margin: 10px 0px;  height: 12px; width: 12px;" />
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <img src="<?= public_path() . '/assets/img/resume/skill-one-line.svg'; ?>" style="padding: 0px 0px 0px 5px;height:220px; width:2px;" />
                                                      </td>
                                                </tr>
                                          </table>
                                    </td>
                                    <td style="width: 60%; padding: 0px 100px 0px 30px; vertical-align: top;">
                                          <table style="width: 100%;">
                                                <tr>
                                                      <td style="padding: 0px;">
                                                            <h2 style="font-family: 'Roboto-Regular', sans-serif; margin: 0px 0px 17px 0px; font-size: 24px; line-height: 30px; font-weight: 700; color: #555659;">
                                                                  EXPERIENCE</h2>
                                                      </td>
                                                </tr>
                                                @foreach ($userData['get_user_experiences'] as $userExperiences)
                                                <tr>
                                                      <td style="padding: 0px;">
                                                            <h3 style="font-family: 'Roboto-Regular', sans-serif; margin: 0px 0px 0px 0px; font-size: 14px;  line-height: 15px;  font-weight: 700; color: #555659;">
                                                                  {{$userExperiences['title']}}
                                                            </h3>
                                                            <p style="font-family: 'Roboto-Regular', sans-serif; margin: 2px 0px 0px 0px; font-size: 14px; line-height: 15px;  font-weight: 500; color: #555659;">
                                                                  {{$userExperiences['company']}}/ {{ date('Y', strtotime($userExperiences['start_date']))}}
                                                            </p>
                                                            <p style="font-family: 'Roboto-Regular', sans-serif;  margin: 15px 0px 30px 0px;  font-size: 14px; line-height: 18px; font-weight: 500; color: #555659;">
                                                                  {{$userExperiences['job_duties']}}
                                                            </p>
                                                      </td>
                                                </tr>
                                                @endforeach

                                                <tr>
                                                      <td style="padding: 0px;">
                                                            <h2 style="font-family: 'Roboto-Regular', sans-serif;  margin: 0px 0px 10px 0px; font-size: 24px; line-height: 30px; font-weight: 700;  color: #555659;
                                                            text-transform: uppercase;">Skill</h2>
                                                      </td>
                                                </tr>

                                                <tr>
                                                      <td style="padding: 0px 0px 0px 0px;">
                                                            <table style="width: 100%;">
                                                                  @if(isset($userData["get_user_statement_data"]))
                                                                  @foreach($userData['get_user_statement_data'] as $getUserStatement)
                                                                  <tr>
                                                                        <td style="width: 70%;">
                                                                              <p style="font-family: 'Roboto-Regular', sans-serif;margin: 0px 0px 0px 0px;  font-size: 13px; line-height: 18px; font-weight: 500; color: #555659;">
                                                                                    {{$getUserStatement['skill_name']}}
                                                                              </p>
                                                                        </td>
                                                                        <td style="width: 5%; padding: 0px 3px 0px 3px;">
                                                                              <img src="<?= public_path() . '/assets/img/resume/orange-round.svg'; ?>" style="width: 10px; height: 10px;" />
                                                                        </td>
                                                                        <td style="width: 5%; padding: 0px 3px 0px 3px;">
                                                                              <img src="<?= public_path() . '/assets/img/resume/orange-round.svg'; ?>" style="width: 10px; height: 10px;" />
                                                                        </td>
                                                                        <td style="width: 5%; padding: 0px 3px 0px 3px;">
                                                                              <img src="<?= public_path() . '/assets/img/resume/orange-round.svg'; ?>" style="width: 10px; height: 10px;" />
                                                                        </td>
                                                                        <td style="width: 5%; padding: 0px 3px 0px 3px;">
                                                                              <img src="<?= public_path() . '/assets/img/resume/orange-round.svg'; ?>" style="width: 10px; height: 10px;" />
                                                                        </td>
                                                                        <td style="width: 5%; padding: 0px 3px 0px 3px;">
                                                                              <img src="<?= public_path() . '/assets/img/resume/orange-round.svg'; ?>" style="width: 10px; height: 10px;" />
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
                  </td>
            </tr>
      </table>
</body>

</html>
