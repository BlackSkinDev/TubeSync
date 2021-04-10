<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Start Party | TubeSync</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
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
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <body>

        <div id="app">
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
           
                <div class="row" style="margin-top: 26px">

                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header">Enjoy your party</h5>
                            <div class="card-body">
                                <div id="party" style="width:100%; height:370px">
                                           
                                </div>
                                <div>

                                    @if(Auth::user()->id==$session->user->id)
                                        <button v-on:click="play"> <i class="fa fa-play fs-4x"></i></button>
                                        <button id="pause" v-on:click="pause"> <i class="fa fa-pause fs-4x"></i></button>
                                        <button id="mute-toggle" v-on:click="mute"><span>mute</span></button>
                                    
                                    @endif
                                    <p><span id="current-time">0:00</span> / <span id="duration">0:00</span></p>
                                     @if(Auth::user()->id==$session->user->id)
                                    <input type="range" id="progress-bar" min="0" max="100" value="0" style="width: 591px;" v-on:mouseup="fowardOrRewind">
                                      @endif
                                </div>
                            </div>
                        </div>

                    </div> <!-- column 6 ends -->


                    <div class="col-md-4">
                         <div class="card">
                            <h5 class="card-header">Chat Room</h5>
                            <div class="card-body " style="max-height:500px;overflow-y:auto;" id="mainBody">
                                <span class="badge bg-secondary rounded-pill" style="display: none;" id="start">Start chat..</span>
                                 <center><span class="badge badge-pill" style="color: brown"  v-if="activeUser">@{{ activeUser }} is typing...</span></center>
                                <div id="messages">
                        

                                </div>

                              
                            </div>
                        </div>
                        
                        <div style="margin-top:10px;">
                        <input type="text" name="body" class="form-control" placeholder="Send Message.." id="messageBox" v-model="messageBox"  @keydown="sendTypingEvent" >

                             <button class="btn btn-success" style="margin-top:10px" v-on:click="
                        sendMessage">Send</button>
                        <div id="error" style="color: red;display: none">Message cannot be empty</div>
                        </div>
                    
                    </div> <!-- column 4 ends -->

                    <div class="col-md-2">
                       
                        <div class="card">
                            <h5 class="card-header">Online users</h5>
                            <div class="card-body">
                                <div class="alert alert-success" id="popUp" style="display: none;"></div>
                                <div class="alert alert-danger" id="popUp2" style="display: none;"></div>
                               
                                <div id="users">
                                    
                                </div>
                                <div class="input-group mb-3">
                                  <input type="text" class="form-control" id="link" value="{{url()->current()}}" aria-describedby="basic-addon2" disabled>
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="copy('link')" title="Copy Video Link">Link</button>
                                  
                                  </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- column 2 ends -->

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
         <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
         <script src="{{ asset('js/app.js') }}" ></script>

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



            //  $('#progress-bar').on('mouseup touchend', function (e) {

            //     // Calculate the new time for the video.
            //     // new time in seconds = total duration in seconds * ( value of range input / 100 )
            //     var newTime = player.getDuration() * (e.target.value / 100);

            //     // Skip video to new time.
            //     player.seekTo(newTime);
              
            // });


           
            // $('#play').on('click', function () {

            //         player.playVideo();

            // });

            // $('#pause').on('click', function () {

            //     player.pauseVideo();

            // });

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




              
               
              });  //end of jquery ready
        
        // my vue.js section


var  session ={!! $session->toJson() !!};
var LoggedInUser ={!! Auth::check() ? Auth::user()->toJson(): 'null' !!};
var isAdmin= LoggedInUser.id==session.user_id;

