<?php
session_start();

class LibraryService {
    public function __construct() {
        // Inisialisasi buku dari sesi jika belum ada
        if (!isset($_SESSION['books'])) {
            $_SESSION['books'] = [];
        }
    }

    public function addBook($id, $title) {
        // Menyimpan buku ke dalam sesi
        $_SESSION['books'][$id] = $title;
        return "Book added successfully.";
    }

    public function getBook($id) {
        // Mengambil buku dari sesi
        return $_SESSION['books'][$id] ?? "Book not found.";
    }

    public function deleteBook($id) {
        // Menghapus buku dari sesi
        if (isset($_SESSION['books'][$id])) {
            unset($_SESSION['books'][$id]);
            return "Book deleted successfully.";
        }
        return "Book not found.";
    }
}

// Membuat server SOAP
$server = new SoapServer(null, ['uri' => 'http://localhost/soap_service.php']);
$server->setClass('LibraryService');
$server->handle();
?>