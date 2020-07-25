

<div class="container">
<h1>Csoport összesítő</h1>
<button id="openSzuresBtn" onclick="szures()" style="margin-bottom:10px; margin-top:10px;">Szűrés</button>


<div class="menu" id="szures">
<form>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Gyümölcs típus</label>
    <select class="form-control" onchange="gyumolcsfajta(); gyumolcsterulet()" id="gyumolcs">
    <option></option>
      <option>Meggy</option>
      <option>Cseresznye</option>
      <option>Barack</option>
      <option>Bodza</option>

    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Terület</label>
    <select class="form-control" onchange="teruletfajtak()" id="terulet" >
      <option></option>
      <option>Fűvölgy II</option>
      <option>Fűvölgy III</option>
      <option>Pityor</option>
      <option>Városi erdő</option>
      <option>Cinge</option>
      <option>Sikáros</option>
      <option>Csókahegy</option>
      <option>Kilóméteres</option>
      <option>Hármastarján</option>
      <option>Szíhalom</option>
      <option>Mogyorós</option>
      <option>Ilakalja II.</option>
      <option>Sikáros</option>
      <option>Nyúl</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Fajta</label>
    <select class="form-control"   id="fajta">
    <option></option>
      <option>Érdi</option>
      <option>Debreceni</option>
      <option>Újfehértói</option>
      <option>Kántorjánosi</option>
      <option>Cigánymeggy</option>
      <option>Éva</option>
      <option>Linda</option>
      <option>Katalin</option>
      <option>Van</option>
      <option>Margit</option>
      <option>Vega</option>
      <option>Szomolyai fekete</option>
      <option>Bigareau</option>
      <option>Korda</option>
      <option>Regina</option>
      <option>Kruploplodnaja</option>
      <option>Gönczi kajszi</option>
      <option>Bergeron</option>
      <option>Bergerouge</option>
      <option>Kioto</option>
      <option>Bigred</option>
      <option>Sylred</option>
      <option>Sweet Red</option>
      <option>Pinkcot</option>
      <option>Petri</option>
      <option>Jolika</option>
      <option>Kordia</option>
      <option>Haschberg</option>
      <option>Lilike</option>
      <option>Szomolyai</option>
    </select>
    <label for="exampleFormControlSelect1">Szedés módja</label>
    <select class="form-control"  id="mod">
    <option></option>
      <option>Rázott</option>
      <option>Kézi</option>
      <option>Bérrázás</option>   
    </select>
    </select>
    <label for="exampleFormControlSelect1">Rekesz fajta</label>
    <select class="form-control"  id="rekesz">
    <option></option>
      <option>E24</option>
      <option>M10</option>
      <option>Tartályláda</option>
      <option>Farekesz</option>      
    </select>
</div> 
<label> Szűrés dátumra </label>
  <div>
  <label for="datum1">Ettől:</label>
<input type="date" id="datum1" name="datum1">
<label for="datum2">Eddig:</label>
<input type="date" id="datum2" name="datum2">
</div>
<div style="display:flex; align-items:center; justify-content:center">
<button id="clear" type='button' style="margin-right:5px">Nincs szűrés</button>
<button type='button' onclick="startFiltering()" >Szűrés</button>
</div>

</div><!-- 
<form>
<button type='button' onclick="location.href='<?='?P=page'?>'" style="margin-top:50px; margin-bottom:50px">Vissza</button> 
</form>-->
<?php
$query="SELECT csoport,hely,gyumolcs_tip,terulet,fajta,szedes_mod,raklap.rekesz_fajta,SUM(raklap.rekesz_db) as DB, SUM(raklap.suly) as suly, datum FROM szallitas JOIN raklap ON (szallitas.id = raklap.szallitas_id) WHERE szedes_mod = 'Kézi' GROUP BY hely,gyumolcs_tip,terulet,fajta,rekesz_fajta,szedes_mod,datum,csoport";

require_once DATABASE_CONTROLLER;
$osszesites=getList($query);

?>

