-- Membuat Database
CREATE DATABASE presengo;

-- Menggunakan Database
USE presengo;

-- Tabel Divisi
CREATE TABLE divisi (
    id_divisi INT AUTO_INCREMENT PRIMARY KEY,
    nama_divisi VARCHAR(100) NOT NULL,
    keterangan TEXT,
    id_kepala_divisi INT NULL
);

-- Tabel Karyawan
CREATE TABLE karyawan (
    id_karyawan INT AUTO_INCREMENT PRIMARY KEY,
    id_divisi INT NOT NULL,
    nama_karyawan VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    jabatan VARCHAR(100),

    CONSTRAINT fk_karyawan_divisi
    FOREIGN KEY (id_divisi)
    REFERENCES divisi(id_divisi)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

-- Tabel Users
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    role ENUM(
        'admin',
        'divisi',
        'karyawan'
    ) NOT NULL,

    id_karyawan INT NULL,

    CONSTRAINT fk_users_karyawan
    FOREIGN KEY (id_karyawan)
    REFERENCES karyawan(id_karyawan)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

-- Tabel Presensi
CREATE TABLE presensi (
    id_presensi INT AUTO_INCREMENT PRIMARY KEY,

    id_karyawan INT NOT NULL,

    status ENUM(
        'Hadir',
        'Izin',
        'Sakit',
        'Alpha'
    ) NOT NULL,

    waktu_presensi TIMESTAMP
    DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_presensi_karyawan
    FOREIGN KEY (id_karyawan)
    REFERENCES karyawan(id_karyawan)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

-- Data Divisi
INSERT INTO divisi
(
    nama_divisi,
    keterangan,
    id_kepala_divisi
)
VALUES
(
    'IT',
    'Divisi Teknologi Informasi dan Pengembangan Sistem',
    NULL
),
(
    'HRD',
    'Divisi Human Resource Development dan Administrasi SDM',
    NULL
),
(
    'Keuangan',
    'Divisi Pengelolaan Keuangan dan Akuntansi Perusahaan',
    NULL
),
(
    'Marketing',
    'Divisi Pemasaran dan Hubungan Pelanggan',
    NULL
);

-- Data Karyawan
INSERT INTO karyawan
(id_divisi, nama_karyawan, alamat, no_hp, jabatan)
VALUES

-- Divisi IT

(1,'Fandy Yoga Aditama','Boyolali','081234567801','Kepala Divisi'),
(1,'Fahrezi Raka Pramudya','Surakarta','081234567802','Staff IT'),
(1,'Himawan Danendra','Klaten','081234567803','Staff IT'),
(1,'Nadzif Ilhami Riyadi','Sukoharjo','081234567804','Staff IT'),
(1,'Raissa Mayla Jasmine','Karanganyar','081234567805','Staff IT'),
(1,'Nafryeza Zasky Nindya Eka Fadillah','Wonogiri','081234567806','Staff IT'),
(1,'Fachrul Ikhwan Nur Rasyid','Boyolali','081234567807','Staff IT'),
(1,'Andika Dwi Prayitno','Surakarta','081234567808','Staff IT'),
(1,'Satria Galuh Saputra','Klaten','081234567809','Staff IT'),
(1,'Razico Almadani Sofenda Putra','Sukoharjo','081234567810','Staff IT'),
(1,'Raffi Rizkiansyah','Karanganyar','081234567811','Staff IT'),

-- Divisi HRD

(2,'Khansa Nadhira Sari','Wonogiri','081234567812','Kepala Divisi'),
(2,'Miftah Rafid Firdaus','Boyolali','081234567813','Staff HRD'),
(2,'Ryan Adib Fitra','Surakarta','081234567814','Staff HRD'),
(2,'Naila Khairunnisa','Klaten','081234567815','Staff HRD'),
(2,'Al Exsan Muchlis Purnomo','Sukoharjo','081234567816','Staff HRD'),
(2,'Ahmad Kamaludin','Karanganyar','081234567817','Staff HRD'),
(2,'Feriawan Setyoaji Saputro','Wonogiri','081234567818','Staff HRD'),
(2,'Muhammad Gilang Ramadhan','Boyolali','081234567819','Staff HRD'),
(2,'Muhammad Imadudin','Surakarta','081234567820','Staff HRD'),
(2,'TB Hilmi Alghifari','Klaten','081234567821','Staff HRD'),
(2,'Ilham Dwi Prasetyo','Sukoharjo','081234567822','Staff HRD'),

-- Divisi Keuangan

(3,'Celvin Ardyatmajaya Putra','Semarang','081234567823','Kepala Divisi'),
(3,'Muhammad Nawawi Al Labib','Salatiga','081234567824','Staff Keuangan'),
(3,'Dimas Satria Mulyono','Sragen','081234567825','Staff Keuangan'),
(3,'Muhammad Java Rahmanda','Purwodadi','081234567826','Staff Keuangan'),
(3,'Desatu Shifa','Semarang','081234567827','Staff Keuangan'),
(3,'Deysilla Afifah Feriz','Salatiga','081234567828','Staff Keuangan'),
(3,'Yola Tria Sitma','Sragen','081234567829','Staff Keuangan'),
(3,'Hidhayatul Angger Sukesi','Purwodadi','081234567830','Staff Keuangan'),
(3,'Galang Bhakti Praja Utama','Semarang','081234567831','Staff Keuangan'),
(3,'Mohammad Fahmi','Salatiga','081234567832','Staff Keuangan'),
(3,'Valentino Vemas Audrey','Sragen','081234567833','Staff Keuangan'),

-- Divisi Marketing

(4,'Ixal Thoriq Uni''am','Yogyakarta','081234567834','Kepala Divisi'),
(4,'Benediktus Michael Adolf Maydilau Sumapoe','Magelang','081234567835','Staff Marketing'),
(4,'Darrely Alfarizy Heristiavin S.','Purwokerto','081234567836','Staff Marketing'),
(4,'Bastian Maulana','Purwodadi','081234567837','Staff Marketing'),
(4,'Raffi Nur Said','Yogyakarta','081234567838','Staff Marketing'),
(4,'Dimas Muhammad Ihram','Magelang','081234567839','Staff Marketing'),
(4,'Novita Fitri Almutavi','Purwokerto','081234567840','Staff Marketing'),
(4,'Azzahra Cholifaqul Saqeena Putri','Purwodadi','081234567841','Staff Marketing'),
(4,'Latifa Salsabila Hanandini','Yogyakarta','081234567842','Staff Marketing'),
(4,'Auliya Andy Nurlaila','Magelang','081234567843','Staff Marketing'),
(4,'Friatna Egi Setiawan','Purwokerto','081234567844','Staff Marketing'),
(4,'Siska Fatikah','Purwodadi','081234567845','Staff Marketing');

-- Menentukan Kepala Divisi

UPDATE divisi
SET id_kepala_divisi = 1
WHERE id_divisi = 1;

UPDATE divisi
SET id_kepala_divisi = 12
WHERE id_divisi = 2;

UPDATE divisi
SET id_kepala_divisi = 23
WHERE id_divisi = 3;

UPDATE divisi
SET id_kepala_divisi = 34
WHERE id_divisi = 4;

-- Data Users

INSERT INTO users
(username, password, role, id_karyawan)
VALUES

('admin','admin123','admin',NULL),

('fandy','12345','divisi',1),
('khansa','12345','divisi',12),
('celvin','12345','divisi',23),
('ixal','12345','divisi',34);