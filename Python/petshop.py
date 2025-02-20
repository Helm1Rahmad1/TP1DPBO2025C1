class Petshop:
    def __init__(self):
        self.id = ""
        self.nama_produk = ""
        self.kategori_produk = ""
        self.harga_produk = 0

    def set_id(self):
        self.id = input("Masukkan Kode Produk: ")

    def get_id(self):
        return self.id

    def set_nama_produk(self):
        self.nama_produk = input("Masukkan Nama Produk: ")

    def get_nama_produk(self):
        return self.nama_produk

    def set_kategori_produk(self):
        self.kategori_produk = input("Masukkan Jenis Produk: ")

    def get_kategori_produk(self):
        return self.kategori_produk

    def set_harga_produk(self):
        while True:
            try:
                self.harga_produk = int(input("Masukkan Harga Produk: "))
                break
            except ValueError:
                print("Harga harus berupa angka!")

    def get_harga_produk(self):
        return self.harga_produk

    def ubah_data(self):
        print("\n--- Perbarui Data Produk ---")
        self.set_id()
        self.set_nama_produk()
        self.set_kategori_produk()
        self.set_harga_produk()
        print("Data produk berhasil diperbarui!")

    def tampilkan_data(self):
        print("\n+--------------------------+")
        print("|      Data Produk         |")
        print("+--------------------------+")
        print(f"| Kode Produk    : {self.id}")
        print(f"| Nama Produk    : {self.nama_produk}")
        print(f"| Jenis Produk   : {self.kategori_produk}")
        print(f"| Harga Produk   : Rp. {self.harga_produk}")
        print("+--------------------------+")
