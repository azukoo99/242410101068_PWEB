# 💎 DiamondStore
---

## Fitur Utama

### Portal Pelanggan
- **Cek Akun Mobile Legends (Fetch API)**: Verifikasi asinkronus untuk mendeteksi *nickname* game berdasarkan User ID & Zone ID sebelum checkout untuk menghindari salah kirim.
- **Formulir Top-Up Dinamis**: Pilihan paket diamond dibaca secara *real-time* dari database dengan validasi stok otomatis (pembelian diblokir jika stok habis).
- **Riwayat Pesanan**: Tabel riwayat transaksi lengkap dengan detail status, tanggal, metode bayar, dan total harga.
- **Mode Gelap/Terang (Dark/Light Mode)**: Peralihan tema menggunakan cookies (`color-theme`) tanpa kedipan layar (*flicker*) saat halaman dimuat ulang.

### Dashboard Admin
- **Statistik Ringkasan Harian**: Kartu grafik yang menghitung Pesanan Hari Ini, Pendapatan Hari Ini (Rp), dan Total Diamond Terjual Hari Ini.
- **Kelola Stok Produk (CRUD)**: Menambah, mengubah detail, dan menghapus paket produk diamond lewat popup modal interaktif.
- **Live Search Stok**: Pencarian instan produk berdasarkan nama paket atau ID produk di sisi frontend.
- **Log Pesanan Pelanggan**: Tabel komprehensif seluruh transaksi pelanggan dengan sistem paginasi (*pagination*) dan akses cepat ke detail invoice masing-masing.
- **Proteksi Keamanan**: Pembatasan akses ke menu `/admin/*` menggunakan Middleware khusus role `admin`.

---

## Teknologi yang Digunakan

- **Backend**: PHP 8.2+, Laravel 13.
- **Frontend**: Tailwind CSS, Alpine.js, Vanilla JS.
- **Database**: MySQL.
- **Asset Bundler**: Vite.
- **Penyedia API**: APIGames REST API
- **Hosting / Deploy**: Railway.

---

## 📊 Entity Relationship Diagram (ERD)

Berikut adalah struktur hubungan antar tabel database di proyek ini:

```mermaid
erDiagram
    users ||--o{ pesanans : "memiliki"
    users ||--o{ sessions : "melacak"

    users {
        int id PK
        string name
        string email "Unique"
        string password
        string role
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    pesanans {
        int id PK
        int user_id FK
        string game_user_id
        string zone_id
        string paket
        int harga
        string pembayaran
        string status
        string email
        timestamp created_at
        timestamp updated_at
    }

    products {
        int id PK
        string nama_paket
        int harga
        int stok
        timestamp created_at
        timestamp updated_at
    }

    sessions {
        string id PK
        int user_id FK
        string ip_address
        text user_agent
        longtext payload
        int last_activity
    }

    password_reset_tokens {
        string email PK
        string token
        timestamp created_at
    }

    cache {
        string key PK
        text value
        int expiration
    }

    jobs {
        bigint id PK
        string queue
        longtext payload
        tinyint attempts
        int reserved_at
        int available_at
        int created_at
    }
```

---
