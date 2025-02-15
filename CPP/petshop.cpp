#include <iostream> // Library untuk fungsi input-output
#include <string>   // Library untuk tipe data string

using namespace std;

class Petshop {
private:
    string id;                // Kode produk
    string namaProduk;        // Nama produk
    string kategoriProduk;    // Kategori produk
    int hargaProduk;          // Harga produk

public:
    // Konstruktor default
    Petshop() {
        id = "";
        namaProduk = "";
        kategoriProduk = "";
        hargaProduk = 0;
    }

    // Setter dan Getter untuk id produk
    void setid() { 
        cout << "Masukkan Kode Produk: ";
        cin >> id; 
    }
    string getid() const { return id; }

    // Setter dan Getter untuk nama produk
    void setNamaProduk() { 
        cout << "Masukkan Nama Produk: ";
        cin.ignore();
        getline(cin, namaProduk); 
    }
    string getNamaProduk() const { return namaProduk; }

    // Setter dan Getter untuk kategori produk
    void setkategoriProduk() { 
        cout << "Masukkan Jenis Produk: ";
        cin.ignore();
        getline(cin, kategoriProduk); 
    }
    string getkategoriProduk() const { return kategoriProduk; }

    // Setter dan Getter untuk harga produk
    void setHargaProduk() { 
        cout << "Masukkan Harga Produk: ";
        cin >> hargaProduk; 
    }
    int getHargaProduk() const { return hargaProduk; }

    // Fungsi untuk memperbarui informasi produk tanpa parameter
    void ubahData() {
        cout << "\n--- Perbarui Data Produk ---" << endl;
        setid();
        setNamaProduk();
        setkategoriProduk();
        setHargaProduk();
        cout << "Data produk berhasil diperbarui!" << endl;
    }

    // Fungsi untuk menampilkan informasi produk
    void tampilkanData() const {
        cout << "+-----------------+----------------------+" << endl;
        cout << "|    Informasi Produk                    |" << endl;
        cout << "+-----------------+----------------------+" << endl;
        cout << "| Kode Produk     | " << id << endl;
        cout << "+-----------------+----------------------+" << endl;
        cout << "| Nama Produk     | " << namaProduk << endl;
        cout << "+-----------------+----------------------+" << endl;
        cout << "| Jenis Produk    | " << kategoriProduk << endl;
        cout << "+-----------------+----------------------+" << endl;
        cout << "| Harga Produk    | Rp " << hargaProduk << endl;
        cout << "+-----------------+----------------------+" << endl;
    }

    // Fungsi untuk mencari produk berdasarkan input user
    void cariData() const {
        string kodeCari;
        cout << "Masukkan kode produk yang dicari: ";
        cin >> kodeCari;
        if (id == kodeCari) {
            cout << "Produk ditemukan!" << endl;
            tampilkanData();
        } else {
            cout << "Produk tidak ditemukan." << endl;
        }
    }

    // Destructor
    ~Petshop() {}
};
