# Experiments

## Experiment 1 - Creating a Class Diagram

**Class:** `Karyawan`

**Attributes:** `id`, `nama`, `jenisKelamin`, `jabatan`, and `gaji`.

**Methods:** `tampilkanDataDiri()` and `lihatGaji()`.

Files:

- [Karyawan.java](experiment-01-class-diagram/Karyawan.java)
- [Class diagram DOCX](experiment-01-class-diagram/Jobsheet-02-4.1-Class-Diagram.docx)

## Experiment 2 - Creating and Accessing Class Members

**Class:** `Mahasiswa`

The test instantiates three objects: `mhs1`, `mhs2`, and `mhs3`.

Key concepts:

- `mhs1.nim = 101` assigns `101` to the `nim` attribute of `mhs1`.
- `mhs1.tampilBiodata()` calls the method that displays the object's NIM, name, address, and class.

Files:

- [Mahasiswa.java](experiment-02-class-members/Mahasiswa.java)
- [TestMahasiswa.java](experiment-02-class-members/TestMahasiswa.java)

Run:

```bash
cd experiment-02-class-members
javac Mahasiswa.java TestMahasiswa.java
java TestMahasiswa
```

## Experiment 3 - Writing a Method with a Return Value

**Class:** `Barang`

The `tambahStok(int brgMasuk)` method receives incoming stock as an argument and returns the calculated stock total.

Files:

- [Barang.java](experiment-03-return-value/Barang.java)
- [TestBarang.java](experiment-03-return-value/TestBarang.java)

Run:

```bash
cd experiment-03-return-value
javac Barang.java TestBarang.java
java TestBarang
```

Expected final line:

```text
Stok baru adalah 30
```
