<?php
class ContactController
{
    public function index(): void
    {
        render('contacts/index', ['contacts' => Contact::all()]);
    }

    public function create(): void
    {
        require_login();
        render('contacts/form', ['contact' => ['name' => '', 'email' => '', 'phone' => ''],
            'errors' => [], 'action' => 'contacts/store', 'title' => 'Add contact']);
    }

    public function store(): void
    {
        require_login();
        csrf_check();
        $d = $this->input();
        $errors = $this->validate($d);
        if ($errors) {
            render('contacts/form', ['contact' => $d, 'errors' => $errors,
                'action' => 'contacts/store', 'title' => 'Add contact']);
            return;
        }
        Contact::create($d);
        $_SESSION['flash'] = 'Contact added.';
        redirect('contacts/index');
    }

    public function edit(): void
    {
        require_login();
        $c = $this->findOr404();
        render('contacts/form', ['contact' => $c, 'errors' => [],
            'action' => 'contacts/update&id=' . $c['id'], 'title' => 'Edit contact']);
    }

    public function update(): void
    {
        require_login();
        csrf_check();
        $c = $this->findOr404();
        $d = $this->input();
        $errors = $this->validate($d);
        if ($errors) {
            render('contacts/form', ['contact' => $d, 'errors' => $errors,
                'action' => 'contacts/update&id=' . $c['id'], 'title' => 'Edit contact']);
            return;
        }
        Contact::update((int) $c['id'], $d);
        $_SESSION['flash'] = 'Contact updated.';
        redirect('contacts/index');
    }

    public function delete(): void
    {
        require_login();
        csrf_check();
        $c = $this->findOr404();
        Contact::delete((int) $c['id']);
        $_SESSION['flash'] = 'Contact deleted.';
        redirect('contacts/index');
    }

    private function input(): array
    {
        return [
            'name'  => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
        ];
    }

    private function validate(array $d): array
    {
        $e = [];
        if ($d['name'] === '' || mb_strlen($d['name']) > 100) {
            $e['name'] = 'Name is required (max 100 characters).';
        }
        if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL) || strlen($d['email']) > 150) {
            $e['email'] = 'Enter a valid email (max 150 characters).';
        }
        if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $d['phone'])) {
            $e['phone'] = 'Phone must be 7-20 characters: digits, +, -, spaces, brackets.';
        }
        return $e;
    }

    private function findOr404(): array
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $c = $id ? Contact::find($id) : null;
        if (!$c) {
            http_response_code(404);
            exit('Contact not found.');
        }
        return $c;
    }
}
