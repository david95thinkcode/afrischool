<?php
 namespace App\Traits;

 trait TraitSms{

    protected function sendSms($mobile, $message)
    {
        $messageF =  $this->removeAccent($message);
        $user = env('OCEANIC_USER');
        $password = env('OCEANIC_PASSWORD');
        $text2 = urlencode($messageF);
        $url2 = "http://oceanicsms.com/api/http/sendmsg.php?user=$user&password=$password&from=Vroomiste&to=$mobile&text=$text2&api=14265";
        
        $this->CallUrl($url2);
    }
    
    protected function senderParent($ecole, $numero, $message)
    {
        $societe = $this->removeAccent($ecole);
        $societe1 = urlencode($societe);
        $messageF =  $this->removeAccent($message);
        $user = env('OCEANIC_USER');
        $password = env('OCEANIC_PASSWORD');
        $text2 = urlencode($messageF);
        $url2 = "http://oceanicsms.com/api/http/sendmsg.php?user=$user&password=$password&from=$societe1&to=$numero&text=$text2&api=14265";
        
        $this->CallUrl($url2);
    }

    function removeAccent($str)
    {
        if (($length=mb_strlen($str, "UTF-8"))<strlen($str)) {
            $i=$count=0;
            while ($i<$length) {
                if (strlen($c = mb_substr($str, $i, 1, "UTF-8"))>1) {
                    $he=htmlentities($c);
                    if (($nC=preg_replace("#&([A-Za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#", "\\1", $he))!=$he ||
                        ($nC=preg_replace("#&([A-Za-z]{2})(?:lig);#", "\\1", $he))!=$he ||
                        ($nC=preg_replace("#&[^;]+;#", "", $he))!=$he) {
                        $str=str_replace($c, $nC, $str, $count);
                        if ($nC=="") {
                            $length=$length-$count;
                            $i--;
                        }
                    }
                }
                $i++;
            }
        }
        return $str;
    }
  
    function CallUrl($url){
      return file_get_contents($url);
    }
 }
