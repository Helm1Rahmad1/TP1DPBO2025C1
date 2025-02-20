from petshop import Petshop

def main():
    daftar_produk = []
    
    while True:
        print("\n=============================")
        print("   PetShop Management Menu   ")
        print("=============================")
        print("1. Tampilkan Data")
        print("2. Tambah Data")
        print("3. Ubah Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("6. Keluar")
        print("=============================")
        choice = input("Pilih opsi: ")

        if choice == "1":
            if not daftar_produk:
                print("Tidak ada produk dalam daftar.")
            else:
                for produk in daftar_produk:
                    produk.tampilkan_data()

        elif choice == "2":
            produk_baru = Petshop()
            produk_baru.ubah_data()
            daftar_produk.append(produk_baru)
            print("Produk berhasil ditambahkan!")

        elif choice == "3":
            kode = input("Masukkan Kode Produk yang akan diubah: ")
            ditemukan = False
            for produk in daftar_produk:
                if produk.get_id() == kode:
                    produk.ubah_data()
                    print("Data produk berhasil diperbarui!")
                    ditemukan = True
                    break
            if not ditemukan:
                print("Produk tidak ditemukan!")

        elif choice == "4":
            kode = input("Masukkan Kode Produk yang akan dihapus: ")
            for produk in daftar_produk:
                if produk.get_id() == kode:
                    daftar_produk.remove(produk)
                    print("Produk berhasil dihapus!")
                    break
            else:
                print("Produk tidak ditemukan!")

        elif choice == "5":
            kode = input("Masukkan Kode Produk yang dicari: ")
            ditemukan = False
            for produk in daftar_produk:
                if produk.get_id() == kode:
                    print("\nDetail Produk:")
                    produk.tampilkan_data()
                    ditemukan = True
                    break
            if not ditemukan:
                print("Produk tidak ditemukan!")

        elif choice == "6":
            print("Keluar dari program...")
            break

        else:
            print("Pilihan tidak valid!")

if __name__ == "__main__":
    main()
