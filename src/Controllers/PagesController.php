<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Contracts\Repositories\ContactsRepositoryContract;

class PagesController extends Controller
{
    const REDIRECT_URL = '/';

    public function __construct(
        private readonly ContactsRepositoryContract $contactsRepository,
        private readonly Request $request,
    ) {
    }
    
    public function home(): Response
    {
        $contacts = $this->contactsRepository->getContacts();
        return $this->view('pages/home.php', ['contactsList' => $contacts]);
    }

    public function create(): Response
    {
        return $this->view('pages/create.php');
    }

    public function submitCreate(): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        $fields = $this->request->request;
        $name = $fields->get('contactName', '');
        $phone = $fields->get('contactPhone', '');

        $this->contactsRepository->create($name, $phone);

        return new RedirectResponse($redirectUrl);
    }

    public function update(int $id): Response
    {
        $contact = $this->contactsRepository->getById($id);
        return $this->view('pages/update.php', ['contact' => $contact]);
    }

    public function submitUpdate(int $id): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        $fields = $this->request->request;
        $name = $fields->get('contactName', '');
        $phone = $fields->get('contactPhone', '');

        $this->contactsRepository->update($id, $name, $phone);

        return new RedirectResponse($redirectUrl);
    }

    public function delete(string $id): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        $this->contactsRepository->delete($id);
        return new RedirectResponse($redirectUrl);
    }
}
