<?php
// controllers/AppointmentController.php

require_once __DIR__ . '/../models/AppointmentModel.php';
require_once __DIR__ . '/../models/PatientModel.php';

class AppointmentController {
    private AppointmentModel $model;
    private PatientModel $patientModel;

    public function __construct() {
        $this->model        = new AppointmentModel();
        $this->patientModel = new PatientModel();
    }

    // Action: list all appointments
    public function index(): void {
        $appointments = $this->model->getAll();
        require __DIR__ . '/../views/appointments/index.php';
    }

    // Action: show create form
    public function create(): void {
        $errors   = [];
        $data     = [];
        $patients = $this->patientModel->getAll(); // for dropdown
        // Pre-select patient from query string if coming from patient detail page
        $selectedPatientId = (int)($_GET['patient_id'] ?? 0);
        require __DIR__ . '/../views/appointments/create.php';
    }

    // Action: handle create form submission (POST)
    public function store(): void {
        $data = [
            'patient_id'       => (int)($_POST['patient_id']       ?? 0),
            'doctor_name'      => trim($_POST['doctor_name']        ?? ''),
            'appointment_date' => trim($_POST['appointment_date']   ?? ''),
            'department'       => trim($_POST['department']         ?? ''),
            'reason'           => trim($_POST['reason']             ?? ''),
            'status'           => $_POST['status']                  ?? 'Scheduled',
        ];

        $errors = $this->validate($data);

        if (!empty($errors)) {
            $patients = $this->patientModel->getAll();
            $selectedPatientId = $data['patient_id'];
            require __DIR__ . '/../views/appointments/create.php';
            return;
        }

        $this->model->create($data);
        $_SESSION['success'] = "Appointment scheduled successfully!";
        header("Location: index.php?controller=appointment&action=index");
        exit;
    }

    // Action: show edit form
    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $record = $this->model->getById($id);
        if (!$record) {
            header("Location: index.php?controller=appointment&action=index");
            exit;
        }
        $errors   = [];
        $data     = $record;
        $patients = $this->patientModel->getAll();
        require __DIR__ . '/../views/appointments/edit.php';
    }

    // Action: handle edit form submission (POST)
    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            'patient_id'       => (int)($_POST['patient_id']       ?? 0),
            'doctor_name'      => trim($_POST['doctor_name']        ?? ''),
            'appointment_date' => trim($_POST['appointment_date']   ?? ''),
            'department'       => trim($_POST['department']         ?? ''),
            'reason'           => trim($_POST['reason']             ?? ''),
            'status'           => $_POST['status']                  ?? 'Scheduled',
        ];

        $errors = $this->validate($data);

        if (!empty($errors)) {
            $record   = array_merge(['id' => $id], $data);
            $patients = $this->patientModel->getAll();
            require __DIR__ . '/../views/appointments/edit.php';
            return;
        }

        $this->model->update($id, $data);
        $_SESSION['success'] = "Appointment updated successfully!";
        header("Location: index.php?controller=appointment&action=index");
        exit;
    }

    // Action: delete an appointment
    public function delete(): void {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        $_SESSION['success'] = "Appointment deleted successfully!";
        header("Location: index.php?controller=appointment&action=index");
        exit;
    }

    // Private: shared validation logic
    private function validate(array $data): array {
        $errors = [];
        if ($data['patient_id'] <= 0)        $errors[] = "Patient is required.";
        if (empty($data['doctor_name']))      $errors[] = "Doctor Name is required.";
        if (empty($data['appointment_date'])) $errors[] = "Appointment Date is required.";
        if (empty($data['department']))       $errors[] = "Department is required.";
        return $errors;
    }
}
