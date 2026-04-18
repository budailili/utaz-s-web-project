<div class="card">
    <h2>Szállodák listája</h2>
    <table style="width: 100%; border-collapse: collapse;">
<tbody>
<?php foreach($szallodak as $s): ?>
<tr>
    <td><?= htmlspecialchars($s['az']) ?></td>
    <td><?= htmlspecialchars($s['nev']) ?></td>
    <td><?= htmlspecialchars($s['besorolas']) ?> csillag</td>
    <td><?= htmlspecialchars($s['tengerpart_tav']) ?> m</td>

    <td class="actions">
       

        <form method="POST" style="display:inline;">
            <input type="hidden" name="delete_id" value="<?= $s['az'] ?>">
            <button class="btn btn-delete" onclick="return confirm('Biztos?')">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<div class="card">
    <form method="POST">
        <h3><?= isset($_GET['action']) && $_GET['action']=='edit' ? 'Szerkesztés' : 'Új hozzáadása' ?></h3>
        
        <input type="text" name="az" placeholder="ID (pl. BS)" required>
        <input type="text" name="nev" placeholder="Szálloda neve" required>
        <input type="number" name="besorolas" placeholder="Csillagok" max="5" min="1" required>
        <input type="number" name="tengerpart_tav" placeholder="Távolság (m)" required>
        
        <?php if(isset($_GET['action']) && $_GET['action'] == 'add'): ?>
            <input type="hidden" name="uj" value="1">
        <?php endif; ?>
        
        <button type="submit" name="mentes">Mentés</button>
    </form>
</div>
