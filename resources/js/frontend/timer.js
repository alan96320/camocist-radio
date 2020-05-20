export const timeWatcher = {
    data: {
        times: [],
        animateFrame: 0,
        nowTime: 0,
        diffTime: 0,
        startTime: 0,
        isRunning: false
    },
    methods: {
        // Ganti nomor yang diteruskan dalam argumen dari waktu saat ini untuk startTime
        setSubtractStartTime: function (time) {
            var time = typeof time !== 'undefined' ? time : 0;
            this.startTime = Math.floor(performance.now() - time);
        },
        // Mulai timer
        startTimer: function () {
            console.log('test')
            // Disimpan karena nilai ini diubah dalam loop ()
            var vm = this;
            vm.setSubtractStartTime(vm.diffTime);
            // Pengolahan lingkaran
            (function loop() {
                vm.nowTime = Math.floor(performance.now());
                vm.diffTime = vm.nowTime - vm.startTime;
                vm.animateFrame = requestAnimationFrame(loop);
            }());
            vm.isRunning = true;
        },
        // Hentikan timer
        stopTimer: function () {
            this.isRunning = false;
            cancelAnimationFrame(this.animateFrame);
        },
        // Tambahkan waktu selama pengukuran ke array
        pushTime: function () {
            this.times.push({
                hours: this.hours,
                minutes: this.minutes,
                seconds: this.seconds,
                milliSeconds: this.milliSeconds
            });
        },
        // Inisialisasi
        clearAll: function () {
            this.startTime = 0;
            this.nowTime = 0;
            this.diffTime = 0;
            this.times = [];
            this.stopTimer();
            this.animateFrame = 0;
        }
    },
    computed: {
        // hitung waktu
        hours: function () {
            return Math.floor(this.diffTime / 1000 / 60 / 60);
        },
        // Hitung pecahan (kembali ke 0 menit ketika 60 menit)
        minutes: function () {
            return Math.floor(this.diffTime / 1000 / 60) % 60;
        },
        // Hitung jumlah detik (ketika mencapai 60 detik, itu kembali ke 0 detik)
        seconds: function () {
            return Math.floor(this.diffTime / 1000) % 60;
        },
        // Hitung jumlah milidetik (kembali ke 0 ms ketika 1000 ms tercapai)
        milliSeconds: function () {
            return Math.floor(this.diffTime % 1000);
        }
    },
    filters: {
        // Filter Isi Nol Masukkan jumlah digit dalam argumen
        // ※ String.prototype.padStart() Tidak bisa digunakan di IE
        zeroPad: function (value, num) {
            var num = typeof num !== 'undefined' ? num : 2;
            return value.toString().padStart(num, "0");
        }
    }
}