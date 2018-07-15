-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2018 pada 13.21
-- Versi server: 5.7.19
-- Versi PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(30) NOT NULL,
  `penulis` varchar(20) NOT NULL,
  `penerbit` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `cover` varchar(50) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `isbn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penulis`, `penerbit`, `kategori`, `cover`, `tahun_terbit`, `isbn`) VALUES
(1, 'Algoritma dan Pemrograman', 'Leony Lidya', 5, 1, 'file_1531200137.jpg', '2018-03-14', 12345678),
(2, 'Pemrograman Web', 'Benyamin Sueb', 1, 1, 'file_1531127991.jpg', '2018-07-09', 124195012),
(7, 'Belajar Codeigniter', 'Budi Sunaryo', 5, 1, 'file_1531145594.jpg', '2018-07-09', 2147483647),
(8, 'Laravel', 'Muhamad Reshan', 3, 1, 'file_1531145977.jpg', '2018-07-09', 432900),
(9, 'Rumah Melati', 'Sabeni', 2, 4, 'file_1531146143.jpg', '2018-07-09', 23094920),
(10, 'Cinta Tak Pernah Sama', 'Dista Dee', 1, 2, 'file_1531147248.jpg', '2018-07-09', 230920420),
(11, 'Misteri Kehidupan Setelah Mati', 'Miftahul Asror Malik', 4, 5, 'file_1531147401.jpg', '2018-07-18', 290432890),
(12, 'Lamunan Senja', 'Diana Rizky M', 2, 2, 'file_1531147479.jpg', '2018-07-09', 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Pemrograman '),
(2, 'Fiksi'),
(3, 'Komedi'),
(4, 'Misteri'),
(5, 'Religi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'Elexmedia Komputindo'),
(2, 'Andi Publisher'),
(3, 'Lokomedia'),
(4, 'Grasindo'),
(5, 'Informatika');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`),
  ADD KEY `penerbit` (`penerbit`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `kategori` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penerbit` FOREIGN KEY (`penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
