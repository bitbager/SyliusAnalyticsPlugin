<?php

namespace spec\Setono\SyliusAnalyticsPlugin\EventListener;

use Setono\SyliusAnalyticsPlugin\EventListener\BeginCheckoutEventListener;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BeginCheckoutEventListenerSpec extends ObjectBehavior
{
    function let(SessionInterface $session): void
    {
        $this->beConstructedWith($session);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(BeginCheckoutEventListener::class);
    }

    function it_add_begin_checkout(

        SessionInterface $session
    ): void
    {
        $session->has('google_analytics_events')->willReturn(true);

        $session->get('google_analytics_events')->shouldBeCalled();

        $session->set('google_analytics_events' ,[['name' => 'BeginCheckout']])->shouldBeCalled();

        $this->beginCheckout();
    }

    function it_cannot_add_begin_checkout(
        SessionInterface $session
    ): void
    {
        $session->has('google_analytics_events')->willReturn(false);

        $session->set('google_analytics_events', [])->shouldBeCalled();

        $session->get('google_analytics_events')->shouldBeCalled();

        $session->set('google_analytics_events' ,[['name' => 'BeginCheckout']])->shouldBeCalled();

        $this->beginCheckout();
    }
}
