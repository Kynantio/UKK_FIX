@extends('template_admin.template_admin')
@section('title', '[Pengaduan Masyarakat] - Pengaduan')
@section('container')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengaduan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <div class="panel-body">
            @if(Session::get('alert_message'))
                <div class="alert alert-success">
                  <strong>{{Session::get('alert_message')}}</strong>
                </div>
            @endif

            @if(Session('level')=='admin')
            <div class="col-sm-12 col-md-6">
            <!-- <a href="/pengaduan/cetak_pdf_pengaduan" class="btn btn-primary btn-sm btn-center-block" target="_blank">Cetak Laporan</a> -->
            <button id="cetak" href="/pengaduan/cetak_pdf_pengaduan" class="btn btn-primary btn-sm btn-center-block" target="_blank">Cetak Laporan</button>
            <br>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <br>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Nama Pengadu</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                            <th>Tanggal Tanggapan</th>
                            <th>Tanggapan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $no=0; @endphp
                    @foreach($data_tanggapan as $data)
                    @php $no++; @endphp
                    <tbody>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->tgl_pengaduan}}</td>
                            <td>{{$data->masyarakat->nama}}</td>
                            <td>{{$data->isi_laporan}}</td>
                            <td><img src="{{url('/images/'.$data->foto)}}"  style="max-width: 40px"></td>
                            <td>
                            @foreach($data->tanggapan as $tanggapan)
                                <li>{{$tanggapan->tgl_tanggapan}}</li> 
                            @endforeach
                            </td>
                            <td>
                            @foreach($data->tanggapan as $tanggapan)
                            <div class="w-100 d-flex justify-content-between">
                            <span>{{$tanggapan->tanggapan}}</span> 
                            <a href="{{url('/tanggapan/edit/'. $tanggapan->id_tanggapan)}}">
                            <i class="fas fa-fw fa-pen ml-auto"></i>
                            </div>
                            </a>
                            @endforeach
                            </td>
                            <td>{{$data->status}}</td>
                            <td>
                            <a href="{{url('/tanggapan/create/' . $data->id_pengaduan)}}" class="btn btn-success btn-sm btn-center-block">Tanggapan</a> 
                            <a href="{{url('/pengaduan/edit/'. $data->id_pengaduan)}}" class="btn btn-warning btn-sm btn-center-block">Ganti Status</a>
                            <a href="/pengaduan/hapus/{{ $data->id_pengaduan }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data?')">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </div>
            </div>
            </div>
            </div>
            </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script>
    const originalDocument = $(document);
    $('#cetak').click(() => {
    $('.navbar-nav').remove();
        window.print();
        window.location.reload();
    })
    </script>
@stop

