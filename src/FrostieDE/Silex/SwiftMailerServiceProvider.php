<?php

namespace FrostieDE\Silex;

use Pimple\Container;

class SwiftMailerServiceProvider extends \Silex\Provider\SwiftmailerServiceProvider {
    private $transport;

    public function __construct($transport = null) {
        $this->transport = $transport;
    }

    public function register(Container $app) {
        parent::register($app);

        $app['swiftmailer.transport.mail.invoker'] = function($app) {
            return new \Swift_Transport_SimpleMailInvoker();
        };

        $app['swiftmailer.transport.mail'] = function($app) {
            $transport = new \Swift_Transport_MailTransport($app['swiftmailer.transport.mail.invoker'], $app['swiftmailer.transport.eventdispatcher']);

            if (null !== $app['swiftmailer.sender_address']) {
                $transport->registerPlugin(new \Swift_Plugins_ImpersonatePlugin($app['swiftmailer.sender_address']));
            }

            if (!empty($app['swiftmailer.delivery_addresses'])) {
                $transport->registerPlugin(new \Swift_Plugins_RedirectingPlugin(
                    $app['swiftmailer.delivery_addresses'],
                    $app['swiftmailer.delivery_whitelist']
                ));
            }

            return $transport;
        };

        $app['swiftmailer.transport.sendmail'] = function($app) {
            return new \Swift_SendmailTransport();
        };

        $app['swiftmailer.transport.null'] = function($app) {
            return new \Swift_Transport_NullTransport($app['swiftmailer.transport.eventdispatcher']);
        };

        if(!empty($this->transport)) {
            $keyMap = [
                'mail' => 'swiftmailer.transport.mail',
                'sendmail' => 'swiftmailer.transport.sendmail',
                'null' => 'swiftmailer.transport.null'
            ];

            if(in_array($this->transport, array_keys($keyMap))) {
               $app['swiftmailer.transport'] = function($app) use ($keyMap) {
                   return $app[$keyMap[$this->transport]];
               };
            }
        }
    }
}