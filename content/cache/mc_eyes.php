<?php exit;//a:2:{s:4:"week";a:4:{i:15;a:33:{s:2:"id";s:2:"15";s:5:"title";s:60:"centos搭建Apache+php+mysql+phpmyadmin等Web服务器环境";s:4:"date";s:10:"1610155496";s:7:"content";s:9341:"&lt;p&gt;&lt;b&gt;安装Apache&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;1、检测Apache（新系统跳过该步骤）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过Apache。
rpm -qa | grep httpd
# 有就卸载httpd。-y是不提示信息，直接安装，不带-y加载完成资源会提示是否安装需要输入 y/n 回车同意或拒绝，下同。
yum remove -y &quot;httpd*&quot;
&lt;/pre&gt;
&lt;p&gt;2、安装httpd（Apache）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 重新安装httpd。
yum install -y httpd
# 启动httpd。
systemctl start httpd
# 添加开机启动。
systemctl enable httpd
# 查看启动状态。
systemctl status httpd
&lt;/pre&gt;
&lt;p&gt;3、访问IP地址测试，使用浏览器访问http://服务器IP地址ip地址/，如果显示界面正确，则说明php安装成功&lt;/p&gt;
&lt;p&gt;&lt;b&gt;安装php&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;1、检测php（新系统跳过该步骤）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过php。
rpm -qa | grep php
# 有就卸载php。
yum remove -y &quot;php*&quot;&lt;/pre&gt;
&lt;p&gt;2、安装php&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 安装php。
yum install -y php
# 查看php版本 (我的版本是 PHP 7.2.24)
php -v
# 安装php扩展
yum install php-mysql php-gd php-imap php-ldap php-odbc php-pear php-xml php-xmlrpc
# 安装扩展有时会提示失败，其中，安装php-mysql的时候会提示错误：没有匹配的参数：php-mysql
# 解决如下：
yum search php-mysql
# 找到两个匹配版本：php-mysqlnd.x86_64 ;执行安装
yum install php-mysqlnd.x86_64
# 网站用到验证码时，需要GD库支持
yum install php-gd
# 启动php
systemctl start php-fpm
# 设置开机启动
systemctl enable php-fpm
&lt;/pre&gt;
&lt;p&gt;3、测试php&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 创建文件/var/www/html/index.php，写入内容 “&amp;lt;?php phpinfo(); ?&amp;gt;”。
touch    /var/www/html/index.php
echo  &quot;&amp;lt;?php  phpinfo();  ?&amp;gt;&quot; &amp;gt; /var/www/html/index.php
# 重启apache服务，使用浏览器访问http://服务器IP地址ip地址/(index.php),如果显示界面改为phpinfo页面，则说明php安装成功。
systemctl restart  httpd&lt;/pre&gt;
&lt;p&gt;&lt;b&gt;安装MySQL&lt;br&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;1、检测&lt;br&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过mysql。
rpm -qa | grep mysql
# 有就卸载httpd。
yum remove -y &quot;mysql*&quot;&lt;/pre&gt;&lt;p&gt;&lt;/p&gt;
&lt;p&gt;2、安装mysql&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;# 安装mysql。
yum install -y mysql mysql-server
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;启动mysql
systemctl start mysqld.service&lt;/pre&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;&lt;pre style=&quot;padding: 0px; font-size: 15.4px; overflow: auto; overflow-wrap: break-word;&quot;&gt;&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置开机启动&lt;/pre&gt;&lt;/pre&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;systemctl enable mysqld.service
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置root密码为123456
mysqladmin -u root password 123456
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;后续如果需要修改root密码
alter user 'root'@'%' identified with mysql_native_password by '新密码’；
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;登录mysql
mysql -u root -p  //需要输入密码
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置远程可访问
grant all privileges on *.* to 'root'@'%'with grant option;
flush privileges;
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;如果远程还是无法访问，有可能是防火墙的原因，关闭防火墙
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;这里可以查看root用户的host ‘localhost' 已经变成了 ’%‘
use mysql 
select host,user from user;
# 退出mysql 三种方法 exit; quit; \q;
quit;&lt;/pre&gt;&lt;/pre&gt;&lt;p&gt;&lt;b&gt;安装 phpmyadmin&amp;nbsp;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;1、获取版本链接地址&lt;/p&gt;&lt;p&gt;官网地址&amp;nbsp;&lt;a href=&quot;https://www.phpmyadmin.net/&quot; target=&quot;_blank&quot;&gt;https://www.phpmyadmin.net/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;在官网上找到自己适合的版本 ，我用的是5.0.4，不用下载直接右键，复制链接地址即可&lt;/p&gt;&lt;p&gt;2、拷贝安装&amp;nbsp;wget&amp;nbsp;后面跟上你拷贝过来的地址&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;pre style=&quot;padding: 0px; font-size: 15.4px; overflow: auto; overflow-wrap: break-word;&quot;&gt;# 切换路径到指定存放位置&lt;/pre&gt;&lt;font face=&quot;Microsoft Yahei, 微软雅黑, Tahoma, Times New Roman, Arial, Helvetica, STHeiti&quot;&gt;cd /var/www/&lt;span style=&quot;font-size: 15.4px;&quot;&gt;
# &lt;/span&gt;&lt;/font&gt;下载
wget https://files.phpmyadmin.net/phpMyAdmin/5.0.4/phpMyAdmin-5.0.4-all-languages.zip
&lt;span style=&quot;font-family: &amp;quot;Microsoft Yahei&amp;quot;, 微软雅黑, Tahoma, &amp;quot;Times New Roman&amp;quot;, Arial, Helvetica, STHeiti; font-size: 15.4px;&quot;&gt;# &lt;/span&gt;解压
unzip &lt;span style=&quot;font-size: 15.4px;&quot;&gt;phpMyAdmin-5.0.4-all-languages.zip
&lt;/span&gt;# 移动后目标网站所在目录
mv phpMyAdmin-5.0.4-all-languages /var/www/html/phpmyadmin
# 移动到html文件夹下查看是否成功
cd html
ls
如果存在index.php和phpmyadmin就说明上述操作成功&lt;/pre&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;span style=&quot;font-size: 15.4px;&quot;&gt;以下内容如果出现问题可以尝试，没问题跳过
# &lt;/span&gt;把config.sample.inc.php 复制成 config.inc.php，到phpmyadmin的目录下&lt;br&gt;cd phpmyadmin
cp config.sample.inc.php config.inc.php
&lt;span style=&quot;font-size: 15.4px;&quot;&gt;# &lt;/span&gt;修改设置
vi config.inc.php
&lt;span style=&quot;font-size: 15.4px;&quot;&gt;# &lt;/span&gt;填入bluefish的key，不能有空格，打开下面的网页取得 Bluefish 的 key，每次刷新得到的key都不同，选择自己喜欢的就行
&lt;a href=&quot;https://phpsolved.com/phpmyadmin-blowfish-secret-generator/&quot; target=&quot;_blank&quot;&gt;https://phpsolved.com/phpmyadmin-blowfish-secret-generator/&lt;/a&gt;
# 按下i进入编辑模式,大概在18行左右
$cfg['blowfish_secret'] = '' //改为
$cfg['blowfish_secret'] = 't9S:A4=4-8MXs0jlAKe6SQj4qfQk3qCX' //其中 t9S:A4=4-8MXs0jlAKe6SQj4qfQk3qCX为获取的key
# 按ESC键，退出编辑模式 输入:wq保存并退出 :q退出不保存 如果遇到修改了内容，但不想保存，退出失败时可以:q!强制退出
:wq
&lt;/pre&gt;&lt;p&gt;3、测试并使用phpmyadmin&lt;/p&gt;&lt;p&gt;使用浏览器访问http://服务器IP地址ip地址/phpmyadmin&lt;/p&gt;&lt;p&gt;如果出现 The mbstring extension is missing. Please check your PHP configuration.&amp;nbsp;提示，则是缺少php-mbstring，安装php-mbstring&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;yum install php-mbstring&lt;/pre&gt;&lt;p&gt;如果提示&amp;nbsp;The json extension is missing. Please check your PHP configuration.&amp;nbsp;同样安装php-json&amp;nbsp;即可&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot; style=&quot;font-size: 15.4px;&quot;&gt;yum install php-json&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改&lt;/b&gt;&lt;b&gt;Apache&lt;/b&gt;&lt;b&gt;配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/httpd/conf/httpd.conf   //使用vi/vim都是可以的，i进入编辑模式，ESC退出编辑模式，浏览模式下:wq保存并退出文件编辑&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改PHP配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/php.ini&lt;/pre&gt;&lt;p&gt;&lt;/p&gt;";s:7:"excerpt";s:330:"安装Apache
1、检测Apache（新系统跳过该步骤）
# 查看是否安装过Apache。
rpm -qa | grep httpd
# 有就卸载httpd。-y是不提示信息，直接安装，不带-y加载完成资源会提示是否安装需要输入 y/n 回车同意或拒绝，下同。
yum remove -y "httpd*"

