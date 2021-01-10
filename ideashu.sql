-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2021-01-08 09:06:07
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ideashu`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(254) NOT NULL COMMENT '标题',
  `date` varchar(12) NOT NULL COMMENT '日期',
  `content` longtext NOT NULL COMMENT '内容',
  `excerpt` longtext NOT NULL COMMENT '摘要',
  `key` varchar(254) NOT NULL COMMENT '关键字',
  `alias` varchar(254) NOT NULL COMMENT '连接别名',
  `author` int(10) NOT NULL DEFAULT '0' COMMENT '作者 0 佚名, 1管理员  外键 用户id',
  `s_id` int(10) NOT NULL DEFAULT '-1' COMMENT '分类 -1未分类 外键 分类id',
  `type` varchar(8) NOT NULL DEFAULT 'a' COMMENT '类型  a 文章 p 页面',
  `eyes` int(10) NOT NULL COMMENT '阅读量',
  `goodnum` int(10) NOT NULL COMMENT '点赞数',
  `badnum` int(10) NOT NULL COMMENT '踩数',
  `saynum` int(10) NOT NULL COMMENT '评论数',
  `filenum` int(10) NOT NULL COMMENT '附件数',
  `mark` varchar(32) NOT NULL COMMENT 'T 置顶，ST分类置顶，Y原创，Z转载，H热门，J加精',
  `copyrights` int(1) NOT NULL DEFAULT '1' COMMENT '版权，禁止转载 1可转载，0 禁止转载',
  `show` int(1) NOT NULL DEFAULT '1' COMMENT '显示 1 显示，0隐藏',
  `sayok` int(1) NOT NULL DEFAULT '1' COMMENT '允许评论 1 允许，0不允许',
  `template` varchar(254) NOT NULL COMMENT '模板',
  `password` varchar(128) NOT NULL COMMENT '加密密码',
  `pic` varchar(255) NOT NULL COMMENT '主图',
  `tags` text NOT NULL COMMENT '标签 外键 标签id 多标签用,分割',
  `checkok` int(1) NOT NULL COMMENT '审核 1 已审核，0 未审核 ',
  `getsite` varchar(128) NOT NULL DEFAULT '网络' COMMENT '来源名称',
  `geturl` varchar(254) NOT NULL COMMENT '来源连接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `date`, `content`, `excerpt`, `key`, `alias`, `author`, `s_id`, `type`, `eyes`, `goodnum`, `badnum`, `saynum`, `filenum`, `mark`, `copyrights`, `show`, `sayok`, `template`, `password`, `pic`, `tags`, `checkok`, `getsite`, `geturl`) VALUES
(1, '关于', '1609893601', '<p>一个个丰富多彩的设计师作品背后，你的独一无二遇到TA的一见钟情。有研究说，一见钟情只需七秒，而这七秒的背后是彼此的乐趣和生活态度，每一个作品，都带着创作者的故事走入欣赏者的生活，让彼此的生活发生碰撞联结，不露声色。</p><p>&nbsp;一个热爱创作的人，一定是热爱生活，追求梦想和完美的。所以我们会不停的学习，学习如何做美食，自己做一个包包，甚至是一件趁手的乐器...&nbsp;</p><p>在这个发现与分享的旅程中，不断的付出还有收获，最终，我们的生活和生活态度，也会慢慢的发生改变！</p><p>这是一种新的生活态度。</p><p>创意书 就是这样的一个分享生活社区，让创作者的故事走入欣赏者的生活，让梦想家与实践者发生碰撞联结，并分享彼此的创作、文章、话题、碎碎念...</p><p>以及生活态度。 创意书&nbsp;探索生活的可能性。</p>', '', '', 'about', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(2, '免责声明', '1609893747', '<p><b>总则</b></p><p><b><br></b></p>\r\n<p>用户在接受 创意书 服务之前，请务必仔细阅读本条款并同意本声明。</p>\r\n<p>用户直接或通过各类方式（如站外API引用等）间接使用创意书服务和数据的行为，都将被视作已无条件接受本声明所涉全部内容；若用户对本声明的任何条款有异议，请停止使用 创意书所提供的全部服务。</p>\r\n<p><b><br></b></p><p><b>第一条</b></p><p><b><br></b></p>\r\n<p>用户以各种方式使用 创意书服务和数据（包括但不限于发表、宣传介绍、转载、浏览及利用 创意书或 创意书用户发布内容）的过程中，不得以任何方式利用 创意书直接或间接从事违反中国法律法规，以及社会公德的行为。用户应当恪守下述承诺：</p>\r\n<p>1. 发布、转载或提供的内容符合中国法律法规、社会公德；</p>\r\n<p>2.不得干扰、损害和侵犯 创意书的各种合法权利与利益；</p>\r\n<p>3.不得干扰、损害和侵犯其他 创意书用户的各种合法权利与利益；</p>\r\n<p>4.遵守 创意书以及与之相关的网络服务的协议、指导原则、管理细则等。</p>\r\n<p>创意书有权对违反上述承诺的内容予以删除。</p>\r\n<p><b><br></b></p><p><b>第二条</b></p><p><b><br></b></p>\r\n<p>1.创意书仅为用户发布的内容提供存储空间， 创意书不对用户发表、转载的内容提供任何形式的保证：不保证内容满足您的要求，不保证 创意书的服务不会中断。因网络状况、通讯线路、第三方网站或管理部门的要求等任何原因而导致您不能正常使用 创意书， 创意书不承担任何法律责任。</p>\r\n<p>2. 用户在 创意书发表的内容（包含但不限于 创意书目前各产品功能里的内容）仅表明其个人的立场和观点，并不代表 创意书的立场或观点。作为内容的发表者，需自行对所发表内容负责，因所发表内容引发的一切纠纷，由该内容的发表者承担全部法律及连带责任。 创意书不承担任何法律及连带责任。</p>\r\n<p>3. 用户在 创意书发布涉嫌侵犯他人知识产权或其他合法权益的内容，经相关方提供初步证据，创意书有权先行予以删除，并保留移交司法机关查处的权利。参照相应司法机关的查处结果， 创意书对于网站发布内容的处置具有最终决定权。</p>\r\n<p>4. 个人或单位如认为 创意书上存在侵犯自身合法权益的内容，应准备好具有法律效应的证明材料，及时与 创意书取得联系，以便 创意书迅速做出处理。</p>\r\n<p><b><br></b></p><p><b>隐私信息收集与保护&nbsp;</b></p>\r\n<p><b>Personal Iinformation Collected and Usage</b></p><p><b><br></b></p>\r\n<p>1. 在您注册 创意书会员时、使用 创意书产品或服务、访问 创意书网页， 创意书会收集你的个人身份识别资料。 创意书也会收集来自商业伙伴的身份识别资料。只要你在 创意书成功注册并登录服务器，我们将可以识别你。</p>\r\n<p>2. 您可以随时修改您的个人信息和密码，请谨慎保护您的密码，防止密码被盗，个人信息外泄。</p>\r\n<p>3.&nbsp; 创意书会将这些资料用于：</p>\r\n<p>（1）网站用户的信息统计工作；</p>\r\n<p>（2）优化为您提供的服务及体验工作；</p>\r\n<p>（3）您所同意的其他用途。</p>\r\n<p>4.&nbsp; 创意书非常重视对用户隐私权的保护， 创意书在此郑重承诺：不会在未获得用户许可的情况下擅自将用户的个人资料信息出租或出售给任何第三方。除以下免责条款外：</p>\r\n<p>（1）您同意公开你的个人资料，享受为您提供的产品和服务；</p>\r\n<p>（2）创意书需要听从法庭传票、法律命令或遵循法律程序；</p>\r\n<p>（3）创意书发现您违反了 创意书服务条款或 创意书其它使用规定。</p>\r\n<p>5. 出现下列情况时本网站不承担任何责任</p>\r\n<p>（1）您同意让第三方共享资料；</p>\r\n<p>（2）您虽未同意，但由于您将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人资料泄露。</p>\r\n<p>（3）只有透露您的个人资料，才能提供您所要求的产品和服务；</p>\r\n<p>（4）任何由于不可抗力、黑客政击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被篡改等。</p>\r\n<p>（5）由于与 创意书链接的其它网站所造成之个人资料或相关内容泄露及由此而导致的任何法律争议和后果。</p>\r\n<p>（6）我们发现您违反了 创意书服务条款或其他产品及服务的使用规定。</p>\r\n<p><b><br></b></p><p><b>附则</b></p><p><b><br></b></p>\r\n<p>对免责声明的解释、修改及更新权均属于 创意书所有。</p><p><br></p>', '', '', 'disclaimer', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(3, '留言', '1609893804', '<p class="comment_header" style="text-align:center;">\r\n	<b><span style="color:#E56600;">相信您的看法可以一针见血！</span></b> \r\n</p>\r\n<p>\r\n	<br>\r\n</p>', '', '', 'message', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 1, '', '', '', '', 1, '', ''),
(4, '联系我们', '1609895147', '联系我们', '', '', 'contact', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(5, '历史', '1609895177', '历史足迹', '', '', 'history', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(6, '下载', '1609895286', '<br>\r\n<br>\r\n<div style="text-align:center;">\r\n	<span style="font-size:24px;">制&nbsp; 作&nbsp; 中&nbsp; ...</span><br>\r\n<br>\r\n<br>\r\n<br>\r\n<br>\r\n</div>', '', '', 'download', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(7, '合作', '1609895701', '合作加盟，广告合作', '', '', 'ads', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(8, '游戏', '1609898042', '游戏', '', '', 'game', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(9, '加入我们', '1609898165', '加入我们', '', '', 'joinus', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(10, '站点地图', '1609898331', '站点地图', '', '', 'sitemap', 1, 0, 'p', 0, 0, 0, 0, 0, '', 0, 1, 0, '', '', '', '', 1, '', ''),
(11, '我的创意', '1609137850', '这是我的第一篇笔记记录我的生活点滴！', '我的第一个个人文集', '', '', 1, 4, 'a', 12, 6, 0, 0, 0, '', 0, 1, 1, '', '', '', '', 1, '', ''),
(12, '我的笔记', '1609900468', '开始你的创作把', '', '', '', 1, 1, 'a', 2, 0, 0, 0, 0, '', 0, 1, 1, '', '', '', '', 1, '', ''),
(13, '免费可商用图片网站', '1609911968', '&lt;p&gt;写笔记，发文章配图是个令人头疼的问题，这里收集一些提供免费可商用的图片源网站。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n&lt;p&gt;1、&lt;a href=&quot;https://pixabay.com/&quot; target=&quot;_blank&quot;&gt;https://pixabay.com/&lt;/a&gt;&amp;nbsp;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是目前非常知名的免授权图片获取站点。在GOOGLE中排名很高。它也是支持中文的少数国外图片站点之一。内容包括：照片、插画、矢量图、视频。有大量的积累图片可供挖掘，国内很多网站的题图、配图都来自于这里。支持CC0共享授权协议。&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;2、&lt;a href=&quot;https://www.pexels.com/ &quot; target=&quot;_blank&quot;&gt;https://www.pexels.com/&amp;nbsp;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;这个图片站，非常像SHUTTERSTOCK，GETTY等专业商业图库。免费而好用，图片质量上等。提供了大量不同尺寸的图片，免注册即可下载。支持CC0共享授权协议。&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;3、&lt;a href=&quot;https://unsplash.com/ &quot; target=&quot;_blank&quot;&gt;https://unsplash.com/&amp;nbsp;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;圈内比较有名的图片网站，很多互联网网站都在采用它的图片。整体风格极欧美化，很酷，也是我个人非常喜欢的站点之一。有意思的是：它们曾做过一个UNSPLASHWALLPAPER的MAC壁纸软件。虽然下架了，但网站的API接口依然存在。&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;4、&lt;a href=&quot;http://source.pixite.co/&quot; target=&quot;_blank&quot;&gt;http://source.pixite.co/&lt;/a&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;一个偏向于风景图片的免授权获取站点。网站的运营者进行了详细的分类制作。总量较少，可以找一些自己感兴趣的。支持CC0共享授权协议。&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;5、&lt;a href=&quot;https://picography.co/&quot; target=&quot;_blank&quot;&gt;https://picography.co/&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Picography是一个有一定知名度的提供高清免费图片素材的网站。素材涵盖商业、科技、城市、文化、时尚、自然、街头风光等类目。&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;6、&lt;a href=&quot;https://www.pixawl.com/&quot; target=&quot;_blank&quot;&gt;https://www.pixawl.com/&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;PIXAWL是一个提供高质量摄影图片、矢量图片和视频素材的网站。相对其他网站，这个网站的素材数量比较少，但是质量还不错。&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;7、&lt;a href=&quot;https://picjumbo.com/&quot; target=&quot;_blank&quot;&gt;https://picjumbo.com/&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;这个网站的创始人自己曾经是网页设计师、摄影师，在几年前的时候他发现免费图片的分辨率都太低了，所以产生了自己做一个分享高清免费图片网站的想法。也可以不用注册，点开图片右键选择“图片另存为”就可以成功下载啦。&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;8、&lt;a href=&quot;https://gratisography.com/&quot; target=&quot;_blank&quot;&gt;https://gratisography.com/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是一个有点古怪又让人喜欢的图片网站哈哈哈，大众+平淡的图片是不会在Gratisography网站上出现的，大部分都会有点恶趣味或者你想不到的创意图片。有空的时候仔细翻一翻这个网站一定会让你找到几张喜欢的图片&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;9、&lt;a href=&quot;https://www.foodiesfeed.com/&quot; target=&quot;_blank&quot;&gt;https://www.foodiesfeed.com/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;这是一个专注于分析美食类免费图片的网站，在这里可以找到许多餐饮的图片，可以作为你学习拍摄美食的构图及光线灵感，也可以用于公众号配图等等。Foodiesfeed上发布的照片都是在 Creative Commons Zero (CCO)许可下授权的，这意味着你可以免费拷贝、修改、分发和使用这些照片，包括商业用途。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;10、&lt;a href=&quot;https://pickupimage.com/&quot; target=&quot;_blank&quot;&gt;https://pickupimage.com/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Pickupimage主要是自然风景、旅行和户外活动相关的场景。也是不需要注册就能免费下载图片，图片同样可以自由用于复制、修改和商业用途。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;11、&lt;a href=&quot;https://visualhunt.com/&quot; target=&quot;_blank&quot;&gt;https://visualhunt.com/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;visualhunt 和前面那些免费图片网站有个很大的区别是它可以通过色彩来搜索图片，某种程度上让大家找图更方便。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;12、&lt;a href=&quot;https://stocksnap.io/&quot; target=&quot;_blank&quot;&gt;https://stocksnap.io/&lt;/a&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;stocksnap资源还是比较丰富的，&lt;span style=&quot;color: rgba(0, 0, 0, 0.85); font-family: webfont, &amp;quot;PingFang SC&amp;quot;; font-size: 15px;&quot;&gt;可自由下载使用的高清晰数码作品素材库，你随时都可以下载自己免费的资源。&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;13、&lt;a href=&quot;https://www.nasa.gov/ &quot; target=&quot;_blank&quot;&gt;https://www.nasa.gov/&amp;nbsp;&lt;/a&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;由NASA发布的炫酷且激动人心的太空照片，是可以无限制使用的！NASA是由纳税人资助的公立机构，对其发布的绝大多数照片并不具有版权，可以尽情使用。当然，极少数除外，比如哈勃望远镜的部分图片。从庞大的图片数量上讲，绝对的业内良心图库呐。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '', 1, 2, 'a', 4, 0, 0, 0, 1, '', 0, 1, 1, '', '', '../content/uploadfile/20210106/160991288257502.jpg', '1', 1, '原创', '');

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(128) NOT NULL COMMENT '名称',
  `pic` varchar(254) NOT NULL COMMENT '图片地址',
  `link` varchar(254) NOT NULL COMMENT '跳转链接',
  `blank` int(1) NOT NULL DEFAULT '0' COMMENT '新页面打开 0 原页面打开 ，1 新页面打开',
  `index` int(10) NOT NULL COMMENT '排序',
  `show` int(1) NOT NULL DEFAULT '1' COMMENT '显示 1 显示 ，0 隐藏',
  `group` int(10) NOT NULL COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='幻灯片' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `name`, `pic`, `link`, `blank`, `index`, `show`, `group`) VALUES
(1, '轮换图1', '../content/uploadfile/banner/banner_160989728253096.jpg', '', 0, 1, 1, 0),
(2, '轮换图2', '../content/uploadfile/banner/banner_160989767585992.jpg', '', 0, 2, 1, 0),
(3, '轮换图3', '../content/uploadfile/banner/banner_160989768998937.jpg', '', 0, 3, 1, 0),
(4, '轮换图4', '../content/uploadfile/banner/banner_160989770121387.jpg', '', 0, 4, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `a_id` int(10) NOT NULL COMMENT '文章ID',
  `name` varchar(128) NOT NULL COMMENT '附件名',
  `size` varchar(32) NOT NULL COMMENT '附件大小',
  `path` varchar(254) NOT NULL COMMENT '附件地址',
  `addtime` varchar(12) NOT NULL COMMENT '上传时间',
  `type` varchar(32) NOT NULL COMMENT '附件类型',
  `width` int(10) NOT NULL COMMENT '宽度',
  `height` int(10) NOT NULL COMMENT '高度',
  `top_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='附件' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `file`
