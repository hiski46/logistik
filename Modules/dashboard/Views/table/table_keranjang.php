<table class="table table-striped">
    <thead>
        <tr>
            <td>Nama Material</td>
            <td>Jumlah</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($keranjang as $k) { ?>
            <tr>
                <td><?= $material[$k['material']]  ?></td>
                <td><?= $k['jumlah'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>