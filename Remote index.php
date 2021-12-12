<body style="background-color: #0c0c0c; color: #a00000;">
<?php
// This File Works.

$outputWebBug = 'ip-log.csv';
$S ="\r\n";
$visitor = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$port = $_SERVER['REMOTE_PORT'];


if (!file_exists($outputWebBug)) {
    touch($outputWebBug);
}

  @ $details = json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}/json"));
  @ $hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
  
  // Get the query string from the URL.
  $QUERY_STRING = preg_replace("%[^/a-zA-Z0-9@,_=]%", '', $_SERVER['QUERY_STRING']);
  
  // Write the ip address and info to file.
  @ $fileHandle = fopen($outputWebBug, "a");
  if ($fileHandle)
  {
    $string ='"'.$_SERVER['REMOTE_ADDR'].'","'
      .$hostname.'","'
      .$_SERVER['HTTP_USER_AGENT'].'","'
      .$_SERVER['HTTP_REFERER'].'","'
      .$details->loc.'","'
      .$details->org.'","'
      .$details->city.'","'
      .$details->region.'","'
      .$details->country.'","'
      .date("D dS M-Y h:i a").'"'
      ."\n"
      ;
     $write = fputs($fileHandle, $string);
    @ fclose($fileHandle);
  }

  $string = '<b>'
    .'<p>'.$QUERY_STRING.'</p><p>IP address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .$_SERVER['REMOTE_ADDR'].'</p><p>Hostname:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .$hostname.'</p><p>Browser and OS:&nbsp;'
    .$_SERVER['HTTP_USER_AGENT'].'</p><p>'
    .$_SERVER['HTTP_REFERER'].'</p><p>Coordinates:&nbsp;&nbsp;&nbsp;&nbsp;'
    .$details->loc.'</p><p>ISP provider:&nbsp;&nbsp;&nbsp;'
    .$details->org.'</p><p>City:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .$details->city.'</p><p>State:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .$details->region.'</p><p>Country:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .$details->country.'</p><p>Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
    .date("D dS M-Y h:i a").'</p></b>'
    ;
    
// Guess User OS Based On Browser Request
function getOS() { 
    global $browser;
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $browser))
            $os_platform = $value;
    return $os_platform;
}
$user_os = getOS();
 
// Message you want to display after the post
echo '<pre style="font-size: 12px; text-align: center;"> IP Address: '.$visitor.' | Operating System: '.$user_os.' | User Port: '.$port.' <br> Browser: '.$browser.'</pre>';
?>
