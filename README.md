# 1 安装部署

# 1.1 前置依赖

要求部署环境上已经有如下工具:
1.系统环境:Debian Stable ( wheezy 7.8 )
2.服务器: nginx/1.4.6 

3.数据库:mysql/5.5.44
4.php版本 >=5.5.9

# 1.2 安装依赖

# 1.2.1 安装系统工具

在一个干净的debain上安装需要php, php-fpm, curl，composer。

````bash
#安装php环境
sudo apt-get install php5 php5-fpm php5-sybase
在/etc/freetds/freetds.conf中修改新增一行：
````bash
    [global]
            # TDS protocol version
    ;       tds version = 4.2
            tds version = 8.0//新增

````
#安装curl
sudo apt-get install curl


#安装composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
````

# 1.2.2 安装php扩展

中台正常运行需要如下php扩展：Mcrypt/MySQL PDO/CURL/gd。

````bash
sudo apt-get install php5-mcrypt php5-mysql php5-curl php5-gd
````

# 1.3 部署源码

## 1.3.1 从github上获得项目源码

项目源码托管在coding.net上，项目名称为： git@code.sunallies.net:aishan/sunallies-center.git。

````bash
# 使用master分支
git clone git@code.sunallies.net:aishan/sunallies-center.git
git checkout master
````
## 1.3.2 项目目录权限配置

storage：  数据存储目录，用于存储项目缓存数据，需要有写入权限.
bootstrap/cache: 目录的写权限

## 1.3.3 composer加载项目扩展依赖

````bash
#切换到网站根目录下
composer install
````
## 1.3.4 nginx服务器配置

````bash
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
````
# 1.4 配置文件

先复制配置示例：

````bash
#根目录下找到 .env.example
cp .env.example .env
````
.env即该项目配置文件

## 1.4.1 数据库配置

在.env中修改如下配置:

````bash
DB_HOST=120.26.113.176
DB_DATABASE=center
DB_USERNAME=root
DB_PASSWORD=sunallies@0922
````
## 1.4.2 前台数据库配置
````bash
DB_HOST_2=rds7t1x5v77362xp5k05.mysql.rds.aliyuncs.com
DB_DATABASE_2=frontend
DB_USERNAME_2=sam
DB_PASSWORD_2=sun!@#121

#前台数据库配置
DB_HOST_ACTIVITY=rds7t1x5v77362xp5k05.mysql.rds.aliyuncs.com
DB_DATABASE_ACTIVITY=ghlm_activity
DB_USERNAME_ACTIVITY=sam
DB_PASSWORD_ACTIVITY=sun!@#121
````
## 1.4.3 后台SQLSRV配置
````bash
DB_SQLSRV_HOST=rdsrm01d9c2bcx1d9edw.sqlserver.rds.aliyuncs.com,3433
DB_SQLSRV_DATABASE=taview
DB_SQLSRV_USERNAME=test_admin
DB_SQLSRV_PASSWORD=b5f4ffd7_4d52_4962_9212
````

## 1.4.4 redis 配置
````bash
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_DRIVER=redis
````

## 1.4.5 logstach 配置
````bash
REDIS_SERVER_LOG=120.26.113.176
REDIS_PWD_LOG=
REDIS_SERVER_PORT_LOG=6379
REDIS_DATABASE_LOG=6
````

## 1.4.6 wechat 微信配置
````bash
REDIS_SERVER_WECHAT=127.0.0.1
REDIS_PWD_WECHAT=
REDIS_SERVER_PORT_WECHAT=6379
REDIS_DATABASE_WECHAT=13
````

## 1.4.7 邮箱服务器配置
在.env中修改如下配置:
````bash
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mxhichina.com
MAIL_PORT=465
MAIL_USERNAME=center_post@sunallies.com
MAIL_FROM_ADDRESS=center_post@sunallies.com
MAIL_FROM_NAME=center_post@sunallies.com
MAIL_PASSWORD=Center@12
MAIL_ENCRYPTION=ssl
````
用户中心的邮件发送服务将通过此配置邮箱转发,具体配置请详询运营人员

## 1.4.8 系统初始账号
````bash
ADMIN_EMAIL=admin@sunallies.com
ADMIN_PASSWORD=admin
````

## 1.4.9 TA接口地址
````bash
TA_API_URL=http://139.224.20.227:9080/
TA_CG_WEB_URL=http://139.224.20.227:9080/
#TA_API_URL=http://192.168.1.190:8080/
#TA_CG_WEB_URL=http://192.168.1.190:8080/
````

## 1.4.10 七牛云配置
````bash
#QINIU_HOST=http://7xovn6.com1.z0.glb.clouddn.com/
QINIU_HOST=https://o7aytfnjg.qnssl.com/
QINIU_AK=df_ue-AzOhXAE5yO2qmdbT1jqed6hsJCy6fSAxO_
QINIU_SK=Fx-x4NLG2qQ1_q3Hzr6Et8_4DmDwV_8g-d7wNExE
QINIU_BT=center
````

## 1.4.11 rmq通信秘钥

