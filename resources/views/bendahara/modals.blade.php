<!-- Modal untuk Bukti Pembayaran -->
<div class="modal fade" id="cairModal" tabindex="-1" role="dialog" aria-labelledby="cairModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cairModalLabel">Konfirmasi Pencairan Dana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cairForm" method="POST" action="{{ route('bendahara.updateCair') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="pengajuId" name="pengaju_id"> <!-- ID Pengajuan -->
                    <input type="hidden" name="id_statusdana" value="1"> <!-- Status Cair -->

                    <div class="form-group">
                        <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>