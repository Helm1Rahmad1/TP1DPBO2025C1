import java.util.Scanner;

class Petshop {
    private String id;
    private String namaProduk;
    private String kategoriProduk;
    private int hargaProduk;

    public Petshop() {
        this.id = "";
        this.namaProduk = "";
        this.kategoriProduk = "";
        this.hargaProduk = 0;
    }

    public void setId(Scanner scanner) {
        System.out.print("Masukkan Kode Produk: ");
        this.id = scanner.next();
    }

    public String getId() {
        return this.id;
    }

    public void setNamaProduk(Scanner scanner) {
        System.out.print("Masukkan Nama Produk: ");
        scanner.nextLine();
        this.namaProduk = scanner.nextLine();
    }

    public String getNamaProduk() {
        return this.namaProduk;
    }

    public void setKategoriProduk(Scanner scanner) {
        System.out.print("Masukkan Jenis Produk: ");
        this.kategoriProduk = scanner.next();
    }

    public String getKategoriProduk() {
        return this.kategoriProduk;
    }

    public void setHargaProduk(Scanner scanner) {
        System.out.print("Masukkan Harga Produk: ");
        this.hargaProduk = scanner.nextInt();
    }

    public int getHargaProduk() {
        return this.hargaProduk;
    }

    public void ubahData(Scanner scanner) {
        setId(scanner);
        setNamaProduk(scanner);
        setKategoriProduk(scanner);
        setHargaProduk(scanner);
        System.out.println("Data produk berhasil diperbarui!");
    }

    public void tampilkanData() {
        System.out.println("+-----------------+----------------------+");
        System.out.println("|    Informasi Produk                    |");
        System.out.println("+-----------------+----------------------+");
        System.out.println("| Kode Produk     | " + id);
        System.out.println("| Nama Produk     | " + namaProduk);
        System.out.println("| Jenis Produk    | " + kategoriProduk);
        System.out.println("| Harga Produk    | Rp. " + hargaProduk);
        System.out.println("+-----------------+----------------------+");
    }
}
