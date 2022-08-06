<form id="form_tambah_material" action="<?= base_url('material/save') ?>" method="post">
    <?php if ($material) { ?>
        <input type="hidden" value="<?= $material['id'] ?>" name="id">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="material" name="material" value="<?= $material['material'] ?>" readonly>
            <label for="material">Nama Material</label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" id="stok" name="stok" value="<?= $material['stok'] ?>" required>
            <label for="stok">Stok</label>
        </div>
    <?php } else { ?>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="material" name="material" placeholder="Masukkan nama maerial" required>
            <label for="material">Nama Material</label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>
            <label for="stok">Stok</label>
        </div>
    <?php } ?>
</form>

<script>
    function save() {
        $('#form_tambah_material').submit();
    }
</script>