<div class="lista">
<?php 
if(count($osszesites)<=0): 
?>
<p> ÜRES </p>
<?php else: ?>									
<div class="lista">
<table class="table-sortable tabla4" id="myTable" style="margin-top:30px;">
  <thead>
    <tr>
      <th scope="col">Sorszám</th>
      <th scope="col">Csoport</th>
      <th scope="col">Gyümölcs</th>
      <th scope="col">Terület</th>
      <th scope="col">Fajta</th>
      <th scope="col">Szedés módja</th>
      <th scope="col">Rekesz fajta</th>
      <th scope="col">DB</th>
      <th scope="col">Súly</th>
      <th scope="col">Helyszín</th>
      <th scope="col">Utolsó szállítás dátuma</th>
  
    </tr>
  </thead>
  
  <tbody>
  <?php $i=0; ?>
  <?php foreach($osszesites as $o) : ?>
    <?php $i++; ?>
    <tr>
      <th scope="row"><?=$i ?></th>
      <td><?=$o['csoport']?></td>
      <td><?=$o['gyumolcs_tip']?></td>
      <td><?=$o['terulet']?></td>
      <td><?=$o['fajta']?></td>
      <td><?=$o['szedes_mod']?></td>
      <td><?=$o['rekesz_fajta']?></td>
      <td><?=$o['DB']?></td>
      <td><?=$o['suly']?></td>
      <td><?=$o['hely']?></td>
      <td><?=$o['datum']?></td>
  
    </tr>
  <?php endforeach; ?>
    </tbody>
    </table>

<?php endif; ?>
</div>
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
var tableArray = [];
function filtering(array,inputstring,index)
{
  var backArray= [];
  var input=document.getElementById(inputstring);
  var filter=input.value.toUpperCase();
  var tr=array;
  for (let indexer = 0; indexer < tr.length; indexer++) {
    if(indexer==0)
    {
      backArray.push(tr[indexer]);
      continue;
    }
    var elem = tr[indexer].getElementsByTagName("td")[index].innerText;
    if (elem.toUpperCase().indexOf(filter)>-1) {
      backArray.push(tr[indexer]);
    }
    
  }
 
  return backArray;
}
function startFiltering()
{
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  tableArray=tr;
//gyumolcs
  if (document.getElementById("gyumolcs").value!='') {
    tableArray=filtering(tableArray,'gyumolcs',0);
    
  }
  //terulet
  if (document.getElementById("terulet").value!='') {
    tableArray=filtering(tableArray,'terulet',1);
  }
  //fajta
  if (document.getElementById("fajta").value!='') {
    tableArray=filtering(tableArray,'fajta',2);
    
  }
  //szmod
  if (document.getElementById("mod").value!='') {
    tableArray=filtering(tableArray,'mod',3);
 
  }
  //rekeszfajta
  if (document.getElementById("rekesz").value!='') {
    tableArray=filtering(tableArray,'rekesz',4);

  }
  
  //előtte
  if(document.getElementById("datum1").value!='')
  {
  let backArray= [];
  let input=document.getElementById('datum1');
  let filter=input.value;
  let dateVal = moment(filter, "YYYY/MM/DD");
  let tr=tableArray;
  for (let indexer = 0; indexer < tr.length; indexer++) {
    if(indexer==0)
    {
      backArray.push(tr[indexer]);
      continue;
    }
    let elem = moment(tr[indexer].getElementsByTagName("td")[9].innerText,"YYYY/MM/DD");
    let visible = (elem.isBefore(dateVal)); 
    if (!visible) {
      backArray.push(tr[indexer]);
    }
  }
  tableArray=backArray;
  }
  //utánna
  if(document.getElementById("datum2").value!='')
  {
  let backArray= [];
  let input=document.getElementById('datum2');
  let filter=input.value;
  let dateVal = moment(filter, "YYYY/MM/DD");
  let tr=tableArray;
  for (let indexer = 0; indexer < tr.length; indexer++) {
    if(indexer==0)
    {
      backArray.push(tr[indexer]);
      continue;
    }
    let elem = moment(tr[indexer].getElementsByTagName("td")[9].innerText,"YYYY/MM/DD");
    let visible = (elem.isAfter(dateVal)); 
    if (!visible) {
      backArray.push(tr[indexer]);
    }
  }
  tableArray=backArray;
  }
  if (tableArray.length==1) {
    for (let index = 1; index < tr.length; index++) {
      tr[index].style.display="none";
      
    }
    return;
  }
  for (let index = 0; index < tr.length; index++) {
    
    if (tableArray.includes(tr[index])) {
      tr[index].style.display="";
    }
    else{
      tr[index].style.display="none";
    }
    
  }
}
var gyumolcsokteruletek = {};
var gyumolcsfajtak ={};