````bash
RMQ_TOKEN=11fd9690-1cc6-499a-ba7d-ca5b77e27c51
````
## 1.4.12 短信接口
````bash
#SMS_URL= http://139.196.111.179:8081/apis.php
SMS_URL= http://120.26.113.176:8081/send
````
## 1.4.13 产品自动上单通知人电话
````bash
#AUTO_SHELVE_NOTICE_MOBILE='15021415241,18516240572'
AUTO_SHELVE_NOTICE_MOBILE=''
````
## 1.4.14 极光推送配置
````bash
JPUSH_APP_KEY = 7b251a07b0edfe09dd244dbf
JPUSH_MASTER_SECRET = 1997fc5df257ff89ebb7f45e
````

## 1.4.15 CRM接口地址

````bash
CRM_API_URL = http://testcrm.sunallies.com
````

## 1.4.16 电站运维api地址
````bash
PS_API_URL=http://139.196.108.39:9095/
````

## 2016年活动配置

````bash
CROWDFUNDING_START_TIME = 2016-05-30
CROWDFUNDING_END_TIME = 2016-06-15
````

## 1.4.17 打款单接收邮箱
````bash
#RECEIPT_EMAIL=  florence.zhou@sunallies.com
RECEIPT_EMAIL=  arvin.cao@sunallies.com
````
## 1.4.18 流米配置
````bash
#流米配置
#LIUMI_SERVER_URL = http://yfbapi.liumi.com/server/
#LIUMI_APP_KEY = juTmGgZBWU
#LIUMI_APP_SECRET = soNyuemXAZDtNDsM

LIUMI_SERVER_URL = http://api.tenchang.com/server/
LIUMI_APP_KEY = pcfaELJluv
LIUMI_APP_SECRET = jwOupyOcZRcwePOR

RMP_HOST  = 139.196.108.39
RMP_PORT  = 5670
RMP_NAME  = test_admin
RMP_PASS  = 11fd9690-1cc6-499a-ba7d-ca5b77e27c51
RMP_VHOST = ghlm_test
````

## 1.4.19 长期活动机制-配置返券ID(暂时处理逻辑)
````bash
VOUCHER_ONE=486
VOUCHER_TWO=487
VOUCHER_THREE=488
VOUCHER_FOUTH=489
VOUCHER_FIVE=491
VOUCHER_SIX=492
VOUCHER_SEVEN=493
````

## 1.4.20 php artisan时会用到

````bash
SERVER_NAME_NOW=http://www.sunallies-center.com/
````

## 1.4.21 活动盒子

````bash
HUODONG_HEZI_APPID=mc_nyq5hjh3nhcomkw
HUODONG_HEZI_APPSECRET=3ce65f696c3ea7d660efc5182be3495f
ACTIVITY_BOX_MOBILE=17301898103
API_BOX_URL=http://data.huodonghezi.com/
````

# 1.5 数据库/文件初始化

## 1.5.1 数据库初始化

````bash
 在数据库创建center数据库
#在网站根目录执行
php artisan forone:init
#php artisan migrate:refresh --seed
````

# 2 更新部署

初次安装完毕后， 如果需要升级，需要执行如下步骤。

## 2.1 依赖更新

需要参考每一次的更新文档

## 2.2 代码更新

在网站的根目录执行：

````bash
git pull --rebase
````

## 2.3 数据库升级

````
cd src
php artisan migrate --force
````

# 3 开发配置

## 3.1 开启调试

在根目录.env文件中修改如下配置即可控制是否开启调试模式:
````bash
APP_DEBUG=false
````

# 4. 升级php7.0


## ubuntu 14 升级php7.0步骤
```bash
sudo add-apt-repository ppa:ondrej/php

sudo apt-get update

sudo apt-get install php7.0 php7.0-cli php7.0-fpm php7.0-gd php7.0-json php7.0-mysql php7.0-zip php7.0-bcmath php7.0-readline php7.0-mbstring php7.0-xml php7.0-mcrypt php7.0-curl php7.0-sybase

```

## 更改nginx配置
在站点配置

```bash
location ~ \.php$ {
                include snippets/fastcgi-php.conf;
        #       # With php5-fpm:
                fastcgi_pass unix:/var/run/php5-fpm.sock;
        }

```
改为

```bash
location ~ \.php$ {
                include snippets/fastcgi-php.conf;
        #       # With php5-fpm:
                fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        }


```
重启
```bash
sudo service nginx restart

```


### 活动统计
1. 统计表：statistic_front_users 添加activity_name字段
2. **需要注意优惠券创建更新部分，因为和之前没有部署的体验金可能有冲突**

## env配置用例
\--------------------------------------------------------------------------------------------------------
````
APP_ENV=loacl
APP_DEBUG=true
APP_KEY=PKPKPJ3qJJSxgUkDqCanqkZ8txswbnq2
DEBUG_BAR= true

#job预览功能开关
PREVIEW_DEBUG=false


DB_HOST=120.26.113.176
DB_DATABASE=center
DB_USERNAME=root
DB_PASSWORD=sunallies@0922

