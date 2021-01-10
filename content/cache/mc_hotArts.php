<?php exit;//a:4:{i:15;a:27:{s:2:"id";s:2:"15";s:5:"title";s:60:"centos搭建Apache+php+mysql+phpmyadmin等Web服务器环境";s:4:"date";s:10:"1610155496";s:7:"content";s:9341:"&lt;p&gt;&lt;b&gt;安装Apache&lt;/b&gt;&lt;/p&gt;
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
&lt;/pre&gt;&lt;p&gt;3、测试并使用phpmyadmin&lt;/p&gt;&lt;p&gt;使用浏览器访问http://服务器IP地址ip地址/phpmyadmin&lt;/p&gt;&lt;p&gt;如果出现 The mbstring extension is missing. Please check your PHP configuration.&amp;nbsp;提示，则是缺少php-mbstring，安装php-mbstring&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;yum install php-mbstring&lt;/pre&gt;&lt;p&gt;如果提示&amp;nbsp;The json extension is missing. Please check your PHP configuration.&amp;nbsp;同样安装php-json&amp;nbsp;即可&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot; style=&quot;font-size: 15.4px;&quot;&gt;yum install php-json&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改&lt;/b&gt;&lt;b&gt;Apache&lt;/b&gt;&lt;b&gt;配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/httpd/conf/httpd.conf   //使用vi/vim都是可以的，i进入编辑模式，ESC退出编辑模式，浏览模式下:wq保存并退出文件编辑&lt;/pre&gt;&lt;p&gt;&lt;b&gt;修改PHP配置&lt;/b&gt;&lt;/p&gt;&lt;pre class=&quot;prettyprint lang-other&quot;&gt;vim /etc/php.ini&lt;/pre&gt;&lt;p&gt;&lt;/p&gt;";s:7:"excerpt";s:0:"";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:2:"20";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:6:"原创";s:6:"geturl";s:0:"";s:6:"arturl";s:35:"http://localhost/technology/15.html";}i:18;a:27:{s:2:"id";s:2:"18";s:5:"title";s:4:"cbcv";s:4:"date";s:10:"1610254029";s:7:"content";s:0:"";s:7:"excerpt";s:0:"";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"0";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:6:"arturl";s:24:"http://localhost/18.html";}i:17;a:27:{s:2:"id";s:2:"17";s:5:"title";s:9:"挺好听";s:4:"date";s:10:"1610252181";s:7:"content";s:5:"thtjt";s:7:"excerpt";s:0:"";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:6:"arturl";s:35:"http://localhost/technology/17.html";}i:16;a:27:{s:2:"id";s:2:"16";s:5:"title";s:15:"反对好地方";s:4:"date";s:10:"1610252154";s:7:"content";s:15:"fdhdf&amp;nbsp;";s:7:"excerpt";s:0:"";s:3:"key";s:0:"";s:5:"alias";s:0:"";s:6:"author";s:1:"1";s:4:"s_id";s:1:"7";s:4:"type";s:1:"a";s:4:"eyes";s:1:"0";s:7:"goodnum";s:1:"0";s:6:"badnum";s:1:"0";s:6:"saynum";s:1:"0";s:7:"filenum";s:1:"0";s:4:"mark";s:0:"";s:10:"copyrights";s:1:"0";s:4:"show";s:1:"1";s:5:"sayok";s:1:"1";s:8:"template";s:0:"";s:8:"password";s:0:"";s:3:"pic";s:0:"";s:4:"tags";s:0:"";s:7:"checkok";s:1:"1";s:7:"getsite";s:0:"";s:6:"geturl";s:0:"";s:6:"arturl";s:35:"http://localhost/technology/16.html";}}