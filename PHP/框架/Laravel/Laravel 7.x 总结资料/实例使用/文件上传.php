<?php
	4）文件上传：
		①常用：
			$request->file('pic')->move('Path','fileName');

		②使用驱动(方式多种实现,可选择存储服务器[用独立服务器专门存储文件])

			A. config/filesystems.php 文件添加或修改'disks'

			B. .env 文件,添加上 'FILESYSTEM_DRIVER=disk'

			C. 使用驱动实现文件上传：
				a. $path = $request->file('pic')->store('disk');
				b. $path = Storage::putFile('disk',$request->file('pic'));
				[加上As,即可修改文件名]
				c. $path = $request->file('pic')->storeAs('disk','fileName');
				d. $path = Storage::putFileAs('disk',$request->file('pic'),'fileName');

			D.查看文件存储网络路径：return asset('storage/'.$path);

			E.终端输入：php artisan storage:link
			（如果报错或调试失败,请检查AB两步的配置文件及代码使用的disk）

			F.调试：浏览器粘贴D步骤的路径,是否能够显示图片