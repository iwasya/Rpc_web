<?php
// URL layanan SOAP (ganti dengan URL yang sesuai)
$wsdl = 'http://127.0.0.1/soap_service.php?wsdl';
try {
    // Membuat instance dari SoapClient
    $client = new SoapClient($wsdl);

    // Menambahkan buku
    $addResponse = $client->addBook('1', 'Pemrograman Web');
    echo "Add Response: " . $addResponse . "\n";

    // Mengambil buku
    $getResponse = $client->getBook('1');
    echo "Get Response: " . $getResponse . "\n";

    // Menghapus buku
    $deleteResponse = $client->deleteBook('1');
    echo "Delete Response: " . $deleteResponse . "\n";

    // Coba ambil buku yang sudah dihapus
    $getDeletedResponse = $client->getBook('1');
    echo "Get Deleted Response: " . $getDeletedResponse . "\n";
} catch (SoapFault $e) {
    echo "SOAP Fault: " . $e->getMessage() . "\n";
}
?>