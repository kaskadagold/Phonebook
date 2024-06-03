<?php

namespace App;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FlashMessages
{
    public function __construct(private readonly Session $session)
    {
    }

    public function success(array|string $messages): void
    {
        $this->storage()->set('success_message', $messages);
    }

    public function error(array|string $messages): void
    {
        $this->storage()->set('error_message', $messages);
    }

    public function getErrors(): array
    {
        return $this->storage()->get('error_message', []);
    }

    public function getSuccesses(): array
    {
        return $this->storage()->get('success_message', []);
    }

    private function storage(): FlashBagInterface
    {
        return $this->session->getFlashBag();
    }

    public function getFlashBag(): FlashBagInterface
    {
        return $this->session->getFlashBag();
    }
}
