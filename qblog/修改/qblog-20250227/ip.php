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
if ( preg_match("/[a–zA–Z\–_]+/si", $ip_addr) )
{
        $ip_addr = gethostbyname($ip_addr);
}
$ip_addr = gethostbyname($ip_addr);

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

require_once "app/ip/czdb.phar";


use Czdb\DbSearcher;

$dbSearcher = new DbSearcher("app/ip/cz88_public_v4.czdb", "BTREE", "3UTj/zYQygn1nVSUZkYbCw==");

$region = $dbSearcher->search($ip_addr);

$dbSearcher->close();
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
<font color="#000">IP：</font><a href="/ip.html" target="_blank"><font color="#000"><?php echo $ip_addr; ?></font>
<font color="#000">  来自：</font>
<font color="#000">
<?php echo $region; ?>
</font></a>