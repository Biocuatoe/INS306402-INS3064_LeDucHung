<?php
// controllers/PatientController.php

require_once __DIR__ . '/../models/PatientModel.php';
require_once __DIR__ . '/../models/AppointmentModel.php';

class PatientController {
    private PatientModel $model;
    private AppointmentModel $appointmentModel;

    public function __construct() {
        $this->model = new PatientModel();
        $this->appointmentModel = new AppointmentModel();
    }

    // Action: show list of all patients
    public function index(): void {
        $patients = $this->model->getAll();
        require __DIR__ . '/../views/patients/index.php';
    }

    // Action: show create form
    public function create(): void {
        $errors = [];
        $data   = [];
        require __DIR__ . '/../views/patients/create.php';
    }

    // Action: handle create form submission (POST)
    public function store(): void {
        $data = [
            'patient_code'  => trim($_POST['patient_code']  ?? ''),
            'full_name'     => trim($_POST['full_name']     ?? ''),
            'date_of_birth' => $_POST['date_of_birth']      ?? '',
            'gender'        => $_POST['gender']              ?? 'Other',
            'phone'         => trim($_POST['phone']          ?? ''),
            'address'       => trim($_POST['address']        ?? ''),
        ];

        $errors = $this->validate($data);

        if ($this->model->codeExists($data['patient_code'])) {
            $errors[] = "Patient Code already exists!";
        }

        if (!empty($errors)) {
            require __DIR__ . '/../views/patients/create.php';
            return;
        }

        $this->model->create($data);
        $_SESSION['success'] = "New patient added successfully!";
        header("Location: index.php?controller=patient&action=index");
        exit;
    }

    // Action: show edit form
    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = $this->model->getById($id);
        if (!$record) {
            header("Location: index.php?controller=patient&action=index");
            exit;
        }
        $errors = [];
        $data   = $record; // pre-fill form with existing values
        require __DIR__ . '/../views/patients/edit.php';
    }

    // Action: handle edit form submission (POST)
    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'patient_code'  => trim($_POST['patient_code']  ?? ''),
            'full_name'     => trim($_POST['full_name']     ?? ''),
            'date_of_birth' => $_POST['date_of_birth']      ?? '',
            'gender'        => $_POST['gender']              ?? 'Other',
            'phone'         => trim($_POST['phone']          ?? ''),
            'address'       => trim($_POST['address']        ?? ''),
        ];

        $errors = $this->validate($data);

        if ($this->model->codeExists($data['patient_code'], $id)) {
            $errors[] = "Patient Code already exists!";
        }

        if (!empty($errors)) {
            $record = array_merge(['id' => $id], $data);
            require __DIR__ . '/../views/patients/edit.php';
            return;
        }

        $this->model->update($id, $data);
        $_SESSION['success'] = "Patient updated successfully!";
        header("Location: index.php?controller=patient&action=index");
        exit;
    }

    // Action: delete a patient
    public function delete(): void {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $_SESSION['success'] = "Patient deleted successfully!";
        header("Location: index.php?controller=patient&action=index");
        exit;
    }

    // Action: view patient detail with their appointments
    public function show(): void {
        $id = (int)($_GET['id'] ?? 0);
        $patient = $this->model->getById($id);
        if (!$patient) {
            header("Location: index.php?controller=patient&action=index");
            exit;
        }
        $appointments = $this->appointmentModel->getByPatientId($id);
        require __DIR__ . '/../views/patients/show.php';
    }

    // Private: shared validation logic
    private function validate(array $data): array {
        $errors = [];
        if (empty($data['patient_code'])) $errors[] = "Patient Code is required.";
        if (empty($data['full_name']))    $errors[] = "Full Name is required.";
        return $errors;
    }
}
