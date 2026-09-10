# Jobsheet 03 - Written Answers and Outputs

## Experiment 2 Questions

### 1. Why does the first speed increase display an engine-off warning?

`kontakOn` initially contains `false`. `tambahKecepatan()` checks this value before changing the speed, so it rejects the request until `nyalakanMesin()` is called.

### 2. Why are `kecepatan` and `kontakOn` private?

Private access prevents other classes from replacing the values carelessly. Changes must pass through methods that enforce the rules of the `Motor` object.

### 3. Maximum speed of 100

The final `tambahKecepatan()` implementation only increases speed while it is below 100 and uses `Math.min(kecepatan + 5, 100)` to prevent it from exceeding the limit. The question says `Bike`, but the surrounding experiment consistently uses `Motor`, so the answer is applied to `Motor`.

## Experiments 3 and 4 Questions

1. A getter reads and returns a private attribute. A setter changes a private attribute through a controlled public method.
2. `getSimpanan()` returns the member's current savings balance.
3. `setor(float uang)` is used to add to the balance.
4. A constructor is a special block that initializes an object when `new` is used.
5. A constructor has the same name as its class, has no return type, and may accept parameters or be overloaded.
6. Yes. A constructor may be private when object creation needs to be controlled, such as in a Singleton or utility class.
7. Parameters are used when an object or method needs values supplied by its caller, such as a member's name and address.
8. A class attribute uses `static` and is shared by all objects. An instance attribute belongs separately to each object.
9. A class method uses `static` and belongs to the class. An instance method belongs to an object and can directly access that object's instance attributes.

## Tasks 1-3

### Verified output

```text
Name : James
Age : 30
```

`setAge(35)` produces 30 because the setter replaces every value above 30 with the maximum permitted value. The completed setter also replaces values below 18 with 18.

## Tasks 4-6

### Verified fixed-input output

```text
Nama Pemilik Kontainer: PT. Maju Bersama
Kapasitas Maksimal: 5000.0 kg

Memasukkan muatan baru seberat 6.000 kg...
Maaf, berat muatan melebihi kapasitas maksimal kontainer.
Berat muatan saat ini: 0.0 kg

Memasukkan muatan baru seberat 4.000 kg...
Berat muatan saat ini: 4000.0 kg

Membongkar muat/menurunkan barang seberat 500 kg...
Berat muatan saat ini: 3500.0 kg

Membongkar muat/menurunkan barang seberat 1.500 kg...
Berat muatan saat ini: 2000.0 kg
```

The capacity check uses `beratMuatanSaatIni + berat > kapasitasMaksimal`. The unloading safety check uses `berat > beratMuatanSaatIni * 0.5`. The Scanner driver obtains both operation values from the terminal.

## Task 7

### Verified output

```text
Film: Avengers: Endgame
Harga Tiket: 35000.0
Status Lunas? false

Memproses pembayaran...
Status Lunas Terbaru: true
```

The negative price is replaced with Rp35,000 by the constructor. Payment status is read-only from outside the class because there is a getter but no setter; it changes only through `lakukanPembayaran()`.

