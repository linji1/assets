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
    padding-bottom: 6px;
    padding-top: 20px;
    padding-left: 20px;
        }
		</style>
<div id="content" style="position: relative;">
<div id="main" style="background:#fff;padding:15px;box-sizing:border-box;width:100%;">
    <div class="archivepage">    
    <?php 
    $year=0; $mon=0; $i=0; $j=0;
    $output = '<div id="archives"><a id="toggleAll" href="#" style="padding: 10px 0 30px 20px;font-size: 18px;margin-bottom: 20px;">展开/收缩所有年份和月份</a>';
	foreach($archives as $v){
        $year_tmp = date('Y',strtotime($v['atime']));
        $mon_tmp = date('m',strtotime($v['atime']));
        $y=$year; $m=$mon;
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';
        if ($year != $year_tmp) {
            $year = $year_tmp;
            $output .= '<h2 class="year-header">'. $year .' 年</h2><ul class="month-list">'; 
        }
        if ($mon != $mon_tmp) {
            $mon = $mon_tmp;
            $output .= '<li><span><b>'. $mon .' 月</b></span><ul class="month-list">'; 
        }
        $title = $v['title'] == '' ? mb_substr(strip_tags($v['sum']) , 0, 25, 'utf-8') : $v['title'];
        $output .= '<li>'.date('d日: ',strtotime($v['atime'])).'<a href="'. vurl($v['id']) .'" title="'. $title .'">'. $title .'</a> <em>('. $v['num'].' 评论)</em></li>'; 
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