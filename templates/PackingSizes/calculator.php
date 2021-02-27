<table class="packing-results">
    <thead>
        <tr>
            <th>Pack Size</th>
            <th>Number of Packs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($packingResults as $packSize => $packs): ?>
            <tr>
                <td><?= $packSize ?></td>
                <td><?= $packs ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
