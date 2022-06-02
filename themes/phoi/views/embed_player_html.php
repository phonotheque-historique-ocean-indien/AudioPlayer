<?php
$blocks = $this->getVar("blocks");
?>
<script src="/assets/jquery/js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/themes/phoi/assets/pawtucket/css/theme.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.7.95/css/materialdesignicons.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@creativebulma/bulma-tooltip@1.2.0/dist/bulma-tooltip.min.css" />
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
                            <span class="has-tooltip-arrow has-tooltip-right" data-tooltip="précédent">
                                <i class="mdi mdi-skip-previous is-large" style="font-size:2.6em;"></i>
                            </span>
                        </div>
                        <div class="column text-center">
                        <span class="has-tooltip-arrow has-tooltip-right" data-tooltip="lecture/pause">
                            <i class="mdi mdi-pause-circle is-large" style="font-size:2.6em;" onClick='parent.parent.playPauseTrack()'></i>
                        </span>
                        </div>
                        <div class="column text-center">
                        <span class="has-tooltip-arrow has-tooltip-right" data-tooltip="suivant">
                            <i class="mdi mdi-skip-next is-large" style="font-size:2.6em;"></i>
                        </span>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column has-text-left" id="playing-currenttime"></div>
                        <div class="column has-text-right" id="playing-duration"></div>
                    </div>
                    <progress id="soundplayerprogression" class="progress progress4px is-danger" value="65" max="100"></progress>
                </article>
                <aside class="gaside aside-1" style="text-align: left;"><img style="cursor:pointer;" id="playing-image" style="height:120px;width:auto;"/>
                    <p><span class="has-text-weight-bold" id="playing-name"></span></p>
                    <p><span id="playing-artist"></p>
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
                    height:8px;
                    filter: drop-shadow(0px 0px 4px #999999);
                }
                .is-playing .column {
                    padding-bottom:0;
                    padding-top:24px;
                }
                .gmain .mdi,
                table#alecoute .mdi,
                #soundplayerprogression {
                    cursor: pointer;
                }
                span[data-tooltip] {
                    border-bottom: none;
                }


            </style>
        </div>
        <table class="table dataTable" id="alecoute" role="grid" style="background-color: transparent">
            <thead>
            <tr>
                <th></th>
                <th class="no-sort"></th>
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
                    "searching": false,
                    "order": [[ 0, "asc" ]],
                    "columnDefs": [ {
                        "targets"  : 'no-sort',
                        "orderable": false,
                    }]
                });

                var t = $('#alecoute').DataTable();
                var counter = 1;
                if(parent && parent.parent && parent.parent.playing && parent.parent.playing.name) {
                    var audioqueue = parent.parent.audioqueue;
                    for (let i = 0; i < audioqueue.length; i++) {
                        var track = audioqueue[i];
                        console.log("track", track);
                        t.row.add( [
                            (i+1) + "<span onClick='parent.parent.playFromQueue("+i+");document.location.reload();'><i class='mdi mdi-play is-large'></i></span>"
                            +"<span onClick='parent.parent.removeFromQueue("+i+");'><i class='mdi mdi-close is-large'></i></span>",
                            "<img style='height:24px' src='"+track.cover+"' />",
                            track.name.replace("<a href", "<a target=_parent href"),
                            track.artist.replace("<a href", "<a target=_parent href"),
                            track.album.replace("<a href", "<a target=_parent href")
                        ]);
                    }
                    var playing = parent.parent.playing;
                    $("#playing-image").attr("src", playing.cover);
                    $("#playing-image").off("click");
                    $("#playing-image").on("click", function() {
                        console.log("playing-image clicked");
                        console.log("playing-image clicked");
                        console.log(playing.linkImage);
                        $('#iframe', window.parent.parent.document).attr("src", playing.linkImage);
                    });

                    console.log("playing", playing.cover);
                    console.log("playing", playing);
                    playing.nameText = playing.name.replace(/<\/?("[^"]*"|'[^']*'|[^>])*(>|$)/g, "");
                    $("#playing-name").text(playing.nameText);
                    playing.artistText = playing.artist.replace(/<\/?("[^"]*"|'[^']*'|[^>])*(>|$)/g, "");
                    $("#playing-artist").text(playing.artistText);

                    var duration = parent.parent.duration;

                    let minutes = Math.floor(Math.floor(duration) / 60);
                    let seconds = Math.ceil(Math.floor(duration) % 60);
                    $('#playing-duration').text(minutes+":"+(seconds<10 ? "0" : "")+seconds);

                    var audio = parent.parent.document.getElementById('soundplayer');
                    audio.addEventListener('timeupdate', function () {
                        var _currentTime = parseFloat(audio.currentTime);
                        var minutes = Math.floor(Math.floor(_currentTime) / 60);
                        var seconds = Math.ceil(Math.floor(_currentTime) % 60);
                        $('#playing-currenttime').text(minutes+":"+(seconds<10 ? "0" : "")+seconds);
                        duration = audio.duration;
                        var progression = _currentTime/duration *100;
                        $('#soundplayerprogression').attr("value", progression);
                    }, false);

                    var progressBar = document.querySelector("progress");
                    progressBar.addEventListener("click", function seek(e) {
                        var percent = e.offsetX / this.offsetWidth;
                        audio.currentTime = percent * audio.duration;
                        progressBar.value = percent / 100;
                    });
                } else {
	                console.log("pas playing :-(");
	                $('#alecoute').hide();
	                window.setTimeout(function() {
		            	$("#alecoute_wrapper").append($("<p style='text-align:center'><a target='_parent' href=/index.php/Articles/Display/Details/id/21><img align=absmiddle src='/playlist/21/95318773_3196737427004578_9050247149308084224_o.jpg' style='height:120px;margin-right:10px;'><span style='line-height:120px;'>Rien à l'écoute, découvrir une playlist ?</span></a></p>"));    
	                }, 500);
	                
	                
                }
            } );
        </script>
    </div>

</div>

<style>
    #playing-image {
        height:120px !important;
    }
    </style>