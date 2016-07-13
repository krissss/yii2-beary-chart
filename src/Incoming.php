<?php
/**
 * Yii2 BearyChat
 * User: kriss
 * Date: 2016-07-13
 * Time: 14:15
 * @link https://bearychat.com/integrations/incoming
 * @link https://github.com/ElfSundae/BearyChat
 */

namespace kriss\bearyChat;

use ElfSundae\BearyChat\Client;
use yii\base\Component;
use yii\base\UnknownPropertyException;

class Incoming extends Component
{
    /*
    |--------------------------------------------------------------------------
    | Default BearyChat Client Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the BearyChat clients below you wish to use
    | as your default client.
    |
    */
    public $default = 'default';

    /*
    |--------------------------------------------------------------------------
    | BearyChat Clients
    |--------------------------------------------------------------------------
    |
    | Here are each of the BearyChat clients setup for your application.
    |
    | Supported keys:
    |
    |   'webhook':      The Incoming Webhook URL. You can get it from an Incoming Robot.
    |                   See https://bearychat.kf5.com/posts/view/26755/
    |   'message_defaults': Optional message defaults. All keys of message defaults
    |                       are listed in `ElfSundae\BearyChat\MessageDefaults`.
    |                       Supported: "channel", "user", "markdown" (boolean),
    |                       "notification", "attachment_color".
    |
    */
    public $clients = [
        'default' => [
            'webhook' => '',
            // 'message_defaults' => [
            //     'attachment_color' => '#f5f5f5',
            // ]
        ],

        // 'admin' => [
        //     'webhook' => '',
        // ],
    ];

    /**
     * Get a client instance.
     * @param null $name
     * @return \ElfSundae\BearyChat\Client
     * @throws UnknownPropertyException
     */
    public function client($name = null)
    {
        if (is_null($name)) {
            $name = $this->default;
        }

        if (!isset($this->clients[$name])) {
            throw new UnknownPropertyException('Not found "name", it\'s must be set in "clients"');
        }
        return $this->resolve($this->clients[$name]);
    }

    /**
     * Resolve the given client.
     * @param array $config
     * @return \ElfSundae\BearyChat\Client
     * @throws UnknownPropertyException
     */
    protected function resolve($config)
    {
        if (!isset($config['webhook'])) {
            throw new UnknownPropertyException('Not found "webhook", it\'s must be set in "clients[$name]"');
        }
        return new Client(
            $config['webhook'],
            isset($config['message_defaults']) ? $config['message_defaults'] : []
        );
    }
}