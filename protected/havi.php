<div class="container">
<form>
<button type='button' onclick="location.href='<?='?P=page'?>'" style="margin-top:50px; margin-bottom:50px">Vissza</button>
</form>
</div>
<?php
$query="SELECT gyumolcs_tip,terulet,fajta,szedes_mod,raklap.rekesz_fajta,SUM(raklap.rekesz_db) as DB, SUM(raklap.suly) as suly, datum FROM szallitas JOIN raklap ON (szallitas.id = raklap.szallitas_id) WHERE  GROUP BY gyumolcs_tip,terulet,fajta,rekesz_fajta,szedes_mod,datum";

require_once DATABASE_CONTROLLER;
$osszesites=getList($query);

?>


<?php 
if(count($osszesites)<=0): 
?>
<p> ÜRES </p>
<?php else: ?>									
<div class="lista">
<table class="table-sortable">
  <thead>
    <tr>
      <th scope="col">Sorszám</th>
      <th scope="col">Gyümölcs</th>
      <th scope="col">Terület</th>
      <th scope="col">Fajta</th>
      <th scope="col">Szedés módja</th>
      <th scope="col">Rekesz fajta</th>
      <th scope="col">DB</th>
      <th scope="col">Súly</th>
      <th scope="col">Dátum</th>
  
    </tr>
  </thead>
  
  <tbody>
  <?php $i=0; ?>
  <?php foreach($osszesites as $o) : ?>
    <?php $i++; ?>
    <tr>
      <th scope="row"><?=$i ?></th>
      <td><?=$o['gyumolcs_tip']?></td>
      <td><?=$o['terulet']?></td>
      <td><?=$o['fajta']?></td>
      <td><?=$o['szedes_mod']?></td>
      <td><?=$o['rekesz_fajta']?></td>
      <td><?=$o['DB']?></td>
      <td><?=$o['suly']?></td>
      <td><?=$o['datum']?></td>
  
    </tr>
  <?php endforeach; ?>
    </tbody>
    </table>

<?php endif; ?>
</div>
</div>
<script>
function sortTableByColumn(table, column, asc = true) {
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

   
    const sortedRows = rows.sort((a, b) => {
        const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

   
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

   
    tBody.append(...sortedRows);

 
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".table-sortable th").forEach(headerCell => {
    headerCell.addEventListener("click", () => {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
    });
});
</script>