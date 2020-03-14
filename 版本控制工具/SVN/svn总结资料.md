零、SVN版本控制系统

	为什么使用？代码管理，团队分工合作，版本回退。

一、下载安装

	1）官网下载：https://tortoisesvn.net/downloads.html

	2）软件包管理器下载：yum,brew... subversion/svn

二、在windwos下使用(右键菜单栏操作,图形界面很爽)
	
	1）建立远程仓库github/gitee;

	2）本地项目：新建空目录->右键"SVN checkout"->填写项目svn地址、用户名和密码;
	
	3）图标介绍：（与服务器相比较）✅：文件最新；❗️：文件被修改过；黄色！：文件冲突；➕：文件加入版本控制中;

	4）新添文件："TortoiseSVN"->"Add"->"SVN Commit";
	
	5）删除文件："TortoiseSVN"->"Delete"->"SVN Commit";
	
	6）重命名文件："TortoiseSVN"->"Rename"->"SVN Commit";

	7）每次工作和提交前都需要更新一下："SVN Update"

	8）查看日志："TortoiseSVN"->"Show log"

	9）检查未提交的修改："TortoiseSVN"->"Check for modifications"

	10）版本库浏览："TortoiseSVN"->"Repo-browser"

	11）版本回退(选择)："TortoiseSVN"->"Update to reversion"

	12）解决冲突（提交代码时经常会出现与别人修改同一文件甚至同一行）：

		①放弃更新自己的代码并提交,你的代码复制进去后提交："TortoiseSVN"->"Revert"->"SVN Commit"
		②双方协议代码更改后提交："TortoiseSVN"->"Editconflicts"->"SVN Commit"
	
	13）添加忽略文件："TortoiseSVN"->"Add to ignore list"
	
三、在Linux下使用

	1）下载服务器项目到本地：svn checkout Server_Url(http:// or svn://)

	2）添加文件至版本库：svn add fileName

	3）提交文件到服务器：svn commit -m "详细说明" [fileName]
					 svn ci -m ""
					
	4）更新本地项目：svn update

	5）加锁文件：svn lock -m "" file

	6）解锁文件：svn unlock file

	7）版本回退：svn update -r 版本号
			   svn up

	8）查看目录状态：svn status
				   svn st

	9）删除文件：svn delete file -m ""

	10）查看日志：svn log

	11）查看文件信息：svn info file

	12）比较文件差异：svn diff file

	13）合并文件：svn merge -r m:n file (将m和n版本合并到file文件)

	14）解决(移除)冲突：svn resolved

	15）设置忽略文件：svn propedit svn:ignore .
					(添加报错 SVN_EDITOR请看第16点)

	16）设置忽略文件报错,原因是没有指定默认编辑器,做以下操作：

			vi ~/.bash_profile
			export SVN_EDITOR=vim
			source ~/.bash_profile
			svn propedit svn:ignore .

	17）更多详细命令请查看：https://blog.csdn.net/qq_27968607/article/details/55253997
	
四、忽略文件：运行文件、缓存文件、上传文件、临时文件不必上传到服务器

五、Linux下搭建svn服务器

	1）搭建服务器很简单

		A.安装subverson：yum -y install subversion
		B.新建svn目录：mkdir /home/svn
		C.新建版本仓库：sunadmin create /home/svn/<project>
		D.启动服务器：svnserve -d -r /home/svn
		E.测试服务器：svn co svn://ip/<project>

	2）本地服务器使用

		A.下载项目："SVN checkout"->填写URL of repository:"svn://ip/project"
		B.update/commit/等日常使用

	3）服务器配置（用户管理权限,以shop仓库为例子）

		A.开启配置：vim /home/svn/shop/conf/svnsever.conf

			去除注释：password-db = passwd
					authz-db = authz

		B.添加用户：vim /home/svn/shop/conf/passwd

					[users]
					root = 123456
					shop = admin
					...
					(左为用户名,右为密码)

		C.访问权限：vim /home/svn/shop/conf/authz

					[groups]
					admin = root,shop   //添加组成员
					[shop:/]            //项目仓库
					@admin = rw         //admin组有读写权限
					body = r  		    //body用户有读权限

		D.重启服务：ps aux | grep svn //查进程id号
				  kill -9 ID号
				  svnserver -d -r /home/svn