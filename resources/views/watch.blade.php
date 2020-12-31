<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Start Party | TubeSync</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="../favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="dist/css/theme.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#A9A9A9 !important">
      <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">TubeSync</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/dashboard">Home</a>
            </li>
            
          </ul>
           <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/logout">Logout</a>
            </li>
          
          </ul>
        </div>
      </div>
    </nav>
                <div class="container" style="margin-top: 100px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header"><h3>Watch On TubeSync</h3></div>
                                    <div class="card-body">
                                         <div id="party" style="width:100%; height:370px">
                                           
                                         </div>
                                         <div>
                                             <button id="play"> <i class="fa fa-play fs-4x"></i></button>
                                            <button id="pause"> <i class="fa fa-pause fs-4x"></i></button>
                                            <button id="mute-toggle"><span>mute</span></button>
                                            <p><span id="current-time">0:00</span> / <span id="duration">0:00</span></p>
                                             <input type="range" id="progress-bar" min="0" max="100" value="0" style="width: 591px;">
                                         </div>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                    <div class="card-header"><h3>Connected users</h3></div>
                                    <div class="card-body">
                                        <div id="visitfromworld" style="width:100%; height:370px">
                                            <p>Chilling Loccini</p><hr>
                                            <p>Chilling Loccini</p><hr>
                                            <p>Chilling Loccini</p><hr>
                                            <p>Chilling Loccini</p><hr>
                                            <p>Chilling Loccini</p><hr>
                                            <p><b>Host</b>: {{$party->creator()->first()->name}}</p><hr>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" id="link" value="{{url()->current()}}" aria-describedby="basic-addon2" disabled>
                                              <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" onclick="copy('link')">Copy Link</button>
                                              
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>






        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="../plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="../plugins/screenfull/dist/screenfull.js"></script>
        <script src="../dist/js/theme.js"></script>

        <script src="https://www.youtube.com/iframe_api"></script>
        <script>

            function copy(element_id){
              var aux = document.createElement("div");
              aux.setAttribute("contentEditable", true);
              aux.innerHTML = document.getElementById(element_id).value;
              aux.setAttribute("onfocus", "document.execCommand('selectAll',false,null)"); 
              document.body.appendChild(aux);
              aux.focus();
              document.execCommand("copy");
              document.body.removeChild(aux);
            }



            $(document).ready(function(){

                var player;
                window.YT.ready(function(){
                        player = new window.YT.Player('party', {
                        width: 600,
                        height: 400,
                        videoId: "{{$party->url}}",
                        playerVars: {
                            color: 'white',
                        },
                          events: {
                            onReady: initialize
                        }
                    });
                })

                function initialize(){

                        // Update the controls on load
                        updateTimerDisplay();
                        updateProgressBar();

                

                        // Start interval to update elapsed time display and
                        // the elapsed part of the progress bar every second.
                        time_update_interval = setInterval(function () {
                        updateTimerDisplay();
                        updateProgressBar();
                }, 1000)

                // Clear any old interval.
                //clearInterval(time_update_interval);
             }

            // This function is called by initialize()
            function updateTimerDisplay(){
                // Update current time text display.
                $('#current-time').text(formatTime( player.getCurrentTime() ));
                $('#duration').text(formatTime( player.getDuration() ));
            }

            function formatTime(time){
                time = Math.round(time);

                var minutes = Math.floor(time / 60),
                seconds = time - minutes * 60;

                seconds = seconds < 10 ? '0' + seconds : seconds;

                return minutes + ":" + seconds;
            }

            $('#progress-bar').on('mouseup touchend', function (e) {

                // Calculate the new time for the video.
                // new time in seconds = total duration in seconds * ( value of range input / 100 )
                var newTime = player.getDuration() * (e.target.value / 100);

                // Skip video to new time.
                player.seekTo(newTime);
                console.log(newTime)
            });


            // This function is called by initialize()
            function updateProgressBar(){
                // Update the value of our progress bar accordingly.
                $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
            }

           
                $('#play').on('click', function () {

                    player.playVideo();

                });

                $('#pause').on('click', function () {

                    player.pauseVideo();

                });

                $('#mute-toggle').on('click', function() {
                    var mute_toggle = $(this);

                    if(player.isMuted()){
                        player.unMute();
                        mute_toggle.text('mute');
                        
                    }
                    else{
                        player.mute();
                        mute_toggle.text('unmute');
                        
                    }
              });

              
               
             })

            




        </script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
