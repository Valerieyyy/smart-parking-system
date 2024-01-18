<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content={{ csrf_token() }} />

        <title>Attendance</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            .att-header { font-size: 1.6em!important; }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="col-lg-12 text-center pt-5">
                    <img src="{{ asset('assets/images/logo-image.png') }}" alt="" style="width:10%;height:auto;">
                    <br><br>
                    <p class="text-center att-header">
                        <strong>
                            @php
                                $time = date('H')
                            @endphp
                            @if ($time < "12")
                                Good morning!
                            @elseif ($time >= "12" && $time < "17")
                                Good afternoon!
                            @elseif ($time >= "17" && $time < "23")
                                Good evening!
                            @endif
                            <br>
                            Welcome to Polytechnic University of the Philippines - Binan
                            <br>
                            Smart Parking System
                        </strong>
                    </p>
                    <br>
                    <p class="text-center att-header"><strong>{{ date('l') }}</strong></p>
                    <p class="text-center att-header"><strong id="ct5"></strong></p>
                </div>
                <nav class="navbar navbar-success navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<br />
				<div class="alert alert-info">
					<strong>
					<a class="btn btn-success" href="/home" role="button">Back</a>
					</strong> 
					<center>
						<h1>
							Used This Login If Arduino Based RF Scanner Not Working
						</h1>
						Scan ID To LogIn
					</center>
				</div>	
					<div align="center" id="time"></div>
				<ul class="nav navbar-nav">
				</ul>
			</div>
		</nav>
            <center>
            <form action="{{url('/log-out')}}" method="post" >
                 @csrf
                 <input type="hidden" name="status">
					<input id ="time_out" type="text"  name="time_out" class="form-control" autofocus>
                    <br>
					<button type="submit" class="btn btn-primary" name="doneScanning">Submit</button>
			</form>
            </center>
                <div class="col-lg-12">
                    <div class="row p-3">
                        <div class="col-xl-6 p-3">
                            <div class="shadow">
                                <nav class="navbar navbar-light bg-light px-3">
                                    <a class="navbar-brand" href="#"><strong>TIME IN</strong> Logs</a>
                                </nav>
                                <ul class="list-group list-group-flush"style="max-height: 300px;overflow:auto;">
                                @if (isset($Attendance))
                                    @foreach ($Attendance as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                <div class="fw-bold">
                                                {{$item->first_name}} {{$item->middle_name}}. {{$item->last_name}}
                                                </div>
                                                </div>
                                                <span class="badge bg-success rounded-pill">{{ date('M d, Y H:i a', strtotime( $item->time_in))}}</span>
                                            </li>
                                    @endforeach
                                @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-6 p-3">
                            <div class="shadow">
                                <nav class="navbar navbar-light bg-light px-3">
                                    <a class="navbar-brand" href="#"><strong>TIME OUT</strong> Logs</a>
                                </nav>
                                <ul class="list-group list-group-flush"style="max-height: 300px;overflow:auto;">
                                @if (isset($Attendance))
                                    @foreach ($Attendance as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                <div class="fw-bold">
                                                {{$item->first_name}} {{$item->last_name}}
                                                </div>
                                                </div>
                                                <span class="badge bg-success rounded-pill">{{ date('M d, Y H:i a', strtotime( $item->time_out))}}</span>
                                            </li>
                                    @endforeach
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            $(document).ready(function(){
                // Swal.fire('ATTENTION', "We apologize for the inconvenience. This attendance feature is under construction for enhancement. Use it at your own risk; if you have any questions, please contact Jb Bucog. ", 'info');

                display_c5();
            });

            function display_ct5() {
                var x = new Date()
                var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
                hours = x.getHours( ) % 12;
                hours = hours ? hours : 12;
                hours=hours.toString().length==1? 0+hours.toString() : hours;

                var minutes=x.getMinutes().toString()
                minutes=minutes.length==1 ? 0+minutes : minutes;

                var seconds=x.getSeconds().toString()
                seconds=seconds.length==1 ? 0+seconds : seconds;

                var month=(x.getMonth() +1).toString();
                month=month.length==1 ? 0+month : month;

                var dt=x.getDate().toString();
                dt=dt.length==1 ? 0+dt : dt;

                var x1=month + "/" + dt + "/" + x.getFullYear();
                x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
                document.getElementById('ct5').innerHTML = x1;

                display_c5();
            }

            function display_c5(){
                var refresh=1000; // Refresh rate in milli seconds
                mytime=setTimeout('display_ct5()',refresh)
            }
        </script>
        <script type="module">
            import QrScanner from "{{asset('assets/js/qr/qr-scanner.min.js')}}";

            const video = document.getElementById('qr-video');
            const videoContainer = document.getElementById('video-container');
            const camHasCamera = document.getElementById('cam-has-camera');
            const camList = document.getElementById('cam-list');
            const camHasFlash = document.getElementById('cam-has-flash');
            const flashToggle = document.getElementById('flash-toggle');
            const flashState = document.getElementById('flash-state');
            const camQrResult = document.getElementById('cam-qr-result');
            const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');

            function setResult(label, result) {
                if(result.data != "") {
                    window.open(result.data, "mywindow", "menubar=1,resizable=1,width=350,height=250");
                }
                // var ua = navigator.userAgent.toLowerCase();
                // var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
                // if(isAndroid) {
                //     // document.getElementById('android-button').style.display = 'inline';
                //     alert("Android");
                // } else {
                // // is a computer
                // // document.getElementById('computer-button').style.display = 'inline';
                //     alert("PC");
                // }
                label.textContent = result.data;
                camQrResultTimestamp.textContent = new Date().toString();
                label.style.color = 'teal';
                clearTimeout(label.highlightTimeout);
                label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
            }

            // ####### Web Cam Scanning #######

            const scanner = new QrScanner(video, result => setResult(camQrResult, result), {
                onDecodeError: error => {
                    camQrResult.textContent = error;
                    camQrResult.style.color = 'inherit';
                },
                highlightScanRegion: true,
                highlightCodeOutline: true,
            });

            const updateFlashAvailability = () => {
                scanner.hasFlash().then(hasFlash => {
                    camHasFlash.textContent = hasFlash;
                    flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
                });
            };

            scanner.start().then(() => {
                updateFlashAvailability();
                // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
                // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
                // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
                // start the scanner earlier.
                QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                    const option = document.createElement('option');
                    option.value = camera.id;
                    option.text = camera.label;
                    camList.add(option);
                }));
            });

            QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

            // for debugging
            window.scanner = scanner;

            document.getElementById('scan-region-highlight-style-select').addEventListener('change', (e) => {
                videoContainer.className = e.target.value;
                scanner._updateOverlay(); // reposition the highlight because style 2 sets position: relative
            });

            document.getElementById('show-scan-region').addEventListener('change', (e) => {
                const input = e.target;
                const label = input.parentNode;
                label.parentNode.insertBefore(scanner.$canvas, label.nextSibling);
                scanner.$canvas.style.display = input.checked ? 'block' : 'none';
            });

            document.getElementById('inversion-mode-select').addEventListener('change', event => {
                scanner.setInversionMode(event.target.value);
            });

            camList.addEventListener('change', event => {
                scanner.setCamera(event.target.value).then(updateFlashAvailability);
            });

            flashToggle.addEventListener('click', () => {
                scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
            });

            // document.getElementById('start-button').addEventListener('click', () => {
            //     scanner.start();
            // });

            // document.getElementById('stop-button').addEventListener('click', () => {
            //     scanner.stop();
            // });
        </script>
    </body>
</html>