--

INSERT INTO `file` (`id`, `a_id`, `name`, `size`, `path`, `addtime`, `type`, `width`, `height`, `top_id`) VALUES
(1, 13, '桂林', '285736', '../content/uploadfile/20210106/160991288257502.jpg', '1609912882', 'image/jpeg', 960, 640, 0),
(2, 13, 'thum_桂林', '26103', '../content/uploadfile/20210106/them_160991288214295.jpg', '1609912882', 'image/jpeg', 420, 280, 1);

-- --------------------------------------------------------

--
-- 表的结构 `focus`
--

CREATE TABLE IF NOT EXISTS `focus` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pre_uid` int(10) NOT NULL COMMENT '关注者 外键 用户id',
  `pro_uid` int(10) NOT NULL COMMENT '被关注者 外键 用户id',
  `date` varchar(12) NOT NULL COMMENT '关注时间',
  `isok` int(1) NOT NULL DEFAULT '1' COMMENT '关系状态 1 关系正常，0关系破裂',
  `outdate` varchar(12) NOT NULL COMMENT '关系破裂时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户关系' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `link`
--

CREATE TABLE IF NOT EXISTS `link` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sitename` varchar(64) NOT NULL COMMENT '站名',
  `siteurl` varchar(128) NOT NULL COMMENT '连接',
  `description` varchar(254) NOT NULL COMMENT '描述',
  `show` int(1) NOT NULL DEFAULT '1' COMMENT '1 显示 ，0 隐藏',
  `group` int(10) NOT NULL DEFAULT '0' COMMENT '分组',
  `index` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `pic` varchar(254) NOT NULL COMMENT '标识图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `link`