#前台数据库配置
DB_HOST_2=rds7t1x5v77362xp5k05.mysql.rds.aliyuncs.com
DB_DATABASE_2=frontend
DB_USERNAME_2=sam
DB_PASSWORD_2=sun!@#121

#前台数据库配置
DB_HOST_ACTIVITY=rds7t1x5v77362xp5k05.mysql.rds.aliyuncs.com
DB_DATABASE_ACTIVITY=ghlm_activity
DB_USERNAME_ACTIVITY=sam
DB_PASSWORD_ACTIVITY=sun!@#121

#后台SQLSRV配置
DB_SQLSRV_HOST=rdsrm01d9c2bcx1d9edw.sqlserver.rds.aliyuncs.com,3433
DB_SQLSRV_DATABASE=taview
DB_SQLSRV_USERNAME=test_admin
DB_SQLSRV_PASSWORD=b5f4ffd7_4d52_4962_9212

#redis服务器地址
#REDIS_SERVER=ce383695ae594855.m.cnsha.kvstore.aliyuncs.com
#REDIS_PORT=6379
#REDIS_PASSWORD=ce383695ae594855:Sunkv121

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_DRIVER=redis

#logstach
REDIS_SERVER_LOG=120.26.113.176
REDIS_PWD_LOG=
REDIS_SERVER_PORT_LOG=6379
REDIS_DATABASE_LOG=6

#wechat
REDIS_SERVER_WECHAT=127.0.0.1
REDIS_PWD_WECHAT=
REDIS_SERVER_PORT_WECHAT=6379
REDIS_DATABASE_WECHAT=13

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mxhichina.com
MAIL_PORT=465
MAIL_USERNAME=center_post@sunallies.com
MAIL_FROM_ADDRESS=center_post@sunallies.com
MAIL_FROM_NAME=center_post@sunallies.com
MAIL_PASSWORD=Center@12
MAIL_ENCRYPTION=ssl


#系统初始账号
ADMIN_EMAIL=admin@sunallies.com
ADMIN_PASSWORD=admin

#TA接口地址
TA_API_URL=http://139.224.20.227:9080/
TA_CG_WEB_URL=http://139.224.20.227:9080/
#TA_API_URL=http://192.168.1.190:8080/
#TA_CG_WEB_URL=http://192.168.1.190:8080/


#七牛云配置
#QINIU_HOST=http://7xovn6.com1.z0.glb.clouddn.com/
QINIU_HOST=https://o7aytfnjg.qnssl.com/
QINIU_AK=df_ue-AzOhXAE5yO2qmdbT1jqed6hsJCy6fSAxO_
QINIU_SK=Fx-x4NLG2qQ1_q3Hzr6Et8_4DmDwV_8g-d7wNExE
QINIU_BT=center

#rmq通信秘钥
RMQ_TOKEN=11fd9690-1cc6-499a-ba7d-ca5b77e27c51

#短信接口
#SMS_URL= http://139.196.111.179:8081/apis.php
SMS_URL= http://120.26.113.176:8081/send

#产品自动上单通知人电话
#AUTO_SHELVE_NOTICE_MOBILE='15021415241,18516240572'
AUTO_SHELVE_NOTICE_MOBILE=''
#Jpush
JPUSH_APP_KEY = 7b251a07b0edfe09dd244dbf
JPUSH_MASTER_SECRET = 1997fc5df257ff89ebb7f45e


CRM_API_URL = http://testcrm.sunallies.com

#电站运维api地址
PS_API_URL=http://139.196.108.39:9095/

CROWDFUNDING_START_TIME = 2016-05-30
CROWDFUNDING_END_TIME = 2016-06-15


# 打款单接收邮箱
#RECEIPT_EMAIL=  florence.zhou@sunallies.com
RECEIPT_EMAIL=  arvin.cao@sunallies.com

#流米配置
#LIUMI_SERVER_URL = http://yfbapi.liumi.com/server/
#LIUMI_APP_KEY = juTmGgZBWU
#LIUMI_APP_SECRET = soNyuemXAZDtNDsM

LIUMI_SERVER_URL = http://api.tenchang.com/server/
LIUMI_APP_KEY = pcfaELJluv
LIUMI_APP_SECRET = jwOupyOcZRcwePOR

RMP_HOST  = 139.196.108.39
RMP_PORT  = 5670
RMP_NAME  = test_admin
RMP_PASS  = 11fd9690-1cc6-499a-ba7d-ca5b77e27c51
RMP_VHOST = ghlm_test

#长期活动机制--配置返现券ID(暂时处理逻辑)
VOUCHER_ONE=486
VOUCHER_TWO=487
VOUCHER_THREE=488
VOUCHER_FOUTH=489
VOUCHER_FIVE=491
VOUCHER_SIX=492
VOUCHER_SEVEN=493

#php artisan时会用到
SERVER_NAME_NOW=http://www.sunallies-center.com/

#活动盒子
HUODONG_HEZI_APPID=mc_nyq5hjh3nhcomkw
HUODONG_HEZI_APPSECRET=3ce65f696c3ea7d660efc5182be3495f
ACTIVITY_BOX_MOBILE=17301898103
API_BOX_URL=http://data.huodonghezi.com/
````
