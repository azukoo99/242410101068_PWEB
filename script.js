var hamburger = document.getElementById('hamburger');
var menu = document.getElementById('navbar-menu');

hamburger.addEventListener('click', function () {
    menu.classList.toggle('menu-open');
    hamburger.classList.toggle('active');
});

document.querySelectorAll('.nav-link').forEach(function (link) {
    link.addEventListener('click', function () {
        menu.classList.remove('menu-open');
        hamburger.classList.remove('active');
    });
});

const invForm         = document.getElementById('inv-form-barang');
const invFormTitle    = document.getElementById('inv-form-title');
const invBtnSubmit   = document.getElementById('inv-btn-submit');
const invBtnBatal    = document.getElementById('inv-btn-batal');
const invTbody       = document.getElementById('inv-tbody');
const invInputCari   = document.getElementById('inv-input-cari');
const invFilterKat   = document.getElementById('inv-filter-kategori');
const invEmpty       = document.getElementById('inv-empty');
const invTabelWrap   = document.querySelector('.inv-tabel-wrapper');
const elStatTotal    = document.getElementById('stat-total-item');
const elStatNilai    = document.getElementById('stat-nilai-inventaris');
const elStatMenipis  = document.getElementById('stat-stok-menipis');
const invDialogOverlay = document.getElementById('inv-dialog-overlay');
const invDialogMsg     = document.getElementById('inv-dialog-msg');
const invBtnKonfirmasi = document.getElementById('inv-btn-konfirmasi-hapus');
const invBtnBatalHapus = document.getElementById('inv-btn-batal-hapus');
const elKode    = document.getElementById('inv-kode');
const elNama    = document.getElementById('inv-nama');
const elKat     = document.getElementById('inv-kategori');
const elStok    = document.getElementById('inv-stok');
const elHarga   = document.getElementById('inv-harga');
const elTanggal = document.getElementById('inv-tanggal');
const errKode    = document.getElementById('inv-err-kode');
const errNama    = document.getElementById('inv-err-nama');
const errKat     = document.getElementById('inv-err-kategori');
const errStok    = document.getElementById('inv-err-stok');
const errHarga   = document.getElementById('inv-err-harga');
const errTanggal = document.getElementById('inv-err-tanggal');
let daftarBarang = [];
let editIndex    = -1;
let hapusIndex   = -1;

const STORAGE_KEY = 'diamondstore_inventaris';

const simpanKeStorage = () => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(daftarBarang));
};

const muatDariStorage = () => {
    const data = localStorage.getItem(STORAGE_KEY);
    if (data) {
        daftarBarang = JSON.parse(data);
    }
};
const formatRupiah = (angka) => {
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
};

const formatTanggal = (tgl) => {
    const d = new Date(tgl);
    return d.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
};

const updateStatistik = () => {
    elStatTotal.textContent = daftarBarang.length;
    const totalNilai = daftarBarang.reduce((acc, b) => acc + (b.stok * b.harga), 0);
    elStatNilai.textContent = formatRupiah(totalNilai);
    const menipis = daftarBarang.filter((b) => b.stok < 5).length;
    elStatMenipis.textContent = menipis;
};
const renderTabel = () => {
    const keyword   = invInputCari.value.toLowerCase().trim();
    const katFilter = invFilterKat.value;
    const dataFiltered = daftarBarang.filter((barang) => {
        const cocokCari = barang.nama.toLowerCase().includes(keyword)
                       || barang.kode.toLowerCase().includes(keyword);
        const cocokKat  = katFilter === '' || barang.kategori === katFilter;
        return cocokCari && cocokKat;
    });
    invTbody.innerHTML = '';

    if (dataFiltered.length === 0) {
        invTabelWrap.style.display = 'none';
        invEmpty.classList.add('show');
    } else {
        invTabelWrap.style.display = '';
        invEmpty.classList.remove('show');
        dataFiltered.forEach((barang, i) => {
            const indexAsli = daftarBarang.findIndex((b) => b.kode === barang.kode);
            let kelasStok = 'inv-stok-aman';
            if (barang.stok === 0) kelasStok = 'inv-stok-habis';
            else if (barang.stok < 5) kelasStok = 'inv-stok-rendah';

            const tr = document.createElement('tr');
            tr.style.animationDelay = `${i * 0.04}s`;
            tr.innerHTML = `
                <td>${i + 1}</td>
                <td><strong>${barang.kode}</strong></td>
                <td>${barang.nama}</td>
                <td><span class="inv-badge-kategori">${barang.kategori}</span></td>
                <td><span class="inv-badge-stok ${kelasStok}">${barang.stok}</span></td>
                <td>${formatRupiah(barang.harga)}</td>
                <td>${formatTanggal(barang.tanggal)}</td>
                <td>
                    <div class="inv-aksi-group">
                        <button class="inv-btn-aksi inv-btn-edit" data-index="${indexAsli}">✏️ Edit</button>
                        <button class="inv-btn-aksi inv-btn-hapus" data-index="${indexAsli}">🗑️ Hapus</button>
                    </div>
                </td>
            `;
            invTbody.appendChild(tr);
        });
    }

    updateStatistik();
};
const clearErrors = () => {
    [errKode, errNama, errKat, errStok, errHarga, errTanggal].forEach((el) => {
        el.textContent = '';
    });
    [elKode, elNama, elKat, elStok, elHarga, elTanggal].forEach((el) => {
        el.classList.remove('inv-input-error');
    });
};

const setError = (inputEl, errEl, pesan) => {
    inputEl.classList.add('inv-input-error');
    errEl.textContent = pesan;
};