--

INSERT INTO `link` (`id`, `sitename`, `siteurl`, `description`, `show`, `group`, `index`, `pic`) VALUES
(1, '慕课博客', 'http://www.amuker.com', '慕课博客', 1, 0, 1, ''),
(2, '创意书', 'https://www.ideashu.com', '创意书', 1, 0, 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL COMMENT '导航名称',
  `url` varchar(128) NOT NULL COMMENT '导航连接',
  `pic` varchar(254) NOT NULL COMMENT '导航图片',
  `blank` int(1) NOT NULL DEFAULT '0' COMMENT '0 原页面打开 ，1 新页面打开',
  `show` int(1) NOT NULL DEFAULT '1' COMMENT '1 显示 ，0 隐藏',
  `top_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级导航id',
  `index` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `changeok` int(1) NOT NULL DEFAULT '1' COMMENT '1 可更改 ，0 不可改',
  `type` int(1) NOT NULL DEFAULT '-1' COMMENT '0,自定 1,首页 2,系统 3,后台 4,分类 5,单页 6,服务器 7,GAME',
  `type_id` int(10) NOT NULL COMMENT '外键',
  `group` int(2) NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='导航' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `nav`
--

INSERT INTO `nav` (`id`, `name`, `url`, `pic`, `blank`, `show`, `top_id`, `index`, `changeok`, `type`, `type_id`, `group`) VALUES
(1, '主页', '', '', 0, 1, 0, 1, 0, 1, 0, 0),
(2, '登陆', 'login', '', 1, 0, 0, 99, 0, 3, 0, 0),
(3, '发现', 'find', '', 0, 1, 0, 2, 0, 2, 0, 0),
(4, '关注', 'tips', '', 0, 1, 0, 3, 0, 2, 0, 0),
(5, '分类', 'sort', '', 0, 1, 0, 4, 0, 2, 0, 0),
(6, '榜单', 'top', '', 0, 1, 0, 5, 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `key` varchar(254) NOT NULL COMMENT '键',
  `value` longtext NOT NULL COMMENT '值',
  `text` text NOT NULL COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置' AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `text`) VALUES
(1, 'sitename', 'IDEASHU', '网站名称'),
(2, 'siteinfo', '我的第一个网站', '网站简述'),
(3, 'seo_title', '浏览器标题', 'SEO标题'),
(4, 'seo_description', '本站采用PHP+MYSQL制作...', '描述'),
(5, 'seo_key', '个人网站,博客,XX网站', '关键字'),
(6, 'seo_type', '3', 'seo标题方案\n1、文章标题\n2、文章标题+sitename\n3、文章标题+seo_title'),
(7, 'siteurl', 'http://localhost/', '网站域名'),
(8, 'icp', '沪ICP备18007593号-1', '备案号'),
(9, 'footer_info', '<script>\r\n(function(){\r\n    var bp = document.createElement(''script'');\r\n    var curProtocol = window.location.protocol.split('':'')[0];\r\n    if (curProtocol === ''https'') {\r\n        bp.src = ''https://zz.bdstatic.com/linksubmit/push.js'';\r\n    }\r\n    else {\r\n        bp.src = ''http://push.zhanzhang.baidu.com/push.js'';\r\n    }\r\n    var s = document.getElementsByTagName("script")[0];\r\n    s.parentNode.insertBefore(bp, s);\r\n})();\r\n</script>\r\n<script>\r\n(function(){\r\nvar src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";\r\ndocument.write(''<script src="'' + src + ''" id="sozz"><\\/script>'');\r\n})();\r\n</script>', '底部代码'),
(10, 'header_meta', '<meta name="baidu-site-verification" content="fG8MLKRxFV" />', '头部验证'),
(11, 'template', 'ideashu', '模板'),
(12, 'admin_style', 'gray', '后台配色'),
(13, 'art_check', '1', '文章审核'),
(14, 'art_num', '12', '每页文章数'),
(15, 'login_code', '1', '登录验证 1开启 0不开启'),
(16, 'time_zone', 'Asia/Shanghai', '时区'),
(17, 'htmlok', '1', 'html后缀 0 不启动 ，1启动'),
(18, 'aliasok', '1', '连接别名 0 未启动 ，1启动'),
(19, 'url_type', '3', '连接方案\n1、/?blog=1; 动态\n2、/?blog=1; 动态\n3、/type/1.html;分类'),
(20, 'excerpt', '1', '自动摘要 0关闭 ，1开启'),
(21, 'excerpt_long', '120', '摘要字数'),
(22, 'sayok', '1', '是否开启评论0关闭 ，1开启'),
(23, 'say_time', '60', '评论时间间隔 单位s，0不限制'),
(24, 'say_code', '1', '评论验证码 0关闭 ，1开启'),
(25, 'say_check', '0', '评论审核 0不需要 ，1需要'),
(26, 'say_chinese', '0', '评论内容包含中文 0不需要 ，1需要'),
(27, 'say_gravatar', '1', '评论人头像 0不显示 ，1显示'),
(28, 'say_page', '1', '评论分页 0关闭 ，1开启'),
(29, 'say_pnum', '5', '评论每页显示数'),
(30, 'say_order', '1', '0旧评论在前 ，1新评论在前'),
(31, 'reply_code', '0', '回复验证码 0关闭 ，1开启'),
(32, 'file_maxsize', '20', '上传文件最大值,默认2M'),
(33, 'file_type', 'jpg,gif,png,jpeg,mp4,mp3,rar,zip,txt,pdf,docx,doc,xls,xlsx', '允许的文件上传类型'),
(34, 'thumbnailok', '0', '生成缩略图 0不生成 1生成'),
(35, 'thum_imgmaxw', '420', '缩略图限宽，大于该值生成缩略图'),
(36, 'thum_imgmaxh', '480', '缩略图限高，大于该值生成缩略图'),
(37, 'admin_page_num', '12', '后台列表每页显示数'),
(38, 'userpre', 'idea_', '用户名自定义前缀'),
(39, 'mailhost', 'smtp.163.com', '邮件服务器 smtp.163.com   smtp.qq.com'),
(40, 'mail', 'amuke123@163.com', '账号 amuke123@ideashu.com   amuke123@163.com'),
(41, 'mailpswd', 'MFVZHJRACERFHKBV', '发送密码 PFFUGSXSOXMOYKKQ   dmpvsmoxczwbcbca'),
(42, 'mailport', '465', '端口号 465'),
(43, 'new_art_num', '10', '最新文章显示数'),
(44, 'rand_art_num', '12', '随机文章显示数'),
(45, 'hot_art_num', '8', '热门文章显示数'),
(46, 'new_say_num', '10', '最新评论显示数'),
(47, 'top_say_num', '4', '热门评论显示数（神评）'),
(48, 'say_subnum', '20', '评论截取长度'),
(49, 'plugins_list', 'a:0:{}', '开启的插件列表 PHP序列化数据'),
(50, 'widget_list', 'a:0:{}', '系统默认的模块 PHP序列化数据'),
(51, 'diy_widget', 'a:0:{}', '自定义模块 PHP序列化数据'),
(52, 'side1', 'a:0:{}', '边栏 PHP序列化数据'),
(53, 'side2', '', '边栏 PHP序列化数据'),
(54, 'side3', '', '边栏 PHP序列化数据'),
(55, 'side4', '', '边栏 PHP序列化数据');

-- --------------------------------------------------------

--
-- 表的结构 `say`
--

CREATE TABLE IF NOT EXISTS `say` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `a_id` int(10) NOT NULL COMMENT '文章id 外键',
  `top_id` int(10) NOT NULL COMMENT '上级评论id',
  `t_id` int(10) NOT NULL DEFAULT '0' COMMENT '定位主回复',
  `date` varchar(12) NOT NULL COMMENT '时间',
  `posterid` int(10) NOT NULL DEFAULT '0' COMMENT '评论者id 外键',
  `name` varchar(64) NOT NULL COMMENT '评论人昵称',
  `content` text NOT NULL COMMENT '评论内容',
  `mail` varchar(64) NOT NULL COMMENT '邮箱',
  `url` varchar(128) NOT NULL COMMENT '链接',
  `ip` varchar(128) NOT NULL COMMENT 'IP地址',
  `show` int(1) NOT NULL DEFAULT '1' COMMENT ' 1 显示 ，0 隐藏',
  `ischeck` int(1) NOT NULL DEFAULT '1' COMMENT ' 1 已审核 ，0 未审核 默认值与系统配置有关',
  `mark` int(1) NOT NULL DEFAULT '0' COMMENT '0 无标签，1 加精，2神评',
  `good` int(10) NOT NULL DEFAULT '0' COMMENT '赞',
  `bad` int(10) NOT NULL DEFAULT '0',
  `del` int(1) NOT NULL DEFAULT '1' COMMENT '删除，默认 1正常，0删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sort`
--

CREATE TABLE IF NOT EXISTS `sort` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL COMMENT '分类名称',
  `alias` varchar(128) NOT NULL COMMENT '连接别名',
  `pic` varchar(254) NOT NULL COMMENT '分类图片',
  `description` text NOT NULL COMMENT '分类描述',
  `key` text NOT NULL COMMENT '分类关键字',
  `template` varchar(254) NOT NULL COMMENT '模板',
  `group` int(10) NOT NULL DEFAULT '0' COMMENT '分组',
  `top_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级导航id',
  `index` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分类' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `sort`
--

INSERT INTO `sort` (`id`, `name`, `alias`, `pic`, `description`, `key`, `template`, `group`, `top_id`, `index`) VALUES
(1, '创意', 'creative', '../content/uploadfile/sort/sort_160991818065964.jpg', '创意', '创意', '', 0, 0, 1),
(2, '设计', 'design', '../content/uploadfile/sort/sort_160991820666543.jpg', '设计', '设计', '', 0, 0, 2),
(3, '手工', 'diy', '../content/uploadfile/sort/sort_160991822969304.jpg', '手工', '手工', '', 0, 0, 3),
(4, '生活', 'life', '../content/uploadfile/sort/sort_160991825427644.jpg', '生活', '生活', '', 0, 0, 4),
(5, '好物', 'thing', '../content/uploadfile/sort/sort_160991827330983.jpg', '好物', '好物', '', 0, 0, 5),
(6, '好书', 'book', '../content/uploadfile/sort/sort_160991996377618.jpg', '好书', '好书', '', 0, 0, 6),
(7, '技术', 'technology', '../content/uploadfile/sort/sort_160991998721596.jpg', '技术', '技术,科技', '', 0, 0, 7);

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL COMMENT '标签名称',
  `a_id` text NOT NULL COMMENT '文章id 用,分隔',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='标签' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tags`
--

INSERT INTO `tags` (`id`, `name`, `a_id`) VALUES
(1, '免费可商用', '13');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `nickname` varchar(128) NOT NULL COMMENT '昵称',
  `role` varchar(64) NOT NULL COMMENT '权限',
  `ischeck` int(1) NOT NULL DEFAULT '0' COMMENT '审核 1 已审核，0 未审核',
  `photo` varchar(254) NOT NULL COMMENT '头像',
  `date` varchar(12) NOT NULL COMMENT '注册时间',
  `lastdate` varchar(12) NOT NULL COMMENT '最后记笔记时间',
  `sex` int(1) NOT NULL COMMENT '性别 0 女，1 男',
  `birthday` varchar(32) NOT NULL COMMENT '生日',
  `email` varchar(128) NOT NULL COMMENT '邮箱',
  `emailok` int(1) NOT NULL DEFAULT '0' COMMENT '邮箱认证  0 未认证，1已认证',
  `tel` varchar(12) NOT NULL COMMENT '手机',
  `telok` int(1) NOT NULL DEFAULT '0' COMMENT '手机认证  0 未认证，1已认证',
  `description` varchar(254) NOT NULL COMMENT '描述',
  `likesort` text NOT NULL COMMENT '喜欢的分类 分类id 用,分割',
  `collect` text NOT NULL COMMENT '收藏 文章id 用,分割 S|ID',
  `order` int(10) NOT NULL COMMENT '积分',
  `diyurl` varchar(64) NOT NULL COMMENT '个性域名',
  `bgpic` varchar(254) NOT NULL COMMENT '自定义背景',
  `colorstyle` varchar(12) NOT NULL COMMENT '配色方案',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '用户状态 0 正常，1禁言，2封禁，3 永久封禁',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `role`, `ischeck`, `photo`, `date`, `lastdate`, `sex`, `birthday`, `email`, `emailok`, `tel`, `telok`, `description`, `likesort`, `collect`, `order`, `diyurl`, `bgpic`, `colorstyle`, `state`) VALUES
