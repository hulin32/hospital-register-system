医院挂号系统
=========================
有关laravel框架的详细部署及使用要求请参照其官方文档：
http://www.golaravel.com/laravel/docs/4.2/

Laravel 框架对系统环境有如下要求：

* PHP >= 5.4
* MCrypt PHP 扩展
* 需要为 app/storage 目录下的文at件设置写权限。
* 从 PHP 5.5 版本开始，针对某些操作系统的安装包需要你自己手工安装 PHP 的 JSON 扩展模块。如果你使用的是 Ubuntu，可以通过,  apt-get install php5-json 命令直接安装。
* Laravel框架通过设置 public/.htaccess 文件去除链接中的index.php。 如果你你的服务器使用的是 Apache，请确保开启 mod_rewrite 模块。

项目部署
=======
#### 修改配置文件
* 首先，将app/config目录下的database.php.example重命名为database.php，并将里面有关数据库的设置修改为自己本地的数据库设置
* 然后，将该目录下的weixin.php.example重命名为weixin.php，并
设置你的app_id和app_secret
```ruby
cp app/config/database.php.example app/config/database.php
# edit your database password

cp app/config/weixin.php.example app/config/weixin.php
# edit weixin app_id and app_secret
```

#### 清空数据库并运行迁移和数据填充
重新建立数据库，注意这里数据库的名字要与app/config/database.php文件中设置的相同。
``` ruby
DROP DATABASE hospital_register_system;
CREATE DATABASE `hospital_register_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

php artisan migrate
php artisan db:seed
```

#### 配置虚拟主机
在apache安装目录下的conf目录中，找到httpd.conf文件，确保已经成功在该文件中引入了配置虚拟主机的httpd-vhosts.conf文件
``` php
# Virtual hosts
Include <apache_dir>/extra/httpd-vhosts.conf
```
打开httpd-vhosts.conf文件，将里面原有的内容清除（如果之前没有配置过虚拟主机的话，配置过就可以跳过这里了），
然后加入以下内容：
``` php
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "<path_to_project_dir>/public"
    ServerName hospital.com
    ErrorLog "<path_to_apache>/logs/cong-error_log"
    CustomLog "<path_to_apache>/logs/cong-access_log" common
    <Directory "<path_to_project_dir>/">
        DirectoryIndex index.php index.html
        Order allow,deny
        Allow from all
        AllowOverride All
        Options Indexes FollowSymLinks MultiViews
    </Directory>
</VirtualHost>
```
注意：配置虚拟主机之后，apache默认的服务器访问路径会被覆盖为第一个虚拟主机对应的地址，所以要将原来默认的访问路径也配置成一个虚拟主机放在httpd-vhosts.conf文件的最前面

#### 修改hosts文件
找到本地系统下的hosts文件，并在文件末尾添加如下内容。
windows系统下的hosts文件路径为：c:\windows\system32\drivers\etc
OS X和Linux系统下的hosts文件路径为：/etc/hosts
``` php
hospital.com        127.0.0.1
```

#### 安装composer管理的PHP依赖包
laravel的依赖包采用composer进行管理，在项目跟目录下运行以下命令来安装依赖包
注意：composer install 之前要先删除项目根目录下的composer.lock文件，否则会导致命令运行失败
``` php
composer install
```

### 修改Sentry配置
使用composer安装好PHP依赖包后，运行如下命令
``` php
php artisan config:publish cartalyst/sentry
```
然后到app/config/packages/cartalyst/sentry/目录下，
修改config.php文件中'login_attribute'字段:
``` php
'login_attribute' => 'phone'
```

#### 编译生成前端代码
首先需要保证本地已经安装了nodejs的运行环境和nodejs使用的包管理工具npm，可以通过运行以下命令来查看是否已经安装了它们：
``` php
node -v
npm -v
```
安装好npm之后，通过npm来安装前端项目管理工具grunt
``` php
npm install -g grunt-cli
```
同时安装前端grunt运行时需要用到的依赖包，在public目录下运行以下命令来安装
``` php
npm install
```
上述步骤都执行完后，在public目录下运行grunt命令，即可得到编译生成的前端js和css代码
``` php
grunt
```

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
