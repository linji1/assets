<?php if(!defined('WMBLOG'))exit;?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="x-dns-prefetch-control" content="on">
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
<!--IE 8浏览器的页面渲染方式-->
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<!--默认使用极速内核：针对国内浏览器产商-->
<meta name="renderer" content="webkit">
<title><?php echo $tit.'&nbsp;|&nbsp;'.$webtitle;?></title>
<meta name="keywords" content="<?php echo $key;?>" />
<meta name="description" content="<?php echo $des;?>" />
<link href="/assets/<?php echo TEMPLATE;?>/style.css" rel="stylesheet" type="text/css" />
<?php if($tpl=='post.php'){?>
<link href="/assets/js/wangeditor/css/wangEditor.min.css" rel="stylesheet" type="text/css" />
<?php }?>
<link href="/assets/js/highlightjs/dark.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="/assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="/assets/<?php echo TEMPLATE;?>/fontawesome.min.css">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script src="/assets/js/readmore.js" type="text/javascript"></script>
<!-- fancyBox 5 -->
<link rel="stylesheet" href="/assets/js/fancybox/fancybox.min.css" media="all" onload="this.media='all'" />
<script src="/assets/js/fancybox/fancybox.umd.min.js"></script>
<script>
$(document).ready(function() {
      Fancybox.bind('[data-fancybox]', {
          Hash: false,
          Thumbs: {
            type: "classic",
          showOnStart: false,
          },
          Images: {
            Panzoom: {
              maxScale: 4
            }
          },
          Carousel: {
            transition: 'slide'
          },
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: [
              "zoomIn",
              "zoomOut",
              "toggle1to1",
              "rotateCCW",
              "rotateCW",
              "flipX",
              "flipY",
            ],
            right: ["slideshow", "fullscreen", "download", "thumbs", "close"],

          },
        },
      });
});
</script>
<style type="text/css">
@media screen and (max-width: 950px) {
  .fancybox__toolbar__column.is-middle {
    display: none;
  }
}
  </style>
<!-- fancyBox 5 -->

</head>
<body>
<script>
    function openMenu() {
        $('body').css('overflow', 'hidden');
        $(".drawer-menu-plane").addClass("drawer-menu-plane-show");
        $(".menu-plane").appendTo($(".drawer-menu-list"));
        $(".user-menu-plane").appendTo($(".drawer-menu-list"));
        //$(".menu-item-has-children").append('<div class="m-dropdown" onclick="mobile_menuclick(event,this)" ><i class="fa fa-angle-down"></i></div>')
        $(".user-menu-main").not('.user-menu-main-notlogin').append('<div class="m-dropdown" onclick="mobile_menuclick(event,this)"><i class="fal fa-angle-down"></i></div>')
    }
    function closeMenu() {
        $('body').css('overflow', 'auto');
        $(".drawer-menu-plane").removeClass("drawer-menu-plane-show");
        $(".user-menu-plane").prependTo($(".header-menu"));
        $(".menu-plane").prependTo($(".header-menu"));
        $(".m-dropdown").remove();
    }

    function openSubmenu() {
        $(".dialog-Submenu-plane").addClass("dialog-Submenu-plane-show");
    }

    function closeSubmenu() {
        $(".dialog-Submenu-plane").removeClass("dialog-Submenu-plane-show");
    }

    function openDropdown() {
        $(".dialog-Dropdown-plane").addClass("dialog-Dropdown-plane-show");
    }

    function closeDropdown() {
        $(".dialog-Dropdown-plane").removeClass("dialog-Dropdown-plane-show");
    }

    function openSearch() {
        $(".dialog-search-plane").addClass("dialog-search-plane-show");
    }

    function closeSearch() {
        $(".dialog-search-plane").removeClass("dialog-search-plane-show");
    }
	function openLogin1() {
        $(".dialog-Login-plane1").addClass("dialog-Login-plane-show1");
    }

    function closeLogin1() {
        $(".dialog-Login-plane1").removeClass("dialog-Login-plane-show1");
    }
