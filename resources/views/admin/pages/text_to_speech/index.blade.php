@extends('admin.main')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Units X2T english</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Units X2T english</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Text to speech example</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form class="col-md-12">
                        <div class="row">
                            <label>Choose voice</label>
                            <select id="voices" class="form-control"></select>
                        </div>
                        <div class="row">
                            <div class="col ">
                                <label>Rate</label>
                                <p class="range-field">
                                    <input type="range" id="rate" min="1" max="100" value="10" />
                                </p>
                            </div>
                            <div class="col ">
                                <label>Pitch</label>
                                <p class="range-field">
                                    <input type="range" id="pitch" min="0" max="2" value="1" />
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="message" class="materialize-textarea form-control" ></textarea>
                                <label>Write message</label>
                            </div>
                        </div>
                        <a href="javascript:void(0)" id="speak" class="waves-effect waves-light btn btn-secondary">Speak</a>
                    </form>
                </div>

                <div id="modal1" class="modal">
                    <h4>Speech Synthesis not supported</h4>
                    <p>Your browser does not support speech synthesis.</p>
                    <p>We recommend you use Google Chrome.</p>
                    <div class="action-bar">
                        <a href="javascript:void(0)" class=" btn-flat modal-action modal-close">Close</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('script')
    <script type="text/javascript">
        $(function(){
            if ('speechSynthesis' in window) {
                speechSynthesis.onvoiceschanged = function() {
                    var $voicelist = $('#voices');

                    if($voicelist.find('option').length == 0) {
                        speechSynthesis.getVoices().forEach(function(voice, index) {
                            var $option = $('<option>')
                                .val(index)
                                .html(voice.name + (voice.default ? ' (default)' :''));

                            $voicelist.append($option);
                        });

                        $voicelist.material_select();
                    }
                }

                $('#speak').click(function(){
                    var text = $('#message').val();
                    var msg = new SpeechSynthesisUtterance();
                    var voices = window.speechSynthesis.getVoices();
                    msg.voice = voices[$('#voices').val()];
                    msg.rate = $('#rate').val() / 10;
                    msg.pitch = $('#pitch').val();
                    msg.text = text;
                    msg.onend = function(e) {
                        console.log('Finished in ' + event.elapsedTime + ' seconds.');
                    };
                    speechSynthesis.speak(msg);
                })
            } else {
                $('#modal1').openModal();
            }
        });
    </script>
@endpush
