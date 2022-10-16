<form class="row g-3" action="{{ route('irs.update', $data->semester_aktif) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="nim" value="{{ $data->nim }}">
    <div class="col-12">
        <label class="form-label text-dark">SKS</label>
        <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" placeholder="Jumlah SKS" value="{{ $data->sks }}" required>
    </div>
    <div class="col-12">
        <input class="form-check-input" type="checkbox" id="confirm" name="confirm">
        <label class="form-check-label" for="confirm">
            Ulangi scan IRS?
        </label>
    </div>
    <div class="col-12" id="dropzone">
        <label class="form-label">Scan IRS</label>
        <div class="dropzone" style="height: 160px;">
            <input type="file" class="filepond" id="fileEdit" name="fileEdit" data-allow-reorder="true">
        </div>
        <div class="text-danger small fst-italic mt-2 mb-0">*Format file [.pdf], pastikan file yang diupload benar.</div>
        <div class="small fst-italic mt-0">File baru akan menimpa file sebelumya.</div>
    </div>
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-sm btn-primary mb-0">Edit</button>
        <button type="button" class="btn btn-sm btn-secondary mb-0" data-bs-dismiss="modal">Batal</button>
    </div>
</form>

<!-- Load FilePond library -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond@4.17.1/dist/filepond.js"></script>

<!-- Turn all file input elements into ponds -->
<script>
    $(document).ready(function() {
        $('#dropzone').hide();
        $('#confirm').click(function() {
            if ($(this).is(':checked')) {
                $('#dropzone').show();
            } else {
                $('#dropzone').hide();
            }
        });
    });
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    FilePond.create(document.getElementById('fileEdit'), {
        maxParallelUploads: 1,
        maxFileSize: "15MB",
        acceptedFileTypes: ['application/pdf'],
        labelIdle: '<br/><div class="avatar avatar-sm"><a class="link"><img class="avatar-img" src="{{ asset("assets/images/upload.png") }}" alt=""></a></div><br/><span class="link">Upload File</span><br/>',
        stylePanelAspectRatio: 0.2,
    });

    // Send the files to the Controller
    FilePond.setOptions({
        server: {
            url: '/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>