2、安装httpd（Apache）";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:2:"20";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:0;s:6:"arturl";s:35:"http://localhost/technology/15.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/14.jpg";}i:18;a:33:{s:2:"id";s:2:"18";s:5:"title";s:4:"cbcv";s:4:"date";s:10:"1610254029";s:7:"content";s:0:"";s:7:"excerpt";s:0:"";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"0";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:9:"未分类";s:8:"collects";i:0;s:6:"arturl";s:24:"http://localhost/18.html";s:7:"sorturl";s:23:"http://localhost/sort/0";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/23.jpg";}i:17;a:33:{s:2:"id";s:2:"17";s:5:"title";s:9:"挺好听";s:4:"date";s:10:"1610252181";s:7:"content";s:5:"thtjt";s:7:"excerpt";s:5:"thtjt";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:0;s:6:"arturl";s:35:"http://localhost/technology/17.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:62:"http://localhost/content/template/ideashu/images/randoms/8.jpg";}i:16;a:33:{s:2:"id";s:2:"16";s:5:"title";s:15:"反对好地方";s:4:"date";s:10:"1610252154";s:7:"content";s:15:"fdhdf&amp;nbsp;";s:7:"excerpt";s:11:"fdhdf&nbsp;";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:0;s:6:"arturl";s:35:"http://localhost/technology/16.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/24.jpg";}}s:3:"all";a:12:{i:11;a:33:{s:2:"id";s:2:"11";s:5:"title";s:39:"关于图片“出血”详细讲解！";s:4:"date";s:10:"1609229778";s:7:"content";s:1464:"&lt;p&gt;印刷中的裁剪设备可能存在误差，没有添加出血位得到产出物会产生出现白边或有的地方切掉多了。什么样的印刷作品需要加出血呢，只要涉及到反正面印刷的产出物就需要加出血，PS中可以建立实际印刷尺寸，通过画布大小各加点6就完成了上下左右各3毫米的出血，AI与ID软件中可以在新建画布的情况下添加完成。设计时候建议请离出血的位置多一些。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;出血线与出血：&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;出血线是用来界定图片或色地的哪些部分需要被裁切掉的线。（出血线以外的部分会在印刷品装订前被裁切掉。所以也叫裁切线。）&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;出血就是出血线以外的图片或色地，也就是会被裁切掉的部分。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160923007335364.png&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;有出血的版与没有出血的版对比&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160923003052398.png&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;../content/uploadfile/20201229/160923001315248.jpg&quot;&gt;";s:7:"excerpt";s:524:"印刷中的裁剪设备可能存在误差，没有添加出血位得到产出物会产生出现白边或有的地方切掉多了。什么样的印刷作品需要加出血呢，只要涉及到反正面印刷的产出物就需要加出血，PS中可以建立实际印刷尺寸，通过画布大小各加点6就完成了上下左右各3毫米的出血，AI与ID软件中可以在新建画布的情况下添加完成。设计时候建议请离出血的位置多一些。出血线与出血：出血线是用来界定图片或色";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"2";s:4:"type";s:1:"a";s:4:"eyes";s:3:"115";s:7:"goodnum";s:1:"3";s:6:"badnum";s:1:"3";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"9";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:50:"../content/uploadfile/20201229/160923007368364.png";s:4:"tags";s:3:"1,2";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"设计";s:8:"collects";i:1;s:6:"arturl";s:31:"http://localhost/design/11.html";s:7:"sorturl";s:28:"http://localhost/sort/design";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:64:"http://localhost/content/uploadfile/20201229/160923007368364.png";}i:10;a:33:{s:2:"id";s:2:"10";s:5:"title";s:24:"聚餐时如何摆桌子";s:4:"date";s:10:"1609229565";s:7:"content";s:4972:"<p>聚餐时，如何布置餐桌往往会表明食客可以从形式上期待什么，以及餐食的全面程度。经典的Emily Post“礼仪小姐”风格的综合餐桌摆放肯定有时间和地方，但是今天的房主很少拥有正式餐桌摆放所需的各种菜肴。知道这一点，掌握完整桌子设置的形式是件好事，但也可以通过拨回一些东西以使桌子更干净，更简单来庆祝现代性。</p><p><br></p><p style="text-align: center;"><img src="../content/uploadfile/20201229/them_160922962427759.jpg"></p><p style="text-align: center;">如何摆桌子</p><p><br></p><p><b>正式与非正式</b></p><p>正式的桌子很值得一看。每次设置至少有10个器皿，四个杯子和三个盘子，再加上一个杯子，碟子和其他小东西，设置这个场景是一项艰巨的任务。在当今城市房屋缩减和生活成本上涨的世界中，拥有丰富的餐具和中国人需要白金汉宫式餐桌布置的房主已经不那么普遍了。更重要的是，宏大的旧餐桌在当今较小的平方英尺中并不常见，因此使用全面的设置可以在桌子空间上放置阻尼器。</p><p><br></p><p>实际上，看看一些世界上最著名的高端餐厅，很明显，多桌餐桌布置的千篇一律风格已不再流行。当今的餐饮世界将食物视为明星，并且改变每道菜的用餐地点设置而不是一开始就把所有食物都放在那里变得越来越普遍。</p><p><br></p><p><b>永恒的妥协</b></p><p>提供多道菜餐时，备有餐边柜或自助餐来组织每道菜的菜肴会很有帮助。在那里，您可以安排甜点盘，汤匙，咖啡杯和茶具，以便在学习过程中快速分配食物。只需将每个用餐者的脏碗碟清理到厨房，然后根据需要设置新的碗碟，即可用于下一道菜。</p><p><br></p><p>从长远来看，不必担心拥有完整的餐具，例如鱼刀和叉子，对您而言，简单地加倍标准：晚餐，沙拉，汤和甜点餐具可能对您更有利。这样，您将有足够的钱用于多道菜的餐点，同时在容纳更多人的非正式便餐时也足以为整个团伙提供合适的餐具。</p><p><br></p><p><b>两种表设置</b></p><p>忽略超豪华的正式环境并不意味着不会有什么妥协。有“非正式”设置。不要将它与“休闲”表设置相混淆。有什么不同？认为非正式是“不是领带，而不是牛仔裤”，随便什么都可以。</p><p><br></p><p><b>休闲晚餐</b></p><p>休闲晚餐为一周的每个晚上。如果您想要餐垫，请先将其放下。经验法则是，餐垫应从桌子边缘大约1英寸处开始。将餐盘居中放置在餐垫上。将餐刀和汤匙放在盘子的右侧，将叉子放在左侧。同样，餐具应距盘子边缘约1英寸。始终将刀放下并使刀片面朝板。有点琐碎的事情：这在花哨的日子里做的部分目的是为了使餐具制造商的名字面朝上，并且晚餐者可以在与他们一起用餐的餐具口径上留下深刻的印象。</p><p><br></p><p>在小刀上方，放置葡萄酒或水杯。如果将葡萄酒与水或其他饮料一起饮用，则是刀上方的酒杯，然后是酒杯右侧的水或其他杯。如果您有面包或面包卷，并且想要一块单独的盘子，它放在叉子上方的左侧。</p><p><br></p><p><b>非正式设置</b></p><p>非正式会议的开始方式与上述休闲场合相同。餐垫，盘子，刀和匙在右边，叉子在左边等等。放置完所有这些组件后，将添加非正式设置的其他功能。</p><p><br></p><p>在任何餐桌上，您都只能使用自己提供的食物，但是习惯上不管汤匙是否盛汤都可以放汤匙。如果提供需要汤匙的甜点，则可以将汤匙放在外面，因为它会先被使用，然后再将甜点匙放在刀和汤匙之间。另一种选择是将汤匙水平放置在盘子上方，与桌子边缘垂直，进食端指向左侧。两者都起作用，这只是表设置者的喜好问题。</p><p><br></p><p>在叉子一侧，晚餐叉子应最靠近盘子，色拉叉子应在外面。色拉叉的左侧应该是一个色拉盘。</p><p><br></p><p>至于餐巾纸，这又是一个优先事项。人们经常将餐巾放在刀和勺下，其他人将餐巾折叠并放在餐盘的顶部。由你决定。</p><p><br></p><p><b>退缩：盘子和杯子</b></p><p>如果您打算在每餐盘上放置主菜，则将餐点提供给客人，将餐盘放在厨房中或计划将食物撒出的任何地方。铺好食物后，将各部分取出，放在小餐馆前面的桌子上。</p><p><br></p><p>对于每种设置都需要将咖啡杯和碟子放在水杯的右边，这是有争议的，但是它占用了大量空间。另外，在当今的晚宴世界中，饭后喝咖啡和茶并不普遍。因此，为了使您的桌子更简单，请将杯子和碟子放在餐具柜上，并相应地上桌。</p>";s:7:"excerpt";s:520:"聚餐时，如何布置餐桌往往会表明食客可以从形式上期待什么，以及餐食的全面程度。经典的Emily Post“礼仪小姐”风格的综合餐桌摆放肯定有时间和地方，但是今天的房主很少拥有正式餐桌摆放所需的各种菜肴。知道这一点，掌握完整桌子设置的形式是件好事，但也可以通过拨回一些东西以使桌子更干净，更简单来庆祝现代性。如何摆桌子正式与非正式正式的桌子很值得一看。每次设置至少";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"4";s:4:"type";s:1:"a";s:4:"eyes";s:2:"24";s:7:"goodnum";s:1:"2";s:6:"badnum";s:1:"2";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"1";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"1";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:50:"../content/uploadfile/20201229/160922962446246.jpg";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"网络";s:6:"geturl";s:36:"http://www.innocoms.com.cn/lxwm.html";s:8:"sortname";s:6:"生活";s:8:"collects";i:1;s:6:"arturl";s:29:"http://localhost/life/10.html";s:7:"sorturl";s:26:"http://localhost/sort/life";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:64:"http://localhost/content/uploadfile/20201229/160922962446246.jpg";}i:15;a:33:{s:2:"id";s:2:"15";s:5:"title";s:60:"centos搭建Apache+php+mysql+phpmyadmin等Web服务器环境";s:4:"date";s:10:"1610155496";s:7:"content";s:9341:"&lt;p&gt;&lt;b&gt;安装Apache&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;1、检测Apache（新系统跳过该步骤）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过Apache。
rpm -qa | grep httpd
# 有就卸载httpd。-y是不提示信息，直接安装，不带-y加载完成资源会提示是否安装需要输入 y/n 回车同意或拒绝，下同。
yum remove -y &quot;httpd*&quot;
&lt;/pre&gt;
&lt;p&gt;2、安装httpd（Apache）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 重新安装httpd。
yum install -y httpd
# 启动httpd。
systemctl start httpd
# 添加开机启动。
systemctl enable httpd
# 查看启动状态。
systemctl status httpd
&lt;/pre&gt;
&lt;p&gt;3、访问IP地址测试，使用浏览器访问http://服务器IP地址ip地址/，如果显示界面正确，则说明php安装成功&lt;/p&gt;
&lt;p&gt;&lt;b&gt;安装php&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;1、检测php（新系统跳过该步骤）&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过php。
rpm -qa | grep php
# 有就卸载php。
yum remove -y &quot;php*&quot;&lt;/pre&gt;
&lt;p&gt;2、安装php&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 安装php。
yum install -y php
# 查看php版本 (我的版本是 PHP 7.2.24)
php -v
# 安装php扩展
yum install php-mysql php-gd php-imap php-ldap php-odbc php-pear php-xml php-xmlrpc
# 安装扩展有时会提示失败，其中，安装php-mysql的时候会提示错误：没有匹配的参数：php-mysql
# 解决如下：
yum search php-mysql
# 找到两个匹配版本：php-mysqlnd.x86_64 ;执行安装
yum install php-mysqlnd.x86_64
# 网站用到验证码时，需要GD库支持
yum install php-gd
# 启动php
systemctl start php-fpm
# 设置开机启动
systemctl enable php-fpm
&lt;/pre&gt;
&lt;p&gt;3、测试php&lt;/p&gt;
&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 创建文件/var/www/html/index.php，写入内容 “&amp;lt;?php phpinfo(); ?&amp;gt;”。
touch    /var/www/html/index.php
echo  &quot;&amp;lt;?php  phpinfo();  ?&amp;gt;&quot; &amp;gt; /var/www/html/index.php
# 重启apache服务，使用浏览器访问http://服务器IP地址ip地址/(index.php),如果显示界面改为phpinfo页面，则说明php安装成功。
systemctl restart  httpd&lt;/pre&gt;
&lt;p&gt;&lt;b&gt;安装MySQL&lt;br&gt;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;1、检测&lt;br&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;# 查看是否安装过mysql。
rpm -qa | grep mysql
# 有就卸载httpd。
yum remove -y &quot;mysql*&quot;&lt;/pre&gt;&lt;p&gt;&lt;/p&gt;
&lt;p&gt;2、安装mysql&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;# 安装mysql。
yum install -y mysql mysql-server
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;启动mysql
systemctl start mysqld.service&lt;/pre&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;&lt;pre style=&quot;padding: 0px; font-size: 15.4px; overflow: auto; overflow-wrap: break-word;&quot;&gt;&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置开机启动&lt;/pre&gt;&lt;/pre&gt;&lt;pre style=&quot;padding: 0px; overflow: auto; overflow-wrap: break-word;&quot;&gt;systemctl enable mysqld.service
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置root密码为123456
mysqladmin -u root password 123456
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;后续如果需要修改root密码
alter user 'root'@'%' identified with mysql_native_password by '新密码’；
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;登录mysql
mysql -u root -p  //需要输入密码
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;设置远程可访问
grant all privileges on *.* to 'root'@'%'with grant option;
flush privileges;
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;如果远程还是无法访问，有可能是防火墙的原因，关闭防火墙
&lt;span style=&quot;font-size: 15.4px; font-family: Consolas, Monaco, &amp;quot;Bitstream Vera Sans Mono&amp;quot;, &amp;quot;Courier New&amp;quot;, Courier, monospace;&quot;&gt;# &lt;/span&gt;这里可以查看root用户的host ‘localhost' 已经变成了 ’%‘
use mysql 
select host,user from user;
# 退出mysql 三种方法 exit; quit; \q;
quit;&lt;/pre&gt;&lt;/pre&gt;&lt;p&gt;&lt;b&gt;安装 phpmyadmin&amp;nbsp;&lt;/b&gt;&lt;/p&gt;&lt;p&gt;1、获取版本链接地址&lt;/p&gt;&lt;p&gt;官网地址&amp;nbsp;&lt;a href=&quot;https://www.phpmyadmin.net/&quot; target=&quot;_blank&quot;&gt;https://www.phpmyadmin.net/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;在官网上找到自己适合的版本 ，我用的是5.0.4，不用下载直接右键，复制链接地址即可&lt;/p&gt;&lt;p&gt;2、拷贝安装&amp;nbsp;wget&amp;nbsp;后面跟上你拷贝过来的地址&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;pre style=&quot;padding: 0px; font-size: 15.4px; overflow: auto; overflow-wrap: break-word;&quot;&gt;# 切换路径到指定存放位置&lt;/pre&gt;&lt;font face=&quot;Microsoft Yahei, 微软雅黑, Tahoma, Times New Roman, Arial, Helvetica, STHeiti&quot;&gt;cd /var/www/&lt;span style=&quot;font-size: 15.4px;&quot;&gt;
# &lt;/span&gt;&lt;/font&gt;下载
wget https://files.phpmyadmin.net/phpMyAdmin/5.0.4/phpMyAdmin-5.0.4-all-languages.zip
&lt;span style=&quot;font-family: &amp;quot;Microsoft Yahei&amp;quot;, 微软雅黑, Tahoma, &amp;quot;Times New Roman&amp;quot;, Arial, Helvetica, STHeiti; font-size: 15.4px;&quot;&gt;# &lt;/span&gt;解压
unzip &lt;span style=&quot;font-size: 15.4px;&quot;&gt;phpMyAdmin-5.0.4-all-languages.zip
&lt;/span&gt;# 移动后目标网站所在目录
mv phpMyAdmin-5.0.4-all-languages /var/www/html/phpmyadmin
# 移动到html文件夹下查看是否成功
cd html
ls
如果存在index.php和phpmyadmin就说明上述操作成功&lt;/pre&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;&lt;span style=&quot;font-size: 15.4px;&quot;&gt;以下内容如果出现问题可以尝试，没问题跳过
# &lt;/span&gt;把config.sample.inc.php 复制成 config.inc.php，到phpmyadmin的目录下&lt;br&gt;cd phpmyadmin
cp config.sample.inc.php config.inc.php
&lt;span style=&quot;font-size: 15.4px;&quot;&gt;# &lt;/span&gt;修改设置
vi config.inc.php
&lt;span style=&quot;font-size: 15.4px;&quot;&gt;# &lt;/span&gt;填入bluefish的key，不能有空格，打开下面的网页取得 Bluefish 的 key，每次刷新得到的key都不同，选择自己喜欢的就行
&lt;a href=&quot;https://phpsolved.com/phpmyadmin-blowfish-secret-generator/&quot; target=&quot;_blank&quot;&gt;https://phpsolved.com/phpmyadmin-blowfish-secret-generator/&lt;/a&gt;
# 按下i进入编辑模式,大概在18行左右
$cfg['blowfish_secret'] = '' //改为
$cfg['blowfish_secret'] = 't9S:A4=4-8MXs0jlAKe6SQj4qfQk3qCX' //其中 t9S:A4=4-8MXs0jlAKe6SQj4qfQk3qCX为获取的key
# 按ESC键，退出编辑模式 输入:wq保存并退出 :q退出不保存 如果遇到修改了内容，但不想保存，退出失败时可以:q!强制退出
:wq
&lt;/pre&gt;&lt;p&gt;3、测试并使用phpmyadmin&lt;/p&gt;&lt;p&gt;使用浏览器访问http://服务器IP地址ip地址/phpmyadmin&lt;/p&gt;&lt;p&gt;如果出现 The mbstring extension is missing. Please check your PHP configuration.&amp;nbsp;提示，则是缺少php-mbstring，安装php-mbstring&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;yum install php-mbstring&lt;/pre&gt;&lt;p&gt;如果提示&amp;nbsp;The json extension is missing. Please check your PHP configuration.&amp;nbsp;同样安装php-json&amp;nbsp;即可&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot; style=&quot;font-size: 15.4px;&quot;&gt;yum install php-json&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改&lt;/b&gt;&lt;b&gt;Apache&lt;/b&gt;&lt;b&gt;配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/httpd/conf/httpd.conf   //使用vi/vim都是可以的，i进入编辑模式，ESC退出编辑模式，浏览模式下:wq保存并退出文件编辑&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改PHP配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/php.ini&lt;/pre&gt;&lt;p&gt;&lt;/p&gt;";s:7:"excerpt";s:330:"安装Apache
1、检测Apache（新系统跳过该步骤）
# 查看是否安装过Apache。
rpm -qa | grep httpd
# 有就卸载httpd。-y是不提示信息，直接安装，不带-y加载完成资源会提示是否安装需要输入 y/n 回车同意或拒绝，下同。
yum remove -y "httpd*"

