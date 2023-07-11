CREATE DATABASE weton_jodoh;
USE weton_jodoh;

CREATE TABLE neptu_hari(
    id_h INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama_h VARCHAR(50) NOT NULL,
    nilai_h INT NOT NULL
);

CREATE TABLE neptu_pasaran(
    id_p INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama_p VARCHAR(50) NOT NULL,
    nilai_p INT NOT NULL
);

CREATE TABLE orang(
    id_o INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nama_o VARCHAR(100) NOT NULL,
    neptu_hari_id INT NOT NULL,
    neptu_pasaran_id INT NOT NULL,
    FOREIGN KEY (neptu_hari_id) REFERENCES neptu_hari(id_h),
    FOREIGN KEY (neptu_pasaran_id) REFERENCES neptu_pasaran(id_p)
);