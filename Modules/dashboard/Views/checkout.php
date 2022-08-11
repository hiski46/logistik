<h1>Checkout</h1>

<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>History Checkout</h5>
        </div>
        <div class="float-end">
            <button onclick="tambahCheckout()" class="btn btn-sm btn-primary">Tambah</button>
        </div>
    </div>
    <div class="card-body">
        <table id="table-checkout" class="stripe hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jumlah Chekout</th>
                    <th>Stok Awal</th>
                    <th>Stok Akhir</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1">

</div>

<script>
    $(document).ready(function() {
        $('#table-checkout').DataTable({
            searching: true,
            responsive: true,
            ajax: "<?= base_url('checkout/list_checkout'); ?>"
        })
    })

    function tambahCheckout() {
        $.ajax({
            url: "<?= base_url('checkout/formTambahCheckout') ?>",
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }
</script>