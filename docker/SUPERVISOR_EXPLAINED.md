# Penjelasan Supervisor Configuration

## 📋 Struktur File supervisord.conf

### [supervisord]
```ini
nodaemon=true
```
**Fungsi:** Menjalankan supervisord di foreground (tidak sebagai daemon)
**Kenapa:** Docker butuh process utama yang jalan terus. Kalau supervisord jadi daemon, container akan langsung exit.

```ini
logfile=/dev/stdout
logfile_maxbytes=0
```
**Fungsi:** Log supervisor dikirim ke stdout (console)
**Kenapa:** Docker best practice - semua log ke stdout/stderr agar bisa dilihat via `docker logs`

```ini
pidfile=/tmp/supervisord.pid
```
**Fungsi:** File PID disimpan di /tmp
**Kenapa:** /tmp selalu writable, hindari permission issues

```ini
loglevel=info
```
**Fungsi:** Level log yang ditampilkan
**Opsi:** debug, info, warn, error, critical

---

### [program:laravel-server]
**Tugas:** Menjalankan web server Laravel

```ini
command=php /var/www/artisan serve --host=0.0.0.0 --port=8000
```
**Fungsi:** 
- `php artisan serve` = Laravel development server
- `--host=0.0.0.0` = Listen di semua network interface (bisa diakses dari luar container)
- `--port=8000` = Port yang digunakan

**Catatan:** `artisan serve` simple tapi production-ready. Untuk traffic tinggi, pakai nginx+php-fpm.

```ini
directory=/var/www
```
**Fungsi:** Working directory saat command dijalankan

```ini
autostart=true
autorestart=true
startretries=3
```
**Fungsi:**
- `autostart=true` → Start otomatis saat supervisord jalan
- `autorestart=true` → Restart otomatis kalau crash
- `startretries=3` → Coba 3x kalau gagal start

```ini
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
```
**Fungsi:** Redirect semua output ke console Docker
**Benefit:** Bisa lihat log via `docker logs <container_name>`

```ini
stopwaitsecs=10
```
**Fungsi:** Tunggu 10 detik sebelum force kill saat stop
**Kenapa:** Kasih waktu Laravel graceful shutdown

---

### [program:laravel-queue]
**Tugas:** Menjalankan queue worker untuk background jobs

```ini
command=php /var/www/artisan queue:work --sleep=3 --tries=3 --max-time=3600 --timeout=3600
```
**Fungsi:**
- `queue:work` → Process jobs dari queue (database, Redis, SQS, dll)
- `--sleep=3` → Tunggu 3 detik kalau queue kosong (hemat CPU)
- `--tries=3` → Retry job 3x kalau gagal
- `--max-time=3600` → Worker restart setiap 1 jam (prevent memory leak)
- `--timeout=3600` → Max waktu eksekusi 1 job = 1 jam

```ini
process_name=%(program_name)s_%(process_num)02d
numprocs=2
```
**Fungsi:** Jalankan 2 worker secara paralel
- Worker 1: `laravel-queue_00`
- Worker 2: `laravel-queue_01`

**Benefit:** Bisa process multiple jobs sekaligus

```ini
stopasgroup=true
killasgroup=true
```
**Fungsi:** Saat stop, kill semua child processes
**Kenapa:** Queue worker bisa spawn child processes, harus di-kill semua

```ini
stopwaitsecs=3600
```
**Fungsi:** Tunggu 1 jam sebelum force kill
**Kenapa:** Kasih waktu job selesai (timeout job = 1 jam)

---

### [program:laravel-scheduler]
**Tugas:** Jalankan cron scheduler Laravel

```ini
command=bash -c "while true; do php /var/www/artisan schedule:run --verbose --no-interaction & sleep 60; done"
```
**Fungsi:** 
- `while true` → Loop forever
- `schedule:run` → Check & run scheduled tasks
- `& sleep 60` → Run in background, tunggu 60 detik
- Equivalent dengan cron: `* * * * * php artisan schedule:run`

**Benefit:** Tidak perlu setup cron di container

---

## 🎯 Ringkasan Fungsi

| Program | Fungsi | Process Count |
|---------|--------|---------------|
| **laravel-server** | Web server (HTTP) | 1 |
| **laravel-queue** | Background jobs | 2 (parallel) |
| **laravel-scheduler** | Cron tasks | 1 |

**Total:** 4 processes berjalan simultan dalam 1 container

---

## 🔄 Flow Kerja

1. **Container start** → Supervisord jalan
2. **Supervisord** → Start 3 programs
3. **laravel-server** → Handle HTTP requests (port 8000)
4. **laravel-queue** → Process jobs dari database queue
5. **laravel-scheduler** → Cek & jalankan scheduled tasks tiap menit
6. **Semua log** → Ke stdout/stderr → Bisa dilihat via `docker logs`

---

## 🚀 Keuntungan Setup Ini

✅ **Simple:** Satu container untuk web + queue + scheduler
✅ **Reliable:** Auto-restart kalau crash
✅ **Scalable:** Bisa tambah numprocs untuk queue worker
✅ **Debuggable:** Semua log terpusat di stdout
✅ **Production-ready:** Queue & scheduler jalan otomatis

---

## 🛠️ Cara Monitor

```bash
# Lihat semua log
docker logs -f <container_name>

# Lihat status processes
docker exec <container_name> supervisorctl status

# Restart specific program
docker exec <container_name> supervisorctl restart laravel-queue:*

# Stop specific program
docker exec <container_name> supervisorctl stop laravel-scheduler
```

---

## ⚙️ Tuning untuk Production

### Tambah Queue Workers (lebih banyak paralel processing)
```ini
numprocs=5  # Dari 2 jadi 5 workers
```

### Kurangi Memory Leak (restart lebih sering)
```ini
command=php artisan queue:work --sleep=3 --tries=3 --max-time=1800  # 30 menit
```

### Priority Queue (urgent queue dulu)
```ini
command=php artisan queue:work --queue=high,default,low --tries=3
```

---

## 🎨 Kenapa Tailwind/Style Kebaca?

1. **Build Time:** `npm run build` → Generate assets ke `public/build/`
2. **Runtime:** `php artisan serve` → Serve file dari `public/`
3. **Vite Manifest:** Laravel load CSS/JS via manifest di `public/build/manifest.json`
4. **Result:** Semua style & script kebaca sempurna! ✨
