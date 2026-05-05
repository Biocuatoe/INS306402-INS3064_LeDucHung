<?php
// models/AppointmentModel.php

require_once __DIR__ . '/../config/database.php';

class AppointmentModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // READ — get all appointments (joined with patient name)
    public function getAll(): array {
        $stmt = $this->pdo->query(
            "SELECT a.*, p.full_name AS patient_name, p.patient_code
             FROM appointments a
             JOIN patients p ON a.patient_id = p.id
             ORDER BY a.appointment_date DESC"
        );
        return $stmt->fetchAll();
    }

    // READ — get appointments for a specific patient
    public function getByPatientId(int $patientId): array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM appointments WHERE patient_id = ? ORDER BY appointment_date DESC"
        );
        $stmt->execute([$patientId]);
        return $stmt->fetchAll();
    }

    // READ — get one appointment by ID
    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare(
            "SELECT a.*, p.full_name AS patient_name
             FROM appointments a
             JOIN patients p ON a.patient_id = p.id
             WHERE a.id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // CREATE — insert new appointment
    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO appointments (patient_id, doctor_name, appointment_date, department, reason, status)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['patient_id'],
            $data['doctor_name'],
            $data['appointment_date'],
            $data['department'],
            $data['reason'],
            $data['status'],
        ]);
    }

    // UPDATE — modify existing appointment
    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE appointments
             SET patient_id=?, doctor_name=?, appointment_date=?, department=?, reason=?, status=?
             WHERE id=?"
        );
        return $stmt->execute([
            $data['patient_id'],
            $data['doctor_name'],
            $data['appointment_date'],
            $data['department'],
            $data['reason'],
            $data['status'],
            $id,
        ]);
    }

    // DELETE — remove appointment
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM appointments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