gyumolcsokteruletek[''] = ['','Csókahegy','Nyúl', 'Fűvölgy II', 'Fűvölgy III', 'Cinge', 'Pityor', 'Szíhalom', 'Sikáros', 'Városi erdő', 'Kilométeres','Illakalja','Hármastarján','Mogyorós'];
gyumolcsokteruletek['Meggy'] = ['','Csókahegy','Nyúl', 'Fűvölgy II', 'Fűvölgy III', 'Cinge', 'Pityor', 'Szíhalom', 'Sikáros', 'Városi erdő', 'Kilométeres'];
gyumolcsokteruletek['Bodza'] = ['','Illakalja'];
gyumolcsokteruletek['Barack'] = ['','Csókahegy','Hármastarján'];
gyumolcsokteruletek['Cseresznye'] = ['','Csókahegy', 'Mogyorós', 'Városi erdő','Kilométeres'];
gyumolcsfajtak[''] = ['','Kioto','Pin cot','Bigred','Sylred','Sweet Red','Bergarouge','Bergeron','Gönczi kajszi','Haschberg','Lilike','Cigánymeggy','Kántorjánosi','Debreceni','Újfehértói','Érdi','Petri','Éva','Haschberg','Regina','Katalin','Jolika','Kordia','Linda','Van','Szomolyai','Vega','Bigarreu','Krupnoplodnaja','Margit'];
gyumolcsfajtak['Meggy'] = ['','Cigánymeggy','Petri', 'Kántorjánosi', 'Debreceni', 'Újfehértói', 'Érdi','Éva'];
gyumolcsfajtak['Bodza'] = ['','Haschberg'];
gyumolcsfajtak['Barack'] = ['','Kioto','Pin cot','Bigred','Sylred','Sweet Red','Bergarouge','Bergeron','Gönczi kajszi','Lilike'];
gyumolcsfajtak['Cseresznye'] = ['','Regina', 'Katalin', 'Jolika','Kordia','Linda','Van','Szomolyai','Vega','Bigarreu','Krupnoplodnaja','Margit'];


