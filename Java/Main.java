import java.util.ArrayList;
import java.util.Iterator;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        ArrayList<Petshop> daftarProduk = new ArrayList<>();
        int choice;

        do {
            System.out.println("\n=============================");
            System.out.println("   PetShop Management Menu");
            System.out.println("=============================");
            System.out.println("1. Tampilkan Data");
            System.out.println("2. Tambah Data");
            System.out.println("3. Ubah Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("6. Keluar");
            System.out.println("=============================");
            System.out.print("Pilih opsi: ");
            choice = scanner.nextInt();

            switch (choice) {
                case 1:
                    if (daftarProduk.isEmpty()) {
                        System.out.println("Tidak ada produk dalam daftar.");
                    } else {
                        for (Petshop produk : daftarProduk) {
                            produk.tampilkanData();
                        }
                    }
                    break;
                case 2:
                    Petshop produkBaru = new Petshop();
                    produkBaru.ubahData(scanner);
                    daftarProduk.add(produkBaru);
                    System.out.println("Produk berhasil ditambahkan!");
                    break;
                case 3:
                    System.out.print("Masukkan Kode Produk yang akan diubah: ");
                    String kodeEdit = scanner.next();
                    boolean ditemukanEdit = false;
                    for (Petshop produk : daftarProduk) {
                        if (produk.getId().equals(kodeEdit)) {
                            produk.ubahData(scanner);
                            System.out.println("Data produk berhasil diperbarui!");
                            ditemukanEdit = true;
                            break;
                        }
                    }
                    if (!ditemukanEdit) System.out.println("Produk tidak ditemukan!");
                    break;
                case 4:
                    System.out.print("Masukkan Kode Produk yang akan dihapus: ");
                    String kodeHapus = scanner.next();
                    Iterator<Petshop> iterator = daftarProduk.iterator();
                    boolean ditemukanHapus = false;
                    while (iterator.hasNext()) {
                        if (iterator.next().getId().equals(kodeHapus)) {
                            iterator.remove();
                            ditemukanHapus = true;
                            System.out.println("Produk berhasil dihapus!");
                            break;
                        }
                    }
                    if (!ditemukanHapus) System.out.println("Produk tidak ditemukan!");
                    break;
                case 5:
                    System.out.print("Masukkan Kode Produk yang dicari: ");
                    String kodeCari = scanner.next();
                    boolean ditemukanCari = false;
                    for (Petshop produk : daftarProduk) {
                        if (produk.getId().equals(kodeCari)) {
                            produk.tampilkanData();
                            ditemukanCari = true;
                            break;
                        }
                    }
                    if (!ditemukanCari) System.out.println("Produk tidak ditemukan!");
                    break;
                case 6:
                    System.out.println("Keluar dari program...");
                    break;
                default:
                    System.out.println("Pilihan tidak valid!");
            }
        } while (choice != 6);

        scanner.close();
    }
}
