<?php if(!defined('WMBLOG'))exit; ?>
<?php include "head.php";?> 
 	<style>
        /* 设置 .year-header 的鼠标图标为手掌形状 */
        .year-header {
            cursor: grab;
        }
        .month-list {
            cursor: grab;
        }
		#archives h2 {
    border-bottom: 1px solid #eee;
    padding-bottom: 13px;
    padding-top: 13px;
    padding-left: 20px;
        }
		</style>
<div id="content" style="position: relative;">
<div id="main" style="background:#fff;padding:15px;box-sizing:border-box;width:100%;">
    <div class="archivepage">    
    <?php 
$year=0; $mon=0; $i=0; $j=0; $article_count = 0; $comment_count = 0;

// 第一次遍历：统计文章总数和评论总数
foreach ($archives as $v) {
    $article_count++;
    $comment_count += $v['num'];
}
$output = '<div id="archives"><a id="toggleAll" href="#" style="padding: 10px 0 30px 20px;font-size: 18px;margin-bottom: 20px;"><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path fill="var(--minor)" d="M512 1011.2a499.6096 499.6096 0 0 0 242.1248-62.5664 38.4 38.4 0 1 0-37.2736-67.1232 423.168 423.168 0 0 1-204.8 52.8384c-232.9088 0-422.4-189.4912-422.4-422.4 0-219.9552 169.0624-400.9472 384-420.4544V512c0 21.1968 17.2032 38.4 38.4 38.4h455.5264c0.9216 0 1.7408-0.4608 2.6624-0.512 0.9216 0.0512 1.6896 0.512 2.6624 0.512a38.4 38.4 0 0 0 38.4-38.4c0-275.2512-223.9488-499.2-499.2-499.2S12.8 236.7488 12.8 512s223.9488 499.2 499.2 499.2z m420.4544-537.6H550.4V91.5456a422.8096 422.8096 0 0 1 382.0544 382.0544z" p-id="8806"></path><path fill="var(--main)" d="M891.392 698.0096a431.616 431.616 0 0 1-35.328 59.136 38.4 38.4 0 0 0 62.5664 44.6464c15.7184-22.1184 29.7984-45.6192 41.6768-69.8368a38.4 38.4 0 0 0-68.9152-33.9456z"></path></svg> 展开/收缩所有文章<span style="font-size: 12px;">（共 '. $article_count .' 文章，'. $comment_count .' 评论）</span></a>';
$year_count = 0; // 初始化年份文章计数器

foreach($archives as $v){
    $year_tmp = date('Y', strtotime($v['atime']));
    $mon_tmp = date('m', strtotime($v['atime']));
    $y = $year; 
    $m = $mon;

    if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
    if ($year != $year_tmp && $year > 0) {
        $output .= '</ul>';
        $year_count = 0; // 重置年份文章计数器
    }

    if ($year != $year_tmp) {
        $year = $year_tmp;
        $year_count = 1; // 初始化当前年份的文章计数器
        $output .= '<h2 class="year-header">'. $year .' 年 <span style="font-size: 12px;">('. $year_count .' 篇)</span></h2><ul class="month-list">';
    } else {
        $year_count++; // 增加年份文章计数器
        $output = str_replace('<h2 class="year-header">'. $year .' 年 <span style="font-size: 12px;">('. ($year_count - 1) .' 篇)</span></h2>', '<h2 class="year-header">'. $year .' 年 <span style="font-size: 12px;">('. $year_count .' 篇)</span></h2>', $output);
    }

    if ($mon != $mon_tmp) {
        $mon = $mon_tmp;
        $output .= '<li><span><b>'. $mon .' 月</b></span><ul class="month-list">';
    }

    $title = $v['title'] == '' ? mb_substr(strip_tags($v['sum']), 0, 25, 'utf-8') : $v['title'];
    $output .= '<li>'.date('d日: ', strtotime($v['atime'])).'<a href="'. vurl($v['id']) .'" title="'. $title .'">'. $title .'</a> <em>('. $v['num'].' 评论)</em></li>';
}

