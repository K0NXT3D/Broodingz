<?php
/* PROBLEM:
# Unable to pass variable as string using Curl.
# URL and Header have no problem. I have tried 
# reassembling the code to run in countless ways at this point.
*/

// Local Path: $targeturl = "../remote/index.php";
// Remote Path:
$targeturl = "http://path/to/remote/index.php";
$ua = "Brozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00";
$referer = "http://www.mysuperawesomewebsite.com";

function CurlIt($url)
{
  $curl = curl_init();

  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: ";

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, "Slowzilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, "http://www.myawesomewebsite.com");
  curl_setopt($curl, CURLOPT_ENCODING, "gzip,deflate");
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);

  $html = curl_exec($curl);
  echo 'Request Has Been Sent.';
  curl_close($curl);

  return $html;
}

CurlIt($targeturl);
?>
<!-- Path To Local File -->
<p><input type="button" onclick="location.href='../remote/results.php#lastvisit';" value="View Results (As Local File)" /></p>

<!-- Path To Remote File -->
<p><input type="button" onclick="location.href='http://path/to/remote/results.php#lastvisit';" value="View Results (As Remote File)" /></p>