</script>
<!-- 登录框开始 -->
<div class="dialog-Login-plane1">
    <div class="dialog-mask1" onclick="closeLogin1()"></div>
    <div class="dialog-plane1">
        <h2>管理员登陆</h2>
        <form class="search-form1" action="/index.php?act=dologin" method="post">
            <div class="search-form-input-plane1">
                <input type="password" class="search-keyword1" name="pass" autocomplete="on" placeholder="输入密码..." required="required" value="">
	   <input name="l" value="" type="hidden">
            </div>
            <div>
                <button type="submit" class="search-submit1" alt="登 陆 " value="">登陆</button>
            </div>

        </form>
    </div>
</div>
<!-- 登录框结束 -->
<div id="header">
<?php if($tit!=='首页')echo '<div class="cback"><a href="JavaScript:history.back();" title=""><i class="fa" style="color: #888;font-size: 20px;position: absolute;left: 20px;top: 16px;z-index: 9999;font-weight: 600;cursor: pointer;">&#xf053</i></a></div>';?>
<div id="menu_toggle1" onclick="openSearch()"><i class="fa fa-search" style="color: #888;font-size: 20px;position: absolute;right: 60px;top: 16px;z-index: 9999;font-weight: 600;cursor: pointer;"></i></div>
<!-- 搜索框开始 -->
<div class="dialog-search-plane">
    <div class="dialog-mask" onclick="closeSearch()"></div>
    <div class="dialog-plane">
        <h2>搜索内容</h2>
        <form class="search-form" action="/index.php" method="get" role="search">
            <div class="search-form-input-plane">
                <input type="text" class="search-keyword" name="s" autocomplete="on" placeholder="搜索内容" required="required" value="">
            </div>

            <div>
                <button type="submit" class="search-submit" value="">搜索</button>
            </div>

        </form>
    </div>
</div>
<!-- 搜索框结束 -->
<?php if(ADMIN) {echo '<div class="dropdown">
<span class="dropbtn" onclick="openDropdown()"><i style="color: #888;font-size: 20px;position: absolute;right: 20px;top: 16px;z-index: 9999;height: 50px;font-weight: 300;cursor: pointer;" class="fa fa-user"></i></span>
<div class="dialog-Dropdown-plane">
    <div class="dialog-Dropdown-mask" onclick="closeDropdown()"></div>
  <div class="dropdown-content">
    <a href="/index.php?act=add"><i style="font-size: 20px;padding-right: 5px;" class="fa fa-edit"></i> 发布文章</a>
    <a href="/comment.html"><i style="font-size: 20px;padding-right: 5px;" class="fa fa-comment"></i> 文章评论</a>
   <a href="/b0/561.html"><i style="font-size:20px;padding-right: 5px;" class="fa">&#xf073</i> 个人信息</a>
    <a href="https://jz.linji.cn"><i style="font-size:20px;padding-right: 5px;" class="fa">&#xf157</i> 资金明细</a>
    <a href="/index.php?act=set"><i style="font-size: 20px;padding-right: 5px;" class="fa fa-cog"></i> 全局设置</a>
    <a href="/index.php?act=wid"><i style="font-size: 20px;padding-right: 5px;" class="fa fa-wrench"></i> 边栏设置</a>
    <a href="/index.php?act=logout"><i style="font-size: 20px;padding-right: 5px;" class="fa fa-power-off"></i> 退出登录</a>
</div>
</div>
</div>';} else {echo '<div id="menu_toggle1" onclick="openLogin1()"><i style="color: #888;font-size: 20px;position: absolute;right: 20px;top: 16px;z-index: 9999;height: 50px;font-weight: 300;cursor: pointer;" class="fa fa-user"></i></div>';}?>
<div class="navbar-wrap">
  <div class="box-m">
    <div class="logo">
      <h2 id="title"><a href="/"><?php echo $webtitle;?></a></h2>   
    </div>	   
      <ul id="nav" class="collapse"> 
		<?php webmenu();?>
      </ul>   
      </div>
</div>
<div class="other-wrap collapse">
	  <div class="other box-m">
	   <div class="desc"><?php echo $motto;?></div>
	   <form method="get" class="search-form" action="/<?php echo $file;?>"> <input class="search-text" name="s" autocomplete="on" placeholder="输入关键词搜索..." required="required" type="text" value="<?php echo $s;?>"> <button class="search-submit" alt="搜索" type="submit">搜索</button></form>
	   </div>   
</div>
</div>
<div id="wrap"> 