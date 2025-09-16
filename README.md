# Mission-3-Apply-Authentication-and-Authorization
# 📊 Spesifikasi Database

Proyek ini menggunakan **MySQL** sebagai sistem manajemen basis data.   
Detail konfigurasi dan struktur yang digunakan adalah sebagai berikut:

---

## ⚡ Framework
1. **CodeIgniter 4** untuk PHP
2. **Tailwind** untuk CSS   

---

## 🗄️ Database
**Nama Database:** `campus_app`  

---

## 📋 Struktur Tabel:
###  1. `courses`
| Kolom | Tipe Data | Keterangan             |
|-------|-----------|------------------------|
| course_id   | INT(11)   | Primary Key, Unique, AUTO_INCREMENT    |
| course_name   | VARCHAR(100)   | Nama Course    |
| credits  | INT(11)   | SKS         |
| created_at  | TIMESTAMP       | default: current_timestamp()        |
| updated_at  | TIMESTAMP       | default: current_timestamp(), ON UPDATE CURRENT_TIMESTAMP()        |

###  2. `students`
| Kolom | Tipe Data | Keterangan             |
|-------|-----------|------------------------|
| student_id   | INT(11)   | Primary Key, Unique, AUTO_INCREMENT    |
| entry_year   | YEAR(4)   | Tahun masuk    |
| user_id  | INT(11)   | Unique         |
| created_at  | TIMESTAMP       | default: current_timestamp()        |
| updated_at  | TIMESTAMP       | default: current_timestamp(), ON UPDATE CURRENT_TIMESTAMP()        |

###  3. `takes`
| Kolom | Tipe Data | Keterangan             |
|-------|-----------|------------------------|
| id   | INT(11)   | Primary Key, Unique, AUTO_INCREMENT    |
| student_id   | INT(11)   | Unique    |
| course_id  | INT(11)   | Unique         |
| enroll_date  | DATE   | Tanggal enroll         |
| created_at  | TIMESTAMP       | default: current_timestamp()        |
| updated_at  | TIMESTAMP       | default: current_timestamp(), ON UPDATE CURRENT_TIMESTAMP()        |

###  4. `users`
| Kolom | Tipe Data | Keterangan             |
|-------|-----------|------------------------|
| user_id   | INT(11)   | Primary Key, Unique, AUTO_INCREMENT    |
| username   | VARCHAR(50)   | Unique    |
| password  | VARCHAR(255)   | Password akun         |
| role  | ENUM('admin', 'student')	   | Role akun         |
| full_name  | VARCHAR(100)	   | Nama lengkap         |
| created_at  | TIMESTAMP       | default: current_timestamp()        |
| updated_at  | TIMESTAMP       | default: current_timestamp(), ON UPDATE CURRENT_TIMESTAMP()        |

---

## 📷 Dokumentasi Aplikasi
Berikut adalah dokumentasi jalannya aplikasi:

### 1. Halaman Login

![](/assets/images/login.png)  

---

### 2. Admin
a. Dashboard Admin
![](/assets/images/admin.png)    

b. Menambah Course
![](/assets/images/tambahcourse.png)  

c. Detail Student  
![](/assets/images/detail.png)  

d. Edit Student
![](/assets/images/editstudent.png)

---

### 3. Dashboard Student

![](/assets/images/student.png)  

---

## 🔗 Referensi
- [https://drive.google.com/file/d/1TuHtcKl15tECy1chpl1Hhj-0CKjiGgY7/view  ](https://drive.google.com/file/d/1TuHtcKl15tECy1chpl1Hhj-0CKjiGgY7/view)