2、安装httpd（Apache）";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:2:"20";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:0;s:6:"arturl";s:35:"http://localhost/technology/15.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:62:"http://localhost/content/template/ideashu/images/randoms/7.jpg";}i:13;a:33:{s:2:"id";s:2:"13";s:5:"title";s:23:"Emlog全局通用常量";s:4:"date";s:10:"1609565463";s:7:"content";s:2193:"&lt;p&gt;EMLOG_ROOT网站的绝对路径直接访问脚本无法得到这个值,可防止脚本被直接执行&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ISLOGIN用户的登录状态可用户用户是否登录的判断 登陆值为1&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ROLE_ADMIN管理员 admin值为 admin&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ROLE_WRITER作者 writer值为writer&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ROLE_VISITOR游客 visitor值为 visitor&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;ROLE得到用户的角色以上3个值之一&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;UID得到用户的uid&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;BLOG_URL博客地址http://localhost/&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;TPLS_URL模版库地址http://localhost/content/templates/&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;TPLS_PATH模板库路径C:\usr\www\content/templates/&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DYNAMIC_BLOGURL网站地址用户跨域请求,如果只有一个网站和博客地址没有什么区别&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;返回的是最后一个斜杠之前的内容,包括斜杠&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;TEMPLATE_URL前台模版地址http://localhost/content/templates/amuker/&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;TEMPLATE_NAME当前使用的模版名称amuker&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;TEMPLATE_PATH前台模版主题路径C:\web\www\content/templates/amuker/&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DB_HOST数据库连接地址&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DB_USER数据库用户名&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DB_PASSWD数据库密码&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DB_NAME数据库名称&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;DB_PREFIX数据表前缀&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;AUTH_KEY用户密钥a$2dg45DM*^JSXP*7CrT%mSd%6g@U9Jwe3d9c0a5da590831cc59aca115b34dd3&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;AUTH_COOKIE_NAMEcookie名EM_AUTHCOOKIE_LPJ7nKYFjeu1La24z6ENMbRTirRt3neC88&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;";s:7:"excerpt";s:338:"EMLOG_ROOT网站的绝对路径直接访问脚本无法得到这个值,可防止脚本被直接执行ISLOGIN用户的登录状态可用户用户是否登录的判断 登陆值为1ROLE_ADMIN管理员 admin值为 adminROLE_WRITER作者 writer值为writerROLE_VISITOR游客 visitor值为 visitorROLE得到用户的角色以上3个值之一UI";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:2:"12";s:7:"goodnum";s:1:"1";s:6:"badnum";s:1:"1";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:1;s:6:"arturl";s:35:"http://localhost/technology/13.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/14.jpg";}i:14;a:33:{s:2:"id";s:2:"14";s:5:"title";s:9:"写笔记";s:4:"date";s:10:"1609576406";s:7:"content";s:15:"写笔记内容";s:7:"excerpt";s:15:"写笔记内容";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:2:"11";s:7:"goodnum";s:1:"1";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"2";s:7:"filenum";s:1:"1";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:50:"../content/uploadfile/20210103/160960320169186.jpg";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"技术";s:8:"collects";i:1;s:6:"arturl";s:35:"http://localhost/technology/14.html";s:7:"sorturl";s:32:"http://localhost/sort/technology";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:64:"http://localhost/content/uploadfile/20210103/160960320169186.jpg";}i:2;a:33:{s:2:"id";s:1:"2";s:5:"title";s:12:"创意笔记";s:4:"date";s:10:"1609139534";s:7:"content";s:21:"开始你的创作吧";s:7:"excerpt";s:21:"开始你的创作吧";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"1";s:4:"type";s:1:"a";s:4:"eyes";s:1:"9";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"创意";s:8:"collects";i:1;s:6:"arturl";s:32:"http://localhost/creative/2.html";s:7:"sorturl";s:30:"http://localhost/sort/creative";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/17.jpg";}i:8;a:33:{s:2:"id";s:1:"8";s:5:"title";s:38:"您应该用酒精清洁的10件事物";s:4:"date";s:10:"1609219715";s:7:"content";s:7209:"&lt;p&gt;可能在您浴室抽屉的后部有一个瓶子在滚来滚去，但是您实际上多久使用一次搓酒？这种不可饮用的产品也被称为异丙醇，曾经大量用于治疗伤口。不再认为这是明智的选择，但是摩擦酒精仍然有一个目的：便宜，具有抗菌特性并且粘性表面与其功效不匹配。通过这10个清洁技巧，将其从浴室中拉出并扩大其使用寿命。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;1、地毯&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;如果您有孩子，宠物或者不灵巧的时候，您必须随时准备对一些可能泄漏在地毯上的流体做出反应。日常生活中你会发现酒精（丙醇）会是一种令人惊讶的并极其有效的去污剂。将足够多的可擦酒精倒在地毯沾有污渍处使其浸透，然后将毛巾向下压在污渍上并吸干液体。如有必要，请重复第二次。此技巧最适用于新鲜污渍，但也可能有助于最大程度地减少旧污渍的出现。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922866258930.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;2、贴纸残留&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;您肯定因为贴纸而烦恼过，比如：当您用指甲把贴在某个东西上有胶水的标签扣下来时，发现该标签的残留物仍在该东西上可见，这令人非常不舒服。您可以通过用酒精蘸湿纸巾并将其压在粘性区域一分钟，以去除所有的粘性痕迹。擦拭区域，残留物应能轻易被清除掉。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922867993971.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;3、眼镜&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;视力不好的人会意识到从眼镜清洁剂出售的喷雾剂和湿巾中擦出酒精的诉说气味。跳过中间商，直接用酒精擦拭，以去除眼镜镜片上的条纹和斑点。用95％的水和5％的外加酒精的混合物填充一个小的喷雾瓶中，将其喷洒在每个镜头上，并使用用于清洁眼镜的柔软布将其擦去。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922896041970.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;4、臭鞋或脏鞋&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;我们不会告诉任何人，但我们知道您家里有臭鞋子。您可以用外用酒精驱除昨天锻炼的残留气味。将一些倒入喷雾瓶中，然后松开每只鞋的舌头，以方便取放。将酒精喷入每只鞋中，并使其通风过夜。我们会在早晨闻到全新的气味，而没有一点点的恶臭。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922897286437.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;5、超细纤维表面&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;躺在超细纤维覆盖的沙发上时就像获得一个大大的拥抱一样。它柔软而温暖，比绒面革便宜得多，因此这种面料是负担得起的家具的流行选择。如果您家里有超细纤维表面，请喷洒酒精在擦拭痕迹和污渍上。用湿布在次擦拭污渍。酒精会溶解，其上不会残留任何痕迹还起到消毒的作用。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922898238927.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;6、永久标记&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;是的，这个神奇的小帮手也可以清除衣服，家具和墙壁上的污渍。有时灵感似乎击中了您家的小画家，并导致他们用永久性的标记来装饰您的墙？哈哈，这时你该怎么办，怎么才能去除这些痕迹，这时酒精在次闪亮登场，您可以用蘸有水和酒精的纸巾或布，然后如图所示在墙上有标记的地方上擦拭，即可清除掉这些痕迹。抱歉，小凡高...下次再试。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922899431275.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;7、百叶窗&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;百叶帘价格适中，非常适合控制房间的光线。如果他们不那么容易把尘土展示给我们看到就好了。卧式百叶窗就像是灰尘和污垢的磁铁。这个可不用怕，咱们跳过昂贵的除尘喷雾剂，然后使用蘸有酒精的柔软布快速清洁吧。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922911880773.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;8、发胶残留物&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;当您把头发弄得恰到好处时，保留这个发型是很必要的，这样您可以让看到你的每个人欣赏到，这个时候发胶必不可少！而且，当然，一旦喷发剂（从字面上看）浮在空中，它就会掉下来，并在您的镜子和浴室柜台上沉降下来，这些残留的喷发剂是一种粘性物。就像顽固的价格标签一样很难去除，还容易沾染其他灰尘，这时你只要在这些表面上使用酒精擦拭便可以轻松擦去这些粘性物质。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;http://localhost/content/uploadfile/20201229/them_160922900846254.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;9、台面&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;您知道那些说您厨房的不同地方有多脏的研究吗？是的，忽略这些，它们会令人恐惧。只要您经常对柜台进行消毒，就可以了。一份水和一份外用酒精的混合物制成一种超级简单的消毒剂，适合在密封的花岗岩台面上使用。将其喷洒，静置一分钟，然后用干净的布擦去。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922903994891.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;10、你的手&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;好吧，如果您不想知道柜台有多脏，那您绝对是不想自己动手做事。您是否喜欢纯天然的DIY替代品，而不是昂贵的或化学负载的清洁剂？那么用酒精自制您的洗手液吧。酒精加上芦荟凝胶和香精油等其他物品，您便可以制成实际上闻起来很香的消毒剂。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922905046282.jpg&quot;&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;";s:7:"excerpt";s:534:"可能在您浴室抽屉的后部有一个瓶子在滚来滚去，但是您实际上多久使用一次搓酒？这种不可饮用的产品也被称为异丙醇，曾经大量用于治疗伤口。不再认为这是明智的选择，但是摩擦酒精仍然有一个目的：便宜，具有抗菌特性并且粘性表面与其功效不匹配。通过这10个清洁技巧，将其从浴室中拉出并扩大其使用寿命。1、地毯如果您有孩子，宠物或者不灵巧的时候，您必须随时准备对一些可能泄漏在地";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"4";s:4:"type";s:1:"a";s:4:"eyes";s:1:"8";s:7:"goodnum";s:1:"1";s:6:"badnum";s:1:"1";s:6:"saynum";s:1:"0";s:7:"filenum";s:2:"11";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"生活";s:8:"collects";i:1;s:6:"arturl";s:28:"http://localhost/life/8.html";s:7:"sorturl";s:26:"http://localhost/sort/life";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:64:"http://localhost/content/uploadfile/20201229/160922866249435.jpg";}i:9;a:33:{s:2:"id";s:1:"9";s:5:"title";s:44:"10种惊人的残余橘子皮的使用方法";s:4:"date";s:10:"1609229227";s:7:"content";s:7780:"&lt;p&gt;桔子是可以保存的近乎理想的水果，很大程度上是因为它们的果皮是纯天然包装的完美典范。它经久耐用，可以防止瘀伤或变质，易于打开，而且最重要的是，使用完后可以100％降解。但是，不要将它们直接放入垃圾中。橘子皮在房子周围有数十种方便而出人意料的用途。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922935458298.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;1、清洁微波炉&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;微波炉是多功能的，备受喜爱的设备，它们通常是厨房中使用最多的设备。不幸的是，这意味着它们也是最快被弄脏的，如果不加以处理，这些飞溅会迅速变成顽固的，固定的混乱。为了轻松清洁微波炉，请切碎一些橙子皮，然后将其放在可微波加热的碗或量杯中。持续加热5至8分钟，直到将其内表面彻底蒸干，然后再静置10分钟，然后将其擦掉。果皮中的挥发油与蒸汽结合，会使附着的油脂疏松并飞溅，因此容易擦去。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922936952953.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;2、保护植物&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;猫臭名昭著的室内植物，橘子皮可以帮助。猫讨厌皮中的芳香族挥发油，因此将切碎的皮注入水中，然后将其过滤到喷雾瓶中。用混合物将植物喷雾，猫将远离。对于阔叶植物，只需用果皮擦拭即可达到相同的效果。在花园里，在您的植物周围放置桔皮将有助于防止，蚂蚁和蚜虫进入海湾。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922938296432.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;3、保持表面清洁&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;醋是一种出色的无毒全屋清洁剂，橘子皮使它变得更好。将您的果皮切碎，然后放入冰箱中的醋中浸泡一周左右。将混合物过滤到喷雾瓶中，并在家庭中用作通用清洁剂。橘皮中的油增加了醋的清洁和消毒能力，令人愉悦的橘子香气降低了其相对刺耳的气味。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922939323851.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;4、轻松生火&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;劈啪作响的火是壁炉或后院火坑中的一种令人舒心的东西，当您露营时，它可以使享受与潮湿，寒酸的痛苦有所不同。橘皮可以帮助您更轻松地点火。让您的果皮静置并在户外干燥，或者通过在脱水机或温暖的烤箱中干燥果皮来加快过程。干燥的果皮由于具有天然油脂，很容易着火，并且燃烧时间长于纸张。当它们燃烧时，它们还会给您的火带来令人愉悦的芬芳。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922941072514.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;5、给木头一个美丽的光泽&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;木制家具可为任何房间带来温暖和美感，但灰尘，手印和轻微擦伤会很快使之变钝。当然，您可以使用许多商业上光剂来恢复木材的美感，但这并不是完全必要的。要快速自然地刷新家具和其他木质表面，只需用橙皮擦拭即可。它柔和的酸度会擦去灰尘和手印，而天然柑橘油则使表面恢复至美丽的光泽。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922942249416.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;6、口腔卫生&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;众所周知，每个孩子吃了一块橙色的楔子后留下的长方形果皮恰好是正确的大小和形状，可以塞进嘴里，露出橙色的笑容。不要为自己的孩子气而感到尴尬。除了娱乐价值外，橘皮还具有一些口腔卫生超级功效，甚至可以使您的牙医微笑。用橘子皮摩擦牙齿有助于擦去牙菌斑，柑橘中的油脂可以杀死牙齿，牙龈和上颚的异味细菌，从而清新口腔。柑橘的温和酸度也有助于美白牙齿。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922943228734.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;7、清新空气&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;剩余的橘子皮可用于多种方式，以清新空气并掩盖家里的异味。要掩盖令人不愉快的烹饪气味，请在炉子上一些新鲜果皮和肉桂棒。将果皮倒入水或伏特加酒中，然后将混合物过滤到喷雾瓶中，并在产生难闻气味的地方喷雾。制作小袋或小袋干果皮，然后将它们放在闷的壁橱，梳妆台抽屉或时髦的鞋子中。将干果皮与药草，花朵，香料或精油混合，制成您自己的花香，可以将其煮沸以产生高冲击力，或者将其放在碗中即可使房间轻柔清新。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922944359336.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;8、宠爱自己&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;在搅拌机或食品加工机中将“嗡嗡”残留的橙皮几乎变成糊状，然后将其放入装有足够伏特加酒的梅森罐子中。将其放置几天，以便油可以分离出来，然后将混合物过滤到浅盘中，并使酒精蒸发。在您的浴缸中使用几滴所得的橙油，以放松身心并保持清新。或者，将磨碎的果皮与糖或盐混合，制成爽肤的身体磨砂膏。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922945452278.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;9、轻轻地去除斑点&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;您当地药房的皮肤护理过道里充满了可以帮助漂白老年斑和细小斑点的产品。令人惊讶的是，农产品过道也是如此。橙皮的天然油和柔和的酸效果非常好，可以最大程度地减少雀斑，胎记和其他形式的变色现象。丢弃或堆肥之前，只需用橙皮擦拭受影响的部位即可。水果皮还可以帮助减少妊娠纹和轻微疤痕的可见度。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922946528300.jpg&quot;&gt;&lt;/p&gt;&lt;p&gt;10、狡猾&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;橘子皮也有许多狡猾的用途。例如，可以用石蜡或蜂蜡填满挖空的半橙色果皮，并用于与朋友或单独在浴缸周围的户外聚会中制作装饰蜡烛。或者，将两半加满灯油，然后将髓的中心带用作灯芯。长而整齐的干果皮条可用作花圈和插花的装饰和芳香元素。将果皮干燥并粉碎后，可将其放入模制的蜡烛或自制肥皂条中，在其中散发出新鲜的香味和一些额外的擦洗力。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;../content/uploadfile/20201229/them_160922947995333.jpg&quot;&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;";s:7:"excerpt";s:532:"桔子是可以保存的近乎理想的水果，很大程度上是因为它们的果皮是纯天然包装的完美典范。它经久耐用，可以防止瘀伤或变质，易于打开，而且最重要的是，使用完后可以100％降解。但是，不要将它们直接放入垃圾中。橘子皮在房子周围有数十种方便而出人意料的用途。1、清洁微波炉微波炉是多功能的，备受喜爱的设备，它们通常是厨房中使用最多的设备。不幸的是，这意味着它们也是最快被弄脏";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"4";s:4:"type";s:1:"a";s:4:"eyes";s:1:"5";s:7:"goodnum";s:1:"1";s:6:"badnum";s:1:"1";s:6:"saynum";s:1:"0";s:7:"filenum";s:2:"10";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"生活";s:8:"collects";i:1;s:6:"arturl";s:28:"http://localhost/life/9.html";s:7:"sorturl";s:26:"http://localhost/sort/life";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:64:"http://localhost/content/uploadfile/20201229/160922935451726.jpg";}i:3;a:33:{s:2:"id";s:1:"3";s:5:"title";s:78:"社交英语：点赞、关注、加好友等社交热词用英语怎么说？";s:4:"date";s:10:"1609204198";s:7:"content";s:3392:"&lt;p&gt;&lt;b&gt;关注 follow&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;I can't decide if I should follow my ex-boyfriend on a
microblog.&lt;/p&gt;
&lt;p&gt;我无法决定是否应该在微博上关注我前任男友。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;取消关注 unfollow&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;You can choose to simply unfollow those users, block them or
report the accounts to Twitter, as well - all with just one
click.&lt;/p&gt;
&lt;p&gt;只需点击一下鼠标，，你就可以选择取消关注、屏蔽那些用户或向推特举报那些账号。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;粉丝 follower&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Did I tell you Victoria Beckham has just become my follower?&lt;/p&gt;
&lt;p&gt;我有告诉你贝嫂刚成为我的粉丝吗？&lt;/p&gt;
&lt;p&gt;&lt;b&gt;分享 share&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Lots of parents share cute photos of their babies on social
media sites.&lt;/p&gt;
&lt;p&gt;很多父母在社交媒体网站上分享自己孩子的萌照。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;回复 reply&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;We try to reply to all online inquiries within a week.&lt;/p&gt;
&lt;p&gt;我们争取在一周内回复所有在线问询。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;转发 repost&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;This is so useful I am going to repost it.&lt;/p&gt;
&lt;p&gt;这个太有用了我得转发。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;评论 comment&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Why don't you comment?&lt;/p&gt;
&lt;p&gt;你为什么不评论下呢？&lt;/p&gt;
&lt;p&gt;&lt;b&gt;赞/点赞 like&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Her post only received one like.&lt;/p&gt;
&lt;p&gt;她发的帖子才收到一个赞。&lt;/p&gt;
&lt;p&gt;This image has been liked thousands of times on Facebook.&lt;/p&gt;
&lt;p&gt;这张照片在Facebook上收获了数千次的点赞。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;加好友 friend&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;She was so surprised when her ex-boyfriend friended her.&lt;/p&gt;
&lt;p&gt;她很惊讶她的前男友加她为好友。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;删除/解除好友 unfriend&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Sixty percent of those polled say that it is &quot;completely
acceptable&quot; to unfriend an ex-boyfriend or ex-girlfriend.&lt;/p&gt;
&lt;p&gt;60%的受访者称与前男友或前女友解除好友关系“完全可以接受”。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;私信 private message/direct message&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;You can only send direct message to those who follow you.&lt;/p&gt;
&lt;p&gt;你只能给关注你的人发私信。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;朋友圈 Moments（official name）&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;She shared her holiday pictures on her Moments.&lt;/p&gt;
&lt;p&gt;她在朋友圈里晒了她度假的照片。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;@ （音at）&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;You can @ us on microblog.&lt;/p&gt;
&lt;p&gt;你可以在微博上点我们名啊。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;# （音hashtag）&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;You should use # before a trending topic.&lt;/p&gt;
&lt;p&gt;你应该在热门话题前加#。&lt;/p&gt;
&lt;p&gt;&lt;b&gt;简介/个人资料 profile&lt;/b&gt;&lt;/p&gt;
&lt;p&gt;Most social media sites ask you to upload a photo to your
profile.&lt;/p&gt;
&lt;p&gt;大多数社交媒体网站都让你在个人资料部分上传你的照片。&lt;/p&gt;
&lt;br&gt;
";s:7:"excerpt";s:234:"关注 follow
I can't decide if I should follow my ex-boyfriend on a
microblog.
我无法决定是否应该在微博上关注我前任男友。
取消关注 unfollow
You can choose to simply unfollow those users, block them or
r";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"4";s:4:"type";s:1:"a";s:4:"eyes";s:1:"4";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"网络";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"生活";s:8:"collects";i:1;s:6:"arturl";s:28:"http://localhost/life/3.html";s:7:"sorturl";s:26:"http://localhost/sort/life";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/14.jpg";}i:1;a:33:{s:2:"id";s:1:"1";s:5:"title";s:12:"我的笔记";s:4:"date";s:10:"1609137850";s:7:"content";s:54:"这是我的第一篇笔记记录我的生活点滴！";s:7:"excerpt";s:27:"我的第一个个人文集";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"4";s:4:"type";s:1:"a";s:4:"eyes";s:1:"4";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:1:"1";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"生活";s:8:"collects";i:1;s:6:"arturl";s:28:"http://localhost/life/1.html";s:7:"sorturl";s:26:"http://localhost/sort/life";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:62:"http://localhost/content/template/ideashu/images/randoms/7.jpg";}i:12;a:33:{s:2:"id";s:2:"12";s:5:"title";s:15:"手工客笔记";s:4:"date";s:10:"1609565333";s:7:"content";s:21:"手工客笔记描述";s:7:"excerpt";s:21:"手工客笔记描述";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"3";s:4:"type";s:1:"a";s:4:"eyes";s:1:"1";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:1:"3";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"手工";s:8:"collects";i:0;s:6:"arturl";s:28:"http://localhost/diy/12.html";s:7:"sorturl";s:25:"http://localhost/sort/diy";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/27.jpg";}i:7;a:33:{s:2:"id";s:1:"7";s:5:"title";s:87:"相册本diy手工创意自粘式宝宝成长纪念册大容量情侣恋爱家庭影集";s:4:"date";s:10:"1609219180";s:7:"content";s:661:"&lt;p style=&quot;text-align: center;&quot;&gt;相册本diy手工创意自粘式宝宝成长纪念册大容量情侣恋爱家庭影集&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;18寸皮纹相册 大本 文艺 浪漫&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;/p&gt;&lt;p&gt;&lt;video src=&quot;../content/uploadfile/20201229/160921939056458.mp4&quot; controls=&quot;&quot;&gt;&lt;/video&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br&gt;&lt;/p&gt;";s:7:"excerpt";s:125:"相册本diy手工创意自粘式宝宝成长纪念册大容量情侣恋爱家庭影集18寸皮纹相册 大本 文艺 浪漫";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"5";s:4:"type";s:1:"a";s:4:"eyes";s:1:"1";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"1";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"0";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:8:"sortname";s:6:"好物";s:8:"collects";i:1;s:6:"arturl";s:29:"http://localhost/thing/7.html";s:7:"sorturl";s:27:"http://localhost/sort/thing";s:10:"authorname";s:9:"管理员";s:9:"authorurl";s:25:"http://localhost/author/1";s:3:"src";s:63:"http://localhost/content/template/ideashu/images/randoms/18.jpg";}}}