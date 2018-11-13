@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div id="player"></div>
            </div>
        </div>
    </div>
</div>

@endsection

<script type="text/javascript" src="<?php echo asset('js/lib/xapiwrapper.min.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/src/videoprofile.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('js/src/xapi-youtube-statements.js')?>"></script>

<script>

    //var video = "tlBbt5niQto"; // Change this to your video ID
    var video = "{{$uri}}";
    var myXAPI = {};

    ADL.launch(function (err, launchdata, xAPIWrapper) {
        if (!err) {
            ADL.XAPIWrapper = xAPIWrapper;
            myXAPI.actor = launchdata.actor;
            if (launchdata.customData.content) {
                myXAPI.context = {contextActivities: {grouping: [{id: launchdata.customData.content}]}};
            } else {
                myXAPI.context = {contextActivities: {grouping: [{id: "http://adlnet.gov/event/xapiworkshop/launch/no-customData"}]}};
            }
        } else {
            ADL.XAPIWrapper.changeConfig({
                "endpoint":"https://lrs.adlnet.gov/xapi/",
                "user":"profmds",
                "password":"santos13"
            });
            myXAPI.actor = {account: {homePage:"http://example.com/watch-video", name: "ProfMDS"}};
            myXAPI.context = {contextActivities: {grouping: [{id: "http://adlnet.gov/event/xapiworkshop/non-launch"}]}};
        }

        myXAPI.object = {id: "https://www.youtube.com/watch?v="+video, definition: {name: {"en-US": video}}};

        ADL.XAPIYoutubeStatements.changeConfig(myXAPI);

    }, true);

    function initYT() {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: video,
            playerVars: { 'autoplay': 0, 'disablekb': 1 },
            events: {
                'onReady': ADL.XAPIYoutubeStatements.onPlayerReady,
                'onStateChange': ADL.XAPIYoutubeStatements.onStateChange
            }
        });
    }

    initYT();

</script>
