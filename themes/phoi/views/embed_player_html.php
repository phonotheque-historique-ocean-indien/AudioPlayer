<?php
$blocks = $this->getVar("blocks");
?>
<script src="/assets/jquery/js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/themes/phoi/assets/pawtucket/css/theme.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.7.95/css/materialdesignicons.min.css">
<style>
    body {
        background-color: #f7f6f7;
    }
</style>
<div style="background-color:#f7f6f7;padding-bottom:70px;">
    <div class="container">
        <h2><?php _p("A l'écoute."); ?></h2>
        <div id="is-playing">
            <div class="gwrapper is-playing">
                <article class="gmain">
                    <div class="columns is-centered">
                        <div class="column text-center">
                            <i class="mdi mdi-skip-previous is-large" style="font-size:2.6em;"></i>
                        </div>
                        <div class="column text-center">
                            <i class="mdi mdi-pause-circle is-large" style="font-size:2.6em;" onClick='parent.parent.playPauseTrack()'></i>
                        </div>
                        <div class="column text-center">
                            <i class="mdi mdi-skip-next is-large" style="font-size:2.6em;"></i>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column has-text-left" id="playing-currenttime"></div>
                        <div class="column has-text-right" id="playing-duration"></div>
                    </div>
                    <progress id="soundplayerprogression" class="progress progress4px is-danger" value="65" max="100"></progress>
                </article>
                <aside class="gaside aside-1" style="text-align: left;"><img id="playing-image" style="height:120px;width:auto;"/>
                    <p><span class="has-text-weight-bold" id="playing-name"></span></p>
                    <p><span id="playing-artist"></p>
                </aside>
                <aside class="gaside aside-2 has-text-left">
                    <div class="columns is-centered">
                        <div class="column has-text-left">
                            <i class="mdi mdi-volume-high is-large" style="font-size:2.6em;"></i>
                        </div>
                    </div>
                    <div>
                        <div class="pull-left">&nbsp;</div>
                        <div class="pull-right">&nbsp;</div>
                    </div>

                    </p>
                    <progress id="" class="progress progress4px" value="15" max="100"></progress>

                </aside>
            </div>
            <style>
                .gwrapper.is-playing {
                    display: flex;
                    flex-flow: row wrap;
                    font-weight: normal;
                    text-align: center;
                }
                .gwrapper.is-playing img {
                    float:left;
                    margin-right:20px;
                }

                .gwrapper > * {
                    padding: 10px;
                    flex: 1 100%;
                }

                .gmain {
                    padding-left:0px;
                    padding-right: 160px;
                }

                .aside-1.gaside { flex: 3 0 0; }
                .aside-1.gaside p:first-of-type {
                    margin-top:12px;
                }

                .aside-2 {
                }

                @media all and (min-width: 600px) {
                    .gaside { flex: 1 0 0; }
                }

                @media all and (min-width: 800px) {
                    .gmain    { flex: 3 0px; }
                    .aside-1 { order: 1; }
                    .gmain    { order: 2; }
                    .aside-2 { order: 3; }
                    .gfooter  { order: 4; }
                }
                .progress.progress4px {
                    height:4px;
                }
                .is-playing .column {
                    padding-bottom:0;
                    padding-top:24px;
                }
            </style>
        </div>
        <table class="table dataTable" id="alecoute" role="grid" style="background-color: transparent">
            <thead>
            <tr>
                <th></th>
                <th><?php _p("Titre"); ?></th>
                <th><?php _p("Artiste"); ?></th>
                <th><?php _p("Album"); ?></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#alecoute').DataTable({
                    "language": {"url": "/datatables_french.json"},
                    "info": false,
                    "paging":   false,
                    "searching": false
                });

                var t = $('#alecoute').DataTable();
                var counter = 1;
                if(parent && parent.parent && parent.parent.playing && parent.parent.playing.name) {
                    var audioqueue = parent.parent.audioqueue;
                    for (let i = 0; i < audioqueue.length; i++) {
                        var track = audioqueue[i];
                        t.row.add( [
                            (i+1) + "<span onClick='parent.parent.playFromQueue("+i+");'><i class='mdi mdi-play is-large'></i></span>"
                            +"<span onClick='parent.parent.removeFromQueue("+i+");'><i class='mdi mdi-close is-large'></i></span>",
                            track.name,
                            track.artist,
                            track.album
                        ]);
                    }

                    var playing = parent.parent.playing;
                    $("#playing-image").attr("src", playing.cover);
                    $("#playing-name").text(playing.name);
                    $("#playing-artist").text(playing.artist);

                    var duration = parent.parent.duration;

                    let minutes = Math.floor(Math.floor(duration) / 60);
                    let seconds = Math.ceil(Math.floor(duration) % 60);
                    $('#playing-duration').text(minutes+":"+(seconds<10 ? "0" : "")+seconds);

                    var audio = parent.parent.document.getElementById('soundplayer');
                    audio.addEventListener('timeupdate', function () {
                        var _currentTime = parseFloat(audio.currentTime);
                        var minutes = Math.floor(Math.floor(_currentTime) / 60);
                        var seconds = Math.ceil(Math.floor(_currentTime) % 60);
                        $('span#position').text(minutes+":"+(seconds<10 ? "0" : "")+seconds);
                        duration = audio.duration;
                        var progression = _currentTime/duration *100;
                        $('#soundplayerprogression').attr("value", progression);
                    }, false);
                } else {
	                console.log("pas playing :-(");
	                $('#alecoute').hide();
	                window.setTimeout(function() {
		            	$("#alecoute_wrapper").append($("<p style='text-align:center'><a target='_parent' href=https://dev.phoi.io/index.php/Playlists/Show/Details/id/21><img align=absmiddle src='/playlist/21/95318773_3196737427004578_9050247149308084224_o.jpg' style='height:120px;margin-right:10px;'><span style='line-height:120px;'>Rien à l'écoute, découvrir une playlist ?</span></a></p>"));    
	                }, 500);
	                
	                
                }
            } );
        </script>
    </div>

</div>