function gyumolcsterulet() {
  var gyumolcs = document.getElementById("gyumolcs");
  var teruletek = document.getElementById("terulet");
  var gy = gyumolcs.options[gyumolcs.selectedIndex].value;
  while (teruletek.options.length) {
    teruletek.remove(0);
  }
  var select=document.getElementById("terulet");
  for (let index = 0; index < gyumolcsokteruletek[gyumolcs.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=gyumolcsokteruletek[gyumolcs.value][index];
    opt.innerHTML=gyumolcsokteruletek[gyumolcs.value][index];
    select.appendChild(opt);
    }


} 
function gyumolcsfajta() {
  var gyumolcs = document.getElementById("gyumolcs");
  var fajtak = document.getElementById("fajta");
  var gy = gyumolcs.options[gyumolcs.selectedIndex].value;
  while (fajtak.options.length) {
    fajtak.remove(0);
  }
  
  var select2=document.getElementById("fajta");
 
  for (let index = 0; index < gyumolcsfajtak[gyumolcs.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=gyumolcsfajtak[gyumolcs.value][index];
    opt.innerHTML=gyumolcsfajtak[gyumolcs.value][index];
    select2.appendChild(opt);
    }

} 
function teruletgyumolcs() {
  let teruletgyumolcsok={};
  teruletgyumolcsok['']=['','Meggy','Cseresznye','Barack','Bodza'];
  teruletgyumolcsok['Nyúl']=['','Meggy'];
  teruletgyumolcsok['Fűvölgy II']=['','Meggy'];
  teruletgyumolcsok['Fűvölgy III']=['','Meggy'];
  teruletgyumolcsok['Cinge']=['','Meggy'];
  teruletgyumolcsok['Pityor']=['','Meggy'];
  teruletgyumolcsok['Szíhalom']=['','Meggy'];
  teruletgyumolcsok['Sikáros']=['','Meggy'];
  teruletgyumolcsok['Városi erdő']=['','Cseresznye','Meggy'];
  teruletgyumolcsok['Kilométeres']=['','Cseresznye','Meggy'];
  teruletgyumolcsok['Mogyorós']=['','Cseresznye'];
  teruletgyumolcsok['Hármastarján']=['','Barack'];
  teruletgyumolcsok['Illakalja']=['','Bodza'];
  teruletgyumolcsok['Csókahegy']=['','Meggy','Cseresznye','Barack']
  

  var terulet = document.getElementById("terulet");
  var gyumolcsok = document.getElementById("gyumolcs");
  var t = terulet.options[terulet.selectedIndex].value;
 
  while (gyumolcsok.options.length) {
    gyumolcsok.remove(0);
  }




  var select6=document.getElementById("gyumolcs");
  for (let index = 0; index < teruletgyumolcsok[terulet.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=teruletgyumolcsok[terulet.value][index];
    opt.innerHTML=teruletgyumolcsok[terulet.value][index];
    select6.appendChild(opt);
    }



}
function teruletfajtak() {
  let teruletfajtak = {};
teruletfajtak['']=['','Cigánymeggy','Petri', 'Kántorjánosi', 'Debreceni', 'Újfehértói', 'Érdi', 'Petri', 'Éva','Regina', 'Katalin', 'Jolika','Kordia','Linda','Van','Vega','Szomolyai','Bigarreu','Krupnoplodnaja','Margit','Kioto','Hármastarján','Pin cot','Bigred','Sylred','Sweet Red','Bergarouge','Bergeron','Gönczi kajszi','Haschberg','Lilike','Haschberg'];
teruletfajtak['Nyúl'] = ['','Cigánymeggy'];
teruletfajtak['Csókahegy'] =['','Petri','Kántorjánosi','Újfehértói','Debreceni','Cigánymeggy','Regina','Katalin','Jolika','Kordia','Kioto','Pin cot','Bigred','Sylred','Sweet red','Bergarouge','Bergeron'];
teruletfajtak['Fűvölgy II'] =['','Újfehértói','Érdi','Debreceni','Kántorjánosi'];
teruletfajtak['Fűvölgy III'] =['','Újfehértói','Cigánymeggy'];
teruletfajtak['Cinge'] =['','Újfehértói','Kántorjánosi','Cigánymeggy','Érdi'];
teruletfajtak['Pityor'] =['','Érdi','Kántorjánosi','Újfehértói','Debreceni'];
teruletfajtak['Szíhalom'] =['','Újfehértói'];
teruletfajtak['Sikáros'] =['','Kántorjánosi','Cigánymeggy'];
teruletfajtak['Városi erdő'] =['','Érdi','Újfehértói','Bigarreu','Van','Szomolyai'];
teruletfajtak['Kilométeres'] =['','Petri','Kántorjánosi','Újfehértói','Éva','Cigánymeggy','Katalin','Regina','Kordia','Krupnoplopdnaja'];
teruletfajtak['Mogyorós'] =['','Katalin','Linda','Van','Margit','Vega'];
teruletfajtak['Városi erdő'] =['','Bigarreu','Van','Szomolyai'];
teruletfajtak['Hármastarján'] =['','Bergeron','Gönczi kajszi','Lilike'];
teruletfajtak['Illakalja'] =['','Haschberg'];
 
  var terulet = document.getElementById("terulet");
  var fajtak = document.getElementById("fajta");
  var t = terulet.options[terulet.selectedIndex].value;

  while (fajtak.options.length) {
    fajtak.remove(0);
  }
  let gyumolcs = document.getElementById("gyumolcs");
  let gy = gyumolcs.options[gyumolcs.selectedIndex].value;
  if(gy=="Meggy")
  {
    teruletfajtak['Csókahegy'] =['','Petri','Kántorjánosi','Újfehértói','Debreceni','Cigánymeggy'];
    teruletfajtak['Kilométeres'] =['','Petri','Kántorjánosi','Újfehértói','Éva','Cigánymeggy'];
    teruletfajtak['Városi erdő'] =['','Érdi','Újfehértói'];
    teruletfajtak['']=['','Cigánymeggy','Petri', 'Kántorjánosi', 'Debreceni', 'Újfehértói', 'Érdi', 'Petri', 'Éva'];
  }
  else if(gy=="Cseresznye")
  {
    teruletfajtak['Csókahegy'] =['','Regina','Katalin','Jolika','Kordia'];
    teruletfajtak['Városi erdő'] =['','Bigarreu','Van','Szomolyai'];
    teruletfajtak['Kilométeres'] =['','Katalin','Regina','Kordia','Krupnoplopdnaja'];
    teruletfajtak['']=['','Regina', 'Katalin', 'Jolika','Kordia','Linda','Van','Vega','Szomolyai','Bigarreu','Krupnoplodnaja','Margit'];
  }
  else if(gy=="Barack")
  {
    teruletfajtak['Csókahegy'] =['','Kioto','Pin cot','Bigred','Sylred','Sweet red','Bergarouge','Bergeron'];
    teruletfajtak['']=['','Kioto','Pin cot','Bigred','Sylred','Sweet Red','Bergarouge','Bergeron','Gönczi kajszi','Haschberg','Lilike'];

  }
  else if(gy=="Bodza")
  {
    teruletfajtak['']=['','Haschberg'];

  }
  else
  {
    teruletfajtak['Csókahegy'] =['','Petri','Kántorjánosi','Újfehértói','Debreceni','Cigánymeggy','Regina','Katalin','Jolika','Kordia','Kioto','Pin cot','Bigred','Sylred','Sweet red','Bergarouge','Bergeron'];
    teruletfajtak['Kilométeres'] =['','Petri','Kántorjánosi','Újfehértói','Éva','Cigánymeggy','Katalin','Regina','Kordia','Krupnoplopdnaja'];
    teruletfajtak['Városi erdő'] =['','Érdi','Újfehértói','Bigarreu','Van','Szomolyai'];

  }
  

  
  
  var select3=document.getElementById("fajta");
 
  for (let index = 0; index < teruletfajtak[terulet.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=teruletfajtak[terulet.value][index];
    opt.innerHTML=teruletfajtak[terulet.value][index];
    select3.appendChild(opt);
    }

} 


function fajtaterulet() {
  let fajtateruletek={};
fajtateruletek['']=['','Csókahegy','Nyúl', 'Fűvölgy II', 'Fűvölgy III', 'Cinge', 'Pityor', 'Szíhalom', 'Sikáros', 'Városi erdő', 'Kilométeres','Illakalja','Hármastarján','Mogyorós'];
fajtateruletek['Cigánymeggy']=['','Nyúl','Csókahegy','Fűvölgy III','Cinge','Sikáros','Kilométeres'];
fajtateruletek['Petri']=['','Csókahegy','Kilométeres'];
fajtateruletek['Kántorjánosi']=['','Csókahegy','Fűvölgy II','Cinge','Sikáros','Kilométeres','Pityor'];
fajtateruletek['Újfehértói']=['','Csókahegy','Fűvölgy II','Fűvölgy III','Cinge','Kilométeres','Pityor','Városi erdő','Szíhalom'];
fajtateruletek['Debreceni']=['','Csókahegy','Fűvölgy II','Pityor'];
fajtateruletek['Érdi']=['','Cinge','Fűvölgy II','Pityor','Városi erdő'];
fajtateruletek['Éva']=['','Kilométeres'];
fajtateruletek['Regina']=['','Csókahegy','Kilométeres'];
fajtateruletek['Katalin']=['','Csókahegy','Kilométeres','Mogyorós'];
fajtateruletek['Jolika']=['','Csókahegy'];
fajtateruletek['Linda']=['','Mogyorós'];
fajtateruletek['Van']=['','Mogyorós','Városi erdő'];
fajtateruletek['Margit']=['','Mogyorós'];
fajtateruletek['Vega']=['','Mogyorós'];
fajtateruletek['Bigarreu']=['','Városi erdő'];
fajtateruletek['Szomolyai']=['','Városi erdő'];
fajtateruletek['Kordia']=['','Csókahegy','Kilométeres'];
fajtateruletek['Krupnoplopdnaja']=['','Kilométeres'];
fajtateruletek['Kioto']=['','Csókahegy'];
fajtateruletek['Pin cot']=['','Csókahegy'];
fajtateruletek['Bigred']=['','Csókahegy'];
fajtateruletek['Sylred']=['','Csókahegy'];
fajtateruletek['Sweet Red']=['','Csókahegy'];
fajtateruletek['Bergarogue']=['','Csókahegy'];
fajtateruletek['Bergeron']=['','Csókahegy','Hármastarján'];
fajtateruletek['Gönczi kajszi']=['','Hármastarján'];
fajtateruletek['Haschberg']=['','Illakalja'];
fajtateruletek['Lilike']=['','Hármastarján'];

  var fajtak = document.getElementById("fajta");
  var teruletek = document.getElementById("terulet");
  var f = fajtak.options[fajtak.selectedIndex].value;
  if(teruletek.selectedIndex>0)
  {
    return;
  }
  while (teruletek.options.length) {
    teruletek.remove(0);
  }




  var select4=document.getElementById("terulet");
  for (let index = 0; index < fajtateruletek[fajtak.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=fajtateruletek[fajtak.value][index];
    opt.innerHTML=fajtateruletek[fajtak.value][index];
    select4.appendChild(opt);
    }



}
function fajtagyumolcs() {
  let fajtagyumolcsok={};
fajtagyumolcsok['']=['','Meggy','Cseresznye','Barack','Bodza'];
fajtagyumolcsok['Cigánymeggy']=['','Meggy'];
fajtagyumolcsok['Petri']=['','Meggy'];
fajtagyumolcsok['Kántorjánosi']=['','Meggy'];
fajtagyumolcsok['Újfehértói']=['','Meggy'];
fajtagyumolcsok['Debreceni']=['','Meggy'];
fajtagyumolcsok['Érdi']=['','Meggy'];
fajtagyumolcsok['Éva']=['','Meggy'];
fajtagyumolcsok['Regina']=['','Cseresznye'];
fajtagyumolcsok['Katalin']=['','Cseresznye'];
fajtagyumolcsok['Jolika']=['','Cseresznye'];
fajtagyumolcsok['Linda']=['','Cseresznye'];
fajtagyumolcsok['Van']=['','Cseresznye'];
fajtagyumolcsok['Margit']=['','Cseresznye'];
fajtagyumolcsok['Vega']=['','Cseresznye'];
fajtagyumolcsok['Bigarreu']=['','Cseresznye'];
fajtagyumolcsok['Szomolyai']=['','Cseresznye'];
fajtagyumolcsok['Kordia']=['','Cseresznye'];
fajtagyumolcsok['Krupnoplodnaja']=['','Cseresznye'];
fajtagyumolcsok['Kioto']=['','Barack'];
fajtagyumolcsok['Pin cot']=['','Barack'];
fajtagyumolcsok['Bigred']=['','Barack'];
fajtagyumolcsok['Sylred']=['','Barack'];
fajtagyumolcsok['Sweet Red']=['','Barack'];
fajtagyumolcsok['Bergarogue']=['','Barack'];
fajtagyumolcsok['Bergeron']=['','Barack'];
fajtagyumolcsok['Gönczi kajszi']=['','Barack'];
fajtagyumolcsok['Haschberg']=['','Bodza'];
fajtagyumolcsok['Lilike']=['','Barack'];

  var fajtak = document.getElementById("fajta");
  var gyumolcsok = document.getElementById("gyumolcs");
  var f = fajtak.options[fajtak.selectedIndex].value;
  while (gyumolcsok.options.length) {
    gyumolcsok.remove(0);
  }




  var select5=document.getElementById("gyumolcs");
  for (let index = 0; index < fajtagyumolcsok[fajtak.value].length; index++) {
    let opt = document.createElement('option');
    opt.value=fajtagyumolcsok[fajtak.value][index];
    opt.innerHTML=fajtagyumolcsok[fajtak.value][index];
    select5.appendChild(opt);
    }
select5.selectedIndex=0;


}

function szures() {
  var x = document.getElementById("szures");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function showAll(){
    var $rows = $('#myTable tr');
  $rows.show();
  var dropDown = document.getElementById("gyumolcs");
        dropDown.selectedIndex = 0;
  var dropDown = document.getElementById("terulet");
        dropDown.selectedIndex = 0;
 var dropDown = document.getElementById("fajta");
        dropDown.selectedIndex = 0;
        var dropDown = document.getElementById("mod");
        dropDown.selectedIndex = 0;
        var dropDown = document.getElementById("rekesz");
        dropDown.selectedIndex = 0;
        document.getElementById("datum1").value = "";
        document.getElementById("datum2").value = "";
        let teruletek = document.getElementById("terulet");
  while (teruletek.options.length) {
    teruletek.remove(0);
  }
  let fajtak = document.getElementById("fajta");
  while (fajtak.options.length) {
    fajtak.remove(0);
  }
  let gyumolcs = document.getElementById("gyumolcs");
  while (gyumolcs.options.length) {
    gyumolcs.remove(0);
  }
//területek
 let optionteruletek=document.createElement("option");
  optionteruletek.value="";
  optionteruletek.innerHTML="";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Fűvölgy II";
  optionteruletek.innerHTML="Fűvölgy II";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Fűvölgy III";
  optionteruletek.innerHTML="Fűvölgy III";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Cinge";
  optionteruletek.innerHTML="Cinge";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Pityor";
  optionteruletek.innerHTML="Pityor";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Szíhalom";
  optionteruletek.innerHTML="Szíhalom";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Csókahegy";
  optionteruletek.innerHTML="Csókahegy";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Nyúl";
  optionteruletek.innerHTML="Nyúl";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Sikáros";
  optionteruletek.innerHTML="Sikáros";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Városi erdő";
  optionteruletek.innerHTML="Városi erdő";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Kilométeres";
  optionteruletek.innerHTML="Kilométeres";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Mogyorós";
  optionteruletek.innerHTML="Mogyorós";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Hármastarján";
  optionteruletek.innerHTML="Hármastarján";
  teruletek.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Illakalja";
  optionteruletek.innerHTML="Illakalja";
  teruletek.appendChild(optionteruletek);
  
//gyümölcsök
  optionteruletek=document.createElement("option");
  optionteruletek.value="";
  optionteruletek.innerHTML="";
  gyumolcs.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Meggy";
  optionteruletek.innerHTML="Meggy";
  gyumolcs.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Cseresznye";
  optionteruletek.innerHTML="Cseresznye";
  gyumolcs.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Barack";
  optionteruletek.innerHTML="Barack";
  gyumolcs.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Bodza";
  optionteruletek.innerHTML="Bodza";
  gyumolcs.appendChild(optionteruletek);
//fajtak
optionteruletek=document.createElement("option");
  optionteruletek.value="";
  optionteruletek.innerHTML="";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Cigánymeggy";
  optionteruletek.innerHTML="Cigánymeggy";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Petri";
  optionteruletek.innerHTML="Petri";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Kántorjánosi";
  optionteruletek.innerHTML="Kántorjánosi";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Újfehértói";
  optionteruletek.innerHTML="Újfehértói";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Debreceni";
  optionteruletek.innerHTML="Debreceni";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Érdi";
  optionteruletek.innerHTML="Érdi";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Éva";
  optionteruletek.innerHTML="Éva";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Regina";
  optionteruletek.innerHTML="Regina";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Katalin";
  optionteruletek.innerHTML="Katalin";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Jolika";
  optionteruletek.innerHTML="Jolika";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Kordia";
  optionteruletek.innerHTML="Kordia";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Linda";
  optionteruletek.innerHTML="Linda";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Van";
  optionteruletek.innerHTML="Van";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Margit";
  optionteruletek.innerHTML="Margit";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Vega";
  optionteruletek.innerHTML="Vega";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Bigarreu";
  optionteruletek.innerHTML="Bigarreu";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Szomolyai";
  optionteruletek.innerHTML="Szomolyai";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Krupnoplodnaja";
  optionteruletek.innerHTML="Krupnoplodnaja";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Kioto";
  optionteruletek.innerHTML="Kioto";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Pin cot";
  optionteruletek.innerHTML="Pin cot";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Bigred";
  optionteruletek.innerHTML="Bigred";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Sylred";
  optionteruletek.innerHTML="Sylred";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Sweet Red";
  optionteruletek.innerHTML="Sweet Red";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Bergarouge";
  optionteruletek.innerHTML="Bergarouge";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Gönczi kajszi";
  optionteruletek.innerHTML="Gönczi kajszi";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Haschberg";
  optionteruletek.innerHTML="Haschberg";
  fajtak.appendChild(optionteruletek);
  optionteruletek=document.createElement("option");
  optionteruletek.value="Lilike";
  optionteruletek.innerHTML="Lilike";
  fajtak.appendChild(optionteruletek);

}
var osszes = $('#clear');
osszes.click(showAll);
</script>
