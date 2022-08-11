<form id="form_tambah_checkout" action="<?= base_url('checkout/save') ?>" method="post">
    <div class="form-floating mb-3">
        <select class="form-select" id="material" name="material" aria-label="Floating label select example">
            <?php foreach ($material as $m) { ?>
                <option value="<?= $m['id'] ?>"><?= $m['material'] ?>|| (<?= $m['stok'] ?>) </option>
            <?php } ?>
        </select>
        <label for="material">Nama Material</label>
    </div>
    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="stok_awal" name="stok_awal" value="" readonly>
        <label for="stok_awal">Stok Sekarang</label>
    </div> -->

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="" required>
        <label for="jumlah">Jumlah Checkout</label>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#material').change(function() {
            id = $(this).children().attr()
            alert(id);
            $('#stok_awal').val(id);
        })
    })

    function save() {
        $('#form_tambah_checkout').submit();
    }
</script>