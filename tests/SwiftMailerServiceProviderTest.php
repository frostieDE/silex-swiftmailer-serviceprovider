<?php

namespace FrostieDE\Silex;

use Pimple\Container;

class SwiftMailerServiceProviderTest extends \PHPUnit_Framework_TestCase  {
    public function testSendmailTransport() {
        $app = new Container();
        $app->register(new SwiftMailerServiceProvider('sendmail'));

        $this->assertEquals(\Swift_SendmailTransport::class, get_class($app['swiftmailer.transport']));
    }

    public function testMailTransport() {
        $app = new Container();
        $app->register(new SwiftMailerServiceProvider('mail'));

        $this->assertEquals(\Swift_Transport_MailTransport::class, get_class($app['swiftmailer.transport']));
    }

    public function testNullTransport() {
        $app = new Container();
        $app->register(new SwiftMailerServiceProvider('null'));

        $this->assertEquals(\Swift_Transport_NullTransport::class, get_class($app['swiftmailer.transport']));
    }

    public function testDefaultTransport() {
        $app = new Container();
        $app->register(new SwiftMailerServiceProvider());

        $this->assertEquals(\Swift_Transport_EsmtpTransport::class, get_class($app['swiftmailer.transport']));
    }

    public function testInvalidTransport() {
        $app = new Container();
        $app->register(new SwiftMailerServiceProvider('invalid'));

        $this->assertEquals(\Swift_Transport_EsmtpTransport::class, get_class($app['swiftmailer.transport']));
    }
}