// 输出最后一个年份的文章总数
if ($year > 0) {
    $output = str_replace('<h2 class="year-header">'. $year .' 年 <span style="font-size: 12px;">('. ($year_count - 1) .' 篇)</span></h2>', '<h2 class="year-header">'. $year .' 年 <span style="font-size: 12px;">('. $year_count .' 篇)</span></h2>', $output);
}
$output .= '</ul></li></ul></div>';
echo $output;
?>    
        <div class="clearfix"></div>
    </div>
</div>
</div>
</div>
<?php include "foot.php";?>
<?php echo $set['foot'];?>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    // 获取所有的年份标题
    const yearHeaders = document.querySelectorAll('.year-header');

    // 为每个年份标题添加点击事件监听器
    yearHeaders.forEach(header => {
        header.addEventListener('click', function() {
            // 找到对应的月份列表
            const monthList = this.nextElementSibling;
            
            // 切换月份列表的显示状态
            if (monthList.style.display === 'none' || monthList.style.display === '') {
                monthList.style.display = 'block';
            } else {
                monthList.style.display = 'none';
            }
        });
    });

    // 获取所有的月份项
    const monthItems = document.querySelectorAll('.month-list > li');

    // 为每个月份项添加点击事件监听器
    monthItems.forEach(item => {
        item.addEventListener('click', function(event) {
            // 阻止事件冒泡到年份标题
            event.stopPropagation();

            // 找到对应的子月份列表
            const subMonthList = this.querySelector('.month-list');
            
            // 如果存在子月份列表，则切换其显示状态
            if (subMonthList) {
                if (subMonthList.style.display === 'none' || subMonthList.style.display === '') {
                    subMonthList.style.display = 'block';
                } else {
                    subMonthList.style.display = 'none';
                }
            }
        });
    });

    // 获取所有的月份列表
    const monthLists = document.querySelectorAll('.month-list');
    monthLists.forEach(list => {
        list.style.display = 'none';
    });

    // 展开第一年的月份列表及其第一个子月份列表
    if (yearHeaders.length > 0) {
        const firstYearMonthList = yearHeaders[0].nextElementSibling;
        if (firstYearMonthList) {
            firstYearMonthList.style.display = 'block';

            // 获取第一个子月份列表
            const firstMonthItem = firstYearMonthList.querySelector('li:first-child');
            if (firstMonthItem) {
                const firstSubMonthList = firstMonthItem.querySelector('.month-list');
                if (firstSubMonthList) {
                    firstSubMonthList.style.display = 'block';
                }
            }
        }
    }

    // 获取展开/收缩所有年份和月份的链接
    const toggleAllLink = document.getElementById('toggleAll');
    let allExpanded = false;

    // 为链接添加点击事件监听器
    toggleAllLink.addEventListener('click', function(event) {
        event.preventDefault(); // 阻止默认的链接跳转行为

        if (!allExpanded) {
            // 展开所有年份和月份
            yearHeaders.forEach(header => {
                const monthList = header.nextElementSibling;
                monthList.style.display = 'block';

                // 展开当前年份下的所有月份列表
                const monthItemsInYear = monthList.querySelectorAll('li');
                monthItemsInYear.forEach(monthItem => {
                    const subMonthList = monthItem.querySelector('.month-list');
                    if (subMonthList) {
                        subMonthList.style.display = 'block';
                    }
                });
            });
            allExpanded = true;
        } else {
            // 收缩所有年份和月份
            yearHeaders.forEach(header => {
                const monthList = header.nextElementSibling;
                monthList.style.display = 'none';

                // 收缩当前年份下的所有月份列表
                const monthItemsInYear = monthList.querySelectorAll('li');
                monthItemsInYear.forEach(monthItem => {
                    const subMonthList = monthItem.querySelector('.month-list');
                    if (subMonthList) {
                        subMonthList.style.display = 'none';
                    }
                });
            });
            allExpanded = false;
        }
    });
});
  </script>
</body>
</html>