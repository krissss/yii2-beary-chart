yii2 bearyChat
==============
yii2 bearyChat 组件，依赖[BearyChat for PHP](https://github.com/ElfSundae/BearyChat)

## 安装

推荐使用 [composer](http://getcomposer.org/download/).

```
php composer.phar require --prefer-dist kriss/yii2-beary-chat "*"
```

或添加下面代码到`composer.json`文件

```
"kriss/yii2-beary-chat": "*"
```

然后使用

```
php composer.phar update
```


## 使用方式

### 单独使用

1.进行配置

basic 模版为 config/web.php, advanced 模版为对应入口的 config/main.php

示例配置如下：

```php
'components' => [
    .....
    'bearyChat' => [
        'class' => 'kriss\bearyChat\Incoming',
        'clients' => [
            'default' => [
                'webhook' => 'https://hook.bearychat.com/=XXXX/incoming/XXXXXXXXXXXXXX',
                 'message_defaults' => [
                     'attachment_color' => '#f5f5f5',
                 ]
            ],
            // 'admin' => [
            //     'webhook' => '',
            // ],
        ]
    ],
    ...
]
```

2.进行使用

最简单的使用方式：

```php
Yii::app->bearyChat->client()->sendMessage(json_encode(['text'=>'hello world']));
```

更多使用方式参看：
[BearyChat for PHP](https://github.com/ElfSundae/BearyChat)

tips:`Yii::app->bearyChat->client()`获得的即是`\ElfSundae\BearyChat\Client`

### 配合 yii2-thread 使用

发送一条 BearyChat 消息实际上是向 Incoming Webhook 发送同步 HTTP 请求，所以这在一定程度上会延长应用的响应时间。可以使用 yii2-thread （或任意多线程方式）来异步发送消息。

使用 yii2-thread 只需要在对应位置使用发送消息的代码就可以，使用方式不变

参考链接：[yii2-thread](https://github.com/krissss/yii2-thread)
