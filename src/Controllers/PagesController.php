<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Exceptions\PageNotFoundException;
use Exception;

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

    /** @throws PageNotFoundException | Exception */
    public function submitCreate(): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        $fields = $this->request->request;
        $name = $this->validateData($fields->get('contactName', ''));
        $phone = $this->validateData($fields->get('contactPhone', ''));

        try {
            $result = $this->contactsRepository->create($name, $phone);

            if (! $result) {
                throw new Exception;
            }

            flash()->success('Вы успешно добавили новый контакт');
        } catch (PageNotFoundException $e) {
            flash()->error([$e->getMessage()]);
        } catch (Exception $e) {
            flash()->error(['Контакт с таким именем и телефоном уже существует']);
            return new RedirectResponse($_SERVER['REQUEST_URI']);
        }

        return new RedirectResponse($redirectUrl);
    }

    /** @throws Exception */
    public function update(int $id): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        try {
            $contact = $this->contactsRepository->getById($id);

            if ($contact === null) {
                throw new Exception;
            }
        } catch (Exception $e) {
            flash()->error(['Невозможно отредактировать несуществующий контакт']);
            return new RedirectResponse($redirectUrl);
        }
        
        return $this->view('pages/update.php', ['contact' => $contact]);
    }

    /** @throws Exception */
    public function submitUpdate(int $id): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        $fields = $this->request->request;
        $name = $this->validateData($fields->get('contactName', ''));
        $phone = $this->validateData($fields->get('contactPhone', ''));

        try {
            $result = $this->contactsRepository->update($id, $name, $phone);

            if (! $result) {
                throw new Exception;
            }

            flash()->success(['Вы успешно обновили контакт']);
        } catch (Exception $e) {
            flash()->error(['Контакт с таким именем и телефоном уже существует']);
            return new RedirectResponse($_SERVER['REQUEST_URI']);
        }
        

        return new RedirectResponse($redirectUrl);
    }

    /** @throws Exception */
    public function delete(string $id): Response
    {
        $redirectUrl = static::REDIRECT_URL;

        try {
            $result = $this->contactsRepository->delete($id);
            if (!$result) {
                throw new Exception;
            }

            flash()->success(['Вы успешно удалили контакт']);
        } catch (Exception $e) {
            flash()->error(['Невозможно удалить несуществущий контакт']);
        }

        return new RedirectResponse($redirectUrl);
    }

    private function validateData(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
