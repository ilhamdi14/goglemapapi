<?= $this->extend('layout'); ?>

<?= $this->section('page-content'); ?>
<div class="container mt-5">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Awal</th>
      <th scope="col">Tujuan</th>
      <th scope="col">Jarak</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; ?>
      <?php foreach($history as $h): ?> 
    <tr>
      <th scope="row"><?= $i++;?></th>
      <td><?= $h['awal'];?></td>
      <td><?= $h['tujuan'];?></td>
      <td><?= $h['jarak'];?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>


<?= $this->endSection(); ?>