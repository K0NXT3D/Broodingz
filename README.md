# broodingz
<h2><em>Sometimes it only works "So Well"..</em></h2>
<p>Adding a few projects that I'm not really satisfied with and it's probably something simple that I'm missing.</p>
<h2>Curl using a random User Agent String from a file</h2>
<p>I have a few more ideas, but I'm pretty much stumped as to why curl will handle some variables and not others.<br>
I'm going to try the while IFS= read -r (file) next, but I'm not sure if that's going to solve anything.<br>
All the files are included as well as a zip. You can run them locally as long as they're in seperate folders,<br>
or run the local files locally and the remote on your server. The tracking works well, but for whatever reason,<br>
that string issue.
  <p>The Variable Configuration:</p>
<code>
  $ua = "Brozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00";
  $referer = "http://www.mysuperawesomewebsite.com";
</code>  
<p></p>
  <p>This is where the shit hits the fan when USERAGENT and/or REFERER are $variables.</p>
<code>
  curl_setopt($curl, CURLOPT_USERAGENT, "Slowzilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, "http://www.myawesomewebsite.com");
 </code>
