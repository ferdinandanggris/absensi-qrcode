<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>
  <body>
    <div class="container">
        <h1>Test QR-Code</h1>
        <div class="row">
            <div class="col-lg-6 mt-3">
                <form action="" method="post" id="form-qrcode">
                      
                    <div class="mb-3 form-group row">
                        <label for="kategori-pelajaran" class="col-form-label col-sm-2">Kategori Pelajaran</label>
                        <div class="col-sm-10">
                            <select class="custom-select" aria-label="Default select example" name="kategori-pelajaran" id="kategori-pelajaran">
                                
                                <option value="matematika">Matematika</option>
                                <option value="ipa">IPA</option>
                                <option value="fisika">Fisika</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-group row">
                        <label for="kelas" class="col-form-label col-sm-2">Kelas</label>
                        <div class="col-sm-10">
                            <select class="custom-select" aria-label="Default select example" name="kelas" id="kelas">
                                
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-group row">
                        <label for="kelas" class="col-form-label col-sm-2">Guru</label>
                        <div class="col-sm-10">
                            <select class="custom-select" aria-label="Default select example" name="kelas" id="kelas">
                                
                                <option value="ernin">Ernin</option>
                                <option value="widya">Widya</option>
                                <option value="desi">Desi</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 form-group row">
                        <label for="murid" class="col-form-label col-sm-2">Murid</label>
                        <div class="col-sm-10">
                            <select class="custom-select js-example-basic-multiple" name="murid[]" id="murid" aria-label="Default select example" multiple="multiple">
                                <option value="toni" selected>Toni</option>
                                <option value="agoes">Agoes</option>
                                <option value="santoso">Santoso</option>
                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                       <button type="submit" class="col mx-3 btn btn-primary float-right">Submit</button>
                    </div>
                    
                </form>

                <div  class="mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">
                                QR-Code Generate
                            </h5>
                        </div>
                        <div class="card-body text-center" id="qrcode-generate">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <div style="width: 400px" id="reader"></div>  
                <div class="card mt-3" id="qrcode" style="visibility: hidden">
                    <div class="card-header">
                        Hasil Qr - Code
                    </div>
                    <div class="card-body">
                        <p>Text :</p> <span id="isi-qrcode"></span>
                    </div>
                </div>  
            </div>

        </div>
    </div>


    <script src="js/qrcode.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {         
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.js-example-basic-multiple').select2({
                placeholder: 'Select an option'
            });


            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                $("#qrcode").css('visibility','visible');
                decodedText = JSON.parse(decodedText);
                console.log(`Scan result: ${decodedText}`, decodedResult);
                $("#isi-qrcode").html(
                    "Kategori Pelajaran : "+ decodedText.kategori_pelajaran +
                    "<br>Kelas : "+ decodedText.kelas + " <br> "+
                   " Murid : " + decodedText.murid.toString() +"<br>"
                );
                alert(`Kategori Pelajaran : ${decodedText.kategori_pelajaran}
                Kelas : ${decodedText.kelas}
                Murid : ${decodedText.murid}
                `)
            }

            function onScanError(errorMessage) {
                // handle on error condition, with error message
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanError);

            
            $( "#form-qrcode").submit(function( event ) {
                
                // alert( "Handler for .submit() called." );
                $.post("test-qrcode",
                    {
                        kategori_pelajaran : $('#kategori-pelajaran').val(),
                        kelas : $('#kelas').val(),
                        guru : $('#guru').val(),
                        murid : $('#murid').val(),
                    },
                    ).done(function(data){
                        alert('Data berhasil di generate dalam bentuk qr-code');
                        $("#qrcode-generate").html(data);
                    })

                event.preventDefault();
            });
        })
      

    
    </script>
  </body>
</html>