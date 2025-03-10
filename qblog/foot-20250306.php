<?php if(!defined('WMBLOG'))exit; ?><div id="footer" alt="（linji.cn）域名注册时间：2004-04-02 14:50:54" title="（linji.cn）域名注册时间：2004-04-02 14:50:54"><p><i class="far fa-copyright"></i> 2004–<?php echo date('Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;博主稳定运行<span id="divClock" style="color: red;"></span>
<!--计时功能代码-->
    <script language="javascript">
        // 判断是否为闰年的函数
        function isLeapYear(year) {
            return (year % 4 === 0 && year % 100!== 0) || year % 400 === 0;
        }

        // 计算两个日期之间时间差，并精确计算月份差的函数
        function calculateTimeDifference(startDate, endDate) {
            const diffInMilliseconds = endDate - startDate;

            // 先计算完整的年份差
            const years = Math.floor(diffInMilliseconds / (1000 * 60 * 60 * 24 * 365));
            // 扣除已计算的年份对应的毫秒数，得到剩余毫秒数用于后续计算
            let remainingMilliseconds = diffInMilliseconds % (1000 * 60 * 60 * 24 * 365);

            // 计算月份差，通过逐月递减剩余毫秒数并统计月份
            let months = 0;
            const monthsInYear = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            const startYear = startDate.getFullYear();
            for (let i = 0; i < 12; i++) {
                const daysInMonth = i === 1 && isLeapYear(startYear + years)? 29 : monthsInYear[i];
                const millisecondsInMonth = 1000 * 60 * 60 * 24 * daysInMonth;
                if (remainingMilliseconds >= millisecondsInMonth) {
                    months++;
                    remainingMilliseconds -= millisecondsInMonth;
                } else {
                    break;
                }
            }

            // 计算天数差
            const days = Math.floor(remainingMilliseconds / (1000 * 60 * 60 * 24));
            remainingMilliseconds %= (1000 * 60 * 60 * 24);

            // 计算小时差
            const hours = Math.floor(remainingMilliseconds / (1000 * 60 * 60));
            remainingMilliseconds %= (1000 * 60 * 60);

            // 计算分钟差
            const minutes = Math.floor(remainingMilliseconds / (1000 * 60));
            remainingMilliseconds %= (1000 * 60);

            // 计算秒数差
            const seconds = Math.floor(remainingMilliseconds / 1000);

            return {
                years,
                months,
                days,
                hours,
                minutes,
                seconds
            };
        }

        function updateClock1(elementId, startDateStr) {
            const startDate = new Date(startDateStr);
            startDate.setTime(startDate.getTime() + 8 * 60 * 60 * 1000); // 转换为北京时间

            function updateTimeDisplayF() {
                const endDate = new Date();
                endDate.setTime(endDate.getTime() + 8 * 60 * 60 * 1000); // 转换为北京时间

                const { years, months, days, hours, minutes, seconds } = calculateTimeDifference(startDate, endDate);

                document.getElementById(elementId).innerHTML = `${years} 年 ${months} 月 ${days} 天 ${hours} 时 ${minutes} 分 ${seconds} 秒`;
            }

            // 每隔1秒更新一次时间差显示
            setInterval(updateTimeDisplayF, 1000);
        }
        updateClock1("divClock", "1977-10-26T00:00:00");
    </script>
<!--计时功能代码-->
&nbsp;|&nbsp;&nbsp;<a href="https://beian.miit.gov.cn/" rel="nofollow" target="_blank" style="color: #000;"><?php echo $set['icp'];?></a>
</div>
<script type="text/javascript" async language="javascript" src="/assets/js/layer.js"></script>
<script type="text/javascript" async language="javascript" src="/assets/js/ajax.js"></script>
<?php if(ADMIN) echo '<script type="text/javascript" async language="javascript" src="/assets/js/admin.js"></script>';?>

<!--手机端底部导航开始-->
<div class="layout-footer">
    <div class="bottom_nav">
          <a href="/index.html"><i class="fa fa-book" style="font-size: 20px;font-style: oblique;"></i><div style="font-size:14px;text-decoration:none;">老林笔记</div></a> 
    </div>
<div class="bottom_nav">
	<span style="cursor: pointer;" onclick="openSubmenu()">
		<i class="fa fa-bars" style="font-size: 22px;"></i>
		<div style="font-size:14px;text-decoration:none;">文章分类</div>
	</span>
	<div class="dialog-Submenu-plane">
		<div class="dialog-Submenu-mask" onclick="closeSubmenu()"></div>
		<div class="layout-submenu">
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b3/list-3.html">小学教育</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b4/list-4.html">小学校历</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b5/list-5.html">毕业记忆</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b6/list-6.html">相关通知</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b7/list-7.html">信息科技</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b0/list-0.html">生活随笔</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/b8/list-8.html">闲说人生</a>
			</div>
            <div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="https://linji.cn/i.php">人在旅途</a>
			</div>
            <div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="https://m.wdlu.cn">仿朋友圈</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/archives.html">文章归档</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="https://linji.cn/file/">老林网盘</a>
			</div>
			</div>
	</div>
</div>
    <div class="bottom_nav">
        <a href="/b2/list-2.html"><i class="fa fa-laptop" style="font-size:20px;"></i><div style="font-size:14px;text-decoration:none;">继续教育</div></a>
    </div>
    <div class="bottom_nav">
       <a href="/b1/list-1.html"><i class="fa fa-trophy" style="font-size:20px;"></i><div style="font-size:14px;text-decoration:none;">荣誉证书</div></a>
</div>
    <div class="bottom_nav">
       <a href="https://p.linji.cn"><i class="fa fa-link" style="font-size:20px;"></i><div style="font-size:14px;text-decoration:none;">老林导航</div></a>
</div>
</div>
<!--手机端底部导航结束-->
<!-- 给博客顶部加一个浏览进度条，表示浏览当面页面的进度 -->
<script language="javascript">
	document.addEventListener('DOMContentLoaded', function () {
      var winHeight = window.innerHeight,
            docHeight = document.documentElement.scrollHeight,
            progressBar = document.querySelector('#content_progress');
      progressBar.max = docHeight - winHeight;
      progressBar.value = window.scrollY;

      document.addEventListener('scroll', function () {
            progressBar.max = document.documentElement.scrollHeight - window.innerHeight;
            progressBar.value = window.scrollY;
            // 显示进度条
            if (window.scrollY > 0) {
                progressBar.style.display = 'block';
            } else {
                progressBar.style.display = 'none';
            }
      });
});
</script>

<progress id="content_progress" value="0" style="display: none;"></progress>
<!-- 给博客顶部加一个浏览进度条，表示浏览当面页面的进度 -->