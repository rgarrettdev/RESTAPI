<?php
$page = Documentation::checkEndpoint();
switch ($page) {
    case '1':
        # code...
        $request = "/api/schedule/";
        $result = "{
            'status': 200,
            'message': {
                'text': 'Records found'
            },
            'data': {
                'rowCount': 367,
                'result': [
                    {
                        'id': '0',
                        'slotsID': '0',
                        'title': 'Speaker prep room',
                        'type': 'miscellaneous',
                        'room': 'Etive',
                        'chair': 'TBA',
                        'description': 'Miscellaneous',
                        'day': 'Monday',
                        'time': '09:00 - 10:30'
                    },..]}.}";
        $info = "";
        Documentation::docEndpoint("/api/schedule/", $request, $result, $info);
        break;
        case '2':
            # code...
            $request = "/api/schedule/6";
            $result = "{
                'status': 200,
                'message': {
                    'text': 'Records found'
                },
                'data': {
                    'rowCount': 63,
                    'result': [
                        {
                            'title': 'PersonalTouch: 
                            Improving Touchscreen Usability by Personalizing Accessibility Settings based on Individual User's Touchscreen Interaction',
                            'description': 'Paper session',
                            'chair': 'Michail Schwab',
                            'room': 'Boisdale 1',
                            'day': 'Monday',
                            'time': '16:00 - 17:20',
                            'id': '153'
                        },..]}.}";
            $info = "";
            Documentation::docEndpoint("/api/schedule/:id", $request, $result, $info);
            break;
            case '3':
                # code...
                $request = "/api/schedule/update/0";
                $result = "{
                    'message': 'Successfully changed session chair of id: '0''
                }";
                $info = "Requires authentication, the jwt cookie is set via the login endpoint.";
                Documentation::docEndpoint("/api/schedule/update/:id", $request, $result, $info);
                break;
                case '4':
                    # code...
                    $request = "/api/presentations/";
                    $result = "{
                        'status': 200,
                        'message': {
                            'text': 'Records found'
                        },
                        'data': {
                            'rowCount': 2172,
                            'result': [
                                {
                                    'title': 'Opening Keynote: Touchies and Feelies: Everything I Know About Human Interfaces',
                                    'doiURL': '',
                                    'abstract': 'Social psychologist Aleks Krotoski is not an expert on computer-human interfaces. 
                                    But she is an expert on other things. In this interactive talk, she shares what baking, beach volleyball,
                                     parenting and radio storytelling have taught her about how we interact with each other,
                                      ourselves and the world around us – and what this tells us about the possibilities for future social, digital humans.',
                                    'description': 'Keynote',
                                    'chair': 'TBA',
                                    'room': 'Clyde Auditorium',
                                    'day': 'Monday',
                                    'time': '09:00 - 10:30',
                                    'author': 'Pardis Emami-Naeini',
                                    'affiliation': 'Carnegie Mellon University, Pittsburgh, PA, USA'
                                },..]}.}";
                    $info = "";
                    Documentation::docEndpoint("/api/presentations/", $request, $result, $info);
                    break;
                    case '5':
                        # code...
                        $request = "/api/presentations/1";
                        $result = "{
                            'status': 200,
                            'message': {
                                'text': 'Records found'
                            },
                            'data': {
                                'rowCount': 1,
                                'result': [
                                    {
                                        'title': 'Opening Keynote: Touchies and Feelies: Everything I Know About Human Interfaces',
                                        'doiURL': '',
                                        'abstract': 'Social psychologist Aleks Krotoski is not an expert on computer-human interfaces. 
                                        But she is an expert on other things. In this interactive talk, she shares what baking, beach volleyball, 
                                        parenting and radio storytelling have taught her about how we interact with each other, 
                                        ourselves and the world around us – and what this tells us about the possibilities for future social, digital humans.',
                                        'description': 'Keynote',
                                        'chair': 'TBA',
                                        'room': 'Clyde Auditorium',
                                        'day': 'Monday',
                                        'time': '09:00 - 10:30',
                                        'author': 'Pardis Emami-Naeini',
                                        'affiliation': 'Carnegie Mellon University, Pittsburgh, PA, USA'
                                    }
                                ]
                            }
                        }";
                        $info = "";
                        Documentation::docEndpoint("/api/presentations/:id", $request, $result, $info);
                        break;
                        case '6':
                            # code...
                            $request = "/api/presentations/category/paper";
                            $result = "{
                                'status': 200,
                                'message': {
                                    'text': 'Records found'
                                },
                                'data': {
                                    'rowCount': 723,
                                    'result': [
                                        {
                                            'title': 'Exploring How Privacy and Security Factor into IoT Device Purchase Behavior',
                                            'doiURL': 'https://doi.org/10.1145/3290605.3300764',
                                            'abstract': 'Despite growing concerns about security and privacy of Internet of Things (IoT) devices, 
                                            consumers generally do not have access to security and privacy information when purchasing these devices. 
                                            We interviewed 24 participants about IoT devices they purchased. 
                                            While most had not considered privacy and security prior to purchase, they reported becoming concerned later due to media reports, 
                                            opinions shared by friends, or observing unexpected device behavior. 
                                            Those who sought privacy and security information before purchase, reported that it was difficult or impossible to find. 
                                            We asked interviewees to rank factors they would consider when purchasing IoT devices;
                                             after features and price, privacy and security were ranked among the most important. 
                                             Finally, we showed interviewees our prototype privacy and security label. 
                                             Almost all found it to be accessible and useful, 
                                             encouraging them to incorporate privacy and security in their IoT purchase decisions.',
                                            'type': 'paper',
                                            'description': 'Paper session',
                                            'chair': 'Karola Marky',
                                            'room': 'Hall 1',
                                            'day': 'Monday',
                                            'time': '11:00 - 12:20',
                                            'author': 'Lorrie Faith Cranor',
                                            'affiliation': 'Carnegie Mellon University, Pittsburgh, PA, USA'
                                        },..]}.}";
                            $info = "";
                            Documentation::docEndpoint("/api/presentations/category/:categoryname", $request, $result, $info);
                            break;
                            case '7':
                                # code...
                                $request = "/api/presentations/search/virtual";
                                $result = "{
                                    'status': 200,
                                    'message': {
                                        'text': 'Records found'
                                    },
                                    'data': {
                                        'rowCount': 293,
                                        'result': [
                                            {
                                                'title': 'PicMe: Interactive Visual Guidance for Taking Requested Photo Composition',
                                                'doiURL': 'https://doi.org/10.1145/3290605.3300625',
                                                'abstract': 'PicMe is a mobile application that provides interactive on-screen guidance that helps 
                                                the user take pictures of a composition that another person requires. 
                                                Once the requester captures a picture of the desired composition and delivers it to the user (photographer), 
                                                a 2.5D guidance system, called the virtual frame, guides the user in real-time by showing a three-dimensional 
                                                composition of the target image (i.e., size and shape). In addition, according to the matching accuracy rate, 
                                                we provide a small-sized target image in an inset window as feedback and edge visualization for further alignment 
                                                of the detail elements. We implemented PicMe to work fully in mobile environments. We then conducted a preliminary 
                                                user study to evaluate the effectiveness of PicMe compared to traditional 2D guidance methods. The results show that 
                                                PicMe helps users reach their target images more accurately and quickly by giving participants 
                                                more confidence in their tasks.',
                                                'description': 'Paper session',
                                                'chair': 'Daniela Busse',
                                                'room': 'Boisdale 1',
                                                'day': 'Monday',
                                                'time': '11:00 - 12:20',
                                                'author': 'Benjamin Reinheimer',
                                                'affiliation': 'Karlsruhe Institute of Technology, Karlsruhe, Germany'
                                            },..]}.}";
                                    $info = "";
                                Documentation::docEndpoint("/api/presentations/search/:searchterm", $request, $result, $info);
                                break;
                                case '8':
                                    # code...
                                    $request = "/api/presentations/search/virtual/paper";
                                    $result = "{
                                        'status': 200,
                                        'message': {
                                            'text': 'Records found'
                                        },
                                        'data': {
                                            'rowCount': 97,
                                            'result': [
                                                {
                                                    'title': 'PicMe: Interactive Visual Guidance for Taking Requested Photo Composition',
                                                    'doiURL': 'https://doi.org/10.1145/3290605.3300625',
                                                    'abstract': 'PicMe is a mobile application that provides interactive on-screen guidance that helps the user take pictures of a composition 
                                                    that another person requires. Once the requester captures a picture of the desired composition and delivers it to the user (photographer), 
                                                    a 2.5D guidance system, called the virtual frame, guides the user in real-time by showing a three-dimensional composition of the 
                                                    target image (i.e., size and shape). In addition, according to the matching accuracy rate, we provide a small-sized target image in an 
                                                    inset window as feedback and edge visualization for further alignment of the detail elements. We implemented PicMe to work fully in mobile environments. 
                                                    We then conducted a preliminary user study to evaluate the effectiveness of PicMe compared to traditional 2D guidance methods. 
                                                    The results show that PicMe helps users reach their target images more accurately and quickly by giving participants more confidence in their tasks.',
                                                    'description': 'Paper session',
                                                    'chair': 'Daniela Busse',
                                                    'room': 'Boisdale 1',
                                                    'day': 'Monday',
                                                    'time': '11:00 - 12:20',
                                                    'author': 'Benjamin Reinheimer',
                                                    'affiliation': 'Karlsruhe Institute of Technology, Karlsruhe, Germany'
                                                },..]}.}";
                                        $info = "";
                                    Documentation::docEndpoint("/api/presentations/search/:searchterm/:categoryname", $request, $result, $info);
                                    break;
                                    case '9':
                                        # code...
                                        $request = "/api/login/";
                                        $result = "{
                                            'message': 'Successfully logged in'
                                        }";
                                        $info = "Cookies are set, jwt is returned which is used for authentication";
                                        Documentation::docEndpoint("/api/login/", $request, $result, $info);
                                        break;
                                        case '10':
                                            # code...
                                            $request = "/api/logout";
                                            $result = "{
                                                'data': {
                                                    'result': 'LoggedOut'
                                                }
                                            }";
                                            $info = "Cookies are set to expire";
                                            Documentation::docEndpoint("/api/logout", $request, $result, $info);
                                            break;
    
    default:
        # code...
        Documentation::docIndex();
        break;
}
