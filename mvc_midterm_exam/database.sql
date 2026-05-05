-- ============================================================
-- hospital_db — Full Schema + Sample Data
-- ============================================================

CREATE DATABASE IF NOT EXISTS hospital_db
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hospital_db;

-- 1. Patients
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    date_of_birth DATE,
    gender ENUM('Male', 'Female', 'Other') DEFAULT 'Other',
    phone VARCHAR(20),
    address VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Appointments (FK to patients with CASCADE delete)
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_name VARCHAR(100) NOT NULL,
    appointment_date DATETIME NOT NULL,
    department VARCHAR(100) NOT NULL,
    reason TEXT,
    status ENUM('Scheduled', 'Completed', 'Cancelled') DEFAULT 'Scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_patient FOREIGN KEY (patient_id)
        REFERENCES patients(id) ON DELETE CASCADE
);

-- 3. Sample patients
INSERT INTO patients (patient_code, full_name, date_of_birth, gender, phone, address) VALUES
('PT001', 'Hoàng Cẩm Anh',              '1990-05-15', 'Male',   '0901234567', '123 Le Loi, HCMC'),
('PT002', 'Hoàng Tú Anh',               '1985-08-22', 'Female', '0912345678', '456 Nguyen Trai, Hanoi'),
('PT003', 'Nguyễn Ngọc Anh',            '1978-11-30', 'Male',   '0923456789', '789 Tran Hung Dao, Da Nang'),
('PT004', 'Zakari Abdurraheem Chawai',   '2000-02-14', 'Female', '0934567890', '321 Hai Ba Trung, Hue'),
('PT005', 'Nguyễn Tiến Đạt',            '1965-07-09', 'Male',   '0945678901', '654 Ly Thuong Kiet, Can Tho'),
('PT006', 'Trần Mạnh Đức',              '1995-12-05', 'Female', '0956789012', '987 Le Duan, Nha Trang'),
('PT007', 'Đoàn Thu Dương',             '1982-03-25', 'Male',   '0967890123', '147 Nguyen Dinh Chieu, Hai Phong'),
('PT008', 'Lã Nhật Bảo Duy',            '1998-09-18', 'Female', '0978901234', '258 Phan Dang Luu, Da Lat'),
('PT009', 'Phạm Quang Hà',              '1970-06-12', 'Male',   '0989012345', '369 Dien Bien Phu, Vung Tau'),
('PT010', 'Nguyễn Thị Hồng Hạnh',       '1988-04-02', 'Female', '0990123456', '741 Nguyen Van Linh, HCMC');

-- 4. Sample appointments
INSERT INTO appointments (patient_id, doctor_name, appointment_date, department, reason, status) VALUES
(1, 'Dr. Trần Quốc Hiệu', '2026-04-05 09:00:00', 'Cardiology',   'Routine checkup',   'Scheduled'),
(2, 'Dr. Vũ Thu Hoà',     '2026-04-06 10:30:00', 'Neurology',    'Chest pain',        'Scheduled'),
(3, 'Dr. Nguyễn Thu Hồng','2026-04-02 14:00:00', 'Orthopedics',  'Back pain',         'Completed'),
(4, 'Dr. Nguyễn Thị Huế', '2026-04-10 11:15:00', 'Dermatology',  'Skin allergy',      'Scheduled'),
(1, 'Dr. Trần Quốc Hiệu', '2026-03-15 09:00:00', 'Cardiology',   'Previous checkup',  'Completed');
