<?php if(!defined('WMBLOG'))exit;?><!DOCTYPE HTML>
<html>
<head>
<!--                                                                                                                                                      
<script data-fixed="true">
	!function(){
		var protocol = window.location.protocol;
		if (protocol == "https:") {
			window.location.href = window.location.href.replace("https","http");
		}
	}();
</script>                                                                                                                                                      
                                                                                                                   7WW2                               
                                                                                                                  8MMMMM                              
                                               :MMX                                             MM7               0M.MMMM                             
                              ;B.              aMMMM@;                                          MMMMM:            iM @MMM7                            
                              ,MMB.              rMMMMM                                        ZMMMMMM2            M.WMMMr                            
                               WMMM@              @MMMM                                       MMMMMMMMMi           iS0MMM2ZM0i                        
                               MMMMMM             MMMMM                                     SMMMMMMMMMMi             @MMM, MMMM7                      
                              ,MMMMMM             MMMMM                                   XMMMMMMMMM0.             7@MMMM  MMMMM,                     
                              ,MMMMM              MMMM0    ..                           7MMMMMMM0;          i,    @MMMMM0 XMMMMMr                     
                              :MMMMM2             MMMMMMMMMMMM                       ;BMMMMMMMMB            MMMi8MMZrMMMX MMMMMX                      
                             .WMMMMMMM,           MMMMMMMMMMMM2                     ZMMMMMMMMMMMM8         .MMMMMMM rMMMMMMMMX                        
                          .SMMMMMMMMMMZ         i8MMMMMMMMM@Z.                      MMMMMMMMMMMMMMM        MMMMMMM, @MMMMMMM:                         
                       .aMMMMMMMMMMMai       i8MMMMMMMMMS.                          MMMMMMMMMMMMMMM@       2MMMMMi  MMMMMM;                           
                     2@MMMMMMMMMMMM       :8MMMMMMMMMM,                             7MM@7 BMMMMMMMM: MMMa   MMMMr   MMMM8.ZaWMM0:                     
            ,2:  iZMMMMMMMMMMMMMMMZ    ,0MMMMMMMMMMMMM                                    MMMMMMMM.  8MMM8   Ba    MMMMMBZMMMMMMMX                    
            :MMMMMMMMMMMMMMMWXMMMM0  XMMMMMMMMMMMMMMMW                                  7MMMMMMMZ   a MMMMa      aMMMMMMMMMMMMMBr                     
              ;MMMMMMMMMMMB,  MMMMM8MMMZ.    SMMMWMMM8                                aMMMMMMM@    SM SMMMB    XMMMMMMMMMMZ                           
                ,BMMMMMMZ    XMMMMMMMZ       MMMM ZMMMa                               MMMMMMMMMi   MS SMMM;  ZMMMMMMMMMMMMM                           
                   0MMS     :MMMMMMM.       WMMM  ZMMMMMM7                           ,MMMMMMMMMMM BM  XMMMBWMMMMMMMMMMMMMMi                           
                           SMMMMMMr        BMMM:  2MMMMMMMMB7                         MMMMMMMMMMMMM8  8MMMMMMMMMM@MMMMMMMi                            
                          @MMMMMM         0MMM    aMMM.aMMMMMM8;                      0MMMZrMMMMMMM   @MMMMMMMM8 ,MMMMMMM@MMW2                        
                       ,ZMMMMMMMS        BMMM:    BMMZ   XMMMMMMMMa.                   ,:   MMMMMMZ   MMM@      XMMMMMMMMMMMMMMMi                     
                     8MMMMMMMMMM7      .MMMMi     WMM@     rMMMMMMMMMZ,                    iMMMMMM    MMMW    SMMMMMMMMMMMMMMMMMr                     
                     aMMMMMMMMMMi   rSMMMMB       MMMM       BMMMMMMMMMMM7                 MMMMMMZ   ,MMM@   @MMMMMMMMMS ,;;Xr:.                      
                      MMMMMM7WMM:   MMMMX         MMMM         XMMMMMMMMZr                rMMMMMM    :MMMM  iMMMMM,;MMMa                              
                      BMMMMr MMM:                iMMMM                                    MMMMMMZ    :MMMS   0MM7   MMM7                              
                       MMM.  MMMa                @MMMM                                   MMMMMMM      MMM0           MM  7a0000B2r                    
                             MMM8                MMMMM.                                 MMMMMMM,      7MMMM2;;rX2Z0W@MMMMMMMMMMMMMMM;                 
                             MMMW               7MMMMM                                  MMMMMM@        MMMMMMMMMMMMMMMMMMMMMMMMMMMMM0                 
                             :MMM                MMMMM                                  MMMMMM.         rMMMMMMMMMM@ZSriii;i;;77X7;                   
                               MM                .MMMZ                                   MMMMX            .WMMMXi,                                    
                               .W                  MM                                     ;i                                                          
                                                                                                                                                      
                                                                                                                                                      

