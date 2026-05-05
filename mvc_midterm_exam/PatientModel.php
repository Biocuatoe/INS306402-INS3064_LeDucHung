<?php
// models/PatientModel.php

require_once __DIR__ . '/../config/database.php';

class PatientModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    // READ — get all patients
    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM patients ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // READ — get one patient by ID
    public function getById(int $id): array|false {
        $stmt = $this->pdo->prepare("SELECT * FROM patients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // CREATE — insert new patient
    public function create(array $data): bool {
        $stmt = $this->pdo->prepare(
            "INSERT INTO patients (patient_code, full_name, date_of_birth, gender, phone, address)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['patient_code'],
            $data['full_name'],
            $data['date_of_birth'] ?: null,
            $data['gender'],
            $data['phone'],
            $data['address'],
        ]);
    }

    // UPDATE — modify existing patient
    public function update(int $id, array $data): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE patients
             SET patient_code=?, full_name=?, date_of_birth=?, gender=?, phone=?, address=?
             WHERE id=?"
        );
        return $stmt->execute([
            $data['patient_code'],
            $data['full_name'],
            $data['date_of_birth'] ?: null,
            $data['gender'],
            $data['phone'],
            $data['address'],
            $id,
        ]);
    }

    // DELETE — remove patient (appointments cascade via FK)
    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM patients WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // CHECK — does patient_code already exist? (optional: exclude current id on edit)
    public function codeExists(string $code, int $excludeId = 0): bool {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM patients WHERE patient_code = ? AND id != ?");
        $stmt->execute([$code, $excludeId]);
        return (int)$stmt->fetchColumn() > 0;
    }
}
