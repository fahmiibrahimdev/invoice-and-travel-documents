window.livewire.on("dataStore", () => {
    $("#tambahDataModal").modal("hide");
    $("#tambahDataModalType").modal("hide");
    $("#tambahDataModalCashDetail").modal("hide");
    $("#tambahDataCustomerModal").modal("hide");
    $("#ubahDataModal").modal("hide");
});
window.livewire.on("dataDetailStore", () => {
    $("#tambahDataModalCashDetail").modal("hide");
});
window.addEventListener("swal:modal", function () {
    Swal.fire({
        title: event.detail.message,
        html: event.detail.html,
        text: event.detail.text,
        icon: event.detail.type,
    });
});
window.addEventListener("swal", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "Jika kamu menghapus data tersebut, datanya tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("deleteConfirmed");
            Swal.fire("Deleted!", "Data Berhasil Dihapus", "success");
        }
    });
});
window.addEventListener("swalDetail", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "Jika kamu cancel data tersebut, datanya tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("deleteConfirmedDetail");
        }
    });
});
window.addEventListener("swalCancel", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "Jika kamu cancel data tersebut, datanya tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("cancelConfirmed");
        }
    });
});
window.addEventListener("swal:unactive", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "Anda ingin menonaktifkan akun ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Unactive it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("unactiveConfirmed");
            Swal.fire(
                "Non-Actived!",
                "User Berhasil Dinonaktifkan!",
                "success"
            );
        }
    });
});
window.addEventListener("swal:active", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "Anda ingin mengaktifkan akun ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Active it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("activeConfirmed");
            Swal.fire("Actived!", "User Berhasil Diaktifkan!", "success");
        }
    });
});
window.addEventListener("swal:unconfirm", function () {
    Swal.fire({
        title: "Are you sure?",
        text: "You want non-active it?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Unconfirm it!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("unkonfirmasiConfirmed");
            Swal.fire(
                "Non-Actived!",
                "User Berhasil Dinon-confirm!",
                "success"
            );
        }
    });
});
window.addEventListener("swal:konfirmasi", function () {
    Swal.fire({
        title: "Perhatikan!",
        text: "Apa anda yakin file ini sudah selesai produksi? Jika klik OK maka data tidak bisa diedit kembali!.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Saya setuju!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("konfirmasiConfirmed");
            Swal.fire("Success!", "Data berhasil diupdate!", "success");
        }
    });
});
window.addEventListener("swal:konfirmasiTaking", function () {
    Swal.fire({
        title: "Perhatikan!",
        text: "Pembayaran belum lunas!, Apakah anda tetap ingin melakukan proses pengambilan barang?.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Saya setuju!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("konfirmasiConfirmed");
            Swal.fire("Success!", "Data berhasil diupdate!", "success");
        }
    });
});
window.addEventListener("swal:konfirmasiTakingAgree", function () {
    Swal.fire({
        title: "Perhatikan!",
        text: "Apakah anda yakin ingin melakukan proses pengembalian barang?.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Saya setuju!",
    }).then((result) => {
        if (result.isConfirmed) {
            livewire.emit("konfirmasiConfirmed");
            Swal.fire("Success!", "Data berhasil diupdate!", "success");
        }
    });
});
