@if(session('hapuscart'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "Hapus Data Keranjang Berhasil",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "red",
	}).showToast();
</script>
@endif
@if(session('konsumen_lengkapi'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "Update Biodata Berhasil",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "#4fbe87",
	}).showToast();
</script>
@endif

@if(session('upload'))
<script type="text/javascript">
	document.getElementById('success');
	Swal.fire({
		icon: "success",
		title: "Berhasil Upload Bukti Transfer",
		text: "Tunggu Konfirmasi dari Pihak Toko.",
	});
</script>
@endif

@if(session('confirm_konsumen'))
<script type="text/javascript">
	document.getElementById('top-right');
	Toastify({
		text: "Confirm Barang Berhasil.",
		duration: 3000,
		close:true,
		gravity:"top",
		position: "right",
		backgroundColor: "#4fbe87",
	}).showToast();
</script>
@endif