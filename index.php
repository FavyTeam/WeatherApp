<?php
require_once './vendor/autoload.php';
define('STDIN',fopen("php://stdin","r"));

function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig('client_secret.json');
    $client->setAccessType('offline');

    // Load previously authorized credentials from a file.
    $credentialsPath = expandHomeDirectory('credentials.json');
    if (file_exists($credentialsPath)) {
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
       
    } else {
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n<br>", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN)); 
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        if (!file_exists(dirname($credentialsPath))) {
            mkdir(dirname($credentialsPath), 0700, true);
        }
        file_put_contents($credentialsPath, json_encode($accessToken));
        printf("Credentials saved to %s\n", $credentialsPath);
    }
    $client->setAccessToken($accessToken);

    if ($client->isAccessTokenExpired()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path)
{
    $homeDirectory = getenv('HOME');
    if (empty($homeDirectory)) {
        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
    }
    return str_replace('~', realpath($homeDirectory), $path);
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

?>






<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>Weather App</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700,inherit,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
    <link rel="stylesheet" href="css/weather.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/weather.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
             .wecode{
        
            width: 58px;
            display: inline-block;
            margin-left: 0px;
            margin-bottom:0px;
            background-color: #fff;
			    border-radius: 100%;
        }
        .dd{
            line-height: -19px;
            
            margin-bottom:0px;
            
        }
        h6{
            
            margin-bottom: 0px;
        }
       .wicon {
    height: 32px;
    width: auto;
}
        
        
   .speech {
    border: 1px solid #DDD;
    width: 300px;
    padding: 0;
    margin: 0;
    text-align: center;
    float: left;
}
 .speech input {
    border: 0;
    width: 267px;
    display: inline-block;
    height: 30px;
    float: left;
	    padding: 10px;
}
  .speech img {
    width: 30px;
    text-align: center;
    padding: 0;
    float: right;
}
        
  .left_side, .right_side {
    color: #fff;
    padding: 10px;
    margin: 0px !important;
}
    .p-2.mt-3.p-2 {
    background: none;
    padding: 0px !important;
    margin: 0 auto;
    text-align: center;
}
.outer_div {
    background: #000;
    float: left;
    width: 100%;
    padding: 18px;
	    border: 6px solid #f6f6f6;
}
.bg-secondary {
    background-color: transparent !important;
}
iframe {
    width: 100%;
    border: none;
    background: #fff;
    border-radius: 1px;
	    margin: 20px 0px;
}

.events {
    color: #fff;
}
.events h1 {
    font-size: 25px;
    margin-bottom: -9px;
    width: auto;
    padding-bottom: 9px;
    position: relative;
}
.events h1:after {
    content: "";
    border-bottom: 1px solid #fff;
    width: 200px;
    position: absolute;
    bottom: 0px;
    left: 0;
}
@media only screen and (max-width: 600px) {
	iframe {
    width: 100%;
    border: none;
    background: #fff;
    border-radius: 1px;
    margin: 40px 0px;
}
	.dd h1 {
    font-size: 27px;
}
   .p-2.mt-3.p-2 {
    width: 20%;
    float: left;
	text-align: left;
    margin: inherit;
}

.left_side, .right_side {
    width: 50%;
}
.inner_side {
    width: 80%;
    margin-left: 22px;
    padding: 0px;
}
.wecode {
width: 34px;
}
div#dates h6 {
    font-size: 14px;
}
h1#time {
    font-size: 22px;
}
.small, small {
    font-size: 63%;
    font-weight: 400;
}
}
    </style>

</head>
<body class="body page-index clearfix">

    <div class="container mt-3">
	<div class="outer_div">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6  left_side mx-auto">
                   
                        <div id="dates" class="bg-seconday">
                            
                            <h6 id="date"></h6>
                        </div>
                   
                  
                       <h1 id="time"></h1>
                 
                        
                    </div>
                <div class="col-md-6 col-sm-6 col-xs-6  mx-auto right_side">
                   <div class="row">
                         <div class="col-md-4 col-sm-4 col-xs-4  p-2 mt-3 p-2">
                            <span class=" ml-auto wecode " id="wecode">
							</span>
                        </div>
                         <div class='col-md-8 col-sm-8 col-xs-8 inner_side'>
                            
                            <h6  class="d-inline-block"id="city"> </h6>
                            <h6  class="d-inline-block"id="cntr"></h6>
                            
                            <div class="dd">

                                <h1 style="display: inline" id="temp" class="d-inline"></h1>
                            </div>

                            <div class="iocnss">
                          <span>  <img class=" wicon" src="images/Wind.svg"><small id="wind"></small> |</span>
                           <span> <img class=" wicon" src="images/Droplet.svg"><small id="humid"></small> | </span>
                            </div>

                        </div>

                    </div>
                </div>
            
            
            </div>
        <div class="row" style="    margin: 33px 0px;">
            <form id="labnol" method="get" action="https://www.google.com/search">
                <div class="speech">
                    <input type="text" name="q" id="transcript" placeholder="Speak" />
                    <img onclick="startDictation()" src="http://icons.iconarchive.com/icons/icons-land/play-stop-pause/256/Microphone-Disabled-icon.png" />
                </div>
            </form>
        </div>
        
        
   
    
    
	<div class="row">
		<div class="col-md-6 events">
	<?php

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);

if (empty($results->getItems())) {
    print "No upcoming events found.\n";
} else {
    print "<h1>Upcoming events:\n</h1>";
    foreach ($results->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("<br> <i class='fa fa-calendar' aria-hidden='true'></i> %s <br> <i class='fa fa-clock-o' aria-hidden='true'></i> (%s)\n", $event->getSummary(), $start);
    }
}
?>
</div>
		<div class="col-md-6">
   <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.channelnewsasia.com/rssfeeds/8395986";  
rssfeed_frame_width="60%"; 
rssfeed_frame_height="300"; 
rssfeed_scroll="on"; 
rssfeed_scroll_step="6"; 
rssfeed_scroll_bar="off"; 
rssfeed_target="_blank"; 
rssfeed_font_size="12"; 
rssfeed_font_face=""; 
rssfeed_border="on"; 
rssfeed_css_url="https://feed.surfing-waves.com/css/style4.css"; 
rssfeed_title="on"; 
rssfeed_title_name=""; 
rssfeed_title_bgcolor="#3366ff"; 
rssfeed_title_color="#fff"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#fff"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="off"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#fff"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="off"; 
rssfeed_no_items="0"; 
rssfeed_cache = "baf9ad6af6fa1007096f149bd7b33fb6"; 
//--> 
</script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>
    <script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
    <script src="js/news.js"></script>
    <script src="js/weather.js"></script>
    <script src="js/script.js"></script>
    <script src="js/voice.js"></script>
	</div>

	     </div>
	</div>
	</div>
</body>
</html>

