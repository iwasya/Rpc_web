<?php
session_start();

// Memeriksa apakah session books sudah ada, jika tidak, buat array kosong
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

// Mengambil data dari session
$books = &$_SESSION['books'];

// Menambahkan buku baru
function addBook($id, $title) {
    global $books;
    $books[$id] = $title;
    return "Book added successfully.";
}

// Mengambil buku berdasarkan ID
function getBook($id) {
    global $books;
    return $books[$id] ?? "Book not found.";
}

// Menghapus buku berdasarkan ID
function deleteBook($id) {
    global $books;
    if (isset($books[$id])) {
        unset($books[$id]);
        return "Book deleted successfully.";
    }
    return "Book not found.";
}

// Mengedit buku berdasarkan ID
function editBook($id, $newTitle) {
    global $books;
    if (isset($books[$id])) {
        $books[$id] = $newTitle;
        return "Book updated successfully.";
    }
    return "Book not found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data JSON dari request
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'];
    $response = '';

    switch ($action) {
        case 'add':
            $response = addBook($data['id'], $data['title']);
            break;
        case 'get':
            $response = getBook($data['id']);
            break;
        case 'delete':
            $response = deleteBook($data['id']);
            break;
        case 'edit':
            $response = editBook($data['id'], $data['title']);
            break;
    }

    // Hanya mengembalikan respons tanpa bagian books
    echo json_encode(['response' => $response]);
}
?>