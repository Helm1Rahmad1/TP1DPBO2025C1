#include "petshop.cpp"  // Memasukkan definisi class Petshop
#include <iostream>     // Library untuk fungsi input-output
#include <list>         // Library untuk tipe data list
#include <algorithm>    // Library untuk fungsi remove_if

using namespace std;

int main() {
    list<Petshop> daftarProduk; // list untuk menyimpan daftar produk
    int choice;                 // Variabel untuk menyimpan pilihan menu
    
    do {
        // Menampilkan menu
        cout << "\n=============================\n";
        cout << "   PetShop Management Menu\n";
        cout << "=============================\n";
        cout << "1. Tampilkan Data\n";
        cout << "2. Tambah Data\n";
        cout << "3. Ubah Data\n";
        cout << "4. Hapus Data\n";
        cout << "5. Cari Data\n";
        cout << "6. Keluar\n";
        cout << "=============================\n";
        cout << "Pilih opsi: ";
        cin >> choice;
        
        switch (choice) {
            case 1: {
                // Menampilkan semua data produk
                if (daftarProduk.empty()) {
                    cout << "Tidak ada produk dalam daftar.\n";
                } else {
                    for (const auto &produk : daftarProduk) {
                        produk.tampilkanData();
                        cout << "----------------------\n";
                    }
                }
                break;
            }
            case 2: {
                // Menambah data produk baru
                Petshop produkBaru;
                produkBaru.ubahData(); // Memasukkan data langsung tanpa parameter
                daftarProduk.push_back(produkBaru);
                cout << "Produk berhasil ditambahkan!\n";
                break;
            }
            case 3: {
                // Mengubah data produk berdasarkan kode produk
                string kode;
                cout << "Masukkan Kode Produk yang akan diubah: "; cin >> kode;
                bool ditemukan = false;
                for (auto &produk : daftarProduk) {
                    if (produk.getid() == kode) {
                        produk.ubahData();
                        cout << "Data produk berhasil diperbarui!\n";
                        ditemukan = true;
                        break;
                    }
                }
                if (!ditemukan) cout << "Produk tidak ditemukan!\n";
                break;
            }
            case 4: {
                // Menghapus data produk berdasarkan kode produk
                string kode;
                cout << "Masukkan Kode Produk yang akan dihapus: "; cin >> kode;
                auto it = remove_if(daftarProduk.begin(), daftarProduk.end(), [&](const Petshop &produk) {
                    return produk.getid() == kode;
                });
                if (it != daftarProduk.end()) {
                    daftarProduk.erase(it, daftarProduk.end());
                    cout << "Produk berhasil dihapus!\n";
                } else {
                    cout << "Produk tidak ditemukan!\n";
                }
                break;
            }
            case 5: {
                // Mencari data produk berdasarkan kode produk
                string kode;
                cout << "Masukkan Kode Produk yang dicari: "; cin >> kode;
                bool ditemukan = false;
                for (const auto &produk : daftarProduk) {
                    if (produk.getid() == kode) {
                        produk.tampilkanData();
                        ditemukan = true;
                        break;
                    }
                }
                if (!ditemukan) cout << "Produk tidak ditemukan!\n";
                break;
            }
            case 6:
                // Keluar dari program
                cout << "Keluar dari program...\n";
                break;
            default:
                // Pilihan tidak valid
                cout << "Pilihan tidak valid!\n";
        }
    } while (choice != 6);
    
    return 0;
}
