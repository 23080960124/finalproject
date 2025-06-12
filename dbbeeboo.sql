CREATE TABLE tbuser (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('owner','karyawan') NOT NULL
);

CREATE TABLE tbproduk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    kategori VARCHAR(100) NOT NULL
);

CREATE TABLE tbtransaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_karyawan INT,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(12,2),
    FOREIGN KEY (id_karyawan) REFERENCES tbuser(id)
);

CREATE TABLE tbdetail_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT,
    id_produk INT,
    jumlah INT,
    subtotal DECIMAL(10,2),
    FOREIGN KEY (id_transaksi) REFERENCES tbtransaksi(id),
    FOREIGN KEY (id_produk) REFERENCES tbproduk(id)
);