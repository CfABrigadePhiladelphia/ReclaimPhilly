<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!-- Comment encoding="UTF-8" -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
samp {
  white-space: pre;
}
</style>
<script type="text/javascript">
<?php
$addrField = "";
if (isset($_REQUEST["addr"])) {
  $addrField = $_REQUEST["addr"];
}
$addrCoord = NULL;
$googleReq = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&address=";
/*
 * Set up google maps api in Curl.
 */
class mapXml
{
  public $responseString = "";
  public $responseLength = 0;
  public $accumulatedString = "";
  public $accumulatedLength = 0;

  public function curlFetch($curlHandle, $xmlData)
  {
    $this->responseString = $xmlData;
    $this->responseLength = strlen($xmlData);
    $this->accumulatedString .= $xmlData;
    $this->accumulatedLength += $this->responseLength;
  }
}
$aMap = new mapXml();

if ($addrField) {
  $addrWords = explode(" ", $addrField);
  $addrStr = implode("+", $addrWords);
  $ch = curl_init($googleReq . $addrStr);
  if ($ch) {
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($aMap, "curlFetch"));

    curl_exec($ch);
    curl_close($ch);
  }
}
?>
</script>
</head>
<body>
<p>
<?php
echo $addrField . " " . $googleReq;
?>
</p>
<form method="get" action="/~robinschaufler">
  <fieldset>
    <input type="text" name="addr" value="<?php echo $addrField; ?>"/>
    <input type="submit" name="send" value="send" />
  </fieldset>
</form>
<p>
  <samp>
aMap -> accumulatedString...
<?php echo $aMap->accumulatedString; ?>
  </samp>
</p>
</body>
</html>
