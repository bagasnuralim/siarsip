<?php
    //cek session
    if(!empty($_SESSION['admin'])){
?>

<noscript>
    <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
</noscript>

<!-- Footer START -->
<footer class="page-footer">
    <div class="container">
           <div class="row">
               <br/>
           </div>
    </div>
    <div class="footer-copyright blue-grey darken-1 white-text">
        <div class="container" id="footer">
         
                <span class="white-text">IT Inaba</span>
                
          
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="asset/js/jquery.autocomplete.min.js"></script>
<script data-pace-options='{ "ajax": false }' src='asset/js/pace.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    //detail surat public
    
    //jquery dropdown
    $(".dropdown-button").dropdown({ hover: false });

    //jquery sidenav on mobile
    $('.button-collapse').sideNav({
        menuWidth: 240,
        edge: 'left',
        closeOnClick: true
    });

    //jquery datepicker
    $('#tgl_surat,#batas_waktu,#dari_tanggal,#sampai_tanggal').pickadate({
        selectMonths: true,
        selectYears: 10,
        format: "yyyy-mm-dd"
    });

    //jquery teaxtarea
    $('#isi_ringkas').val('');
    $('#isi_ringkas').trigger('autoresize');

    //jquery dropdown select dan tooltip
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 10});

    //jquery autocomplete
    $( "#kode" ).autocomplete({
        serviceUrl: "kode.php",   // Kode php untuk prosesing data.
        dataType: "JSON",           // Tipe data JSON.
        onSelect: function (suggestion) {
            $( "#kode" ).val(suggestion.kode);
        }
    });

    $( "#referensi_surat" ).autocomplete({
        serviceUrl:"referensi_surat_masuk.php", // suratmasuk php untuk prossesing data.
        dataType:"JSON",
        onSelect:function(suggestion){
            $( "#referensi_surat" ).val(suggestion.referensi_surat);
        }
    });

    $( "#referensi_suratk" ).autocomplete({
        serviceUrl:"referensi_surat_keluar.php",
        dataType:"JSON",
        onSelect:function(suggestion){
            $( "#referensi_suratk" ).val(suggestion.referensi_suratk);
        }
    });


    //jquery untuk menampilkan pemberitahuan
    $("#alert-message").alert().delay(5000).fadeOut('slow');

    //jquery modal
    $('.modal-trigger').leanModal();
 });
function detailsm()
{
    Swal.fire('Any fool can use a computer')
}

</script>
<!-- Javascript END -->

<?php
    } else {
        header("Location: ../");
        die();
    }
?>
