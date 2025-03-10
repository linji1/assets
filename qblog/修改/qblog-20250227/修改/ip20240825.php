<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

define('QQWRY' ,  'app/ip/qqwry.dat' ) ;

function IpToInt($Ip) {
    $array=explode('.',$Ip);
    $Int=($array[0] * 256*256*256) + ($array[1]*256*256) + ($array[2]*256) + $array[3];
    return $Int;
}

function IntToIp($Int) {
    $b1=($Int & 0xff000000)>>24;
    if ($b1<0) $b1+=0x100;
    $b2=($Int & 0x00ff0000)>>16;
    if ($b2<0) $b2+=0x100;
    $b3=($Int & 0x0000ff00)>>8;
    if ($b3<0) $b3+=0x100;
    $b4= $Int & 0x000000ff;
    if ($b4<0) $b4+=0x100;
    $Ip=$b1.'.'.$b2.'.'.$b3.'.'.$b4;
    return $Ip;
}

class TQQwry
{
    var $StartIP = 0;
    var $EndIP   = 0;
    var $Country = '';
    var $Local   = '';
    var $CountryFlag = 0; // 标识 Country位置
                          // 0x01,随后3字节为Country偏移,没有Local
                          // 0x02,随后3字节为Country偏移，接着是Local
                          // 其他,Country,Local,Local有类似的压缩。可能多重引用。
    var $fp;
    var $FirstStartIp = 0;
    var $LastStartIp = 0;
    var $EndIpOff = 0 ;

    function getStartIp ( $RecNo ) {
        $offset = $this->FirstStartIp + $RecNo * 7 ;
        @fseek ( $this->fp , $offset , SEEK_SET ) ;
        $buf = fread ( $this->fp , 7 ) ;
        $this->EndIpOff = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])* 256*256);
        $this->StartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        return $this->StartIp ;
    }

    function getEndIp ( ) {
        @fseek ( $this->fp , $this->EndIpOff , SEEK_SET ) ;
        $buf = fread ( $this->fp , 5 ) ;
        $this->EndIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        $this->CountryFlag = ord ( $buf[4] ) ;
        return $this->EndIp ;
    }

    function getCountry ( ) {
        switch ( $this->CountryFlag ) {
            case 1:
            case 2:
                $this->Country = $this->getFlagStr ( $this->EndIpOff+4) ;
                //echo sprintf('EndIpOffset=(%x)',$this->EndIpOff );
                $this->Local = ( 1 == $this->CountryFlag )? '' : $this->getFlagStr ( $this->EndIpOff+8);
                break ;
            default :
                $this->Country = $this->getFlagStr ($this->EndIpOff+4) ;
                $this->Local =   $this->getFlagStr ( ftell ( $this->fp )) ;
        }
    }

    function getFlagStr ( $offset )
    {
        $flag = 0 ;
        while ( 1 ){
            @fseek ( $this->fp , $offset , SEEK_SET ) ;
            $flag = ord ( fgetc ( $this->fp ) ) ;
            if ( $flag == 1 || $flag == 2 ) {
                $buf = fread ($this->fp , 3 ) ;
                if ($flag == 2 ){
                    $this->CountryFlag = 2 ;
                    $this->EndIpOff = $offset - 4 ;
                }
                $offset = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])* 256*256);
            }else{
                break ;
            }
        }
        if ( $offset < 12 )
            return '';
        @fseek($this->fp , $offset , SEEK_SET ) ;
        return $this->getStr();
    }

    function getStr ( )
    {
        $str = '' ;
        while ( 1 ) {
            $c = fgetc ( $this->fp ) ;
            if ( ord ( $c[0] ) == 0  )
               break ;
            $str .= $c ;
        }
        return $str ;
    }

    function qqwry ($dotip) {
        $nRet;
        $ip = IpToInt ( $dotip );
        $this->fp= @fopen(QQWRY, "rb");
        if ($this->fp == NULL) {
              $szLocal= "OpenFileError";
            return 1;
          }
          @fseek ( $this->fp , 0 , SEEK_SET ) ;
        $buf = fread ( $this->fp , 8 ) ;
        $this->FirstStartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        $this->LastStartIp  = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])*256*256) + (ord($buf[7])*256*256*256);
        $RecordCount= floor( ( $this->LastStartIp - $this->FirstStartIp ) / 7);
        if ($RecordCount <= 1){
            $this->Country = "FileDataError";
            fclose ( $this->fp ) ;
            return 2 ;
        }
          $RangB= 0;
        $RangE= $RecordCount;
        // Match ...
        while ($RangB < $RangE-1)
        {
          $RecNo= floor(($RangB + $RangE) / 2);
          $this->getStartIp ( $RecNo ) ;
            if ( $ip == $this->StartIp )
            {
                $RangB = $RecNo ;
                break ;
            }
          if ( $ip > $this->StartIp)
            $RangB= $RecNo;
          else
            $RangE= $RecNo;
        }
        $this->getStartIp ( $RangB ) ;
        $this->getEndIp ( ) ;
        if ( ( $this->StartIp  <= $ip ) && ( $this->EndIp >= $ip ) ){
            $nRet = 0 ;
            $this->getCountry ( ) ;
            $this->Local = str_replace("", "", $this->Local);
        }else {
            $nRet = 3 ;
            $this->Country = '未知' ;
            $this->Local = '' ;
        }
        fclose ( $this->fp ) ;
        return $nRet ;
    }
}