const validasiForm = () => {
    clearErrors();
    let valid = true;
    const kode = elKode.value.trim();
    if (!kode) {
        setError(elKode, errKode, 'Kode paket wajib diisi.');
        valid = false;
    } else if (kode.length < 3) {
        setError(elKode, errKode, 'Minimal 3 karakter.');
        valid = false;
    } else {
        const duplikat = daftarBarang.findIndex((b) => b.kode.toLowerCase() === kode.toLowerCase());
        if (duplikat !== -1 && duplikat !== editIndex) {
            setError(elKode, errKode, 'Kode paket sudah digunakan.');
            valid = false;
        }
    }
    const nama = elNama.value.trim();
    if (!nama) {
        setError(elNama, errNama, 'Nama paket wajib diisi.');
        valid = false;
    } else if (nama.length < 2) {
        setError(elNama, errNama, 'Minimal 2 karakter.');
        valid = false;
    }
    if (!elKat.value) {
        setError(elKat, errKat, 'Pilih kategori.');
        valid = false;
    }
    const stok = elStok.value;
    if (stok === '' || stok === null) {
        setError(elStok, errStok, 'Stok wajib diisi.');
        valid = false;
    } else if (Number(stok) < 0 || !Number.isInteger(Number(stok))) {
        setError(elStok, errStok, 'Stok harus bilangan bulat ≥ 0.');
        valid = false;
    }
    const harga = elHarga.value;
    if (harga === '' || harga === null) {
        setError(elHarga, errHarga, 'Harga wajib diisi.');
        valid = false;
    } else if (Number(harga) <= 0) {
        setError(elHarga, errHarga, 'Harga harus lebih dari 0.');
        valid = false;
    }
    if (!elTanggal.value) {
        setError(elTanggal, errTanggal, 'Tanggal wajib diisi.');
        valid = false;
    }

    return valid;
};
invForm.addEventListener('submit', (e) => {
    e.preventDefault();

    if (!validasiForm()) return;
    const data = {
        kode:     elKode.value.trim(),
        nama:     elNama.value.trim(),
        kategori: elKat.value,
        stok:     parseInt(elStok.value),
        harga:    parseInt(elHarga.value),
        tanggal:  elTanggal.value
    };
    if (editIndex === -1) {
        daftarBarang.push(data);
    } else {
        daftarBarang[editIndex] = data;
        keluarModeEdit();
    }

    simpanKeStorage();
    renderTabel();
    invForm.reset();
    clearErrors();
});
const masukModeEdit = (index) => {
    editIndex = index;
    const barang = daftarBarang[index];
    elKode.value    = barang.kode;
    elNama.value    = barang.nama;
    elKat.value     = barang.kategori;
    elStok.value    = barang.stok;
    elHarga.value   = barang.harga;
    elTanggal.value = barang.tanggal;

    invFormTitle.textContent    = '✏️ Edit Paket Diamond';
    invBtnSubmit.textContent   = '💾 Update';
    invBtnBatal.style.display  = 'inline-flex';
    invForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
    clearErrors();
};

const keluarModeEdit = () => {
    editIndex = -1;
    invFormTitle.textContent    = '➕ Tambah Paket Diamond';
    invBtnSubmit.textContent   = '💾 Simpan';
    invBtnBatal.style.display  = 'none';
    invForm.reset();
    clearErrors();
};

invBtnBatal.addEventListener('click', keluarModeEdit);
const bukaDialogHapus = (index) => {
    hapusIndex = index;
    const barang = daftarBarang[index];
    invDialogMsg.textContent = `Apakah kamu yakin ingin menghapus paket "${barang.nama}" (${barang.kode})?`;
    invDialogOverlay.classList.add('show');
};

const tutupDialogHapus = () => {
    hapusIndex = -1;
    invDialogOverlay.classList.remove('show');
};

invBtnKonfirmasi.addEventListener('click', () => {
    if (hapusIndex !== -1) {
        daftarBarang.splice(hapusIndex, 1);
        if (editIndex === hapusIndex) {
            keluarModeEdit();
        } else if (editIndex > hapusIndex) {
            editIndex--;
        }

        simpanKeStorage();
        renderTabel();
    }
    tutupDialogHapus();
});

invBtnBatalHapus.addEventListener('click', tutupDialogHapus);

invDialogOverlay.addEventListener('click', (e) => {
    if (e.target === invDialogOverlay) {
        tutupDialogHapus();
    }
});
invTbody.addEventListener('click', (e) => {
    const target = e.target.closest('.inv-btn-aksi');
    if (!target) return;

    const index = parseInt(target.dataset.index);

    if (target.classList.contains('inv-btn-edit')) {
        masukModeEdit(index);
    } else if (target.classList.contains('inv-btn-hapus')) {
        bukaDialogHapus(index);
    }
});
invInputCari.addEventListener('input', () => {
    renderTabel();
});
invFilterKat.addEventListener('change', () => {
    renderTabel();
});
const inputErrorPairs = [
    [elKode, errKode],
    [elNama, errNama],
    [elKat, errKat],
    [elStok, errStok],
    [elHarga, errHarga],
    [elTanggal, errTanggal]
];

inputErrorPairs.forEach(([inputEl, errEl]) => {
    const eventName = inputEl.tagName === 'SELECT' ? 'change' : 'input';
    inputEl.addEventListener(eventName, () => {
        inputEl.classList.remove('inv-input-error');
        errEl.textContent = '';
    });
});
muatDariStorage();
renderTabel();