-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo $tit.'&nbsp;|&nbsp;'.$webtitle;?></title>
<meta name="keywords" content="<?php echo $key;?>" />
<meta name="description" content="<?php echo $des;?>" />
<link href="/assets/<?php echo TEMPLATE;?>/style.css?v=4.0" rel="stylesheet" type="text/css" />
<?php if($tpl=='post.php'){?>
<link href="/assets/js/wangeditor/css/wangEditor.min.css" rel="stylesheet" type="text/css" />
<?php }?>
<link href="/assets/js/highlightjs/dark.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="/assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="/assets/<?php echo TEMPLATE;?>/fontawesome.min.css">
<link rel="icon" href="/icon_32.png" type="image/x-icon">
<link rel="stylesheet" id="fancybox-css"  href="/assets/js/fancybox/jquery.fancybox.min.css" type="text/css" media="all" />
<script type='text/javascript' src="/assets/js/fancybox/jquery.fancybox.min.js"></script>
<script src="/assets/js/readmore.js" type="text/javascript"></script>
<!-- fancyBox 3 -->
<script type="text/javascript">
jQuery(function(){

	var images = jQuery('a').filter( function() { return /\.(jpe?g|png|gif|bmp|webp)$/i.test(jQuery(this).attr('href')) });

		images.each(function(){
			var title = jQuery(this).children("img").attr("title");
			var caption = jQuery(this).children("img").attr("alt");
			jQuery(this).attr("data-fancybox", "gallery").attr("title",title).attr('data-caption',caption);
		});
	
	

	jQuery("[data-fancybox]").fancybox({
		'loop': false,
		'margin': [44, 0],
		'gutter': 50,
		'keyboard': true,
		'arrows': true,
		'infobar': false,
		'toolbar': true,
		'buttons': ["zoom", "slideShow", "fullScreen", "download","thumbs", "close"],
		'idleTime': 4,
		'protect': false,
		'modal': false,
		'animationEffect': "zoom",
		'animationDuration': 350,
		'transitionEffect': "fade",
		'transitionDuration': 350,
					});

});

</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a2918bbf217245e4804526a57c412e0e";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script>
<script>LA.init({id: "1zD94Tfv4pSHRu8p",ck: "1zD94Tfv4pSHRu8p"})</script>
<script src="https://sdk.51.la/perf/js-sdk-perf.min.js" crossorigin="anonymous"></script>
<script>
  new LingQue.Monitor().init({id:"1zD9HeO5MGUlWhyx"});
</script>
</head>
<body>
<div id="header"> 
<a id="menu_toggle" href="#"><i class="fa fa-search" style="color: #fff;font-size: 20px;position: absolute;right: 60px;top: 16px;z-index: 9999;"></i></a>
<?php if(ADMIN) {echo '<a id="menu_toggle" href="/index.php?act=logout"><i style="color: #fff;font-size: 20px;position: absolute;right: 20px;top: 16px;z-index: 9999;" class="fa fa-user"></i></a>';} else {echo '<a id="menu_toggle" href="/index.php?act=login&l="><i style="color: #fff;font-size: 20px;position: absolute;right: 20px;top: 16px;z-index: 9999;" class="fa fa-user"></i></a>';}?>
<div class="navbar-wrap">
  <div class="box-m">
    <div class="logo">
      <h2 id="title"><?php echo $webtitle;?></h2>   
    </div>	   
      <ul id="nav" class="collapse"> 
		<?php webmenu();?>
      </ul>   
      </div>
</div>
<div class="other-wrap collapse">
	  <div class="other box-m">
	   <div class="desc"><?php echo $motto;?></div>
	   <form method="get" class="search-form" action="<?php echo $file;?>"> <input class="search-text" name="s" autocomplete="on" placeholder="输入关键词搜索..." required="required" type="text" value="<?php echo $s;?>"> <button class="search-submit" alt="搜索" type="submit">搜索</button></form>
	   </div>   
</div>
</div>
<div id="wrap"> 