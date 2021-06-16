<?php
$blocks = $this->getVar("blocks");
?>
<script src="/assets/jquery/js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/themes/phoi/assets/pawtucket/css/theme.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.7.95/css/materialdesignicons.min.css">
<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<div style="background-color:#f2f2f2">
    <div class="container">
        <h2>Dernières playlists</h2>
        <table class="table dataTable" id="lastplaylists" role="grid" style="background-color: transparent;width:100%;">
            <thead>
            <tr role="row">
                <th>Album</th>
                <th>Artiste</th>
                <th>Auteur</th></tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="/index.php/Articles/Show/Details/id/5">Abdullah Ibrahim, la spiritualité faite musique</a></td>
                <td>23.12.2018</td>
                <td>Jonathan GRONDIN</td>
            </tr><tr>
                <td><a href="/index.php/Articles/Show/Details/id/1">Alain Peters Rest’ la maloya</a></td>
                <td>12.12.2019</td>
                <td>Jonhatan Grondin</td>
            </tr><tr>
                <td><a href="/index.php/Articles/Show/Details/id/4">Dj Sebb, le maître réunionnais de la Gommance</a></td>
                <td>04.05.2020</td>
                <td>Jonhatan Grondin</td>
            </tr><tr>
                <td><a href="/index.php/Articles/Show/Details/id/2">Le séga réunionnais inscrit à l'inventaire national du Patrimoine Culturel Immatériel de France</a></td>
                <td>JJ.MM.AAAA</td>
                <td>Jonhatan Grondin</td>
            </tr><tr>
                <td><a href="/index.php/Articles/Show/Details/id/6">Pendant le IOMMA,  les femmes donnent le la !</a></td>
                <td>30.04.2020</td>
                <td>Jonathan GRONDIN</td>
            </tr><tr>
                <td><a href="/index.php/Articles/Show/Details/id/3">Siti &amp; The Band Le pouvoir aux femmes</a></td>
                <td>28/04/2020</td>
                <td>Julien LG</td>
            </tr></tbody>
        </table>
        <script>
            $(document).ready( function () {
                $('#lastplaylists').DataTable({
                    "language": {"url": "/datatables_french.json"},
                    "info": false,
                    "paging":   false,
                    "searching": false
                });
            } );
        </script>
        <div style="text-align:center;padding:4px 0 40px 0;">
            <button class="button is-primary" style="background-color: #e4675f;padding:12px 70px;font-size:1.3em;">Voir plus de playlists</button>
        </div>
    </div>
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