function GetRealClientIP()
{
        if( getenv("HTTP_CLIENT_IP") ) 
        {
                $ip_real                = getenv("HTTP_CLIENT_IP") ;
        } 
        else if( getenv("HTTP_X_FORWARDED_FOR") ) 
        {
                $ip_real                = getenv("HTTP_X_FORWARDED_FOR") ;
        } 
        else
        {
                $ip_real                = getenv("REMOTE_ADDR") ;
        }
        return $ip_real ;
}

function ip2location ( $ip )
{
    $wry = new TQQwry ;
    $nRet = $wry->qqwry ( $ip );
  return $wry->Country.$wry->Local ;
}
//$ip = $getip;
?>
<script>
    function copyip_addr() {
            var Url2=document.getElementById("ip_addr").innerText;
            var oInput = document.createElement('input');
            oInput.value = Url2;
            document.body.appendChild(oInput);
            oInput.select(); // 选择对象
            document.execCommand("copy");  // 执行浏览器复制命令
            oInput.style.display='none';
            alert('复制成功');
}
    function copyip_pos() {
            var Url2=document.getElementById("ip_pos").innerText;
            var oInput = document.createElement('input');
            oInput.value = Url2;
            document.body.appendChild(oInput);
            oInput.select(); // 选择对象
            document.execCommand("copy");  // 执行浏览器复制命令
            oInput.style.display='none';
            alert('复制成功');
}
</script>

<?php
$ip_addr = "";
if ( IsSet($_REQUEST['ip']) )
{
        $ip_addr = $_REQUEST['ip'];
}
else
{
        $ip_addr = GetRealClientIP();
}
if ( preg_match("/[a-zA-Z\-_]+/si", $ip_addr) )
{
        $ip_addr = gethostbyname($ip_addr);
}
//echo str_replace("CZ88.NET","",ip2location($ip_addr));
$yoip=$_SERVER["REMOTE_ADDR"];
?>
<font color="#000">IP：</font><a href="/ip.html" target="_blank"><font color="#000"><?php echo $ip_addr; ?></font>
<font color="#000">  来自：</font>
<font color="#000">
<?php
   $str = str_replace("CZ88.NET","",ip2location($ip_addr));
   echo mb_convert_encoding($str, "UTF-8", "GB2312");
?>
</font></a>