const app = new Vue({
    el: '#app',
    data:{
        session:{!! $session->toJson() !!},
        LoggedInUser:{!! Auth::check() ? Auth::user()->toJson(): 'null' !!},
        messageBox:'',
        messages:{},
        newMessage:{},
        typing:'',
        activeUser:false,
        typingTimer:false,
        isAdmin,
            
    },
    mounted(){
        this.joinRoom()
        this.getMessages()
        this.StartVideo()

    },
    methods:{
        
        getMessages(){
            axios.get(`/messages/${this.session.id}`)
                
                .then( (response)=>{
                   
                   this.messages=response.data

                   if (this.messages.length>0) {

                    for (var i = 0; i < this.messages.length; i++) {

                        if (this.LoggedInUser.id == this.messages[i].user.id) {
                        
                             $("#messages").append(
                                '<div class="message mt-4 "><span class="ml-2"><b>You</b></span> <span style="color: #aaa;"> '+this.messages[i].created_at+'</span><div class="box2"><span>'+this.messages[i].content+'</span></div></div>');
                   
                        }
                   
                        else{
                        

                            $("#messages").append(
                                '<div class="message mt-4"><span class="ml-2"><b>'+this.messages[i].user.name+'</b></span> <span style="color: #aaa;"> '+this.messages[i].created_at+'</span><div class="box1"><span>'+this.messages[i].content+'</span></div></div>');
                        }  
                   
                    }



                   }
                   else{

                        $("#start").show();

                   }
                

                    
                }) 
                .catch( function (error){
                  console.log(error);
                })

            },

        joinRoom(){
        Echo.join('chatroom.'+this.session.id)
            .here((user) => {
                for (var i = 0; i < user.length; i++) {
                    if (this.session.user.id==user[i].id) {
                        $("#users").append('<p id='+user[i].id+'><b>Admin: </b>'+user[i].name+'</p>');
                    }
                    else{
                        $("#users").append('<p id='+user[i].id+'>'+user[i].name+'</p>');    
                    }
                    
                }
            })
            .joining((user) => {
                console.log(user.name + " joined");

                if (this.session.user.id==user.id) {
                    $("#users").append('<p id='+user.id+'><b>Admin: </b>'+user.name+'</p>');
                }
                else{
                     $("#users").append('<p id='+user.id+'>'+user.name+'</p>');
                }
                

                $("#popUp").text(user.name+ " Joined");

                $( "#popUp" ).show(); 

                setTimeout(function() {

                    $( "#popUp" ).hide();

                }, 3000);

            })
            .leaving((user) => {
                console.log(user.name + " left");
                 $("#"+user.id).remove();
                 $("#popUp2").text(user.name+ " Left");

                $( "#popUp2" ).show(); 

                setTimeout(function() {

                    $( "#popUp2" ).hide();

                }, 3000);
               
            })
            .listen('NewMessage', (message)=>{
                 console.log(message)
                $("#messages").append(
                    '<div class="message mt-4"><span class="ml-2">'+message.user.name+'</span> <span style="color: #aaa;margin-left: 40px;"> '+message.created_at+'</span><div class="box1"><span>'+message.content+'</span></div></div>');
                  
                  
                  var myDiv = document.getElementById("mainBody");
                  myDiv.scrollTop = myDiv.scrollHeight;

            })

            .listenForWhisper('typing', (e) => {

                //console.log(e.name)
                this.activeUser=e.name

                if (this.typingTimer) {
                    clearTimeout(this.typingTimer)
                }
                
                this.typingTimer= setTimeout( ()=>{
                    this.activeUser=false
                 },3000)
               
                
            })

            .listenForWhisper('paused', (e) => {

                    console.log(e.info)
                   player.pauseVideo();
                    
                 
            })

            .listenForWhisper('played', (e) => {
                    
                    //player.playVideo();
                    
                     player.seekTo(e.time);

                     //player.playVideo()
                     console.log("seeked")

                 
            })

             .listenForWhisper('mute', (e) => {
                    console.log(e.info)

                    if(player.isMuted()){
                        player.unMute();
                        $("#mute_toggle").text('mute');
                        
                    }
                    else{
                        player.mute();
                        $("#mute_toggle").text('unmute');
                        
                    }
                    
                 
            })

              .listenForWhisper('change', (e) => {
                    // Calculate the new time for the video.
                    // // new time in seconds = total duration in seconds * ( value of range input / 100 )
                    // var newTime = player.getDuration() * (e.target.value / 100);

                    // // Skip video to new time.
                    // player.seekTo(newTime);
              
              });



        },

        sendMessage(){
            if (this.messageBox=='') {
                 $( "#error" ).show(); 

                setTimeout(function() {

                    $( "#error" ).hide();

                }, 2000);
            }
            else{

            //calling send message endpoint

              axios.post(`/send/${this.session.id}`, {
                 content:this.messageBox 
              })  
              .then( (response)=>{
                this.newMessage=response.data
                console.log(this.newMessage)
                this.messageBox=''
                $("#start").hide()
                 $("#messages").append(
                    '<div class="message mt-3" id="new' +this.newMessage.id+'"><span class="ml-2"><b>You</b></span> <span style="color: #aaa;margin-left: 40px;"> '+this.newMessage.created_at+'</span><div class="box2"><span>'+this.newMessage.content+'</span></div></div>');
                      
                    // scroll to last message
                      var myDiv = document.getElementById("mainBody");
                      myDiv.scrollTop = myDiv.scrollHeight;

               
    
                })

              .catch( function (error){
                  console.log(error);
              })

          }
        //calling endpoint ends                
                           
        },

         sendTypingEvent(){
            Echo.join('chatroom.'+this.session.id)
                .whisper('typing', {
                    name: this.LoggedInUser.name,
             });
               
        },

       
        StartVideo(){

                            // starter function starts
                var tag = document.createElement('script');

                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);                
                window.YT.ready(function(){

                        player = new window.YT.Player('party', {
                        width: 600,
                        height: 400,
                        videoId: "{{$session->url}}",
                        playerVars: {
                            color: 'white',
                        },
                        events: {
                            onReady: initialize
                        },

                        playerVars: {

                              //'autoplay': !this.isAdmin,
                              'autoplay': 0,
                              'controls': 0,
                              'disablekb': 0,
                              'fs': 0,
                              'loop': 0,
                              'modestbranding': 0,
                              'rel': 0,
                              'showinfo': 0,
                              'mute': 0,
                              'autohide': 0

                            },
                    });
                })

              
                function initialize(){
                        updateTimerDisplay();
                        updateProgressBar();
                        

                        //Dr. Cloud

                       // setTimeout(()=>{
                       //      player.pauseVideo();
                       // },1000);

                        time_update_interval = setInterval(function () {
                        updateTimerDisplay();
                        updateProgressBar();
                }, 1000)
                
                // Clear any old interval.
                //clearInterval(time_update_interval);
             }

            function updateTimerDisplay(){
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

            // This function is called by initialize()
            function updateProgressBar(){
                // Update the value of our progress bar accordingly.
                $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
            }


            // starter function ends




        },

        pause(){

            Echo.join('chatroom.'+this.session.id)
                .whisper('paused', {
                    info: "video paused",
             });
            player.pauseVideo();

           

        },

        play(){
             Echo.join('chatroom.'+this.session.id)
                .whisper('played', {
                    time: player.getCurrentTime() / (player.getDuration() * 100),
             });
            player.playVideo();
        },

        mute(){

             Echo.join('chatroom.'+this.session.id)
                .whisper('mute', {
                    info: "video muted",
             });

        },

        fowardOrRewind(){

             Echo.join('chatroom.'+this.session.id)
                .whisper('change', {
                    info: "video forward or rewinded",
             });

        },


    }
});



        // end of vue.js section
            
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