(1, 'admin', '$2y$10$AvP4Y4T7WlRROzuNUO4X/OkVMAsbbbSGLFOGS7USW8IddOJizwVPy', '管理员', 'admin', 1, '../content/uploadfile/avatar/avatar_160991176340190.png', '1609911765', '1609916056', 1, '2020-06-06', 'admin@admin.com', 1, '15555888866', 1, '描述', '', 'a|11', 888, 'amuke123', '', '', 0),
(2, 'user', '$2y$10$/y2f3Ys5auOYireUBqE6a.Ke0jc/1cDrJNlF./XxkzdHAQ/ki4cVy', '束缚の花', 'writer', 1, '../content/uploadfile/avatar/avatar_160991690848482.jpg', '1609916910', '', 0, '', '', 0, '', 0, '', '', '', 0, '', '', '', 0),
(3, 'root', '$2y$10$BCiqP7XkjMXatL1diTdMSuD8Lymy9zpw1JNy0mXUEHIYFyRNcLt.C', '你的名字', 'writer', 1, '../content/uploadfile/avatar/avatar_160991692387574.jpg', '1609916926', '', 0, '', '', 0, '', 0, '', '', '', 0, '', '', '', 0),
(4, 'amuker', '$2y$10$8oT8nq0VYjQSQ6HNFl4HRu.XKEA6XuJ4uB5BQBRMZmTgRwUeyU9qa', '伸手碰阳光', 'writer', 1, '../content/uploadfile/avatar/avatar_160991693213619.jpg', '1609916935', '', 0, '', '', 0, '', 0, '', '', '', 0, '', '', '', 0),
(5, 'amuke123', '$2y$10$UZ2VPRCfq/g5JjY9GFL4bu0SrIcoJf1PDusMi2sGeuQVjfD6e1tgO', '清风饮露', 'writer', 1, '../content/uploadfile/avatar/avatar_160991694453915.jpg', '1609916946', '', 0, '', '', 0, '', 0, '清风饮露', '', 'a|11', 0, '', '', '', 0),
(6, 'xiaoq', '$2y$10$q4eyG4FyrA9v68QDKrrXne5zdhjx2jWENdzbveALwlfp2.LE3nL3q', '小Q', 'writer', 1, '../content/uploadfile/avatar/avatar_160991696145126.jpg', '1609916963', '', 0, '', '', 0, '', 0, '', '', '', 0, '', '', '', 0),
(7, 'ideashu', '$2y$10$AezRnMkaxFaqhjhs3JJu0eNDa8TjMv1N6ojAiRAJZbPBok0TcZZnG', '聆听语声', 'writer', 1, '../content/uploadfile/avatar/avatar_160991698042780.jpg', '1609916982', '', 0, '', '', 0, '', 0, '聆听语声', '', '', 0, '', '', '', 0),
(8, 'cymx', '$2y$10$XDc0fNUtuN2xuOfJHS5RO.gJhTNgNy0W.mBr6SmPPIRWWmHjWU5AO', '蝉音弥夏', 'writer', 1, '../content/uploadfile/avatar/avatar_160991702413125.jpg', '1609917026', '', 0, '', '', 0, '', 0, '蝉音弥夏', '', '', 0, '', '', '', 0),
(9, 'qsch', '$2y$10$dWwnTayle4LJrN4wt7AHUumBFq2vFx8qza1YSosq9x1Z9tHelKawS', '七色彩虹', 'writer', 1, '../content/uploadfile/avatar/avatar_160991700787371.jpg', '1609917009', '', 0, '', '', 0, '', 0, '七色彩虹', '', '', 0, '', '', '', 0),
(10, 'muke', '$2y$10$88FK2ToKM80RejuE10ZOc.ACR.LoC/syjU/RBByjS41hYQXbEiPIC', '创意书', 'writer', 1, '../content/uploadfile/avatar/avatar_160992013230041.jpg', '1609920135', '', 0, '', '', 0, '', 0, '创意书', '', '', 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `name` varchar(128) NOT NULL COMMENT '清单名称',
  `date` varchar(16) NOT NULL COMMENT '创建日期',
  `lastdate` varchar(16) NOT NULL COMMENT '最后更新时间',
  `artids` text NOT NULL COMMENT '笔记清单，用“,”分割',
  `text` text NOT NULL COMMENT '清单说明',
  `pic` varchar(255) NOT NULL COMMENT '清单配图',
  `show` int(11) NOT NULL COMMENT '显隐',
  `follownum` int(10) NOT NULL COMMENT '点赞数',
  `likenum` int(10) NOT NULL COMMENT '喜欢数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='清单' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `wishlist`
--

INSERT INTO `wishlist` (`id`, `uid`, `name`, `date`, `lastdate`, `artids`, `text`, `pic`, `show`, `follownum`, `likenum`) VALUES
(1, 1, '我的清单11', '1609137850', '1609137850', '11,12', '我的清单说明222', '../content/uploadfile/wishlist/wishlist_160992374188582.jpg', 1, 18, 326),
(2, 1, '清单2222', '1609565463', '1609565463', '12', '我的清单说明222', '../content/uploadfile/wishlist/wishlist_160992371590722.jpg', 1, 5, 4),
(3, 1, '清单33333', '1609565463', '1609565463', '11', '我的清单说明222', '../content/uploadfile/wishlist/wishlist_160992372415633.jpg', 1, 0, 0),
(4, 1, '清单44444', '1609137900', '1609137900', '', '我的清单说明222', '../content/uploadfile/wishlist/wishlist_160992373230780.jpg', 1, 0, 0),
(5, 1, '清单555', '1609137900', '1609137900', '', '我的清单说明222', '../content/uploadfile/wishlist/wishlist_160992374926531.jpg', 1, 5, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
