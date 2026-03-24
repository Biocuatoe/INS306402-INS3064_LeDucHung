# Session 06: Database Design

**Student:**[Lê Đức Hùng]
**Course:** INS3064 - Multimedia Design & Web Development

---

## Part 1: Normalization
Dưới đây là kết quả chuẩn hóa bảng `Student_Grades_Raw` về dạng 3NF (loại bỏ phụ thuộc từng phần và phụ thuộc bắc cầu).

| Table Name | Primary Key | Foreign Key | Normal Form | Description |
| :--- | :--- | :--- | :--- | :--- |
| Students | student_id | None | 3NF | Lưu thông tin cơ bản của sinh viên |
| Professors | professor_id | None | 3NF | Lưu thông tin và email của giáo sư |
| Courses | course_id | professor_id | 3NF | Lưu thông tin khóa học và giáo sư giảng dạy |
| Grades | student_id, course_id | student_id, course_id | 3NF | Bảng trung gian (Junction) lưu điểm số của sinh viên |

---

## Part 2: Relationships
Xác định loại quan hệ và vị trí đặt Khóa ngoại (Foreign Key).

- **Author to Book:** One-to-Many (1:N). Một tác giả có thể viết nhiều sách. *FK `author_id` đặt tại bảng `Books`.*
- **Citizen to Passport:** One-to-One (1:1). Một công dân có 1 hộ chiếu duy nhất hiện tại. *FK `citizen_id` đặt tại bảng `Passports` (kèm UNIQUE constraint).*
- **Customer to Order:** One-to-Many (1:N). Một khách hàng có thể có nhiều đơn hàng. *FK `customer_id` đặt tại bảng `Orders`.*
- **Student to Class:** Many-to-Many (N:N). Một sinh viên học nhiều lớp, một lớp có nhiều sinh viên. *Cần tạo bảng trung gian `Student_Classes` chứa FK `student_id` và `class_id`.*
- **Team to Player:** One-to-Many (1:N). Một đội bóng có nhiều cầu thủ. *FK `team_id` đặt tại bảng `Players`.*