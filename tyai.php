<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>Weather App</title>
  <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700,inherit,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">        
    <style>
        .wecode{
        
            width: 40px;
            display: inline-block;
            margin-left: 0px;
            margin-bottom:0px;
            background-color: aliceblue;
        }
        .dd{
            line-height: -19px;
            
            margin-bottom:0px;
            
        }
        h6{
            
            margin-bottom: 0px;
        }
        .wicon{
            height: 15px;
            width: auto;
        }
    
    </style>

</head>
<body class="body page-index clearfix">
    <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-6 bg-success mx-auto">
                    <div id="dates">
                         <h1 id="time"></h1>
                        <small id="date"></small>
                    </div>
                </div>
                <div class="col-5 mx-auto bg-danger">
                   <div class="row">
                         <div class="col-4 p-2 mt-3 p-2 bg-danger">
                            <span class=" ml-auto wecode " id="wecode"></span>
                        </div>
                         <div class='col-8 bg-secondary'>
                            <div class="bg-success  row">
                            <h6  class="d-inline-block"id="city"> </h6>
                            <h6  class="d-inline-block"id="cntr"></h6>
                            </div>
                            <div class="dd row">

                                <h1 style="display: inline" id="temp" class="d-inline"></h1>
                            </div>

                            <div class="row bg-warning ">
                          <span>  <img class=" wicon" src="images/Wind.svg"><small id="wind"></small> |</span>
                           <span> <img class=" wicon" src="images/Droplet.svg"><small id="humid"></small> | </span>
                            </div>

                        </div>

                    </div>
                </div>
            
            
            </div>
        
        
        </div>
    
    
    
    <script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://news.google.com/news/rss/?ned=in&gl=IN&hl=en-IN";  
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
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="off"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="off"; 
rssfeed_no_items="0"; 
rssfeed_cache = "71040566f83c7ead0ddfa249d3efbeec"; 
//--> 
</script> 
        
        

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.1.0/jquery.simpleWeather.min.js"></script>
    <script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
    <script src="js/news.js"></script>
    <script src="js/weather.js"></script>
    <script src="js/script.js"></script>
</body>
</html>







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
    print "Upcoming events:\n";
    foreach ($results->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}

?>